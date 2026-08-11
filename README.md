<p align="center">
<a href="https://laravel.com" target="_blank">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</a>
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# VoteCount - Online College Voting System

## About the Project

**VoteCount** is a web-based **Online College Voting System** developed using **PHP, Laravel, MySQL, Blade, HTML, CSS, and JavaScript** as part of my MCA learning journey.

The system is designed to digitize the college election process by allowing students to register, log in, view active elections, select candidates, and cast their votes online. Administrators can manage elections, candidates, students, and voting information through an admin dashboard.

This project helped me understand how Laravel can be used to build a structured, database-driven web application using MVC architecture, authentication, Eloquent ORM, migrations, validation, and CRUD operations.

---

## Project Objectives

* Develop a digital platform for college elections.
* Simplify the student voting process.
* Provide separate student and administrator modules.
* Manage elections and candidates efficiently.
* Store voting information in a MySQL database.
* Learn Laravel MVC architecture and Eloquent ORM.
* Gain practical experience in full-stack web development.

---

## Features

### Student Module

* Student Registration
* Student Login
* Student Logout
* Student Profile
* Roll Number-Based Authentication
* Department Information

### Voting Module

* View Active Elections
* View Candidate Information
* Candidate Photo Display
* Candidate Department and Manifesto
* Select Candidate
* Cast Vote
* Vote Confirmation
* Protected Voting Routes

### Election Management

* Create Election
* View Elections
* Manage Election Information
* Manage Active Elections

### Candidate Management

* Add Candidate
* View Candidates
* Delete Candidate
* Assign Candidate to Election
* Candidate Department
* Candidate Manifesto
* Candidate Photo Upload

### Admin Module

* Admin Login
* Admin Logout
* Admin Dashboard
* Student Statistics
* Voting Statistics
* Candidate Statistics
* Election Statistics
* Candidate Management
* Election Management

### Result Module

* Display Election Results
* Display Candidate Vote Counts
* Identify Leading Candidate
* Visual Result Chart
* Candidate-wise Voting Statistics

---

## Technologies Used

| Technology   | Purpose                   |
| ------------ | ------------------------- |
| PHP 8.2+     | Backend Programming       |
| Laravel 12   | Web Application Framework |
| Blade        | Template Engine           |
| MySQL        | Database                  |
| Eloquent ORM | Database Operations       |
| HTML5        | Web Page Structure        |
| CSS3         | Styling                   |
| JavaScript   | Client-Side Functionality |
| Bootstrap    | User Interface            |
| Composer     | PHP Dependency Management |
| Vite         | Frontend Asset Management |
| Git & GitHub | Version Control           |
| Docker       | Containerization Support  |

---

## Project Architecture

```text
                         User
                           |
             +-------------+-------------+
             |                           |
             v                           v
        Student Portal              Admin Portal
             |                           |
             v                           v
       Authentication              Admin Authentication
             |                           |
             v                           v
       Voting System            Election & Candidate
             |                    Management
             |                           |
             +-------------+-------------+
                           |
                           v
                  Laravel Application
                           |
                           v
                      Eloquent ORM
                           |
                           v
                     MySQL Database
```

The project follows the **MVC (Model-View-Controller)** architecture provided by Laravel.

* **Models** handle database entities and relationships.
* **Views** are implemented using Blade templates.
* **Controllers** handle application logic.
* **Routes** define application endpoints.
* **Eloquent ORM** manages database operations.

---

## Project Modules

### Authentication Module

The authentication system provides separate access for students and administrators.

Student authentication includes:

* Registration
* Login
* Logout
* Password Hashing
* Roll Number Validation
* Email Validation

Admin authentication includes:

* Admin Login
* Admin Logout
* Protected Admin Routes

---

### Election Management Module

Administrators can manage college elections through the admin dashboard.

Features include:

* Create Election
* View Elections
* Manage Election Information
* Associate Candidates with Elections

---

### Candidate Management Module

Administrators can manage candidates participating in elections.

Features include:

* Add Candidate
* Candidate Name
* Department
* Manifesto
* Candidate Photo
* Election Assignment
* Delete Candidate

---

### Voting Module

Students can participate in an active election through the ballot interface.

The voting process is:

```text
Student Login
      |
      v
Active Election
      |
      v
View Candidates
      |
      v
Select Candidate
      |
      v
Confirm Vote
      |
      v
Submit Vote
      |
      v
Store Vote in Database
```

---

### Result Module

The result module provides voting statistics after votes are recorded.

It includes:

* Candidate Vote Count
* Leading Candidate
* Election Result Cards
* Visual Vote Chart
* Candidate-wise Results

---

## Database Design

The application uses a relational MySQL database to store students, administrators, elections, candidates, and votes.

### Main Tables

| Table      | Purpose                          |
| ---------- | -------------------------------- |
| students   | Stores student information       |
| admins     | Stores administrator information |
| elections  | Stores election information      |
| candidates | Stores candidate information     |
| votes      | Stores voting records            |
| users      | Laravel user authentication      |

