# 🛒 Advanced E-Commerce Platform (LEGO Store)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-blue.svg?style=for-the-badge)

> A robust, full-stack dynamic e-commerce web application built with PHP, JavaScript, and MySQL. Developed as the final project for the **Advanced Web Programming and Applications** course at Saigon University.

## 📖 Table of Contents
- [About the Project](#about-the-project)
- [Core Business Logic](#core-business-logic)
- [Key Features](#key-features)
  - [End-User (Client)](#end-user-client)
  - [Administrator (Admin)](#administrator-admin)
- [Database Architecture](#database-architecture)
- [Installation & Setup](#installation--setup)
- [Team Members](#team-members)

## 🚀 About the Project
This project is a comprehensive e-commerce solution that handles everything from user browsing to complex inventory management. It enforces strict data integrity, client-side validation, and utilizes a fully relational database architecture. 

The system operates strictly without any pre-built CMS, relying on custom-written logic to manage dynamic pricing, inventory tracking, and order fulfillment.

## 🧠 Core Business Logic (Dynamic Pricing Algorithm)
A standout feature of this system is the **Weighted Average Inventory Pricing**. The selling price of a product is dynamically calculated based on the import history:
- `Selling Price = Import Price * (100% + Profit Margin)`
- `Import Price` is updated dynamically upon new stock arrival using the formula: 
  *(Current Stock * Current Import Price + New Stock * New Import Price) / (Current Stock + New Stock)*.

## ✨ Key Features

### 🛍️ End-User (Client)
- **Product Discovery:** Browse products by categories with seamless pagination. View detailed product specifications tailored to the merchandise.
- **Advanced Search Engine:** Multi-criteria search capabilities filtering by Product Name, Category, and Price Range simultaneously.
- **Secure Authentication:** User registration (capturing full delivery details) and secure login/logout mechanisms.
- **Smart Shopping Cart:** Require authentication to access. Dynamic cart manipulation (add/remove/update quantities).
- **Checkout Process:** - Dynamic address selection (use saved profile address or input a new one).
  - Multiple payment methods supported (Cash on Delivery, Bank Transfer with details, Online Payment integration prep).
  - Comprehensive order summary before finalizing the purchase.
- **Order Tracking:** Customers can view their personal purchase history, sorted by the most recent orders.

### 🛡️ Administrator (Admin)
- **Isolated Admin Portal:** Secure login via a dedicated URL, completely separated from the client interface.
- **Access Management:** Manage user accounts (add new users, reset passwords, lock/unlock accounts).
- **Product Lifecycle Management:**
  - Complete CRUD operations for Categories and Products (including images, base quantities, and visibility status).
  - **Soft Delete Mechanism:** Products with existing import history are hidden (soft-deleted) rather than permanently removed to preserve relational data integrity.
- **Inventory & Procurement:**
  - Create and manage complex Import Receipts (multiple products per receipt).
  - Track imports by date, batch, import price, and quantity.
  - Ability to edit pending receipts before finalization.
- **Financial & Price Management:**
  - Configure desired profit margin percentages per product.
  - Track Cost of Goods Sold (COGS), profit margins, and selling prices by import batches.
- **Order Fulfillment Routing:**
  - Track and update order statuses (Pending, Confirmed, Delivered, Cancelled).
  - Advanced filtering by Date Range.
  - **Logistics Sorting:** Filter orders by status and sort them geographically by **Delivery Ward** for optimized shipping routes. One-click deep link to order details.
- **Reporting & Analytics:**
  - Real-time stock querying at any specified timestamp.
  - Comprehensive Import-Export reports within custom date ranges.
  - **Customizable Low-Stock Alerts:** Admin can define the threshold for "low stock" warnings per product.

## 🗄️ Database Architecture
- Strictly adheres to **1:N (One-to-Many)** relational database design principles.
- Ensures absolute data integrity without orphaned records.

## ⚙️ Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/tlong1312/lego_store.git
2. **Database Setup:**
   - Import the `database.sql` file into your MySQL server (via phpMyAdmin or CLI).
   - Update the database credentials in the configuration file (e.g., `config/database.php`).

3. **Environment:**
   - Ensure your server runs PHP 8.x and MySQL 8.x.
   - The application uses **relative paths**, ensuring seamless execution across different environments (localhost or live server).

4. **Run the Application:**
   - Access the client portal via `http://localhost/lego_store/`
   - Access the admin portal via `http://localhost/lego_store/index.php?controller=dashboard&action=index`

## 📸 Screenshots

### Client Interface
*(Add your screenshot of the homepage or registration form here)*
![Register Form](#)

### Smart Validation & Notifications
*(Add your screenshot of the SweetAlert notification here)*
![SweetAlert Notification](#)

## 👨‍💻 Team Members

| STT | Student ID (MSSV) | Full Name (Họ Tên) | Role / Tasks (Nhiệm vụ) | Contribution (%) |
| :---: | :--- | :--- | :--- | :---: |
| 1 | 3122410215 | **Đặng Tiểu Long** | Full-stack Developer | 50% |
| 2 | 3122410218 | **Trần Hoàng Long** | Full-stack Develope | 50% |

---
*Project evaluated on Firefox / Google Chrome as per university standards.*

   
