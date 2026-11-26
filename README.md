# Careerly Job Portal (PHP + MySQL)

## Requirements
- XAMPP (Apache + MySQL)
- PHP 8+ recommended

## Setup
1. Copy the `Careerly_Job_Portal` folder into `C:\xampp\htdocs\`.
2. Start Apache and MySQL from XAMPP Control Panel.
3. Open `http://localhost/phpmyadmin`.
4. Import `database.sql` (it creates the `job_portal` database and demo data).
5. Open `http://localhost/Careerly_Job_Portal/`.

## Demo admin
- Email: `admin@careerly.test`
- Password: `admin123`

## Features
- Responsive home page and sample job listings
- Job search by title/company, location and job type
- Job detail page and candidate applications
- Candidate registration/login and dashboard
- Companies directory
- Admin job create/edit/delete panel
- Password hashing, prepared SQL statements and session-based access checks

## Notes
- XAMPP's default MySQL username is `root` and password is empty. If yours differs, edit `config/database.php`.
- Sample data is fictional.
- This is a learning/demo project. Before public deployment, add CSRF protection, email verification, rate limiting, stronger admin provisioning and production configuration.
