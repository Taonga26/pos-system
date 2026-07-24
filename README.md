# Bakery Inventory and Sales Management System

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge\&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge\&logo=php)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge\&logo=bootstrap)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge\&logo=mysql)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

**A modern Laravel Inventory and Sales Management System designed for bakeries and small retail businesses.**

Built with Laravel, Bootstrap, JavaScript, and MySQL.

</div>

---

## 📖 Overview

Bakery POS is a complete sales and inventory management solution that streamlines day-to-day bakery operations. The application manages products, inventory, suppliers, employees, customers, orders, payments, and reporting from a single web interface.

The project follows Laravel best practices by separating business logic into service classes, using database transactions for checkout operations, implementing model observers for activity logging, and enforcing role-based access control.

---

# ✨ Features

| Module            | Features                                         |
| ----------------- | ------------------------------------------------ |
| 🔐 Authentication | Secure Login, Sessions, Role-Based Authorization |
| 📦 Products       | CRUD, Categories, Images, Search, Filtering      |
| 🛒 Orders         | Shopping Cart, Checkout, Order Tracking          |
| 💳 Payments       | Cash, Simulated Card, Simulated Mobile Money     |
| 🧾 Receipts       | Printable Sales Receipts                         |
| 📊 Dashboard      | KPIs, Revenue, Top Products                      |
| 📈 Analytics      | Sales Reports, Revenue Reports                   |
| 📦 Inventory      | Automatic Stock Deduction                        |
| 👥 Customers      | Customer Profiles                                |
| 👨‍💼 Employees   | Employee Management                              |
| 🚚 Suppliers      | Supplier Management                              |
| 📜 Activity Logs  | Audit Trail                                      |
| ⚙ Administration  | User Management & Sessions                       |

---

# 📸 Screenshots

Replace the placeholders below with screenshots from your project.

| Dashboard                               | New Order                         |
| --------------------------------------- | --------------------------------- |
| ![Dashboard](docs/images/dashboard.png) | ![Orders](docs/images/orders.png) |

| Products                              | Analytics                               |
| ------------------------------------- | --------------------------------------- |
| ![Products](docs/images/products.png) | ![Analytics](docs/images/analytics.png) |

| Receipt                             | Activity Logs                 |
| ----------------------------------- | ----------------------------- |
| ![Receipt](docs/images/receipt.png) | ![Logs](docs/images/logs.png) |

---

# 🏗 System Architecture

```text
                        Browser
                           │
                           ▼
                     Laravel Routes
                           │
                           ▼
                     Controllers
                           │
               ┌───────────┼───────────┐
               ▼           ▼           ▼
       CheckoutService PaymentService InventoryService
               │           │           │
               └───────────┼───────────┘
                           ▼
                     Eloquent Models
                           │
                           ▼
                        MySQL
```

---

# 🛒 Checkout Workflow

```text
Customer

      │

      ▼

Shopping Cart

      │

      ▼

Checkout Request Validation

      │

      ▼

Checkout Service

      │

      ▼

Database Transaction

      │

      ▼

Create Order

      │

      ▼

Save Order Items

      │

      ▼

Calculate Total

      │

      ▼

Process Payment

      │

      ▼

Save Payment

      │

      ▼

Reduce Inventory

      │

      ▼

Generate Activity Logs

      │

      ▼

Generate Receipt

      │

      ▼

Commit Transaction
```

---

# 💳 Payment Architecture

```text
Payment Page

      │

      ▼

Payment Service

      │

      ├──────────────┬──────────────┐

      ▼              ▼              ▼

Cash          Mobile Money       Card

      │              │              │

      └──────────────┴──────────────┘

                     │

                     ▼

              Payment Successful?

                     │

          Yes ───────┴──────── No

          │                    │

          ▼                    ▼

 Save Payment          Rollback Transaction

          │

          ▼

 Update Order

          │

          ▼

 Print Receipt
```

---

# 📂 Project Structure

```text
app
├── Http
│   ├── Controllers
│   ├── Middleware
│   └── Requests
│
├── Models
│
├── Observers
│
├── Services
│   ├── CheckoutService
│   ├── PaymentService
│   ├── InventoryService
│   └── ReceiptService
│
├── Providers
│
└── Policies

database
├── migrations
├── factories
└── seeders

resources
├── css
├── js
└── views

routes
└── web.php
```

---

# 👥 User Roles

| Permission    | Admin | Manager | Cashier |
| ------------- | :---: | :-----: | :-----: |
| Dashboard     |   ✅   |    ✅    |    ✅    |
| Products      |   ✅   |    ✅    |    ❌    |
| Inventory     |   ✅   |    ✅    |    ❌    |
| Suppliers     |   ✅   |    ✅    |    ❌    |
| Employees     |   ✅   |    ❌    |    ❌    |
| Users         |   ✅   |    ❌    |    ❌    |
| Orders        |   ✅   |    ✅    |    ✅    |
| Customers     |   ✅   |    ✅    |    ✅    |
| Payments      |   ✅   |    ✅    |    ✅    |
| Analytics     |   ✅   |    ✅    |    ❌    |
| Activity Logs |   ✅   |    ❌    |    ❌    |

---

# 🔐 Security Features

* CSRF Protection
* Password Hashing
* Role-Based Access Control
* Database Sessions
* Session Regeneration
* Form Request Validation
* Database Transactions
* Activity Logging
* Secure Authentication

---

# 📜 Activity Logging

The system automatically records:

* User Login
* User Logout
* Product Creation
* Product Updates
* Product Deletion
* Order Creation
* Order Completion
* Payment Processing
* Inventory Updates

---

# 🧰 Technology Stack

| Layer          | Technology      |
| -------------- | --------------- |
| Backend        | Laravel 12      |
| Language       | PHP 8.2+        |
| Database       | MySQL           |
| Frontend       | Blade           |
| Styling        | Bootstrap 5     |
| Icons          | Bootstrap Icons |
| JavaScript     | Vanilla JS      |
| Authentication | Laravel Auth    |
| Sessions       | Database Driver |

---

# 🚀 Installation

## Clone Repository

```bash
git clone https://github.com/yourusername/bakery-pos.git

cd bakery-pos
```

---

## Install Dependencies

```bash
composer install

npm install
```

---

## Configure Environment

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Configure your database credentials inside `.env`.

---

## Run Migrations

```bash
php artisan migrate
```

---

## Seed Database

```bash
php artisan db:seed
```

---

## Start Development Server

```bash
php artisan serve
```

Application:

```text
http://127.0.0.1:8000
```

---

# 📅 Roadmap

* ✅ Authentication
* ✅ Product Management
* ✅ Inventory Management
* ✅ Shopping Cart
* ✅ Checkout Service
* ✅ Simulated Payment Gateway
* ✅ Receipt Printing
* ✅ Activity Logs
* ✅ Database Sessions
* 🔄 Barcode Scanner Support
* 🔄 QR Code Payments
* 🔄 Email Receipts
* 🔄 SMS Notifications
* 🔄 Customer Loyalty Program
* 🔄 Real Mobile Money Integration
* 🔄 REST API
* 🔄 Mobile App

---

# 🤝 Contributing

Contributions are welcome.

1. Fork the repository.
2. Create a feature branch.
3. Commit your changes.
4. Push the branch.
5. Open a Pull Request.

---

# 📄 License

This project is licensed under the MIT License.

---

<div align="center">

**Developed using Laravel ❤️**

</div>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
