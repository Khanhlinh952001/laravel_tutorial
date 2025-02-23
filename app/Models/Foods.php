<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Foods - Quản lý thông tin các món ăn trong hệ thống
 */
class Foods extends Model
{
    // Chỉ định tên bảng trong database
    protected $table = 'foods';

    // Khóa chính của bảng
    protected $primaryKey = 'id';

    // Cho phép sử dụng timestamp tự động (created_at, updated_at)
    public $timestamps = true;

    // Các trường có thể được gán giá trị hàng loạt (mass assignment)
    // name: tên món ăn
    // price: giá món ăn
    // count: số lượng
    // description: mô tả món ăn
    protected $fillable = ['name', 'price', 'count', 'description','image_path'];

}
