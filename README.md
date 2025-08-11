
# Laravel Multi-Company (Multi-Tenant) API

This project is a Laravel-based REST API for managing multiple companies under a single user account with multi-tenant data isolation.

## Features

- User registration, login, and logout (Laravel Sanctum authentication)
- CRUD operations for companies
- Multi-tenant logic ensuring each user can only access their own companies
- Ability to set and switch the active company for the user
- Data scoping based on active company
- MySQL database with Eloquent ORM
- Validation & error handling

## Requirements

- PHP 8.1+
- Composer
- MySQL
- Laravel 10+

## Installation

1. **Clone the repository**
    ```bash
    git clone https://github.com/<your-username>/laravel-multi-company-api.git
    cd laravel-multi-company-api
    ```

2. **Install dependencies**
    ```bash
    composer install
    ```

3. **Copy environment file**
    ```bash
    cp .env.example .env
    ```

4. **Set up environment variables** in `.env`
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=multi_company_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Generate application key**
    ```bash
    php artisan key:generate
    ```

6. **Run migrations**
    ```bash
    php artisan migrate
    ```

7. **Serve the application**
    ```bash
    php artisan serve
    ```

## API Endpoints

### Authentication
- **Register**  
  `POST /api/register`  
  ```json
  {
    "name": "Test User",
    "email": "test@example.com",
    "password": "password",
    "password_confirmation": "password"
  }
  ```

- **Login**  
  `POST /api/login`  
  ```json
  {
    "email": "test@example.com",
    "password": "password"
  }
  ```

- **Logout**  
  `POST /api/logout` (Requires Auth)

### Companies
- **List Companies**: `GET /api/companies`  
- **Create Company**: `POST /api/companies`  
  ```json
  {
    "name": "My Company",
    "address": "123 Street",
    "industry": "IT"
  }
  ```
- **Update Company**: `PUT /api/companies/{id}`  
- **Delete Company**: `DELETE /api/companies/{id}`  

### Active Company
- **Set Active Company**: `POST /api/companies/active`  
  ```json
  {
    "company_id": 1
  }
  ```

## Multi-Tenant Logic & Data Scoping

- Every company is linked to a specific user via `user_id`.
- Users can **only** access their own companies (authorization checks in controllers).
- Active company is tracked per user (either in `users` table or separate `user_active_companies` table).
- All future modules (e.g., invoices, projects) will be scoped to the active company.

## License
This project is open-source and available under the [MIT license](LICENSE).
