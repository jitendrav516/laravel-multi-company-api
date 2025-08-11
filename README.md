# Laravel Multi-Company API

## Overview
This project is a **Multi-Tenant Laravel API** that allows user registration, login, and management of multiple companies with active company switching.

---

## Features
- User Registration & Login (Sanctum Auth)
- Company CRUD
- Active Company selection
- Data scoped per authenticated user
- Simple HTML/CSS/JS frontend

---

## Setup Instructions

1. Clone the repository:
   ```bash
   git clone https://github.com/<your-username>/laravel-multi-company-api.git
   cd laravel-multi-company-api
   ```

2. Install dependencies:
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

3. Setup database in `.env` and run migrations:
   ```bash
   php artisan migrate
   ```

4. Serve the application:
   ```bash
   php artisan serve
   ```

---

## API Endpoints

### Auth
| Method | Endpoint       | Description         |
|--------|---------------|---------------------|
| POST   | `/api/register`| Register user       |
| POST   | `/api/login`   | Login user          |
| POST   | `/api/logout`  | Logout user         |

### Company
| Method | Endpoint         | Description         |
|--------|-----------------|---------------------|
| GET    | `/api/companies`| List companies      |
| POST   | `/api/companies`| Create company      |
| GET    | `/api/companies/{id}`| Show company   |
| PUT    | `/api/companies/{id}`| Update company |
| DELETE | `/api/companies/{id}`| Delete company |

---

## Multi-Tenant Logic
- Each user has their own companies.
- `companies` table is scoped by `user_id`.
- Active company is stored in a separate table and linked to user.

---

## Frontend (HTML/CSS/JS)

A simple static frontend is included in **`public/frontend`**.  
You can open it directly in the browser after running Laravel:

```
http://127.0.0.1:8000/frontend/index.html
```

The frontend interacts with the Laravel API via AJAX (fetch API).

---

## Example Requests

### Register
```bash
curl --location 'http://127.0.0.1:8000/api/register' --header 'Content-Type: application/json' --data '{
  "name": "Test User",
  "email": "test@example.com",
  "password": "password",
  "password_confirmation": "password"
}'
```
