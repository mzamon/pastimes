## Mzamo Ndlovu
Pastimes Marketplace / ClothingStore Demo

## Requirements

| Requirement | Version |
|---|---|
| XAMPP | 8.x (Apache + MySQL + PHP 8.0+) |
| PHP | 8.0 or higher |
| MySQL / MariaDB | 5.7+ / 10.3+ |
| Browser | Any modern browser with JavaScript |

---

## Installation

### Step 1 — Copy files
```
C:\xampp\htdocs\pastimes\
```

### Step 2 — Import database
1. Start Apache and MySQL in the XAMPP Control Panel
2. Open **phpMyAdmin** at `http://localhost/phpmyadmin`
3. Click **Import** → Select `pastimes/myClothingStore.sql` → Click **Go**

If you want the POE-named database, run the loader below after importing.

### Step 2b — Seed full demo data
Run the loader script once after the schema is imported:
```
http://localhost/pastimes/loadClothingStore.php
```
This creates or refreshes the `ClothingStore` database and inserts the larger demo set required for the POE.

To rebuild the POE-style `tblUser` table from the text file, run:
```
http://localhost/pastimes/createTable.php
```

### Step 3 — Verify database connection
Open `/pastimes/config/DBConn.php` and confirm:
```php
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');          // Default XAMPP MySQL has no password
define('DB_NAME', 'ClothingStore');
```

### Step 4 — Verify image directories exist
Ensure these folders are present and writable:
```
pastimes/assets/images/vintage-clothing/
pastimes/assets/images/streetwear/
pastimes/assets/images/sports-gear/
pastimes/assets/images/books/
pastimes/assets/images/collectibles/
pastimes/assets/images/electronics/
pastimes/assets/images/placeholder/
pastimes/assets/images/uploads/          ← create this if missing
```

### Step 5 — Run
```
http://localhost/pastimes/
```

Use the user login for buyers/sellers and the Admin button for the separate admin login flow.

---

## Test Accounts

| Role   | Email                 | Password   |
|--------|-----------------------|------------|
| Admin  | admin@pastimes.co.za  | password   |
| Buyer  | john@example.com      | password   |
| Seller | sarah@example.com     | password   |
| Seller | mike@example.com      | password   |

---

## Feature Map

### LU4 — PHP & MySQL
- Full CRUD for products (Create, Read, Update, Delete)
- Prepared statements (`mysqli_prepare` / `mysqli_stmt_bind_param`) on **all** queries
- Normalised schema (1NF–3NF) with foreign key constraints
- `ON DELETE CASCADE` / `RESTRICT` referential integrity
- FULLTEXT search index on products

### LU5 — State Management
- `session_start()` centralised in `functions.php` (fires once per request)
- `$_SESSION['user_id']`, `['user_name']`, `['role']`, `['cart']` 
- Session cart persists across all pages (cart count in nav updated on every request)
- `session_regenerate_id(true)` on login (prevents session fixation)
- Secure logout: session wiped, cookie expired, `session_destroy()` called
- Role-based access: `requireLogin()`, `requireSeller()`, `requireAdmin()` guards

### UI & Responsiveness
- Mobile-first CSS (base = single column)
- CSS Grid & Flexbox layouts
- Breakpoints: **480px** (mobile) and **768px** (tablet)
- Hamburger navigation on ≤480px
- Touch-friendly 48px+ tap targets

### Security
- `password_hash(PASSWORD_DEFAULT)` + `password_verify()` — modern hash support
- `md5()` compatibility for POE sample data loaded from `userData.txt`
- Login accepts a username + email + password combination and shows the logged-in user table on success
- `sanitize()` — trims/strips for input; `h()` — `htmlspecialchars` on all output
- No raw SQL concatenation anywhere
- Ownership verification before edit/delete operations
- File upload: extension whitelist + `uniqid()` filename obfuscation

### POE Compliance Additions
- New users stay pending until an administrator verifies them
- Seller requests are submitted through `/auth/request_seller.php`
- Admin verification and user management are handled in `/admin/verify_users.php` and `/admin/users.php`
- `loadClothingStore.php` recreates and seeds the database for the full demo
- `createTable.php` rebuilds `tblUser` from `userData.txt`
- Documentation folders are reserved under `/documentation`
- `POE_Documentation.md` contains the Word-style project documentation in Markdown format

---

## Troubleshooting

**Blank page / errors on screen** — Enable error reporting in `config/DBConn.php`:
```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

**Images not showing** — Check that placeholder/no-image.jpg exists and that the path in `getProductImage()` resolves correctly.

**Image upload fails** — Right-click `assets/images/uploads/`, Properties → Security → allow write for Apache user (Windows: `Everyone`).

**Session not persisting** — Confirm `session.save_path` is writable in `php.ini` and that no output precedes `session_start()`.
