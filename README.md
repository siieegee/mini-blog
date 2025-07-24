# 🌤️ Skybound Tales — Laravel Blog Website

**Skybound Tales** is a blog platform built that allows users to register, log in, and manage their own blog posts. The design is clean and responsive with GitHub version control integration.

---

## 🚀 Features

- 🔐 User Authentication (Laravel Breeze)
- ✍️ CRUD Functionality for Blog Posts
- 💬 Comment System per Post
- 🎨 Blade Templating + Tailwind CSS
- ⚡ Vite-powered frontend bundling
- 🛠️ Git/GitHub Integration

---

## 📦 Installation & Setup

### Requirements

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL / MariaDB
- Laravel CLI (optional)

### Steps

1. **Clone the repository**
    ```bash
    git clone https://github.com/your-username/skybound-tales.git
    cd skybound-tales

2. **Install dependencies**
    ```bash
    composer install
    npm install

3. **Set up environment variables**
    ```bash
    cp .env.example .env
    php artisan key:generate

4. **Set up the database**
- Create a MySQL database (e.g., skybound_blog)
    ```bash
    CREATE DATABASE skybound_blog;
- Update your .env file:
    ```bash
    DB_DATABASE=skybound_blog
    DB_USERNAME=root
    DB_PASSWORD=

5. **Run migrations**
    ```bash
    php artisan migrate

6. **Compile frontend assets**
    ```bash
    npm run dev

7. **Start the server**
    ```bash
    php artisan serve

8. **Visit:**
   ```bash
   http://localhost:8000