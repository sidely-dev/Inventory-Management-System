<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: ../index.php");
    exit;
}
?>

<select id="category-filter">
    <option value="">📁 All Categories</option>
</select>


<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="product-table-body">
            <!-- Dynamic rows will be injected here -->
        </tbody>
    </table>
</div>

