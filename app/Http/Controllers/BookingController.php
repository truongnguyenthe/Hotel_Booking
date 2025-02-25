<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('customer_name', 'like', '%' . $request->search . '%')
                ->orWhereHas('room', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                });
        }

        $bookings = $query->with('room')->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::where('status', 'available')->get();
        $customers = Customer::all();
        return view('bookings.create', compact('rooms', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'customer_id' => 'required|exists:customers,id', // Sử dụng customer_id
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $room = Room::findOrFail($request->room_id);
        if ($room->status === 'booked') {
            return back()->withErrors(['room_id' => 'This room is already booked, please choose another room!'])->withInput();
        }

        $customer = Customer::findOrFail($request->customer_id); // Lấy customer từ database

        DB::beginTransaction();
        try {
            $booking = new Booking();
            $booking->room_id = $room->id;
            $booking->customer_name = $customer->name; // Sử dụng customer name từ customer model.
            $booking->start_date = $request->start_date;
            $booking->end_date = $request->end_date;

            Log::info('Booking data before saving:', $booking->toArray());

            $booking->save();

            $room->update(['status' => 'booked']);

            DB::commit();

            return redirect()->route('bookings.index')->with('success', 'Booking successful!');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->withErrors(['error' => 'An error occurred while processing your booking. Please try again later.'])->withInput();
        }
    }

    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $rooms = Room::where('status', 'available')->orWhere('id', $booking->room_id)->get();
        $customers = Customer::all();
        return view('bookings.edit', compact('booking', 'rooms', 'customers'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'customer_name' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($request->room_id != $booking->room_id) {
            $newRoom = Room::findOrFail($request->room_id);
            if ($newRoom->status === 'booked' && $newRoom->id !== $booking->room_id) { // Fix: allow changing to the same room
                return back()->withErrors(['room_id' => 'This room is already booked, please choose another room!'])->withInput();
            }

            $booking->room->update(['status' => 'available']);
            $newRoom->update(['status' => 'booked']);
        }

        $booking->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }

    public function destroy(Booking $booking)
    {
        $room = $booking->room;

        $booking->delete();

        if (!Booking::where('room_id', $room->id)->exists()) {
            $room->update(['status' => 'available']);
        }

        return redirect()->route('bookings.index')->with('success', 'Booking canceled successfully!');
    }
}