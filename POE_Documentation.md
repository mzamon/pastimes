# Pastimes Marketplace / ClothingStore

## Portfolio of Evidence Documentation

### Project Overview
Pastimes Marketplace is a clothing marketplace web application built with PHP, MySQL, HTML, CSS, and JavaScript. The system supports buyer, seller, and admin workflows, including registration, verification, product browsing, cart management, checkout, order tracking, messaging, and seller-request approval.

### Technology Stack
- PHP 8.x with MySQLi
- MySQL / MariaDB database named `ClothingStore`
- XAMPP for local development and testing
- HTML5, CSS3, and a small amount of JavaScript for UI interactions

### Folder Structure
- `auth/` — login, register, logout, and admin login pages
- `admin/` — admin dashboard, verification queue, and user management
- `cart/` — cart view and cart actions
- `config/` — database connection files
- `includes/` — shared helpers, header, footer, and access guards
- `messages/` — inbox, chat, and send message pages
- `orders/` — checkout, confirmation, tracking, and seller management
- `products/` — browse, view, add, edit, and delete product pages
- `assets/` — CSS, JavaScript, and image folders

### Database Summary
The database uses POE-aligned table names for the main entities:
- `tblUser` — buyers, sellers, and admin accounts
- `tblProducts` — listed items for sale
- `tblOrders` — customer order headers
- `tblMessages` — buyer/seller conversations
- `tblReviews` — product reviews
- `tblSellerRequests` — seller approval workflow

Unstated tables remain as supporting entities:
- `categories`
- `cart_items`
- `order_items`

### Setup and Running the Project
1. Install and start XAMPP.
2. Import `myClothingStore.sql` into phpMyAdmin.
3. Run `loadClothingStore.php` to rebuild the database and seed the demo data.
4. Run `createTable.php` if you need to rebuild `tblUser` from `userData.txt`.
5. Open the site in the browser at `http://localhost/pastimes/`.

### Test Accounts
- Admin: `admin@pastimes.co.za` / `password`
- Buyer: `john@example.com` / `password`
- Seller: `sarah@example.com` / `password`
- Seller: `mike@example.com` / `password`

### Core User Flows
- New users register through the registration form.
- New accounts remain pending until an administrator verifies them.
- Buyers can request seller access through the seller-request form.
- Sellers can add and manage products.
- Buyers can browse products, add items to the cart, and complete checkout.
- Orders can be tracked by buyers and managed by sellers.
- Buyers and sellers can exchange messages about products.

### Admin Functions
- Verify or reject new user registrations.
- Manage users through add, edit, and delete actions.
- Review pending seller requests.
- View dashboard statistics for users, products, orders, messages, and requests.

### Validation and Safety Checks
- All major PHP files were syntax-checked after the final rename pass.
- The loader script was run successfully and the database was verified afterward.
- `createTable.php` was tested successfully and then the demo database was restored.

### Known Notes
- `loadClothingStore.php` intentionally drops and recreates the database so the demo can be refreshed cleanly.
- `createTable.php` intentionally rebuilds `tblUser` from `userData.txt` for POE compliance.
- The application uses sticky forms, prepared statements, and role-based access checks throughout.

### Conclusion
This documentation captures the working structure and operational flow of the Pastimes Marketplace / ClothingStore application. The project is aligned to the POE requirements and includes a clean local setup, seeded demo data, and the core functionality needed for the submission.
