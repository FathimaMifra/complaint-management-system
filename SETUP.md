# Complaint Management System Setup Guide

## Overview

This is a Laravel-based complaint management system with role-based access control and AI-powered complaint analysis.

## Features

-   **Role-based Access Control**: Admin, Manager, and User roles
-   **AI Analysis**: Automatic sentiment and urgency analysis of complaints
-   **Filament Admin Panel**: For administrators
-   **Custom Dashboard**: For regular users and managers
-   **Complaint Management**: Full CRUD operations with role-based permissions

## User Roles and Permissions

### Admin

-   Full access to all complaints
-   Can edit and delete complaints
-   Access to Filament admin panel
-   Can manage users and settings

### Manager

-   Can view all complaints
-   Can create and edit complaints
-   Cannot delete complaints
-   Access to custom dashboard

### User

-   Can view only their own complaints
-   Can create complaints
-   Cannot edit or delete complaints
-   Access to custom dashboard

## Setup Instructions

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Setup

```bash
php artisan migrate
php artisan db:seed

php artisan migrate:fresh --seed
```

### 4. Set up Roles and Permissions

```bash
php artisan setup:roles-permissions
```

### 5. Start AI Service (Optional)

If you want to use AI analysis:

```bash
cd /path/to/ai_model.py
python ai_model.py
```

### 6. Build Assets

```bash
npm run build
```

### 7. Start the Application

```bash
php artisan serve
```

## Default Users

After running the seeder, you'll have these default users:

-   **Admin**: admin@example.com / password
-   **User**: user@example.com / password
-   **Manager**: manager@example.com / password

## Login and Redirection

### Admin Users

-   Login at: `/login`
-   Redirected to: Filament admin panel (`/admin`)
-   Can access custom dashboard at: `/dashboard`

### Regular Users & Managers

-   Login at: `/login`
-   Redirected to: Custom dashboard (`/dashboard`)
-   Cannot access Filament admin panel

## Routes

### Public Routes

-   `/` - Welcome page
-   `/login` - Login page
-   `/register` - Registration page

### Protected Routes

-   `/dashboard` - Custom dashboard (role-based content)
-   `/complaints` - Complaint listing
-   `/complaints/create` - Create complaint
-   `/complaints/{id}` - View complaint
-   `/complaints/{id}/edit` - Edit complaint (Admin/Manager only)
-   `/profile` - User profile

### Admin Routes

-   `/admin` - Filament admin panel (Admin only)

## AI Analysis

The system includes AI-powered analysis that provides:

-   **Sentiment Analysis**: Positive/Negative sentiment detection
-   **Urgency Detection**: High/Low urgency classification
-   **Category Classification**: Service/Billing/Product/Other
-   **Confidence Score**: Analysis confidence percentage

## File Structure

```
app/
├── Http/Controllers/
│   ├── ComplaintController.php    # Main complaint controller
│   └── Auth/                     # Authentication controllers
├── Models/
│   ├── User.php                  # User model with roles
│   └── Complaint.php             # Complaint model
├── Services/
│   └── AiAnalysisService.php     # AI analysis service
└── Filament/Admin/               # Filament admin panel
    └── Resources/
        └── ComplaintResource.php  # Filament complaint resource

resources/views/
├── complaints/                   # Complaint views
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── show.blade.php
│   └── edit.blade.php
├── dashboard.blade.php           # Custom dashboard
└── auth/                        # Authentication views
```

## Troubleshooting

### Common Issues

1. **Permission Denied Errors**

    - Run: `php artisan setup:roles-permissions`
    - Check if user has proper role assigned

2. **AI Analysis Not Working**

    - Ensure Python AI service is running
    - Check network connectivity to localhost:5001

3. **Filament Admin Panel Not Accessible**

    - Ensure user has 'Admin' role
    - Check `canAccessPanel` method in User model

4. **Database Issues**
    - Run: `php artisan migrate:fresh --seed`
    - Check database connection in `.env`

## Security Features

-   CSRF protection on all forms
-   Role-based access control
-   Input validation and sanitization
-   SQL injection protection via Eloquent ORM
-   XSS protection via Blade templating

## Customization

### Adding New Roles

1. Add role in `SetupRolesAndPermissions` command
2. Assign permissions to the role
3. Update controllers for role-specific logic

### Adding New Permissions

1. Add permission name to the permissions array
2. Assign to appropriate roles
3. Use `@can` directive in views or `can()` method in controllers

### Customizing AI Analysis

Modify `ai_model.py` to add new analysis features or change the API response format.
