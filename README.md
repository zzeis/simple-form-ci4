# Simple Form using CodeIgniter 4, PHP, MySQL (MariaDB) and JavaScript

## Overview

This is a simple web-based form application built with **CodeIgniter 4**, **PHP**, **MySQL (MariaDB)**, and **JavaScript**. The project demonstrates how to handle form submissions, validation, and storing data in a relational database.

## Features

- Form validation (client-side and server-side)
- Data storage using MySQL/MariaDB
- Simple and clean interface with JavaScript interactivity

## Requirements

Before running this application, make sure you have the following installed:

- **PHP 7.4+**
- **CodeIgniter 4.x**
- **MySQL or MariaDB**
- **Composer** (for dependency management)


## Installation

### 1. Clone the Repository

-```bash
git clone https://github.com/yourusername/your-repository-name.git
cd your-repository-name

### 2. Install Dependencies

Make sure you have Composer installed, then run:

bash

composer install

### 3. Configure the Environment

Copy the .env file and set your database and environment configurations:

bash

cp env.example .env

Edit the .env file with your database details:

bash

database.default.hostname = localhost
database.default.database = your_database_name
database.default.username = your_db_username
database.default.password = your_db_password
database.default.DBDriver = MySQLi

### 4. Database Setup

Create a database in MySQL/MariaDB and run the migration scripts if provided, or manually create the necessary tables.

bash

php spark migrate

###  5. Start the Development Server

You can run the CodeIgniter built-in server using:

bash

php spark serve

The application will be accessible at http://localhost:8080.
Usage

    Navigate to the homepage where the form is located.
    Fill out the form fields.
    Upon submission, the form data is validated and saved into the database.
    Errors will be shown for invalid input.

File Structure

A brief overview of the file structure:

bash

/
|-- app/
|-- public/
|-- writable/
|-- .env
|-- composer.json
|-- README.md

    app/ contains the core application code.
    public/ holds the front-end assets like CSS, JavaScript.
    writable/ stores logs, cache files, etc.

### Contributing

Feel free to fork this repository, submit issues, or contribute with pull requests. Please follow the commit message standards.
License

### This project is licensed under the MIT License. See the LICENSE file for more details.