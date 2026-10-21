# 🗄️ Database Architecture & Structural Summary Report
**Project Name:** Centralized Inventory Management System (IMS)  
**System Architecture Paradigm:** Full-Stack Layered Architecture (Separated Concerns)  
**Target RDBMS Engine:** MySQL Relational Cluster

---

## 1. Executive Architectural Overview
The storage tier of the Inventory Management System is constructed using a normalized, relational database model managed under **MySQL**. In strict compliance with professional architectural specifications, the web ecosystem isolates database activities entirely. **The browser frontend never establishes a direct transport line to the database cluster.** 

Instead, a secure intermediate business service layer written in **PHP** leverages native **PDO (PHP Data Objects)** drivers to handle query executions, validate variables, process record sanitizations, and prevent direct external surface exposure.

---

## 2. Entity Relation Matrix & Schema Normalization
The data storage architecture resolves layout mapping dependencies by implementing a distinct structural separation between classification properties (Categories) and individual stock items (Products).

### A. The 'Categories' Table Schema
Acts as a parent entity reference anchor. Individual product records reference this layer to organize items dynamically without repeating string literals.
*   `CategoryID` (INT, AUTO_INCREMENT, PRIMARY KEY): The singular indexed identifier token.
*   `CategoryName` (VARCHAR(100), NOT NULL): The formal text string descriptor defining the warehouse group (e.g., *Electronics*, *Office Supplies*).
*   `CreatedAt` (TIMESTAMP): Logs exact system arrival times automatically.

### B. The 'Products' Table Schema
Manages localized physical inventory specification metrics persistently.
*   `ProductID` (INT, AUTO_INCREMENT, PRIMARY KEY): Unique system tracking index.
*   `ProductName` (VARCHAR(100), NOT NULL): Standard identification descriptor title.
*   `CategoryID` (INT, FOREIGN KEY): Maps a direct relational constraint link to the parent Categories table.
*   `Price` (DECIMAL(10, 2), NOT NULL): Financial value descriptor tracking money fields securely. Uses exact decimal storage layout matrices instead of unstable floating floats to guarantee decimal absolute calculation precision.
*   `sku` (VARCHAR(50), UNIQUE, NOT NULL): Stock Keeping Unit string tracking label. The application forces global alphanumeric uniqueness to prevent duplicate item registrations.
*   `QuantityInStock` (INT, NOT NULL): Quantitative item storage ledger integers.
*   `CreatedAt` / `UpdatedAt` (TIMESTAMP): Automated record lifecycle logging tracking parameters.

---

## 3. Data Integrity & Relational Constraints Configuration
To ensure maximum operational stability, the schema implements strict integrity assertions:

1.  **Foreign Key Mapping:** The system establishes an immutable logical constraint link binding `Products.CategoryID` directly to `Categories.CategoryID`.
2.  **Cascade Operations (`ON DELETE CASCADE`):** If a core administrative Category row is truncated, the database engine executes automated deep structural cleanups, instantly clearing out any nested product child rows to prevent orphaned database elements.
3.  **Prepared Parameter Injection Protection:** All backend data creation, update, and deletion tasks pass exclusively through parameterized prepared statements. This technique separates user input data from operational SQL commands entirely, blocking malicious SQL Injection attacks by design.
