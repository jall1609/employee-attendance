<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'login';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:5',
            'name' => 'required|string|between:4,150',
            'gender' => ['required', 'in:male,female'],
            'city_name' => 'required|string|between:4,50',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:14',
            'linkedin_link' => 'string|max:255',
            'profile_headline' => 'string|max:255',
            'current_salary' => 'integer',
            'expected_salary' => 'integer',
            'skill' => 'string|max:255',
        ]);
        
        if ($validator->fails()) {
            return sendResponse(400, $validator->errors(), 'Bad Request');
        }

        $validatedData = $validator->validated();

        DB::beginTransaction();
        try {
            // $create_candidat = (new CandidatController())->register($validatedData);
            // $return_api = [ 201, $create_candidat, 'Candidat successfully created'];
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $return_api = [ 500, $th->getMessage(), 'Internal Server Error'];
        }

        return sendResponse( ...$return_api );
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

    public function login()
    {
        return view('admin.login');
    }

    public function prosesLogin(Request $request)
    {
        $response = (new AuthController())->login( $request);
        $response = json_decode($response->getContent());

        if ($response->meta->code != 201) return redirect()->back()->withErrors(['login_error' => 'Unauthorized']);

        $token = $response->data->access_token;
        session(['api_token' => $token]);
        return redirect()->route('dashboard')->with('success', 'Login successful!');
    }
}
