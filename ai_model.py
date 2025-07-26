from transformers import pipeline
import re
from flask import Flask, request, jsonify

# Initialize sentiment analysis model
sentiment_analyzer = pipeline("sentiment-analysis", model="distilbert-base-uncased-finetuned-sst-2-english")

# Rule-based categorization
def categorize_complaint(text):
    categories = {
        'service': ['service', 'support', 'staff', 'customer service'],
        'billing': ['billing', 'payment', 'charge', 'invoice'],
        'product': ['product', 'item', 'defective', 'quality']
    }
    text = text.lower()
    for category, keywords in categories.items():
        if any(keyword in text for keyword in keywords):
            return category
    return 'other'

# Rule-based urgency detection
def detect_urgency(text):
    urgent_keywords = ['urgent', 'immediately', 'critical', 'emergency']
    text = text.lower()
    return 'high' if any(keyword in text for keyword in urgent_keywords) else 'low'

# Analyze complaint
def analyze_complaint(text):
    sentiment_result = sentiment_analyzer(text)[0]
    sentiment = sentiment_result['label'].lower()
    confidence = sentiment_result['score']
    category = categorize_complaint(text)
    urgency = detect_urgency(text)
    return {
        'sentiment': sentiment,
        'confidence': confidence,
        'category': category,
        'urgency': urgency
    }

# Flask API
app = Flask(__name__)

@app.route('/analyze', methods=['POST'])
def analyze():
    data = request.json
    text = data.get('text', '')
    if not text:
        return jsonify({'error': 'No text provided'}), 400
    result = analyze_complaint(text)
    return jsonify(result)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5001)
