<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
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

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
