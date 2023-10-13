Welcome to the Crowdfunding Application repository! This Laravel-based web application allows users to participate in donations, view and manage their own donations, and access their donation history.

## Features

- **User Registration and Authentication:** Users can easily create an account or log in to the application.

- **Donation Management:** Users can create, edit, and delete donations they've made. 

- **View and Participate:** Users can view and participate in open donations.

- **Target Amount Tracking:** The application allows setting a target amount for donations and displays the amount raised toward each donation.

- **Donation Completion:** When a target amount is reached, the donation's completion status is updated in the database. A value of 1 indicates completion, and 0 indicates incompleteness. Once a target is reached, the donation is closed, and users cannot participate in it.

## Technology Stack

- **Framework:** Laravel
- **Styling:** Bootstrap and Custom CSS
- **Database:** SQL

## Installation

To run this application locally, follow these steps:

1. Clone the repository to your local machine.

2. Make sure you have PHP, Laravel, Composer, and a compatible database system installed.

3. Set up your environment variables, including your database credentials, in the `.env` file.

4. Run migrations to create the database tables:
  	php artisan migrate
5.	Start the application:
php artisan serve 
6.	Open a web browser and go to http://localhost:8000 to access the application.
Usage
•	Register or log in to access the features.
•	Create and manage donations.
•	Participate in open donations.
•	View your donation history.
Docker Support
This repository also provides Docker and Docker Compose configurations. You can containerize the application for easy deployment.





