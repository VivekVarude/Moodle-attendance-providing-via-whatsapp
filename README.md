# Moodle-attendance-providing-via-whatsapp
taking attendance from moodle local system and sending to the personal parent whatsapp number
Flow:

Moodle LMS stores attendance in MySQL database

PHP scripts fetch attendance data

Twilio API sends WhatsApp messages

Parents receive attendance notification

🖥️ Technologies Used

🟢 PHP

🟢 MySQL

🟢 Moodle LMS

🟢 Twilio WhatsApp API

🟢 Composer

⚙️ Moodle Installation Guide
1️⃣ Install XAMPP / LAMP

Make sure your system has:

Apache

PHP (>= 7.4 recommended)

MySQL

On Ubuntu:

sudo apt install apache2 mysql-server php php-mysql libapache2-mod-php

2️⃣ Download Moodle

Download from official site:

👉 https://download.moodle.org/

Or using git:

git clone -b MOODLE_401_STABLE git://git.moodle.org/moodle.git

3️⃣ Create MySQL Database

Login to MySQL:

mysql -u root -p


Create database:

CREATE DATABASE moodle;


Create user:

CREATE USER 'moodleuser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON moodle.* TO 'moodleuser'@'localhost';
FLUSH PRIVILEGES;

4️⃣ Configure Moodle

Move Moodle folder to:

/var/www/html/moodle


Open browser:

http://localhost/moodle


Follow installation wizard:

Select MySQL

Enter database details

Complete setup

🗄️ Moodle with MySQL Working

Moodle stores attendance in MySQL tables such as:

mdl_user

mdl_course

mdl_attendance

mdl_attendance_log

This project connects directly to the Moodle database to extract attendance records.

📲 Twilio Setup
1️⃣ Create Twilio Account

👉 https://www.twilio.com/

2️⃣ Get:

Account SID

Auth Token

WhatsApp Sandbox Number

3️⃣ Configure Environment Variables

Create .env file (NOT pushed to GitHub):

TWILIO_SID=your_account_sid
TWILIO_TOKEN=your_auth_token
TWILIO_WHATSAPP_NUMBER=whatsapp:+14155238886

🚀 How to Run This System
Step 1 — Install Dependencies
composer install

Step 2 — Configure Database

Edit database connection in:

attendance.php


Set:

$host = "localhost";
$dbname = "moodle";
$username = "moodleuser";
$password = "password";

Step 3 — Start Apache & MySQL

On Ubuntu:

sudo systemctl start apache2
sudo systemctl start mysql

Step 4 — Open in Browser
http://localhost/project/front.html

Step 5 — Send Attendance

Select student

Process attendance

WhatsApp message will be sent to parent

🔐 Security Best Practices

Do NOT push .env

Do NOT hardcode Twilio credentials

Always rotate API keys if exposed

Use prepared statements for SQL queries

📈 Future Improvements

Admin dashboard

Cron-based automatic messaging

SMS + Email support

Secure Moodle plugin integration

Role-based access system

👨‍💻 Author

Vivek Varude
Computer Science Engineering
3rd Year Project
