# Pastimes Image Catalog - WORKING IMAGES

This document lists all **existing and working** images for the Pastimes second-hand marketplace.

**All images are in .jpg format and verified working.**

---

## CLOTHING CATEGORIES (3 Images Each - ALL WORKING ✓)

### 1. VINTAGE CLOTHING (`/assets/images/vintage-clothing/`)

| Filename | Status | Description |
|----------|--------|-------------|
| denim-jacket-1.jpg | ✓ Working | Classic blue denim jacket, 90s style, worn look |
| denim-jacket-2.jpg | ✓ Working | Black denim jacket, vintage cut, faded wash |
| leather-jacket-1.jpg | ✓ Working | Brown leather biker jacket, distressed finish |

### 2. STREETWEAR (`/assets/images/streetwear/`)

| Filename | Status | Description |
|----------|--------|-------------|
| sneakers-hightop-1.jpg | ✓ Working | White high-top basketball sneakers, clean |
| hoodie-black-1.jpg | ✓ Working | Black oversized hoodie with front pocket |
| joggers-camo-1.jpg | ✓ Working | Camouflage pattern jogger pants, tapered fit |

### 3. SPORTS GEAR (`/assets/images/sports-gear/`)

| Filename | Status | Description |
|----------|--------|-------------|
| yoga-mat-1.jpg | ✓ Working | Purple non-slip yoga mat rolled up |
| running-shorts-1.jpg | ✓ Working | Athletic running shorts, black with stripe |
| gym-tanktop-1.jpg | ✓ Working | Grey workout tank top, muscle fit |

---

## OTHER CATEGORIES (1 Image Each)

### 4. BOOKS (`/assets/images/books/`)

| Filename | Status | Description |
|----------|--------|-------------|
| comic-marvel-1.jpg | ✓ Working | Marvel comic book, superhero cover |

### 5. COLLECTIBLES (`/assets/images/collectibles/`)

| Filename | Status | Description |
|----------|--------|-------------|
| vinyl-record-1.jpg | ✓ Working | Stack of vinyl records in sleeves |

### 6. ELECTRONICS (`/assets/images/electronics/`)

| Filename | Status | Description |
|----------|--------|-------------|
| headphones-overear-1.jpg | ✗ MISSING | Black noise-cancelling over-ear headphones |

---

## PLACEHOLDER (`/assets/images/placeholder/`)

| Filename | Status | Description |
|----------|--------|-------------|
| no-image.jpg | ✓ Working | Generic placeholder image for products without photos |

---

## Usage in Database

When adding products, store the full relative path in the `image` column:

```sql
-- Example: Adding a vintage denim jacket
INSERT INTO products (seller_id, category_id, title, description, price, condition, image, status) 
VALUES (1, 1, 'Vintage Denim Jacket', 'Classic 90s style', 450.00, 'Good', 'vintage-clothing/denim-jacket-1.jpg', 'active');
```

The application will automatically resolve the path using `getProductImage()` helper.

---

## Summary

**Total Working Images: 12 of 13**

| Category | Working | Missing |
|----------|---------|---------|
| Vintage Clothing | 3 | 0 |
| Streetwear | 3 | 0 |
| Sports Gear | 3 | 0 |
| Books | 1 | 0 |
| Collectibles | 1 | 0 |
| Electronics | 0 | 1 |
| Placeholder | 1 | 0 |

**Note:** Electronics product will display placeholder image until headphones-overear-1.jpg is added.
