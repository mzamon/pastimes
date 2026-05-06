-- ============================================================
-- Pastimes — Full Database Schema
-- WEDE6021 Part 2 | MySQL 5.7+ / MariaDB 10.3+
-- ============================================================

CREATE DATABASE IF NOT EXISTS pastimes
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE pastimes;

-- ============================================================
-- 1. users
-- ============================================================
CREATE TABLE users (
    id            INT          AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(100) NOT NULL,
    email         VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role          ENUM('buyer','seller','admin') NOT NULL DEFAULT 'buyer',
    is_verified   TINYINT(1)   NOT NULL DEFAULT 0,
    seller_request ENUM('none','pending','approved','rejected') NOT NULL DEFAULT 'none',
    seller_request_note TEXT    NULL,
    created_at    DATETIME     DEFAULT CURRENT_TIMESTAMP,
    last_login    DATETIME     NULL,
    INDEX idx_email (email),
    INDEX idx_role  (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 2. categories
-- ============================================================
CREATE TABLE categories (
    id   INT         AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 3. products
-- ============================================================
CREATE TABLE products (
    id          INT           AUTO_INCREMENT PRIMARY KEY,
    seller_id   INT           NOT NULL,
    category_id INT           NOT NULL,
    title       VARCHAR(150)  NOT NULL,
    description TEXT          NOT NULL,
    price       DECIMAL(10,2) NOT NULL CHECK (price > 0),
    `condition` ENUM('New','Like New','Good','Fair','Poor') NOT NULL DEFAULT 'Good',
    image       VARCHAR(255)  NULL,
    status      ENUM('active','sold') NOT NULL DEFAULT 'active',
    created_at  DATETIME      DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME      DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (seller_id)   REFERENCES users(id)      ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT,
    INDEX idx_seller   (seller_id),
    INDEX idx_category (category_id),
    INDEX idx_status   (status),
    FULLTEXT INDEX idx_search (title, description)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 4. cart_items  (DB-persisted fallback — normalisation req.)
-- ============================================================
CREATE TABLE cart_items (
    id         INT      AUTO_INCREMENT PRIMARY KEY,
    user_id    INT      NOT NULL,
    product_id INT      NOT NULL,
    quantity   INT      NOT NULL DEFAULT 1 CHECK (quantity > 0),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id)    REFERENCES users(id)    ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY uq_cart (user_id, product_id),
    INDEX idx_user_cart (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 5. orders
-- ============================================================
CREATE TABLE orders (
    id               INT           AUTO_INCREMENT PRIMARY KEY,
    buyer_id         INT           NOT NULL,
    total            DECIMAL(10,2) NOT NULL,
    delivery_address TEXT          NOT NULL,
    status           ENUM('Pending','Packed','In Transit','Delivered') NOT NULL DEFAULT 'Pending',
    tracking_number  VARCHAR(100)  NULL,
    payment_method   ENUM('Credit Card','Debit Card') NULL,
    created_at       DATETIME      DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (buyer_id) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_buyer  (buyer_id),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 6. order_items  (preserves price_at_purchase — 3NF)
-- ============================================================
CREATE TABLE order_items (
    id                INT           AUTO_INCREMENT PRIMARY KEY,
    order_id          INT           NOT NULL,
    product_id        INT           NOT NULL,
    quantity          INT           NOT NULL CHECK (quantity > 0),
    price_at_purchase DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id)   REFERENCES orders(id)   ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE RESTRICT,
    INDEX idx_order (order_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 7. messages
-- ============================================================
CREATE TABLE messages (
    id          INT          AUTO_INCREMENT PRIMARY KEY,
    sender_id   INT          NOT NULL,
    receiver_id INT          NOT NULL,
    product_id  INT          NOT NULL,
    message     VARCHAR(1000) NOT NULL,
    sent_at     DATETIME     DEFAULT CURRENT_TIMESTAMP,
    is_read     TINYINT(1)   NOT NULL DEFAULT 0,
    FOREIGN KEY (sender_id)   REFERENCES users(id)    ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES users(id)    ON DELETE CASCADE,
    FOREIGN KEY (product_id)  REFERENCES products(id) ON DELETE CASCADE,
    INDEX idx_conversation (product_id, sender_id, receiver_id),
    INDEX idx_receiver     (receiver_id, is_read)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 8. reviews
-- ============================================================
CREATE TABLE reviews (
    id          INT      AUTO_INCREMENT PRIMARY KEY,
    reviewer_id INT      NOT NULL,
    product_id  INT      NOT NULL,
    rating      TINYINT  NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment     TEXT     NOT NULL,
    created_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (reviewer_id) REFERENCES users(id)    ON DELETE CASCADE,
    FOREIGN KEY (product_id)  REFERENCES products(id) ON DELETE CASCADE,
    INDEX idx_product  (product_id),
    INDEX idx_reviewer (reviewer_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- SAMPLE DATA
-- All accounts use password:  password
-- Hash = password_hash('password', PASSWORD_DEFAULT)
-- ============================================================

INSERT INTO users (name, email, password_hash, role, is_verified, seller_request, seller_request_note) VALUES
('Admin User',  'admin@pastimes.co.za', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 1, 'approved', 'System administrator'),
('John Buyer',  'john@example.com',     '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'buyer', 1, 'none', NULL),
('Sarah Seller','sarah@example.com',    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'seller', 1, 'approved', 'Vintage clothing and jackets'),
('Mike Seller', 'mike@example.com',     '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'seller', 1, 'approved', 'Streetwear and hobby gear');

INSERT INTO categories (name) VALUES
('Vintage Clothing'),
('Streetwear'),
('Electronics'),
('Books'),
('Sports Gear'),
('Collectibles');

-- Image paths match /assets/images/<path>
INSERT INTO products (seller_id, category_id, title, description, price, `condition`, image, status) VALUES
(3, 1, 'Vintage Denim Jacket',       'Classic 90s blue denim jacket, size L. Barely worn, original buttons intact.',           450.00, 'Good',     'vintage-clothing/denim-jacket-1.jpg',    'active'),
(3, 2, 'Limited Edition Sneakers',   'Rare high-top collab sneakers, worn once. Size 9. Box included.',                       1200.00, 'Like New', 'streetwear/sneakers-hightop-1.jpg',      'active'),
(4, 3, 'Sony Noise-Cancelling Headphones', 'Over-ear wireless headphones, 6 months old. Excellent sound quality.',              800.00, 'Good',     'electronics/headphones-overear-1.jpg',   'active'),
(4, 5, 'Yoga Mat (Purple)',          'Premium 6mm non-slip yoga mat, used twice. Includes carry strap.',                        250.00, 'Like New', 'sports-gear/yoga-mat-1.jpg',             'active'),
(3, 1, 'Vintage Leather Biker Jacket','Distressed brown leather jacket, circa 1990. Lined, size M. Some patina.',               750.00, 'Fair',     'vintage-clothing/leather-jacket-1.jpg',  'active'),
(4, 6, 'Marvel Comic Collection',    'Set of 10 original 1990s Marvel comics in protective sleeves. Good condition.',           600.00, 'Good',     'books/comic-marvel-1.jpg',               'active'),
(3, 2, 'Oversized Black Hoodie',     'Premium heavyweight cotton hoodie, barely worn. Size XL.',                                320.00, 'Like New', 'streetwear/hoodie-black-1.jpg',          'active'),
(4, 6, 'Vinyl Record Collection',    'Stack of 15 classic rock vinyl records from the 70s and 80s. All playable.',              500.00, 'Good',     'collectibles/vinyl-record-1.jpg',        'active'),
(3, 2, 'Camo Jogger Pants',          'Tapered fit camouflage joggers, worn twice. Size L.',                                     180.00, 'Like New', 'streetwear/joggers-camo-1.jpg',          'active'),
(4, 5, 'Running Shorts',             'Lightweight athletic shorts, black with white stripe. Size M. Great condition.',           95.00, 'Good',     'sports-gear/running-shorts-1.jpg',       'active'),
(3, 1, 'Black Denim Jacket',         'Faded wash black denim jacket. Vintage cut, size S. Minor wear on collar.',               380.00, 'Fair',     'vintage-clothing/denim-jacket-2.jpg',    'active'),
(4, 5, 'Gym Tank Top',               'Grey muscle-fit workout tank. Worn 5 times, washed well. Size M.',                        75.00, 'Good',     'sports-gear/gym-tanktop-1.jpg',          'active');

INSERT INTO orders (buyer_id, total, delivery_address, status, tracking_number, payment_method) VALUES
(2, 550.00, '123 Main Street, Johannesburg, 2000', 'Delivered', 'TRK123456',   'Credit Card'),
(2, 1250.00,'45 Park Avenue, Cape Town, 8001',     'In Transit','TRK789012',   'Debit Card');

INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) VALUES
(1, 1, 1, 450.00),
(1, 4, 1, 250.00),
(2, 2, 1, 1200.00);

INSERT INTO messages (sender_id, receiver_id, product_id, message, is_read) VALUES
(2, 3, 1, 'Hi Sarah, is the denim jacket still available?',  1),
(3, 2, 1, 'Yes it is! Would you like more photos?',           1),
(2, 3, 1, 'That would be great, thank you!',                  0);

INSERT INTO reviews (reviewer_id, product_id, rating, comment) VALUES
(2, 1, 5, 'Jacket arrived in perfect condition, exactly as described. Very happy!'),
(2, 4, 4, 'Good quality mat, minor wear on edges but great for the price.');
