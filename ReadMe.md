# User Timezone Application

## Overview

This project is a basic Laravel application that includes the following tasks:

1. Added timezone, firstname, and lastname fields to the `users` table.
2. Seeded the database with 20 users and randomly assigned timezones (`CET`, `CST`, `GMT+1`).
3. Created an Artisan command to update a user's firstname, lastname, and timezone to random values.
4. Frontend implementation to display users.

## Features

- **User Management**: Added timezone, firstname, and lastname fields to users.
- **User Seeder**: 20 users are seeded with random fistname, lastname and email and timezones.
- **Artisan Command**: Updates user details with random values.

## Requirements

- PHP >= 8.0
- Composer
- Laravel 9.x
- MySQL

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/AdekeyeAdeniyi/userTimeZoneApplication.git
   ```

2. Navigate to the project directory:

   ```bash
   cd user-timezone-app
   ```

3. Install the dependencies:

   ```bash
   composer install
   npm install
   ```

4. Copy the `.env` file and configure your database credentials:

   ```bash
   cp .env.example .env
   ```

   Update the `.env` file with your database information:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=usertimezone
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. Generate the application key:

   ```bash
   php artisan key:generate
   ```

## Database Setup

1. Run the migrations to update the `users` table:

   ```bash
   php artisan migrate
   ```

2. Seed the database with users:

   ```bash
   php artisan db:seed --class=UserSeeder
   ```

## Artisan Command

An Artisan command has been created to update user details with random values.

Run the command as follows:

```bash
php artisan app:update-user-details

```

This will update users' firstname, lastname, and timezone with random values

## Frontend

A basic frontend implementation is included to display the users and their details (firstname, lastname, email, timezone).

Example Usage
View the list of users in the browser after running migrations and seeding.
Run the Artisan command to update user details, then refresh the browser to see the updated information.

## Contributing

Feel free to fork this project, make improvements, and submit pull requests.

## License

This project is open-source and available under the MIT License.
