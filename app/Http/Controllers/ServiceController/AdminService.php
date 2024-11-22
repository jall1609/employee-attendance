<?php

namespace App\Http\Controllers\ServiceController;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminService extends Controller
{
    public $rules ;

    public function __construct()
    {
        $this->rules = [
            'email' => 'required|string|email|max:100|unique:users',
            'name' => 'required|string|between:4,150',
        ];
    }
    public function register($validated_data)
    {
        $user = User::create([
            'email' => $validated_data['email'],
            'password' => Hash::make($validated_data['password']),
        ]);
        $user->assignRole('admin');
        $data_create_admin = [
            'user_id' => $user->id,
        ];
        foreach (['name'] as $key => $column) {
            $data_create_admin[$column] = $validated_data[$column] ?? null;
        }
        $employee = Admin::create($data_create_admin);

        return collect($data_create_admin)->except(['user_id', 'id'])->merge([
            'email' => $validated_data['email']
        ])->toArray();
    }
}
