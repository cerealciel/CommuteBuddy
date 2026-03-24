# CommuteBuddy Campus Ride-Sharing System

## Overview
CommuteBuddy is a full-stack web application that allows students to share rides and split gas costs. Drivers can post available rides, and riders can book seats easily.

---

## Features

- View available rides
- Post a ride (Driver)
- Book a ride (Rider)
- Edit ride details
- Delete rides and bookings
- Real-time price calculation using JavaScript

---

## Technologies Used

- HTML
- Tailwind CSS
- JavaScript
- PHP (mysqli)
- MySQL
- XAMPP (Local Server)

---

## Database Structure

### Database Name:
commute_db

### Tables:

#### users
- user_id (Primary Key)
- firstname
- lastname
- type (driver/rider)

#### rides
- ride_id (Primary Key)
- driver_id (Foreign Key → users)
- destination
- departure_time
- seat_price

#### bookings
- booking_id (Primary Key)
- ride_id (Foreign Key → rides)
- user_id (Foreign Key → users)
- booking_status

---

## Installation Guide

### 1. Install XAMPP
Download and install XAMPP.

### 2. Place Project Folder
Move the project into: xampp/htdocs/


### 3. Start Server
Open XAMPP and start:
- Apache
- MySQL

### 4. Setup Database

1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Create a new database: commute_db
3. Import the SQL file: database/commute_db.sql

### 5. Run the System

Open your browser and go to: http://localhost/commutebuddy/


---

## System Workflow

### Posting a Ride
1. Driver enters ride details
2. JavaScript calculates price per seat
3. PHP inserts data into database

---

### Booking a Ride
1. Rider selects a ride
2. PHP creates a user
3. PHP inserts booking into database

---

## Key Concepts Used

- CRUD Operations (Create, Read, Update, Delete)
- PHP $_POST form handling
- MySQL JOIN queries
- Foreign key relationships
- JavaScript DOM manipulation

---

## File Descriptions

- **index.php** – Displays rides and bookings
- **post_ride.php** – Handles ride creation
- **book_ride.php** – Handles ride booking
- **edit_ride.php** – Updates ride info
- **delete_ride.php** – Deletes rides
- **delete_booking.php** – Deletes bookings
- **db.php** – Database connection
- **script.js** – Price calculation logic

---

## Author
Developed as part of ITE 308 – Web System and Technologies
