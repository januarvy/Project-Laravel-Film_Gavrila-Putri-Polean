# Bahan materi kelas XII
Langkah-langkah yang harus dilakukan:

1. Silahkan kalian fork untuk memasukan kedalam repository kalian masing-masing
2. Setelah di fork silahkan kalian lakukan cloning dari repo hasil fork
```bash
git clone nama-repo-masing-masing
cd dataweb
```
3. Membuat file .env
```bash
cp .env.example .env
nano .env
```
4. Atur koneksi database (pastikan databasenya sudah di buat terlebih dahulu)
```bash
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=db_user
DB_PASSWORD=db_pass
```
5. Install dependncies
```bash
composer install
```
6. Generate APP Key
```bash
php artisan key:generate
```
7. Set the administrator account credentials in `.env` before running the seeder:
```dotenv
ADMIN_NAME=Administrator
ADMIN_EMAIL=your-admin-email@example.com
ADMIN_PASSWORD=choose-a-strong-password
```
8. Migration & Seeder
```bash
php artisan migrate --seed
```
9. Copy the images from the `public` folder into `storage/app`
10. Create the storage symlink
```bash
php artisan storage:link
```  
