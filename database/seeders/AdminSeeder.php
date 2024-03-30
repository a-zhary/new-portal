<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        $admin = new Admin();

        $admin->image = '/test';
        $admin->name = 'Super User';
        $admin->email = 'admin@admin.loc';
        $admin->password = Hash::make('password');
        $admin->status = 1;
        $admin->save();
    }
}
