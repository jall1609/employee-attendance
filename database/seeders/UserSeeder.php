<?php

namespace Database\Seeders;

use App\Http\Controllers\ServiceController\AdminService;
use App\Http\Controllers\ServiceController\EmployeeService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::findOrCreate('employee');
        $create_employee = [
            [
                'email' => 'rendragituloh@gmail.com',
                'name' => 'Rendra',
                'city' => 'Jogja',
                'date_of_birth' => '2021-11-11',
                'jabatan' => fake()->jobTitle,
                'password' => 'password123'
            ],
            [
                'email' => 'Kharizajaah@gmail.com',
                'name' => 'Khariz',
                'city' => 'Bantul',
                'date_of_birth' => '2012-12-12',
                'jabatan' => fake()->jobTitle,
                'password' => 'password123'
            ],
            [
                'email' => 'Jokoterdepan@gmail.com',
                'name' => 'Joko',
                'city' => 'Sleman',
                'date_of_birth' => '2010-10-10',
                'jabatan' => fake()->jobTitle,
                'password' => 'password123'
            ],
            [
                'email' => 'Maiyamyuk@gmail.com',
                'name' => 'Mariyam',
                'city' => 'Gunung Kidul',
                'date_of_birth' => '2009-09-09',
                'jabatan' => fake()->jobTitle,
                'password' => 'password123'
            ],
        ];
        foreach ($create_employee as $key => $value) {
            (new EmployeeService())->register($value);
        }

        Role::findOrCreate('admin');
        $create_admin = [
            [
                'email' => 'admin1@gmail.com',
                'name' => 'Admin 1',
                'password' => 'password123'
            ],
            [
                'email' => 'admin2@gmail.com',
                'name' => 'Admin 2',
                'password' => 'password123'
            ],
        ];
        foreach ($create_admin as $key => $value) {
            (new AdminService())->register($value);
        }
    }
}
