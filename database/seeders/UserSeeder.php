<?php

namespace Database\Seeders;

use App\Models\AppConst;
use App\Models\Role;
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
        if (config('app.env') == 'local') {
            $heSo = AppConst::HE_SO;
            $coSo = AppConst::CO_SO;
        } else {
            $heSo = AppConst::HE_SO_PRODUCT;
            $coSo = AppConst::CO_SO_PRODUCT;
        }
        $roleAdmin = Role::where('name', 'admin')->first();
        $roleTrainer = Role::where('name', 'trainer')->first();
        $roleTrainee = Role::where('name', 'trainee')->first();
        User::create([
            'email' => 'admin@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Admin',
            'code' => 'admin',
            'avatar' => 'storage/avatars/hung.jpg',
            'role_id' => $roleAdmin->id,
            // 'campus_id' => 1
        ]);
        // dd($roleAdmin->id);
        User::create([
            'email' => 'cuongnt@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Nguyễn Thái Cường',
            'code' => 'cuongnt',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => $roleTrainer->id,
            'campus_id' => 1*$heSo + $coSo
        ]);
        User::create([
            'email' => 'loanmtm@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Ngô Thị Mai Loan',
            'code' => 'loanmtm',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => $roleTrainer->id,
            'campus_id' => 1*$heSo + $coSo
        ]);
        User::create([
            'email' => 'thuanlv@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Lê Văn Thuận',
            'code' => 'luanlv',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => $roleTrainer->id,
            'campus_id' => 1*$heSo + $coSo
        ]);
        User::create([
            'email' => 'nganntp@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Nguyên Thái Phượng Ngân',
            'code' => 'nganntp',
            'avatar' => 'storage/avatars/avatar.png',
            'status' => 0,
            'role_id' => $roleTrainer->id,
            'campus_id' => 1*$heSo + $coSo
        ]);
        User::create([
            'email' => 'thanhtx@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Trần Xuân Thanh',
            'code' => 'thanhtx',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => $roleTrainer->id,
            'campus_id' => 1*$heSo + $coSo
        ]);
        User::create([
            'email' => 'thaimv@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Mai Văn Thái',
            'code' => 'thaimv',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => $roleTrainee->id,
            'campus_id' => 1*$heSo + $coSo
        ]);
        User::create([
            'email' => 'thanhhm@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Hoàng Minh Thành',
            'code' => 'thanhhm',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => $roleTrainee->id,
            'campus_id' => 1*$heSo + $coSo
        ]);
        User::create([
            'email' => 'hungdt@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Đào Tuấn Hùng',
            'code' => 'hungdt',
            'avatar' => 'storage/avatars/hung.jpg',
            'role_id' => $roleTrainee->id,
            'campus_id' => 1*$heSo + $coSo
        ]);
        User::create([
            'email' => 'tudm@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Dương Minh Tú',
            'code' => 'tudm',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => $roleTrainee->id,
            'campus_id' => 1*$heSo + $coSo
        ]);
        User::create([
            'email' => 'huyennt@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Nguyễn Thị Huyền',
            'code' => 'huyennt',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => $roleTrainee->id,
            'status' => 0,
            'campus_id' => 1*$heSo + $coSo
        ]);
        User::create([
            'email' => 'huyna@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Nguyễn Anh Huy',
            'code' => 'huyna',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => $roleTrainee->id,
            'campus_id' => 2*$heSo + $coSo
        ]);
        User::create([
            'email' => 'tungtt@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Trần Thanh Tùng',
            'code' => 'tungtt',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => $roleTrainee->id,
            'campus_id' => 1*$heSo + $coSo
        ]);
        User::create([
            'email' => 'hungpv@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Phạm Văn Hùng',
            'code' => 'hungpv',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => $roleTrainee->id,
            'status' => 0,
            'campus_id' => 3*$heSo + $coSo
        ]);
        User::create([
            'email' => 'baolt@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Lê Thái Bảo',
            'code' => 'baont',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => $roleTrainee->id,
            'campus_id' => 1*$heSo + $coSo
        ]);
        User::create([
            'email' => 'datpt@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Phạm Thành Đạt',
            'code' => 'datpt',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => $roleTrainee->id,
            'campus_id' => 2*$heSo + $coSo
        ]);
        User::create([
            'email' => 'minhvt@fpt.edu.vn',
            'password' => Hash::make('adminadmin'),
            'name' => 'Vương Thành Minh',
            'code' => 'minhvt',
            'avatar' => 'storage/avatars/avatar.png',
            'role_id' => $roleTrainee->id,
            'status' => 0,
            'campus_id' => 4*$heSo + $coSo
        ]);
        
    }
}
