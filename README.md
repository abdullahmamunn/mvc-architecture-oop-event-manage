# Event Management System

## Overview

The **Event Management System** is a simple, web-based application built with pure PHP using MVC architecture. It allows users to create, manage, and view events, register attendees, and generate event reports.

## Features

### Core Functionalities:

- **User Authentication**: Secure login and registration with password hashing.
- **Event Management**: Users can create, update, view, and delete events.
- **Attendee Registration**: Register attendees and enforce event capacity limits.
- **Event Dashboard**: View events in a paginated, sortable, and filterable format.
- **Event Reports**: Admins can download attendee lists in CSV format.

### Technical Features:

- Built with **pure PHP** (no frameworks).
- Uses **MySQL** as the database.
- Implements **client-side and server-side validation**.
- Uses **prepared statements** to prevent SQL injection.
- Basic responsive UI built with **Bootstrap**.
- `.env` configuration for environment settings.
- Supports **composer autoloading** for better project structure.

## Installation

### Prerequisites:

- PHP 8.2+
- MySQL
- Composer
- Web server (Apache or built-in PHP server)

### Setup Steps:

1. **Clone the repository**:

   ```sh
   git clone git@github.com:abdullahmamunn/mvc-architecture-oop-event-manage.git
   cd event-management-system
   ```

2. **Install dependencies**:

   ```sh
   composer install
   ```

3. **Set up environment variables**:

   - Copy the `.env.example` file and rename it to `.env`
   - Configure database credentials in the `.env` file:
     ```env
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=event_management
     DB_USERNAME=root
     DB_PASSWORD=
     ```

4. **Create the database**:

   - Open MySQL and run:
     ```sql
     CREATE DATABASE event_management;
     ```
   - Import the provided SQL file (`database/event_management.sql`) into the database.

5. **Start the server**:

   ```sh
   composer start
   ```

   The application will be available at `http://localhost:8000`

## Default Login Credentials (For Testing)

| Role  | Email                                          | Password    |
| ----- | ---------------------------------------------- | ----------- |
| Admin | [admin@example.com](mailto\:admin@example.com) | password123 |
| User  | [user@example.com](mailto\:user@example.com)   | password123 |

## Project Structure

```
/event-management-system
│-- app/                  # Application core (Models, Controllers, Views, Helpers)
│-- public/               # Public directory (index.php, assets)
│-- config/               # Configuration files
│-- database/             # Database files
│-- vendor/               # Composer dependencies
│-- .env                  # Environment configuration
│-- composer.json         # PHP dependencies
│-- README.md             # Project documentation
```

## License

This project is open-source and available under the [MIT License](LICENSE).

---

### 🚀 Thank you for using the Event Management System! Feel free to contribute and improve it. Happy coding! 🎉

