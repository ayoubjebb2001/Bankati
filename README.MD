# BANKATI - Banking Management System

## Overview
BANKATI is a modern web-based banking management system built with PHP following the MVC architecture pattern. It provides comprehensive banking functionalities for both administrators and clients.

## Architecture
The application follows the MVC (Model-View-Controller) design pattern:

BANKATI/
├── Controllers/
|   └── # Application logic & data flow control
├── Models/ 
|   └── # Database interactions & business logic
├── Views/
|   └── # User interface templates
├── config/
|   └── # Configuration files
├── core/ 
|   └── # Core framework files
└── public/
    └──# Public assets & entry point

## Key Features

### Admin Dashboard
- Client Management (CRUD operations)
- Account Management
- Transaction Monitoring
- Activity Statistics
- Account Status Management

### Client Portal
- Account Overview
- Fund Transfers
- Transaction History
- Profile Management
- Account Settings

## Technologies Used
- PHP 8.1+
- MySQL
- JavaScript
- TailwindCSS
- SweetAlert2
- Lucide Icons

## Installation Steps

1. Clone the repository
`bash`
`git clone` (https://github.com/yourusername/bankati.git)

2. Configure database
Create MySQL database named 'BANKATI'
Import script.sql for database structure
Update database credentials in database.php

3. Install Dependencies
`npm install`

4. Build assets 
`npm run build`

5. Start local development server
`php -S localhost:8000 -t public`

## Default Access
- Admin:
-- Email: admin@admin.ma
-- Password: admin
- Client:
-- Default password: 123456

## Project Structure

BANKATI/
├── Controllers/
│   ├── AccountController.php
│   ├── AdminController.php
│   ├── AuthController.php
│   ├── BaseController.php
│   └── ClientController.php
├── Models/
│   ├── Account.php
│   ├── Transaction.php
│   └── User.php
├── Views/
│   ├── admin/
│   ├── user/
│   └── partials/
└── public/
    ├── assets/
    │   ├── css/
    │   ├── js/
    │   └── img/
    └── index.php

## Features In Detail

- Authentication
-- Secure login system
-- Session management
-- Role-based access control
- Account Management
-- Create checking/savings accounts
-- Account status monitoring
-- Balance tracking
-- Transaction history
- Transaction Operations
-- Deposits
-- Withdrawals
-- Account transfers
-- Transaction tracking
- Security Features
-- Session-based authentication
-- Password hashing
-- SQL injection prevention
-- XSS protection
