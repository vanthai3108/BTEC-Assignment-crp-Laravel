<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Admin',
            'code' => 'admin',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 1,
            // 'campus_id' => 1
        ]);
        User::create([
            'email' => 'cuongnt@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Nguyễn Thái Cường',
            'code' => 'cuongnt',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 2,
            'campus_id' => 1
        ]);
        User::create([
            'email' => 'loanmtm@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Ngô Thị Mai Loan',
            'code' => 'loanmtm',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 2,
            'campus_id' => 1
        ]);
        User::create([
            'email' => 'thuanlv@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Lê Văn Thuận',
            'code' => 'luanlv',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 2,
            'campus_id' => 1
        ]);
        User::create([
            'email' => 'nganntp@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Nguyên Thái Phượng Ngân',
            'code' => 'nganntp',
            'avatar' => 'storage/avatars/avatar.png',
            'status' => 0,
            'role_id' => 2,
            'campus_id' => 1
        ]);
        User::create([
            'email' => 'thanhtx@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Trần Xuân Thanh',
            'code' => 'thanhtx',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 2,
            'campus_id' => 1
        ]);
        User::create([
            'email' => 'thaimv@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Mai Văn Thái',
            'code' => 'thaimv',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 3,
            'campus_id' => 1
        ]);
        User::create([
            'email' => 'thanhhm@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Hoàng Minh Thành',
            'code' => 'thanhhm',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 3,
            'campus_id' => 1
        ]);
        User::create([
            'email' => 'hungdt@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Đào Tuấn Hùng',
            'code' => 'hungdt',
            'avatar' => 'storage/avatars/hung.jpg',
            'role_id' => 3,
            'campus_id' => 1
        ]);
        User::create([
            'email' => 'tudm@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Dương Minh Tú',
            'code' => 'tudm',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 3,
            'campus_id' => 1
        ]);
        User::create([
            'email' => 'huyennt@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Nguyễn Thị Huyền',
            'code' => 'huyennt',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 3,
            'status' => 0,
            'campus_id' => 1
        ]);
        User::create([
            'email' => 'huyna@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Nguyễn Anh Huy',
            'code' => 'huyna',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 3,
            'campus_id' => 2
        ]);
        User::create([
            'email' => 'tungtt@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Trần Thanh Tùng',
            'code' => 'tungtt',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 3,
            'campus_id' => 1
        ]);
        User::create([
            'email' => 'hungpv@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Phạm Văn Hùng',
            'code' => 'hungpv',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 3,
            'status' => 0,
            'campus_id' => 3
        ]);
        User::create([
            'email' => 'baolt@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Lê Thái Bảo',
            'code' => 'baont',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 3,
            'campus_id' => 1
        ]);
        User::create([
            'email' => 'datpt@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Phạm Thành Đạt',
            'code' => 'datpt',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 3,
            'campus_id' => 2
        ]);
        User::create([
            'email' => 'minhvt@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Vương Thành Minh',
            'code' => 'minhvt',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => 3,
            'status' => 0,
            'campus_id' => 4
        ]);
        
    }
}
