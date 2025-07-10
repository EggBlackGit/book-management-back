# Laravel JWT Backend Project

This project is a Laravel backend API that uses JWT (JSON Web Token) for authentication.

---

## 🛠️ Setup Instructions

### 🔹 1. Install Dependencies
```bash
composer install
```

### 🔹 2. Create Environment File
```bash
cp .env.example .env
```

### 🔹 3. Generate JWT Secret Key
```bash
php artisan jwt:secret
```

### 🔹 4. Generate Application Key
```bash
php artisan key:generate
```

### 🔹 5. Configure Database in `.env`

Update the following lines in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

### 🔹 6. Run Database Migration
```bash
php artisan migrate
```

---

## 🚀 Run the Project

Start the local development server:

```bash
php artisan serve
```

The application will be available at:

```
http://127.0.0.1:8000
```

---

## 📦 Features

- Laravel API backend
- JWT Authentication (`tymon/jwt-auth`)
- RESTful structure

---

## 📝 License

This project is open-source and available under the [MIT license](LICENSE).
