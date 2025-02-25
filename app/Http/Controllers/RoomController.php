<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query();

        // Tìm kiếm theo tên hoặc mô tả phòng
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Lấy danh sách phòng, phân trang nếu có hoặc hiển thị tất cả nếu không có tìm kiếm
        $rooms = $query->paginate(10);

        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:available,booked',
        ]);

        Room::create($request->all());
        return redirect()->route('rooms.index')->with('success', 'Phòng đã được tạo thành công!');
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:available,booked',
        ]);

        // Nếu phòng đang có đặt chỗ, không cho phép đổi trạng thái thành "available"
        if ($room->bookings()->exists() && $request->status === 'available') {
            return back()->withErrors(['status' => 'Không thể đổi trạng thái thành "available" vì phòng đang có đặt chỗ!']);
        }

        $room->update($request->all());
        return redirect()->route('rooms.index')->with('success', 'Cập nhật phòng thành công!');
    }

    public function destroy(Room $room)
    {
        // Kiểm tra nếu phòng có đặt chỗ, không cho phép xóa
        if ($room->bookings()->exists()) {
            return redirect()->route('rooms.index')->withErrors(['room_id' => 'Không thể xóa phòng vì phòng này đang có đặt chỗ!']);
        }

        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Xóa phòng thành công!');
    }

    public function show($id)
    {
        $room = Room::find($id);

        // Kiểm tra nếu phòng không tồn tại
        if (!$room) {
            return redirect()->route('rooms.index')->withErrors(['room_id' => 'Phòng không tồn tại!']);
        }

        return view('rooms.show', compact('room'));
    }
}
