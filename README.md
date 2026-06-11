# Placement Management System

A web-based Placement Management System developed using **CodeIgniter 4**, **PHP**, **MySQL**, **HTML**, **CSS**, **JavaScript**, and **Bootstrap**. The system is designed to streamline campus placement activities by managing students, companies, placement drives, applications, resumes, and notifications through a centralized platform.

## Features

### Admin Module

* Admin Authentication
* Dashboard with Statistics
* Manage Companies
* Manage Departments
* Create and Manage Placement Drives
* View Student Profiles
* Manage Student Applications
* View Uploaded Resumes
* Password Reset System

### Student Module

* Student Authentication
* Dashboard
* Profile Management
* View Placement Drives
* Apply for Placement Drives
* Upload Resume
* View Application Status
* Notifications

## Technology Stack

* Backend: PHP (CodeIgniter 4)
* Database: MySQL
* Frontend: HTML, CSS, Bootstrap, JavaScript
* Version Control: Git & GitHub

## Database Modules

* Users
* Students
* Departments
* Companies
* Placement Drives
* Applications
* Resumes
* Notifications
* Password Resets

## Project Structure

```text
app/
├── Controllers/
├── Models/
├── Views/
├── Database/
│   ├── Migrations/
│   └── Seeds/

public/
├── uploads/
│   └── resumes/

writable/
vendor/
```

## Installation

### Clone Repository

```bash
git clone https://github.com/your-username/placement-management-system.git
```

### Move into Project

```bash
cd placement-management-system
```

### Install Dependencies

```bash
composer install
```

### Configure Environment

Copy the environment file and configure database credentials.

```bash
cp env .env
```

Update:

```env
database.default.hostname = localhost
database.default.database = your_database_name
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

### Run Migrations

```bash
php spark migrate
```

### Start Development Server

```bash
php spark serve
```

Application URL:

```text
http://localhost:8080
```

## Future Enhancements

* Placement Analytics Dashboard
* Email Notifications
* Excel/PDF Report Generation
* Student Eligibility Checker
* Company-wise Placement Statistics
* Interview Scheduling
* Campus Recruitment Tracking

## Author

Dipanshu

B.Tech Student | Akal University

## License

This project is developed for educational and academic purposes.
