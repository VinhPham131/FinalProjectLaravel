# LBJ (Luxury Boys Jewelry) Online Shop

![Home page screenshot](/content/homepage.png)

## Overview
Welcome to the **LBJ (Luxury Boys Jewelry) Online Shop**. This is a high-end e-commerce platform designed to offer an exclusive selection of jewelry. Our mission is to provide a seamless shopping experience for those who seek luxury and elegance.

## Technologies
This project is built with robust and modern technologies to ensure high performance and scalability:
- Laravel Framework 11.9
- Laravel Fortify for authentication
- Livewire for dynamic UI components
- Sanctum for API authentication
- Filament for admin management
- Blade Templating Engine
- Tailwind CSS for styling
- Alpine.js for lightweight interactivity
- Laravel Octane for high performance
- RoadRunner for server handling
- Telescope for debugging
- Laravel Pint for code formatting

## Detail of the project
- [ERD diagram](content/databaseimg/README.md)
- [ScreenShot](content/screenshot/README.md)

## Prerequisites

Before running this project, ensure you have the following installed:

- [PHP 8.2+](https://www.php.net/downloads)
- [MySQL](https://dev.mysql.com/downloads/mysql/)
- [Git](https://git-scm.com/downloads)
- [Composer](https://getcomposer.org/download/)

## Project Structure

Here is an overview of the main directories and files in the project:

- **/app/Http/Controllers**: Contains the logic for handling requests and returning responses.
- **/resources/views**: Contains the Blade templates for rendering HTML pages.
- **/config**: Holds configuration files for the database connection and environment variables.
- **/public**: Static files like CSS, JavaScript, and images.
- **/routes**: Contains all the route definitions for the application.
- **/database/migrations**: Contains the database migration files.
- **/database/seeders**: Contains the database seeder files.
- **/tests**: Contains the test files.
- **artisan**: The command-line interface for Laravel.
- **composer.json**: Lists the PHP dependencies and scripts.
- **package.json**: Lists the JavaScript dependencies and scripts.
## Setup Instructions

1. **Clone the Repository**

```bash
git clone https://github.com/VinhPham131/FinalProjectLaravel.git
cd final_laravel
```

2. **Install Dependencies**

Install all required dependencies using npm:

```bash
npm install
composer install
```

3. **Database Setup**

- Ensure MySQL is running on your machine.
- Create a new database called `apps`.
- Update the database configuration in environment variables (`.env` file).

Create `.env` like `.env.example` and set the values. For example:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jew_db
DB_USERNAME=root
DB_PASSWORD=vinh1301
```

4. **Run Database Migrations**

Run the migrations to set up the database schema:

```bash
php artisan migrate
```

5. **Seed the Database**

Populate the database with initial data:

```bash
php artisan db:seed
```

6. **Start the Server**

Compile Front-End Assets
```bash
npm run dev
```

Start the Server
```bash
php artisan serve
```

### Reset Database

To reset the database, you could run the following command to undo all migrations and re-run them.
```bash
php artisan migrate:refresh
php artisan db:seed
```

## Contributors

1. ngoinhaoto - Lê Đình Chính
2. VinhPham131 - Phạm Quang Vinh
3. comeheretnt - Phạm Nguyễn Huy Minh
4. nhannguyen1208 - Nguyễn Minh Nhân
5. voidkuugeki - Nguyễn Trần Xuân Trí

