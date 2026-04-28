# SIMPEG API

Sistem Informasi Kepegawaian (SIMPEG) Backend API built with Laravel.

## Prerequisites

Before you begin, ensure you have the following installed on your local machine:
- PHP (>= 8.2)
- Composer
- PostgreSQL

## Installation Guide

Follow these steps to set up the project locally after cloning the repository:

### 1. Install Dependencies
Run the following command to install all PHP dependencies:
```bash
composer install
```

### 2. Environment Configuration
Copy the `.env.example` file to create your `.env` file:
```bash
cp .env.example .env
```

### 3. Database Setup (PostgreSQL)
Create a new PostgreSQL database. You can do this via your preferred database client (e.g., pgAdmin, DBeaver) or using the terminal:

```sql
CREATE DATABASE simpeg_db;
```

Ensure your `.env` file matches your PostgreSQL credentials. By default, it is configured as follows:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=simpeg_db
DB_USERNAME=postgres
DB_PASSWORD=password
```

### 4. Generate Application Key
Generate a new application encryption key:
```bash
php artisan key:generate
```

### 5. Run Migrations & Seeders
Run the database migrations along with the seeders to populate initial data:
```bash
php artisan migrate:fresh --seed
```

### 6. Create Storage Link
Create a symbolic link to make uploaded files (like employee photos) accessible from the web:
```bash
php artisan storage:link
```

## Running the Application

To start the local development server, run:
```bash
php artisan serve
```
The API will be accessible at `http://127.0.0.1:8000`.

## Default Login Credentials

You can use the following credentials to authenticate with the API:

- **Email:** `test@example.com`
- **Password:** `password`
