<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Kiểm tra xem user đã tồn tại hay chưa, nếu chưa thì mới tạo
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Kiểm tra xem Room đã tồn tại chưa
        if (!Room::where('name', 'Luxury Room')->exists()) {
            Room::create([
                'name' => 'Luxury Room',
                'description' => 'This is a test room.',
                'price' => '20000000',
                'status' => 'available',
            ]);
        }
        if (!Room::where('name', 'Master Room')->exists()) {
            Room::create([
                'name' => 'Master Room',
                'description' => 'Master, this is a test room.',
                'price' => '3000000',
                'status' => 'booked',
            ]);
        }

        // Giả sử có dữ liệu phòng trong bảng rooms
        $roomIds = DB::table('rooms')->pluck('id'); // Lấy tất cả ID phòng từ bảng 'rooms'

       
        foreach ($roomIds as $roomId) {
            Booking::create([
                'room_id' => $roomId,
                'customer_name' => 'Khách hàng ' . Str::random(5), // Tạo tên khách hàng ngẫu nhiên
                'start_date' => Carbon::now()->addDays(rand(1, 10))->format('Y-m-d'), // Ngày bắt đầu ngẫu nhiên
                'end_date' => Carbon::now()->addDays(rand(11, 20))->format('Y-m-d'), // Ngày kết thúc ngẫu nhiên
                
            ]);
        }
    }

}
