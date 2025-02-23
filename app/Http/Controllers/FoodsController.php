<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foods;

/**
 * Controller quản lý các chức năng liên quan đến món ăn
 * Bao gồm: thêm, sửa, xóa, hiển thị danh sách món ăn
 */
class FoodsController extends Controller
{
    /**
     * Hiển thị danh sách tất cả món ăn
     * GET /foods
     * Phương thức này sẽ:
     * - Lấy tất cả bản ghi từ bảng foods
     * - Truyền dữ liệu vào view để hiển thị
     * @return \Illuminate\View\View
     */
    public function index(){
        // Sử dụng model Foods để lấy tất cả bản ghi
        // Phương thức all() sẽ trả về collection chứa tất cả món ăn
        $foods = Foods::all();

        // Trả về view 'foods.index' và truyền biến $foods
        // Hàm compact() sẽ tạo một mảng với key là 'foods' và value là $foods
        return view('foods.index', compact('foods'));
    }

    /**
     * Hiển thị form tạo mới món ăn
     * GET /foods/create
     * Phương thức này chỉ đơn giản trả về view chứa form thêm món ăn
     * Form sẽ gửi request POST đến route foods.store
     * @return \Illuminate\View\View
     */
    public function create(){
        return view('foods.create');
    }

    /**
     * Xử lý lưu món ăn mới vào database
     * POST /foods
     * Các bước thực hiện:
     * 1. Validate dữ liệu đầu vào
     * 2. Upload và lưu hình ảnh
     * 3. Tạo bản ghi mới trong database
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        // Kiểm tra tính hợp lệ của dữ liệu gửi lên
        // - name: bắt buộc, độ dài tối đa 255 ký tự
        // - price: bắt buộc, phải là số
        // - count: bắt buộc, phải là số
        // - description: bắt buộc
        // - image_path: bắt buộc, phải là ảnh (jpeg,png,jpg), kích thước tối đa 5MB
        $request->validate([
            'name' =>'required|max:255',
            'price' =>'required|numeric',
            'count' =>'required|numeric',
            'description' =>'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:5048'
        ]);

        // Tạo instance mới của model Foods
        $foods = new Foods();

        // Xử lý upload hình ảnh
        // Lấy file ảnh từ request
        $image = $request->file('image_path');
        // Tạo tên file ảnh mới để tránh trùng lặp
        // Kết hợp time() để tạo tên unique
        $generatedImageName = 'image_' . time() . '.' . $request->name . '._' . $image->getClientOriginalExtension();

        // Di chuyển file ảnh vào thư mục public/images
        $image->move(public_path('images'), $generatedImageName);
        // Lưu tên file ảnh vào database
        $foods->image_path = $generatedImageName;

        // Gán các giá trị từ request vào các thuộc tính của model
        $foods->name = $request->name;
        $foods->description = $request->description;
        $foods->count = $request->count;
        $foods->price = $request->price;

        // Lưu model vào database
        $foods->save();

        // Redirect về trang danh sách với thông báo thành công
        return redirect()->route('foods.index')->with('success', 'Add new food successful!');
    }

    /**
     * Hiển thị form chỉnh sửa món ăn
     * GET /foods/edit/{id}
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id){
        // Tìm món ăn theo ID
        $food = Foods::find($id);
        // Kiểm tra nếu không tồn tại
        if (!$food) {
            return redirect()->route('foods.index')->with('error', 'Foods no data!');
        }
        // Trả về view edit kèm thông tin món ăn
        return view('foods.edit', compact('food'));
    }

    /**
     * Cập nhật thông tin món ăn
     * PUT /foods/{id}
     * Phương thức này sẽ:
     * 1. Validate dữ liệu đầu vào
     * 2. Tìm món ăn theo ID
     * 3. Cập nhật thông tin cơ bản
     * 4. Xử lý upload hình ảnh mới (nếu có)
     * 5. Redirect về trang danh sách
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'count' => 'required|numeric',
            'description' => 'required',
            // Cho phép không upload ảnh mới
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:5048'
        ]);

        // Tìm món ăn cần cập nhật
        $food = Foods::findOrFail($id);

        // Xử lý upload hình ảnh mới nếu có
        if ($request->hasFile('image_path')) {
            // Xóa file ảnh cũ nếu tồn tại
            if ($food->image_path && file_exists(public_path('images/' . $food->image_path))) {
                unlink(public_path('images/' . $food->image_path));
            }

            // Upload file ảnh mới
            $image = $request->file('image_path');
            $generatedImageName = 'image_' . time() . '.' . $request->name . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $generatedImageName);

            // Cập nhật tên file ảnh mới vào database
            $food->image_path = $generatedImageName;
        }

        // Cập nhật các thông tin khác
        $food->name = $request->name;
        $food->description = $request->description;
        $food->count = $request->count;
        $food->price = $request->price;

        // Lưu các thay đổi
        $food->save();

        // Redirect về trang danh sách với thông báo thành công
        return redirect()->route('foods.index')->with('success', 'Update successful!');
    }

    /**
     * Xóa món ăn khỏi database
     * GET /foods/delete/{id}
     * Các bước thực hiện:
     * 1. Tìm món ăn theo ID
     * 2. Kiểm tra sự tồn tại
     * 3. Thực hiện xóa
     * 4. Redirect với thông báo
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id){
        // Tìm món ăn theo ID sử dụng phương thức find()
        $food = Foods::find($id);

        // Kiểm tra nếu không tìm thấy món ăn
        // Redirect về trang danh sách với thông báo lỗi
        if (!$food) {
            return redirect()->route('foods.index')->with('error', 'Foods no data!');
        }

        // Thực hiện xóa bản ghi khỏi database
        $food->delete();

        // Redirect về trang danh sách với thông báo thành công
        return redirect()->route('foods.index')->with('success', 'Delete !');
    }
}
