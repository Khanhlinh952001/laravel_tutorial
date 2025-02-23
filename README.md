# Laravel Common Commands (Các Lệnh Thường Dùng Trong Laravel)

## Artisan Commands (Các Lệnh Artisan)

### Server (Máy Chủ)

```bash
# Start Laravel development server (Khởi động máy chủ phát triển Laravel)
php artisan serve
composer run dev            

```

### Migration & Database (Di Chuyển & Cơ Sở Dữ Liệu)

```bash
# Create new migration (Tạo migration mới)
php artisan make:migration create_table_name_table

# Run migrations (Chạy các migration)
php artisan migrate

# Rollback last migration (Hoàn tác migration cuối cùng)
php artisan migrate:rollback

# Reset and re-run all migrations (Đặt lại và chạy lại tất cả migration)
php artisan migrate:fresh
```

### Models & Controllers (Mô Hình & Bộ Điều Khiển)

```bash
# Create Model (Tạo Model)
php artisan make:model ModelName

# Create Model with migration (Tạo Model kèm migration)
php artisan make:model ModelName -m

# Create Controller (Tạo Controller)
php artisan make:controller ControllerName

# Create Resource Controller (Tạo Resource Controller)
php artisan make:controller ControllerName --resource

# Create Model, Migration, Controller and Resource all at once 
# (Tạo Model, Migration, Controller và Resource cùng lúc)
php artisan make:model ModelName -mcr
```

### Cache & Config (Bộ Nhớ Đệm & Cấu Hình)
```bash
# Clear application cache (Xóa bộ nhớ đệm của ứng dụng)
php artisan cache:clear

# Clear config cache (Xóa bộ nhớ đệm cấu hình)
php artisan config:clear

# Clear route cache (Xóa bộ nhớ đệm định tuyến)
php artisan route:clear

# Clear view cache (Xóa bộ nhớ đệm view)
php artisan view:clear
```

### Other Useful Commands (Các Lệnh Hữu Ích Khác)
```bash
# Create new middleware (Tạo middleware mới)
php artisan make:middleware MiddlewareName

# Create new seeder (Tạo seeder mới)
php artisan make:seeder SeederName

# Run seeders (Chạy các seeder)
php artisan db:seed

# Create symbolic link for storage (Tạo liên kết tượng trưng cho storage)
php artisan storage:link

# List all available routes (Liệt kê tất cả các route có sẵn)
php artisan route:list

# Create new job (Tạo job mới)
php artisan make:job JobName

# Create new event (Tạo event mới)
php artisan make:event EventName
```

### Composer Commands (Các Lệnh Composer)
```bash
# Install dependencies (Cài đặt các gói phụ thuộc)
composer install

# Update dependencies (Cập nhật các gói phụ thuộc)
composer update

# Install package (Cài đặt gói)
composer require package/name

# Remove package (Gỡ bỏ gói)
composer remove package/name
```
