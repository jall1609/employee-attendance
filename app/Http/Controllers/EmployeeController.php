<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
