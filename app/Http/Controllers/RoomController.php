<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Room::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        if (is_numeric($request->search)) {
            $query->orWhere('price', $request->search);
        }

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
            'name' => 'required|string|regex:/^[A-Za-z\s]+$/',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:available,booked',
        ]);

        if (Room::where('name', $request->name)->exists()) {
            return back()->withErrors(['name' => 'Room name already exists!'])->withInput();
        }
        $data = $request->all();
        $data['status'] = 'available';  

        Room::create($request->all());
        return redirect()->route('rooms.index')->with('success', 'Room has been created successfully!');
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|regex:/^[A-Za-z\s]+$/',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:available,booked',
        ]);
        
        if ($room->bookings()->exists()) {
            // Kiểm tra nếu người dùng muốn thay đổi giá phòng
            if ($request->price != $room->price) {
                return back()->withErrors(['price' => 'The price cannot be changed because the room is currently booked!']);
            }

            // Kiểm tra nếu người dùng muốn đặt lại trạng thái thành "available"
            if ($request->status === 'available') {
                return back()->withErrors(['status' => 'The status cannot be changed to "available" because the room is currently booked!']);
            }
        }

        $room->update($request->all());
        return redirect()->route('rooms.index')->with('success', 'Room update successful!');
    }

    public function destroy(Room $room)
    {
        
        if ($room->bookings()->exists()) {
            return redirect()->route('rooms.index')->with('room_error', 'The room cannot be deleted because it has existing bookings!');
        }

        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Successfully deleted room!');
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
