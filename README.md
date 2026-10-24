# Learntern — Multi-Tier Containerized Platform

<div align="center">

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP_8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Next.js](https://img.shields.io/badge/Next.js-000000?style=for-the-badge&logo=nextdotjs&logoColor=white)](https://nextjs.org/)
[![Docker](https://img.shields.io/badge/Docker_Compose-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com/)
[![Nginx](https://img.shields.io/badge/Nginx-009639?style=for-the-badge&logo=nginx&logoColor=white)](https://nginx.org/)
[![MySQL](https://img.shields.io/badge/MySQL_8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)

<p align="center">
  A multi-tier platform built with <b>Laravel</b> and <b>Next.js</b>, fully orchestrated using containerized microservices and Docker Compose.
</p>

</div>

---

## 📌 Architectural Overview

**Learntern** is an internship and learning tracking platform engineered with a decoupled, containerized multi-service architecture:

```
                      ┌───────────────────────┐
                      │      Client Web       │
                      │    (Browser / App)    │
                      └───────────┬───────────┘
                                  │ :80
                      ┌───────────▼───────────┐
                      │     Nginx Gateway     │
                      │   (Alpine Container)  │
                      └─────┬───────────┬─────┘
           /api requests    │           │  frontend requests
        ┌───────────────────┘           └───────────────────┐
        ▼                                                   ▼
┌───────────────┐                                   ┌───────────────┐
│ Laravel API   │                                   │ Next.js App   │
│ (PHP-FPM/App) │                                   │ (Node.js)     │
└───────┬───────┘                                   └───────────────┘
        │
        ▼
┌───────────────┐
│  MySQL 8.0 DB │
│ (Data Volume) │
└───────────────┘
```

---

## 🧩 Container Services

| Service | Technology | Role |
| :--- | :--- | :--- |
| **`app`** | PHP 8.2 / Laravel 11 | Core RESTful API backend, business logic, authentication & database migrations |
| **`frontend`** | Next.js / Node.js | Responsive user portal and dynamic dashboards |
| **`webserver`**| Nginx Alpine | Reverse proxy, static asset handler & request routing |
| **`db`** | MySQL 8.0 | Relational database with persistent Docker volume |

---

## 🚀 Quickstart with Docker

### Prerequisites

- [Docker](https://www.docker.com/) & Docker Compose installed

### Running the Stack

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Samhubby/Learntern.git
   cd Learntern
   ```

2. **Environment Setup:**
   Configure environment settings for both backend and frontend:
   ```bash
   cp backend/.env.example backend/.env
   ```

3. **Build and start all containers:**
   ```bash
   docker compose up -d --build
   ```

4. **Initialize Backend (Migrations & Key):**
   ```bash
   docker compose exec app php artisan key:generate
   docker compose exec app php artisan migrate
   ```

5. **Access Applications:**
   - **Frontend Application:** `http://localhost:3000`
   - **API / Backend:** `http://localhost:80/api`

---

## 📄 License

This project is open-source under the [MIT License](LICENSE).
