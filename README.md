# CRUD Testing & Storage App

A premium Laravel application designed specifically for testing **CRUD operations**, **File Storage**, and **Database Connectivity** on a Laravel PaaS environment.

## 🚀 Features
- **Secure Authentication**: Database-driven login system.
- **Product CRUD**: Full Create, Read, Update, and Delete for products.
- **Image Storage**: File upload, replace, and automatic deletion testing.
- **Premium UI**: Modern dark-mode interface with glassmorphism and smooth transitions.

---

## 🛠️ Setup Instructions

Follow these steps to prepare the application on your environment:

### 1. Environment Configuration
Ensure your `.env` is connected to your MySQL instance (PaaS MySQL). The current configuration uses:
- **DB_HOST**: `127.0.0.1`
- **DB_DATABASE**: `crud_testing`
- **DB_USERNAME**: `paas`
- **DB_PASSWORD**: `change_this_password`

### 2. Install Dependencies
```bash
composer install
npm install && npm run build
```

### 3. Application Initialization
```bash
php artisan key:generate
php artisan storage:link
```

### 4. Database Setup & First Account
Run these commands to create tables and generate your first login account:

```bash
# Run migrations (Creates tables)
php artisan migrate

# Create first Auth account via Seeder
php artisan db:seed --class=UserSeeder
```

---

## 🔐 Login Credentials
Once seeded, use these credentials to log in:

- **Email**: `admin@example.com`
- **Password**: `password`

---

## 📦 Deployment on Laravel PaaS
When deploying to your PaaS, make sure:
1. The environmental variables for MySQL are correctly injected.
2. The `storage` directory has write permissions.
3. You run `php artisan migrate --force` and `php artisan db:seed --class=UserSeeder --force` in your CI/CD pipeline or terminal.

---

## 📂 Project Structure for Testing
- **Database**: `app/Models/Product.php` & `database/migrations/`
- **Storage Logic**: `app/Http/Controllers/ProductController.php` (check `store` and `update` methods).
- **Auth Logic**: `app/Http/Controllers/Auth/LoginController.php`.
- **UI/Layout**: `resources/views/layouts/app.blade.php`.
