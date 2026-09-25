# 📦 Inventory Management System

> A web-based inventory management system designed to help small businesses manage, monitor and maintain their inventory through a centralized database.

![Status](https://img.shields.io/badge/Status-In%20Development-yellow?style=for-the-badge)
![Version](https://img.shields.io/badge/Version-0.1.0-blue?style=for-the-badge)
![Stack](https://img.shields.io/badge/Stack-HTML%20%7C%20CSS%20%7C%20JavaScript%20%7C%20PHP%20%7C%20MySQL-orange?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

---

## 📑 Table of Contents

* [About](#-about)
* [Project Objectives](#-project-objectives)
* [Project Scope](#-project-scope)
* [System Features](#-system-features)
* [System Architecture](#-system-architecture)
* [Project Structure](#-project-structure)
* [Technology Stack](#-technology-stack)
* [Database Architecture](#-database-architecture)
* [Application Flow](#-application-flow)
* [Frontend Structure](#-frontend-structure)
* [Backend Structure](#-backend-structure)
* [API Structure](#-api-structure)
* [Analytics Dashboard](#-analytics-dashboard)
* [Validation](#-validation)
* [Security Considerations](#-security-considerations)
* [Development Roadmap](#-development-roadmap)
* [Testing](#-testing)
* [Screenshots](#-screenshots)
* [Known Issues](#-known-issues)
* [Future Improvements](#-future-improvements)
* [Learning Goals](#-learning-goals)
* [License](#-license)
* [Author](#-author)

---

# 📖 About

The **Inventory Management System (IMS)** is a web-based application designed to help a simulated small retail or wholesale business manage its inventory more efficiently.

The system provides a centralized interface for users to:

* Add products
* View products
* Edit product information
* Delete products
* Search for products
* Filter products by category
* View current stock quantities
* Store inventory information persistently in MySQL
* Validate submitted information

The project is being developed as a practical full-stack software development project using a layered architecture.

---

# 🎯 Project Objectives

* [ ] Develop a functional web-based inventory management system
* [ ] Create a centralized MySQL inventory database
* [ ] Implement product CRUD functionality
* [ ] Implement product searching
* [ ] Implement category filtering
* [ ] Display current stock quantities
* [ ] Implement client-side validation
* [ ] Implement server-side validation
* [ ] Connect the frontend to a PHP backend
* [ ] Connect the PHP backend to MySQL
* [ ] Test the complete application
* [ ] Document the system and development process

### Optional Objective

* [ ] Add a basic inventory analytics dashboard if approved within the project scope

---

# 📌 Project Scope

## ✅ Version 1 — In Scope

### Inventory Management

* Create product records
* View product records
* Update product records
* Delete product records
* Display stock quantities
* Search products
* Filter products by category

### Validation

* Client-side form validation
* Server-side form validation
* Required-field validation
* Numeric validation for stock quantities
* Appropriate validation for product information

### Database

* MySQL relational database
* Persistent product storage
* Category/product relationship

### Interface

* Browser-based application
* Inventory dashboard
* Product management interface
* Add/edit product forms
* Search and filtering interface

---

## ❌ Version 1 — Out of Scope

The following features are intentionally excluded from the initial version:

* User accounts
* Authentication
* Role-based access control
* Payments
* Invoicing
* Accounting integration
* Supplier management
* Purchase-order workflows
* Native mobile application
* Barcode scanner hardware
* Advanced AI functionality

This keeps the first version achievable within the project's available time.

---

# 🚀 System Features

| Feature                   | Status          |
| ------------------------- | --------------- |
| Product CRUD              | 🟡 Planned      |
| Product Search            | 🟡 Planned      |
| Category Filtering        | 🟡 Planned      |
| Stock Quantity Management | 🟡 Planned      |
| Client-Side Validation    | 🟡 Planned      |
| Server-Side Validation    | 🟡 Planned      |
| MySQL Persistence         | 🟡 Planned      |
| Dashboard                 | 🟡 Planned      |
| Analytics                 | ⚪ Optional      |
| Authentication            | 🔴 Out of Scope |
| Supplier Management       | 🔴 Out of Scope |
| Payments                  | 🔴 Out of Scope |
| Mobile Application        | 🔴 Out of Scope |

---

# 🏗️ System Architecture

The application will use a simple layered architecture.

```text
┌───────────────────────────────────────────────┐
│                    USER                       │
│                                               │
│             Web Browser                      │
└───────────────────────┬───────────────────────┘
                        │
                        ▼
┌───────────────────────────────────────────────┐
│                 FRONTEND                      │
│                                               │
│        HTML + CSS + JavaScript                │
│                                               │
│  • User Interface                             │
│  • Forms                                      │
│  • Search                                     │
│  • Filtering                                  │
│  • Client-side validation                    │
└───────────────────────┬───────────────────────┘
                        │
                        │ HTTP Requests
                        ▼
┌───────────────────────────────────────────────┐
│                  BACKEND                      │
│                                               │
│                    PHP                        │
│                                               │
│  • Business Logic                             │
│  • Server-side validation                     │
│  • CRUD operations                            │
│  • Database communication                     │
└───────────────────────┬───────────────────────┘
                        │
                        │ SQL Queries
                        ▼
┌───────────────────────────────────────────────┐
│                  DATABASE                     │
│                                               │
│                   MySQL                       │
│                                               │
│  • Products                                   │
│  • Categories                                 │
│  • Inventory information                      │
└───────────────────────────────────────────────┘
```

### Request Flow

A typical request should follow:

```text
User
 ↓
HTML Form
 ↓
JavaScript Validation
 ↓
PHP Endpoint
 ↓
Server-side Validation
 ↓
Database Query
 ↓
MySQL
 ↓
PHP Response
 ↓
JavaScript / HTML Update
 ↓
User
```

The important idea is:

> **The browser should not communicate directly with MySQL.**

PHP acts as the backend layer between the frontend and database.

---

# 📁 Project Structure

The target project structure is:

```text
inventory-management-system/
│
├── README.md
├── LICENSE
├── .gitignore
│
├── docs/
│   ├── requirements/
│   ├── system-design/
│   ├── database/
│   └── screenshots/
│
├── database/
│   ├── schema.sql
│   ├── seed.sql
│   └── README.md
│
├── public/
│   ├── index.php
│   │
│   ├── assets/
│   │   ├── css/
│   │   │   ├── style.css
│   │   │   ├── dashboard.css
│   │   │   ├── products.css
│   │   │   └── forms.css
│   │   │
│   │   ├── js/
│   │   │   ├── main.js
│   │   │   ├── products.js
│   │   │   ├── dashboard.js
│   │   │   └── validation.js
│   │   │
│   │   └── images/
│   │
│   └── pages/
│       ├── dashboard.php
│       ├── products.php
│       ├── add-product.php
│       ├── edit-product.php
│       └── categories.php
│
├── src/
│   │
│   ├── config/
│   │   └── database.php
│   │
│   ├── controllers/
│   │   ├── ProductController.php
│   │   └── CategoryController.php
│   │
│   ├── models/
│   │   ├── Product.php
│   │   └── Category.php
│   │
│   ├── services/
│   │   └── InventoryService.php
│   │
│   ├── repositories/
│   │   ├── ProductRepository.php
│   │   └── CategoryRepository.php
│   │
│   ├── validation/
│   │   └── ProductValidator.php
│   │
│   └── routes/
│       └── api.php
│
├── api/
│   ├── products/
│   │   ├── create.php
│   │   ├── read.php
│   │   ├── update.php
│   │   └── delete.php
│   │
│   └── categories/
│       ├── create.php
│       ├── read.php
│       ├── update.php
│       └── delete.php
│
└── tests/
    ├── frontend/
    ├── backend/
    └── database/
```

---

# 🧠 Understanding the Folder Structure

Don't try to build all of these folders immediately.

The structure represents the **target architecture**, not what you need to create on Day 1.

## `public/`

Contains files that the browser interacts with.

```text
public/
```

Think:

> "What does the user see?"

---

## `src/`

Contains the application's backend logic.

```text
src/
```

Think:

> "How does the application work?"

---

## `database/`

Contains SQL scripts used to create and populate the database.

```text
database/
```

Think:

> "How is the data stored?"

---

## `api/`

Contains PHP endpoints that allow the frontend to communicate with the backend.

```text
api/
```

Think:

> "How does the frontend request something from the backend?"

---

## `tests/`

Contains tests for different parts of the system.

```text
tests/
```

Think:

> "How do we know the system works?"

---

## `docs/`

Contains project documentation and design material.

```text
docs/
```

Think:

> "How do we explain and document the system?"

---

# 💻 Technology Stack

| Technology                          | Purpose                                  |
| ----------------------------------- | ---------------------------------------- |
| HTML5                               | Page structure                           |
| CSS3                                | Interface styling                        |
| JavaScript                          | Client-side interaction and validation   |
| PHP                                 | Backend logic and database communication |
| MySQL                               | Persistent relational data storage       |
| Git                                 | Version control                          |
| GitHub                              | Source-code repository                   |
| XAMPP / PHP Development Environment | Local development                        |

---

# 🗄️ Database Architecture

The initial database should remain simple.

### Entity Relationship

```text
┌───────────────────┐
│     CATEGORY      │
├───────────────────┤
│ category_id (PK)  │
│ category_name     │
└─────────┬─────────┘
          │
          │ 1
          │
          │
          │ *
┌─────────▼─────────┐
│      PRODUCT      │
├───────────────────┤
│ product_id (PK)   │
│ product_name      │
│ category_id (FK)  │
│ description       │
│ price             │
│ stock_quantity    │
└───────────────────┘
```

### Relationship

```text
One Category
      │
      ├── Product
      ├── Product
      ├── Product
      └── Product
```

A category can contain multiple products.

Each product belongs to a category.

---

# 🔄 Application Flow

## Add Product

```text
User
 ↓
Add Product Form
 ↓
JavaScript Validation
 ↓
Submit
 ↓
PHP
 ↓
Server-side Validation
 ↓
INSERT SQL Query
 ↓
MySQL
 ↓
Success Response
 ↓
Product List Updated
```

---

## Edit Product

```text
User selects Edit
        ↓
Product ID
        ↓
PHP retrieves product
        ↓
Edit form populated
        ↓
User changes information
        ↓
Validation
        ↓
PHP
        ↓
UPDATE query
        ↓
MySQL
        ↓
Updated product displayed
```

---

## Delete Product

```text
User selects Delete
        ↓
Confirmation
        ↓
PHP
        ↓
DELETE query
        ↓
MySQL
        ↓
Product removed
        ↓
Inventory refreshed
```

---

## Search Product

```text
Search box
     ↓
JavaScript captures input
     ↓
Search request
     ↓
PHP
     ↓
MySQL query
     ↓
Matching products
     ↓
Results displayed
```

---

# 🎨 Frontend Structure

The frontend should eventually contain the following main views.

### Dashboard

```text
Dashboard
│
├── Total Products
├── Total Stock
├── Categories
├── Low Stock Items
│
├── Stock Overview
└── Category Overview
```

### Products

```text
Products
│
├── Search
├── Category Filter
├── Add Product
│
└── Product Table
      ├── ID
      ├── Name
      ├── Category
      ├── Price
      ├── Quantity
      └── Actions
            ├── Edit
            └── Delete
```

### Product Form

```text
Add / Edit Product

Product Name
Category
Description
Price
Stock Quantity

[Cancel] [Save Product]
```

---

# ⚙️ Backend Structure

The PHP backend should eventually be separated into responsibilities.

```text
Request
   ↓
Controller
   ↓
Validation
   ↓
Service
   ↓
Repository
   ↓
MySQL
```

### Controller

Handles the incoming request.

Example responsibility:

```text
"Create a product"
```

### Validation

Checks whether the submitted information is valid.

Example:

```text
Product name cannot be empty
Price must be numeric
Quantity must be a valid number
```

### Service

Contains inventory-related business logic.

Example:

```text
Calculate whether stock is valid
Prepare inventory operation
```

### Repository

Handles database operations.

Example:

```text
INSERT
SELECT
UPDATE
DELETE
```

This separation makes the application easier to maintain as it grows.

---

# 🔌 API Structure

The application can use PHP endpoints for the main inventory operations.

| Method | Endpoint                   | Purpose             |
| ------ | -------------------------- | ------------------- |
| GET    | `/api/products/read.php`   | Retrieve products   |
| POST   | `/api/products/create.php` | Create product      |
| POST   | `/api/products/update.php` | Update product      |
| POST   | `/api/products/delete.php` | Delete product      |
| GET    | `/api/categories/read.php` | Retrieve categories |

### Example Request

```text
Browser
   ↓
GET /api/products/read.php
   ↓
PHP
   ↓
SELECT ... FROM products
   ↓
MySQL
   ↓
PHP response
   ↓
Browser
```

The exact API design can be refined during the System Design phase.

---

# 📊 Analytics Dashboard

## Optional Feature

A basic analytics dashboard could make the system more useful **without turning it into a completely different project**.

However, because analytics was not part of the original approved Version 1 scope, it should be treated as an **optional feature requiring group/lecturer agreement**.

### Possible dashboard information

```text
┌─────────────────────────────────────────┐
│             INVENTORY DASHBOARD         │
├────────────┬────────────┬───────────────┤
│ Products   │ Categories │ Low Stock     │
│    24      │     5      │      3        │
├────────────┴────────────┴───────────────┤
│                                         │
│          Stock Value / Quantity         │
│              Trend Chart                │
│                                         │
├───────────────────────┬─────────────────┤
│ Products by Category  │ Stock Status    │
│                       │                 │
│       Chart           │   In Stock      │
│                       │   Low Stock     │
│                       │   Out of Stock  │
└───────────────────────┴─────────────────┘
```

### Keep the analytics simple

For the first version, useful metrics could be:

* Total number of products
* Total number of categories
* Total stock quantity
* Products with low stock
* Products with zero stock
* Products per category

Avoid initially adding:

* Machine learning
* Demand forecasting
* AI predictions
* Complex financial analytics
* External business intelligence platforms

The goal should be:

> **Use the data already stored by the inventory system to present useful information.**

That makes the dashboard a natural extension of the project.

---

# 🛡️ Validation

Validation will happen at two levels.

## Client-Side

```text
HTML
 ↓
JavaScript
 ↓
User receives immediate feedback
```

Examples:

* Required fields
* Invalid numbers
* Empty product name
* Invalid price

## Server-Side

```text
Request
 ↓
PHP
 ↓
Validate
 ↓
Database
```

Server-side validation is required even if JavaScript validation exists because browser-side validation should not be trusted as the only protection.

---

# 🔐 Security Considerations

Although authentication is outside Version 1, the system should still follow basic secure development practices.

### Database

* Use prepared statements
* Validate input
* Avoid directly concatenating user input into SQL queries
* Restrict database credentials
* Do not commit database passwords to GitHub

### PHP

* Validate incoming data
* Sanitize output where appropriate
* Handle database errors safely
* Do not expose sensitive database information to users

### GitHub

Do not commit:

```text
database passwords
API keys
private credentials
environment secrets
```

Use environment/configuration files that are excluded from Git where appropriate.

---

# 🗺️ Development Roadmap

## Phase 1 — Project Foundation

* [ ] Create GitHub repository
* [ ] Create project folder structure
* [ ] Configure local PHP environment
* [ ] Create MySQL database
* [ ] Create initial tables
* [ ] Test PHP → MySQL connection

---

## Phase 2 — Frontend

* [ ] Create main layout
* [ ] Create navigation
* [ ] Create dashboard
* [ ] Create products page
* [ ] Create product form
* [ ] Create category interface
* [ ] Add responsive styling if required

---

## Phase 3 — Backend

* [ ] Create database connection
* [ ] Create Product model
* [ ] Create Category model
* [ ] Implement Create
* [ ] Implement Read
* [ ] Implement Update
* [ ] Implement Delete
* [ ] Implement server-side validation

---

## Phase 4 — Integration

* [ ] Connect frontend to PHP
* [ ] Connect PHP to MySQL
* [ ] Display database products
* [ ] Create products from frontend
* [ ] Edit products
* [ ] Delete products
* [ ] Search products
* [ ] Filter products

---

## Phase 5 — Dashboard

* [ ] Display product count
* [ ] Display category count
* [ ] Display stock quantity
* [ ] Display low-stock products
* [ ] Add basic charts if approved
* [ ] Connect dashboard information to database

---

## Phase 6 — Testing

* [ ] Test product creation
* [ ] Test product retrieval
* [ ] Test product editing
* [ ] Test product deletion
* [ ] Test search
* [ ] Test filtering
* [ ] Test validation
* [ ] Test invalid input
* [ ] Test database persistence
* [ ] Test integration between frontend/backend/database

---

## Phase 7 — Documentation

* [ ] Finalize system documentation
* [ ] Add architecture diagrams
* [ ] Add database ERD
* [ ] Add screenshots
* [ ] Document testing
* [ ] Document known issues
* [ ] Prepare presentation

---

# 🧪 Testing

Testing will be performed throughout development rather than only at the end.

### Example Test Cases

| Test                         | Expected Result             |
| ---------------------------- | --------------------------- |
| Add valid product            | Product is stored           |
| Add product with empty name  | Validation error            |
| Enter invalid price          | Validation error            |
| Edit existing product        | Product information updates |
| Delete product               | Product is removed          |
| Search existing product      | Matching product displayed  |
| Search unavailable product   | No matching result          |
| Filter by category           | Correct products displayed  |
| Refresh page                 | Data remains in database    |
| Enter invalid stock quantity | Validation error            |

---

# 📸 Screenshots

Screenshots will be added as the application develops.

### Planned Screenshots

```text
docs/
└── screenshots/
    ├── dashboard.png
    ├── products.png
    ├── add-product.png
    ├── edit-product.png
    └── analytics.png
```

---

# ⚠️ Known Issues

Currently:

* Project is under development
* Backend functionality is not yet complete
* Database structure may change during System Design
* UI is subject to refinement
* Analytics dashboard has not yet been confirmed as part of Version 1

---

# 🔮 Future Improvements

Potential future versions may include:

* User authentication
* Role-based access
* Supplier management
* Purchase orders
* Stock movement history
* Barcode scanning
* Advanced reporting
* Export to CSV/PDF
* Email notifications
* Mobile application
* Advanced analytics
* Automated stock alerts

These features are **not part of the initial Version 1 implementation**.

---

# 📚 Learning Goals

This project is also intended as a practical learning experience.

Through the project, the team aims to develop experience with:

* Full-stack web development
* HTML/CSS
* JavaScript
* PHP
* MySQL
* CRUD operations
* Relational databases
* SQL
* Client-server architecture
* API design
* Input validation
* Software architecture
* Git/GitHub
* Testing
* Team-based software development
* Project documentation

---

# 📜 License

This project is licensed under the MIT License.

---

# 👨‍💻 Author

**IT Project Group**

Developed as part of an Information Technology project.

---

> **Project principle:** Build the simplest working system first, understand every layer, then improve it.
