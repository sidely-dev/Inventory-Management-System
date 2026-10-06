# 📦 Inventory Management System

> A web-based inventory management system for a simulated small retail business, designed to help users maintain product records and monitor stock from one central application.

![Status](https://img.shields.io/badge/Status-In%20Development-yellow?style=for-the-badge)
![Version](https://img.shields.io/badge/Version-0.1.0-blue?style=for-the-badge)
![Stack](https://img.shields.io/badge/Stack-HTML%20%7C%20CSS%20%7C%20JavaScript%20%7C%20PHP%20%7C%20MySQL-orange?style=for-the-badge)

---

## 📑 Table of Contents
- [About](#-about)
- [Project Objectives](#-project-objectives)
- [Scope](#-scope)
- [Planned Features](#-planned-features)
- [Technology Stack](#-technology-stack)
- [System Architecture](#-system-architecture)
- [Proposed Project Structure](#-proposed-project-structure)
- [Database Design](#-database-design)
- [How the Application Works](#-how-the-application-works)
- [Local Setup](#-local-setup)
- [Security and Validation](#-security-and-validation)
- [Testing Plan](#-testing-plan)
- [Development Roadmap](#-development-roadmap)
- [Current Status and Known Decisions](#-current-status-and-known-decisions)
- [Future Improvements](#-future-improvements)
- [Learning Goals](#-learning-goals)
- [Contributors](#-contributors)

---

## 📖 About

The **Inventory Management System (IMS)** is a college group project proposing a web application for managing basic inventory in a simulated small retail business.

Manual records and spreadsheets can become difficult to maintain and may lead to inaccurate quantities, missing information, duplicate records, stock shortages, or delays when searching for products. The proposed system aims to organise product information in one place and make common inventory tasks easier to perform.

The project is a practical exercise in system analysis, project planning, web development, database design, testing, documentation, and teamwork. Features listed as planned are not considered complete until implemented and tested.

## 🎯 Project Objectives

- [ ] Create a usable web interface for inventory management.
- [ ] Store product and stock information in a MySQL database.
- [ ] Implement the core product operations: create, read, update, and delete (CRUD).
- [ ] Allow users to search for products.
- [ ] Organise products by category if confirmed in the final requirements.
- [ ] Validate data in both the browser and PHP backend.
- [ ] Test the main features and document the results.
- [ ] Apply the required project-management and SDLC deliverables.

## 📌 Scope

### Version 1 — Proposed Core Scope
- Add, view, edit, and delete product records.
- Store product name, category, quantity, price, and description where those fields are approved.
- Search the product list.
- Display current stock quantities.
- Persist inventory data in MySQL.
- Provide clear feedback when an operation succeeds or fails.

### Not Included Unless the Group Approves a Change
- Online payments or invoicing.
- Accounting integration.
- Supplier and purchase-order management.
- A native mobile application.
- Barcode-scanner hardware.
- AI-based demand forecasting.
- Advanced analytics or reporting beyond the agreed requirements.
- User accounts and role-based permissions (to be decided during requirements analysis).

Changes to scope should be agreed by the group and recorded in the project documentation.

## 🚀 Planned Features

| Feature | Status |
|---|---|
| Product CRUD | Planned |
| Stock quantity management | Planned |
| Product search | Planned |
| Category filtering | To confirm |
| Client-side validation | Planned |
| PHP server-side validation | Planned |
| MySQL persistence | Planned |
| Dashboard / summary metrics | Optional; confirm scope |
| Authentication / user roles | To decide |
| Automated tests | To plan |

> **Status note:** Update this table as work is implemented and verified. Do not label a feature complete until it has been tested.

## 🧰 Technology Stack

| Technology | Intended role |
|---|---|
| HTML | Structure of pages and forms |
| CSS | Layout and visual styling |
| JavaScript | Browser-side interactions and immediate form feedback |
| PHP | Server-side logic, validation, and database communication |
| MySQL | Persistent relational data storage |
| Apache (for example, through XAMPP) | Serves the local web application and handles PHP requests |
| Git and GitHub | Version control and collaboration |
| VS Code | Code editor |

The backend choice in this README assumes the group agrees to use PHP. Confirm that decision against course requirements before treating it as final.

## 🏗️ System Architecture

The proposed application uses a simple client-server structure:

```text
User
  |
  v
Web Browser
HTML + CSS + JavaScript
  |
  | HTTP request / form submission
  v
Apache + PHP
- Handles requests
- Validates submitted data
- Applies application rules
- Runs database operations
  |
  | SQL queries
  v
MySQL Database
- Product records
- Categories, if used
  |
  v
PHP response
  |
  v
Browser displays updated data or feedback
```

**Important:** browser-side JavaScript should not connect directly to MySQL. The PHP backend sits between the browser and the database. Apache handles the web request and, in a configured PHP environment, passes PHP files for execution. The browser receives the resulting HTML or response data, not the server-side PHP source.

## 📁 Proposed Project Structure

The final folder layout should match the team's actual implementation. Start small and add structure when it helps; do not create every folder before it is needed.

```text
inventory-management-system/
├── README.md
├── .gitignore
├── database/
│   ├── schema.sql
│   └── seed.sql                 # optional sample data
├── docs/
│   ├── planning/
│   ├── requirements/
│   ├── design/
│   └── screenshots/
├── public/                      # web-accessible files
│   ├── index.php
│   └── assets/
│       ├── css/
│       ├── js/
│       └── images/
├── src/                         # server-side application code
│   ├── config/
│   │   └── database.php
│   ├── includes/
│   └── functions/
└── tests/
```

This is a suggested structure, not a requirement. A small student project can begin with fewer files and be reorganised as the application grows.

## 🗄️ Database Design

The database schema must be confirmed during analysis and system design. A possible starting point is:

### `products`

| Field | Purpose |
|---|---|
| `product_id` | Unique product identifier (primary key) |
| `product_name` | Product name |
| `category_id` | Category reference, if categories are used |
| `description` | Optional description |
| `price` | Product price |
| `stock_quantity` | Current recorded quantity |

### `categories` (if approved)

| Field | Purpose |
|---|---|
| `category_id` | Unique category identifier (primary key) |
| `category_name` | Category name |

If categories are implemented, one category may be associated with many products. The final schema should define appropriate data types, primary and foreign keys, required fields, and constraints. This example is conceptual and is not a substitute for the approved ER diagram and SQL schema.

## 🔄 How the Application Works

### Example: Add a Product

1. The user fills in the product form in the browser.
2. JavaScript may provide immediate checks for missing or invalid input.
3. The form submits the data to PHP.
4. PHP validates the data again on the server.
5. PHP uses a prepared SQL statement to insert the record into MySQL.
6. The application returns a success or error response.
7. The browser displays feedback and refreshes or updates the product list.

### CRUD Operations
- **Create:** add a product.
- **Read:** display product records.
- **Update:** edit an existing product.
- **Delete:** remove a product, with a confirmation step where appropriate.

## 🖥️ Local Setup

These are general setup steps for a PHP/MySQL project using XAMPP. Adapt them to the actual repository and database files once those are available.

1. Install and open XAMPP (or another compatible local PHP environment).
2. Start **Apache** and **MySQL** from the control panel.
3. Place the project in the web server's document root, commonly `htdocs` in XAMPP.
4. Create the project database in phpMyAdmin or the MySQL client.
5. Import `database/schema.sql` if the team has created it.
6. Configure the database connection in the project's PHP configuration file. Use the local database name and credentials for your machine.
7. Open the project through the local server, for example:

   ```text
   http://localhost/inventory-management-system/public/
   ```

8. Test that PHP executes and that the application can connect to MySQL.

**Do not open PHP pages by double-clicking them or using a `file://` path.** PHP needs to run through a configured server. The URL above is an example; change it to match the actual folder and Apache configuration.

## 🛡️ Security and Validation

- Validate input in PHP, even if JavaScript validation is also used.
- Use prepared statements for database queries.
- Escape user-supplied values when displaying them in HTML.
- Validate numeric fields such as price and stock quantity.
- Handle database errors without exposing credentials or internal details.
- Keep database credentials out of the public repository.
- Add a suitable `.gitignore` for local configuration and secret files.
- If login is added, use secure password hashing and check permissions on the server.

Authentication and role-based access remain scope decisions until the group confirms them.

## 🧪 Testing Plan

Record the actual result of each test during development. These are example test cases to adapt.

| Test | Expected result |
|---|---|
| Add a valid product | Product is saved and appears in the list |
| Submit an empty product name | Validation message; no invalid record saved |
| Enter an invalid price or quantity | Input is rejected |
| Edit an existing product | Updated details persist in MySQL |
| Delete a product | Product is removed or handled according to the agreed delete design |
| Search for an existing product | Matching result is shown |
| Search for a missing product | Clear empty-state message is shown |
| Refresh the page | Saved records remain available |
| Enter special characters in text fields | Application handles them safely |
| Database connection fails | Application displays a safe, understandable error |

## 🗺️ Development Roadmap

Use the college's required project phases as the formal plan. The checklist below is a development aid and should be aligned with the group's WBS and Gantt chart.

### 1. Planning and Requirements
- [ ] Confirm the target business scenario and users.
- [ ] Agree on scope and exclusions.
- [ ] Confirm PHP as the backend and the final technology stack.
- [ ] Define functional and non-functional requirements.
- [ ] Create the WBS, Gantt chart, and PERT chart.
- [ ] Prepare initial data models.

### 2. System Design
- [ ] Design the application architecture.
- [ ] Create the ER diagram and database schema.
- [ ] Design the main pages and forms.
- [ ] Define validation rules and test cases.

### 3. Implementation
- [ ] Configure the local environment.
- [ ] Create and test the PHP-to-MySQL connection.
- [ ] Build the product list and form.
- [ ] Implement product CRUD.
- [ ] Implement search and any approved category features.
- [ ] Add validation and error handling.

### 4. Integration and Testing
- [ ] Test each core feature.
- [ ] Test frontend, PHP, and database integration.
- [ ] Fix defects and retest.
- [ ] Record test results and known limitations.

### 5. Documentation and Presentation
- [ ] Keep the project report aligned with the system actually built.
- [ ] Add diagrams and screenshots.
- [ ] Document test cases and results.
- [ ] Prepare the final demonstration and individual presentation.

## 📍 Current Status and Known Decisions

The project is under development. The following items should be confirmed or updated by the group:

- [ ] Final target business scenario.
- [ ] Approved Version 1 scope.
- [ ] Confirmation of PHP as the backend technology.
- [ ] Final product fields and category requirements.
- [ ] Whether authentication and user roles are required.
- [ ] Whether a dashboard or reports are required.
- [ ] Actual project structure and database schema.

Do not describe a feature as implemented until it exists in the code and has been tested. Update this section as decisions are made.

## 🔮 Future Improvements

Potential future additions, subject to time and approval, include:
- User authentication and role-based permissions.
- Supplier and purchase-order management.
- Stock movement history.
- Low-stock alerts.
- Export to CSV or PDF.
- More detailed reports.
- Barcode support.
- Mobile-friendly improvements.

These are possible extensions, not commitments for the first version.

## 📚 Learning Goals

Through the project, the team aims to practise:
- Requirements analysis and project planning.
- HTML, CSS, and JavaScript.
- PHP server-side programming.
- MySQL and relational database design.
- CRUD operations and input validation.
- Client-server architecture.
- Testing and debugging.
- Git/GitHub collaboration.
- Technical documentation and teamwork.

## 👥 Contributors

**IT Project Group**  
Developed as part of a college Information Technology project.

---

> **Project principle:** Build the smallest working version first, understand how each layer communicates, test it, and then improve it.
