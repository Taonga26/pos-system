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
