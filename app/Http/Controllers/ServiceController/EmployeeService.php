<?php

namespace App\Http\Controllers\ServiceController;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeService extends Controller
{
    public $rules ;

    public function __construct()
    {
        $this->rules = [
            'email' => 'required|string|email|max:100|unique:users',
            'name' => 'required|string|between:4,150',
            'city' => 'required|string|between:4,50',
            'date_of_birth' => 'required|date',
            'jabatan' => 'required|string|max:14',
        ];
    }

    public function register($validated_data)
    {
        $user = User::create([
            'email' => $validated_data['email'],
            'password' => Hash::make($validated_data['password']),
        ]);
        $user->assignRole('employee');
        $data_create_employee = [
            'username' => createUnixSlug($validated_data['name']),
            'user_id' => $user->id,
        ];
        foreach (['name', 'city', 'date_of_birth', 'jabatan'] as $key => $column) {
            $data_create_employee[$column] = $validated_data[$column] ?? null;
        }
        $employee = Employee::create($data_create_employee);

        return collect($data_create_employee)->except(['user_id', 'id'])->merge([
            'email' => $validated_data['email']
        ])->toArray();
    }
}
