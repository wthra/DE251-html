# 🌸 Little Orchid Shop (E-Commerce)

**Little Orchid Shop** is a dynamic, lightweight e-commerce web application built with **PHP** and **MySQL**. This project demonstrates a fully functional online store featuring a user-friendly frontend for customers and a robust dashboard for administrators to manage products, orders, and sales performance.

The interface is styled with **Bootstrap 5**, ensuring a responsive and modern design across all devices.

---

## 🚀 Tech Stack

* **Backend:** PHP (PDO & MySQLi)
* **Frontend:** HTML5, CSS3, Bootstrap 5.3.2
* **Database:** MySQL
* **Scripting:** JavaScript

---

## ✨ Key Features

### 🛒 For Customers (User)
* **Responsive Browsing:** View featured products, best sellers, and detailed descriptions.
* **Shopping Cart System:** Add items, adjust quantities, and remove products seamlessly (Session-based).
* **Secure Checkout:** Complete orders with shipping details and payment method selection.
* **Order Tracking:** View order history and real-time status updates via the user account panel.
* **Authentication:** Secure registration and login functionality.

### 🛠️ For Administrators (Admin)
* **Dashboard Overview:** Visualize key metrics at a glance:
    * Total Revenue & Average Order Value
    * Total Orders & Products
    * Pending Orders alert
* **Inventory Management:** Add, edit, and delete products easily.
* **Order Processing:** Update order statuses (e.g., Pending → Shipped → Completed).
* **User Management:** Oversee registered users and system access.

---

## ⚙️ Installation & Setup

Follow these steps to run the project locally:

### 1. Prerequisites
Ensure you have a local server environment installed:
* [XAMPP](https://www.apachefriends.org/) (Recommended)
* WAMP or MAMP

### 2. Clone or Download
Download the source code and place the folder into your server's root directory:
* **XAMPP:** `C:\xampp\htdocs\simple-ecommerce-shop`
* **MAMP:** `/Applications/MAMP/htdocs/simple-ecommerce-shop`

### 3. Database Setup
1. Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
2. Create a new database named: `ecommerce`
3. Import the provided SQL file: `/sql/ecommerce.sql`

### 4. Configuration
Verify the database connection settings in `db.php` and `db_pdo.php`. Default settings for XAMPP are:
```php
$host = 'localhost';
$dbname = 'ecommerce';
$user = 'root';
$password = ''; // Leave empty for XAMPP

```

User Roles and Credentials
The application includes predefined accounts to help you test role-based access control:

User Role:

Username: user
Password: user123
Admin Role:

Username: admin
Password: admin123
Use these credentials to log in and explore the respective functionalities for users and administrators.


5. Run the Project
Open your browser and navigate to: http://localhost/simple-ecommerce-shop/

🔐 Login Credentials (Demo)
The project comes with pre-configured accounts for testing:

Role Username Password  Access Level
Admin admin   admin123  "Full Access (Dashboard, Products, Orders)"
User  user    user123   "Shopping, Cart, Order History"


📂 Project Structure
```
/simple-ecommerce-shop
├── admin_dashboard.php  # Admin control panel
├── cart.php             # Shopping cart logic
├── confirm_checkout.php # Order processing
├── db.php               # Database connection (MySQLi)
├── db_pdo.php           # Database connection (PDO)
├── index.php            # Homepage
├── products.php         # Product listing
└── ...









