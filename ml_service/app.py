from flask import Flask, request, jsonify
import joblib
import os
import traceback
import numpy as np
import re
import pandas as pd

# Configuration
MODEL_PATH = "sentiment_model.pkl"
VECTORIZER_PATH = "tfidf_vectorizer.pkl"

# Load trained model and vectorizer
if not os.path.exists(MODEL_PATH) or not os.path.exists(VECTORIZER_PATH):
    raise FileNotFoundError(f"Model files not found at {MODEL_PATH} or {VECTORIZER_PATH}")

model = joblib.load(MODEL_PATH)
vectorizer = joblib.load(VECTORIZER_PATH)

app = Flask(__name__)

# Define cleaning function (same as used in training)
def clean_text(text):
    if not isinstance(text, str) or pd.isna(text):
        return ""
    text = text.lower()
    text = re.sub(r'[^\w\s!,.?]', '', text)
    text = ' '.join(text.split())
    return text

@app.route("/analyze", methods=["POST"])
def analyze():
    try:
        data = request.get_json()
        text = data.get("text", "").strip()

        if not text:
            return jsonify({"error": "No text provided"}), 400
        if not isinstance(text, str):
            return jsonify({"error": "Text must be a string"}), 400

        # Preprocess text consistently with training
        text_clean = clean_text(text)

        # Vectorize and predict
        features = vectorizer.transform([text_clean]).toarray()

        # Keras gives probability distribution directly
        prediction_raw = model.predict(features)
        probabilities = prediction_raw[0]

        confidence = float(np.max(probabilities))

        # Class index
        prediction = [int(np.argmax(probabilities))]

        # Map prediction to sentiment (lowercase for consistency with Laravel)
        sentiment_map = {0: "negative", 1: "neutral", 2: "positive"}
        sentiment = sentiment_map.get(prediction[0], "neutral")

        # Map sentiment to priority (lowercase)
        priority_map = {0: "high", 1: "medium", 2: "low"}
        priority = priority_map.get(sentiment)

        return jsonify({
            "prediction": prediction,
            "sentiment": sentiment,
            "urgency": priority,
            "confidence": confidence,
            "category": data.get("category", "unknown")
        })

    except Exception as e:
        return jsonify({
            "error": f"Error processing request: {str(e)}",
            "trace": traceback.format_exc()
        }), 500

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5001, debug=False)