---

## Project Structure

```text
VoteCount
│
├── app
│   ├── Http
│   │   └── Controllers
│   │       ├── AdminController.php
│   │       ├── AuthController.php
│   │       ├── Controller.php
│   │       └── VoteController.php
│   │
│   ├── Models
│   │   ├── Admin.php
│   │   ├── Candidate.php
│   │   ├── Election.php
│   │   ├── Student.php
│   │   ├── User.php
│   │   └── Vote.php
│   │
│   └── Providers
│
├── bootstrap
├── config
│
├── database
│   ├── factories
│   ├── migrations
│   └── seeders
│
├── public
│
├── resources
│   ├── css
│   ├── js
│   └── views
│       ├── admin
│       ├── auth
│       ├── layouts
│       └── vote
│
├── routes
│   ├── console.php
│   └── web.php
│
├── storage
├── tests
│
├── .env.example
├── composer.json
├── Dockerfile
├── entrypoint.sh
├── package.json
├── vite.config.js
└── README.md
```

---

## Application Workflow

### Student Workflow

```text
Registration
     |
     v
Login
     |
     v
View Active Election
     |
     v
View Candidates
     |
     v
Select Candidate
     |
     v
Confirm Vote
     |
     v
Vote Submitted
```

### Admin Workflow

```text
Admin Login
     |
     v
Admin Dashboard
     |
     +----> Manage Elections
     |
     +----> Manage Candidates
     |
     +----> View Students
     |
     +----> View Voting Statistics
     |
     v
Manage Election System
```

---

## Laravel Concepts Covered

* MVC Architecture
* Routing
* Controllers
* Models
* Eloquent ORM
* Blade Templates
* Authentication
* Middleware
* Form Validation
* Database Migrations
* Model Relationships
* Password Hashing
* File Upload
* Session Management
* CSRF Protection
* CRUD Operations
* Route Protection

---

## Getting Started

### Prerequisites

Make sure the following are installed:

* PHP 8.2 or later
* Composer
* MySQL
* Node.js and npm
* Git
* VS Code or another PHP IDE
* XAMPP, Laragon, or another PHP development environment

---

## Installation

Clone the repository:

```bash
git clone https://github.com/shubhamgangurde58/VoteCount-Online-College-Voting-System.git
```

Navigate to the project:

```bash
cd VoteCount-Online-College-Voting-System
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the Laravel application key:

```bash
php artisan key:generate
```

---

## Database Configuration

Create a MySQL database and update the `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Run the migrations:

```bash
php artisan migrate
```

---

## File Storage

For candidate image uploads, create the Laravel storage link:

```bash
php artisan storage:link
```

---

## Run the Application

Start the Laravel server:

```bash
php artisan serve
```

Start the Vite development server:

```bash
npm run dev
```

Open the application:

```text
http://127.0.0.1:8000
```

---

## Testing

Run Laravel tests using:

```bash
php artisan test
```

---

## Learning Outcomes

Through this project, I gained practical experience in:

* PHP Programming
* Laravel Framework
* MVC Architecture
* Eloquent ORM
* MySQL Database Management
* Authentication and Authorization
* CRUD Operations
* Form Validation
* Database Migrations
* Blade Templates
* File Upload Handling
* Session Management
* Git & GitHub
* Full-Stack Web Development

---

## Future Improvements

I plan to enhance this project by adding:

* Email Verification
* OTP-Based Authentication
* One-Vote-Per-Election Validation
* Advanced Admin Analytics
* Election Start and End Time Management
* Student Voting History
* PDF Result Generation
* Result Export
* Email Notifications
* Improved Role-Based Access Control
* REST API
* Mobile Application
* PostgreSQL Support
* Docker-Based Deployment

---

## Security Considerations

The project uses Laravel security features such as:

* Password Hashing
* CSRF Protection
* Authentication Middleware
* Protected Routes
* Server-Side Validation
* Session Management
* Unique Student Information Validation

This project is developed for educational purposes. A production-level voting system would require additional security auditing, testing, access controls, and independent verification.

---

## Author

**Shubham Santosh Gangurde**

MCA Student
Aspiring Java Full Stack Developer

GitHub: **https://github.com/shubhamgangurde58**

---

## Note

This project was developed as part of my MCA learning journey to understand full-stack web application development using Laravel and PHP.

VoteCount demonstrates how a college election process can be converted into a digital platform with student authentication, administrator management, election management, candidate management, online voting, and result visualization.

Working on this project strengthened my understanding of Laravel MVC architecture, authentication, Eloquent ORM, database migrations, CRUD operations, form validation, file handling, and MySQL database integration.

This project is intended as an educational college project and should not be considered a production-ready electronic voting system without additional security auditing and testing.

---

## License

This project is developed for educational and learning purposes.
