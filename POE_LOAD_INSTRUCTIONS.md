# POE Loader & CreateTable Usage

Files added:

- `config/DBConn.php` — connection helper (uses DB `ClothingStore`).
- `loadClothingStore.php` — creates `ClothingStore` DB and loads `database.sql`.
- `createTable.php` — drops/recreates `tblUser` and loads `userData.txt`.
- `userData.txt` — sample user data (5 entries) for `createTable.php`.

How to run (XAMPP + browser):

1. Start Apache and MySQL in XAMPP.
2. Visit in browser: `http://localhost/pastimes/loadClothingStore.php` to create the `ClothingStore` database and import `database.sql`.
   - This will execute the SQL in `database.sql`. It is destructive for the named database.
3. To specifically recreate `tblUser` from `userData.txt`, run: `http://localhost/pastimes/createTable.php`.

How to run (CLI with XAMPP PHP):

```powershell
& "C:\xampp\php\php.exe" "C:\Users\Student\Desktop\2026\WEDE\app\pastimes\loadClothingStore.php"
& "C:\xampp\php\php.exe" "C:\Users\Student\Desktop\2026\WEDE\app\pastimes\createTable.php"
```

CAUTION: These scripts are intentionally destructive for ease of marking — they will DROP and/or overwrite tables in the `ClothingStore` database. Only run if you accept this.
