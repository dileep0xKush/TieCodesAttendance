<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Device;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // dd(asset('assets/media/default_image.png'));
        $admin = User::where('type', 'superadmin')->first();
        if ($admin == null) {
            $user = new User();
            $user->full_name = 'Super';
            $user->email = 'admin@tiecodes.com';
            $user->type = 'superadmin';
            $user->password = Hash::make('password');
            $user->save();
        }
    }
}
