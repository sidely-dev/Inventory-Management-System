--To make sure our dashboard is populated with some data, we will create a seed.sql file that will insert some sample data into our database tables. This will help us test our application and ensure that everything is working as expected.

--Inserting sample data into Categories table
INSERT INTO Categories (CategoryName) VALUES
('Electronics'),
('Clothing'),
('Home & Kitchen'),
('Books'),
('Toys');

--Inserting sample data into Products table
INSERT INTO Products (CategoryID, ProductName, Price, sku, Description, QuantityInStock) VALUES
(1, 'Smartphone', 699.99, 'SKU001', 'Latest model smartphone with advanced features', 50),
(1, 'Laptop', 999.99, 'SKU002', 'High-performance laptop for professionals', 30),
(2, 'T-Shirt', 19.99, 'SKU003', 'Comfortable cotton t-shirt', 100),
(3, 'Coffee Maker', 49.99, 'SKU004', 'Automatic coffee maker with grinder', 20),
(4, 'Novel Book', 14.99, 'SKU005', 'Bestselling novel by famous author', 75),
(5, 'Action Figure', 29.99, 'SKU006', 'Collectible action figure from popular movie', 60);
