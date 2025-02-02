# Event Management System

## Overview

The **Event Management System** is a simple, web-based application built with pure PHP using MVC architecture. It allows users to create, manage, and view events, register attendees, and generate event reports.

## Features

### Core Functionalities:

- **User Authentication**: Secure login and registration with password hashing.
- **Event Management**: Authenticate Users can create, update, view, and delete events.
- **Event Dashboard**: All events show in the Event Dashboard, Authenticate user can view events in a paginated ,can sort ASC or DESC, and can filter event location, name or upcomming event.
- **Event Reports**: On the event  reports only admin can download attendee lists in CSV format.
- **Public View**: All events are showing user can see view details of event and can regsiter.
- **Attendee Registration**: One public user can register once an event when limits meets with the max capacity then user can't register and it will show **Slots Out** limits.
- **Search Functionalities**: User can search **Event Name** and **Attendee Name** and can find the list in details. 

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
   - Import the provided SQL file (`database/db_schema.sql`) into the database.

5. **Start the server**:

   ```sh
   composer start
   ```

   The application will be available at `http://localhost:8000`

## Default Login Credentials (For Testing)

| Role  | Email                                          | Password    |
| ----- | ---------------------------------------------- | ----------- |
| Admin | [admin@mail.com](mailto\:admin@example.com) | 123456789 |
| User  | [user@email.com](mailto\:user@example.com)   | 123456789 |


## License

This project is open-source and available under the [MIT License](LICENSE).

---

### 🚀 Thank you for using the Event Management System! Feel free to contribute and improve it. Happy coding! 🎉

