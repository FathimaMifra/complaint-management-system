# AI-Powered Complaint Management System - Development Plan

**Institution:** ESOFT Metro Campus, London Metropolitan University   
**Tech Stack:** Laravel 10.x (PHP/MySQL/Blade/Filament for frontend/backend/auth/dashboard), Python (Flask for REST API, NLP with supervised neural network via scikit-learn/TensorFlow/NLTK), Guzzle for API integration.  
**Goal:** Develop an efficient, AI-driven system to automate complaint prioritization and sentiment analysis for institutions like universities/residential complexes, targeting 85%+ NLP accuracy, reducing manual intervention, and providing real-time admin insights.

This plan integrates **full project requirements** extracted from the proposal (all chapters) and interim report. Requirements are categorized into Functional (core features), Non-Functional (performance/usability), Resources (hardware/software/dataset), Deliverables, and Timeline (project plan). Phases now reference these explicitly for Cursor AI prompts.

## Full Project Requirements

### 1. Aim and Objectives (From Proposal Chapter 4)
**Aim:** To develop an AI-powered complaint management system using Laravel and Python that automates the prioritization of complaints based on sentiment analysis, enhancing response efficiency and user satisfaction in institutional settings.

**Objectives:**
- Design and implement a user-friendly Laravel-based frontend for complaint submission and authentication.
- Integrate a Python-based NLP model to classify sentiments (Negative, Neutral, Positive) and map to priorities (High, Medium, Low: Negative→High, Neutral→Medium, Positive→Low).
- Build a Filament admin dashboard for monitoring, filtering, responding, and analytics (trends, resolution time).
- Ensure real-time processing to highlight critical issues, bypassing manual delays.
- Evaluate system performance (e.g., NLP accuracy ≥85%) and scalability for institutional use.

### Introduction (From Proposal Chapter 1 - Full Verbatim Text)
To reach the user satisfaction and assure the efficiency of the functioning of the institution, the example of universities and residential complexes gets the necessity of the effective complaint management. Traditional systems, such as manual ticketing or simple systems, like Zendesk, rely a lot on human resources to prioritize and solve issues, which causes delays and important urgent matters are overlooked.

A Complaint Management System based on AI-Powered model includes Laravel as a robust web-based platform with the Natural Language Processing (NLP) model developed in Python to assess the complaints and classify the level of priority (High, Medium, Low) in regards to the sentiments in new sentiment classes (Negative, Neutral, Positive) and mapping attitudes to the level of priority (Negative - High, Neutral - Medium, Positive - Low). The users, i.e., students or residents, will be able to make a complaint via a Laravel-based frontend connecting to a Python-based REST API performing text analysis to issue priority and sentiment predictions. A Laravel Filament dashboard is used by the administrators to monitor, filter, and respond to complaints with the assistance of analytics on trending and resolution time.

The given approach enhances the efficiency of the responses by automating the prioritization process and indicating the critical issues in real time, bypassing the inefficiency of manual systems.

### Abstract (From Interim Report - Full Verbatim Text)
The following interim report describes the creation of an artificial intelligence-driven complain management system that would optimize the process of complaint management in institutional facilities, including universities, by computerizing the priority of complaints and sentiment detection, and, as a result, decreasing the use of manual algorithms. The system is characterized by a powerful Laravel 10.x front, where it is possible to register users, have variants of logging in, and an administrative panel based on Filament and rallied with a MySQL database, which allows storing and retrieving data effectively. The NLP element is based on a supervised neural network model with an accuracy of about 80-85% on sentiment classification (Negative, Neutral, Positive) and priority mapping (High, Medium, Low). It is served through a Flask REST server, and it is connected to the Larval backend. Limitations caused by the size of the dataset and hyperparameter optimization are challenges and still affect prediction accuracy. The project is within the scheduled timeline with the present development of a working prototype, including user submission, AI prediction, and analytics with an administrator. The current efforts are aimed at enhancing the precision of the AI model, introducing sentiment-based analytics, providing search and resolution-tracking features, and considering the integration of the mobile app. This system is built based on the knowledge of the developer in Laravel, Python and Artificial Intelligence and will be an intelligent, easy to use system meant to automate the process of prioritizing complaints, sentiment analysis and responsiveness of the institution.

### 2. Functional Requirements (From Proposal Chapters 1, 3, 5; Interim Work Completed/Further Work)
[Existing content unchanged - already covers core features, admin, AI integration, workflow, future enhancements.]

### 3. Non-Functional Requirements (Inferred/From Proposal Chapters 2, 3, 5.4)
[Existing content unchanged.]

**Problem Addressed (Chapter 3):** [Reference to pasted TOC; expand if needed via Cursor prompt.]

**Why This Solution (5.4):** [Existing.]

### 4. System Architecture (From Proposal 5.1 & Figure 1)
[Existing; add note: Reference pasted List of Figures for Relational Database Diagram.]

### 5. Resource Requirements (From Proposal Chapter 6)
[Existing.]


### List of Figures (From Proposal & Interim PDFs - Combined Verbatim)
- **Proposal:** Figure 1: Relational Database Diagram (p.10); Figure 2: Gantt Chart (p.19).
- **Interim:** Figure 1: Home Page (p.9); Figure 2: Layout page code (p.10); Figure 3: Home page code (p.10); Figure 4: Register page (p.11); Figure 5: Register page front end code (p.11); Figure 6: Controller code for the register page (p.12); Figure 7: Complaints Table Migration code for Database (p.13); Figure 8: AI Analysis Table Migration code for Database (p.13); Figure 9: User Table Migration code for Database (p.14); Figure 10: Complaint Submit page (p.15); Figure 11: User Home page (p.15); Figure 12: Admin Login page (p.16); Figure 13: Admin Dashboard Complaint Management (p.16); Figure 14: Admin Table view of the Complaints (p.17).

**Progress Review (From Interim Chapter 5):** On track (prototype with submission/AI stub); no major delays. Monitor NLP accuracy. (Reference pasted Interim Contents for full structure.)


## Risks & Mitigation
[Existing.]
