CREATE DATABASE IF NOT EXISTS job_portal CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE job_portal;

DROP TABLE IF EXISTS applications;
DROP TABLE IF EXISTS jobs;
DROP TABLE IF EXISTS companies;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('candidate','admin') NOT NULL DEFAULT 'candidate',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE companies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  industry VARCHAR(120) NOT NULL,
  logo_color VARCHAR(30) NOT NULL DEFAULT '#6655e8'
);

CREATE TABLE jobs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  company_id INT NOT NULL,
  title VARCHAR(160) NOT NULL,
  location VARCHAR(120) NOT NULL,
  job_type VARCHAR(40) NOT NULL,
  salary VARCHAR(100) NOT NULL,
  experience VARCHAR(80) NOT NULL,
  posted_label VARCHAR(50) NOT NULL DEFAULT 'Just now',
  description TEXT NOT NULL,
  requirements TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE CASCADE
);

CREATE TABLE applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  job_id INT NOT NULL,
  user_id INT NOT NULL,
  cover_letter TEXT,
  status ENUM('pending','reviewed','shortlisted','rejected') DEFAULT 'pending',
  applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY unique_application (job_id,user_id),
  FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO companies(name,industry,logo_color) VALUES
('PixelCraft','Design & Technology','#6655e8'),
('TechNova','Software Development','#269b83'),
('Northstar','Digital Products','#e18a42'),
('BrightLabs','AI & Data','#3976c8'),
('CloudNine','Cloud Computing','#8c5db5'),
('Growthly','Marketing','#d45f7d');

INSERT INTO jobs(company_id,title,location,job_type,salary,experience,posted_label,description,requirements) VALUES
(1,'UI/UX Designer','Lahore, Pakistan','Full-time','PKR 100k - 150k','1-3 years','2 days ago','We are looking for a thoughtful UI/UX Designer to create simple, useful digital experiences. You will work with product managers and developers from early ideas to polished interfaces.','Figma proficiency|Strong portfolio|Understanding of user-centered design|Good communication skills'),
(2,'PHP Backend Developer','Remote, Pakistan','Remote','PKR 120k - 180k','2+ years','1 day ago','Build and maintain reliable web applications using PHP and MySQL. Work with a collaborative engineering team and write clean, secure code.','PHP and MySQL experience|REST API knowledge|Git basics|Problem-solving skills'),
(3,'Frontend Developer','Lahore, Pakistan','Full-time','PKR 90k - 140k','1-2 years','3 days ago','Create responsive web interfaces with HTML, CSS and JavaScript. Collaborate with designers and backend developers to ship quality features.','HTML CSS JavaScript|Responsive design|Git and GitHub|Attention to detail'),
(4,'Junior Machine Learning Engineer','Islamabad, Pakistan','Full-time','PKR 100k - 160k','Fresh - 1 year','4 days ago','Help build, evaluate and deploy machine learning models. This role is suitable for a curious learner who enjoys data and practical problem solving.','Python fundamentals|NumPy and Pandas|Basic machine learning|Willingness to learn'),
(5,'Data Analyst Intern','Remote, Pakistan','Internship','PKR 25k - 40k','Fresh graduate','5 days ago','Support the analytics team by cleaning datasets, preparing reports and finding useful insights for business decisions.','SQL basics|Excel or Google Sheets|Basic statistics|Clear communication'),
(6,'Digital Marketing Executive','Karachi, Pakistan','Full-time','PKR 70k - 110k','1-2 years','1 week ago','Plan and execute digital campaigns, review performance and help improve brand awareness across online channels.','Social media knowledge|Content planning|Analytics basics|Creative thinking'),
(2,'WordPress Developer','Remote, Pakistan','Contract','PKR 80k - 130k','1+ years','1 week ago','Develop and customize WordPress websites for clients. Maintain performance, accessibility and responsive layouts.','WordPress and PHP|HTML CSS|Plugin configuration|Client communication'),
(4,'Python Developer Intern','Lahore, Pakistan','Internship','PKR 30k - 50k','Fresh','2 weeks ago','Join the engineering team to develop Python utilities, test APIs and contribute to internal automation projects.','Python basics|OOP concepts|Git basics|Basic SQL');

-- Demo admin account: admin@careerly.test / admin123
INSERT INTO users(name,email,password,role) VALUES
('Careerly Admin','admin@careerly.test','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.','admin');
