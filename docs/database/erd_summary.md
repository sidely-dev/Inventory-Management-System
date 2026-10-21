# 🗄️ Relational Database Management Architecture (IMS)

## Normalization Specifications (1NF to 3NF)
Our storage architecture avoids relational duplicate data anomalies by separating item definitions from their parent classifications:

1. **Categories Table:** Maps unique relational identity tags (`CategoryID`) to specific catalog segments (`CategoryName`).
2. **Products Table:** Houses product specifications, indexing cost values using precise `DECIMAL(10,2)` columns instead of unstable floating floats to maintain absolute precision during live updates.

## Cascading Relations
The entity relationships use explicit foreign key constraints:
```sql
FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID) ON DELETE CASCADE
```
*   **ON DELETE CASCADE:** Guarantees data consistency. If a parent category record is deleted, all matching product items are cleared automatically from the ledger to prevent orphaned database fragments.
