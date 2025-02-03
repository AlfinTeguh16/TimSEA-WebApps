<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Company;


class UserController extends Controller
{
    public function showUserClient(Request $request)
    {
        $users = DB::table('tb_users as u')
            ->join('tb_company as c', 'u.id', '=', 'c.id_users')
            ->select('u.username', 'u.email', 'c.company', 'u.id')
            ->paginate(10);

        return view('pages.dashboard.admin.master-user.client.index', compact('users'));
    }

    public function searchClient(Request $request)
    {
        $search = $request->query('q');

        $users = DB::table('tb_users as u')
        ->leftJoin('tb_company as c', 'u.id', '=', 'c.id_users') 
        ->select('u.username', 'u.email', 'c.company', 'u.id')
        ->where('u.role', 'company')
        ->where('u.is_blocked', 0)
        ->where(function ($query) use ($search) {
            if (!empty($search)) {
                $query->where('u.username', 'LIKE', "%{$search}%")
                    ->orWhere('u.email', 'LIKE', "%{$search}%")
                    ->orWhere('c.company', 'LIKE', "%{$search}%");
            }
        })
        ->paginate(10);

        return response()->json($users);
    }

    public function createUserClient(){

        return view('pages.dashboard.admin.master-user.client.create');
    }


    public function postCreateUserClient(Request $request)
    {

        $request->validate([
            'company'  => 'required|string|max:255',
            'email'    => 'required|email|unique:tb_users,email|max:255',
            'country'  => 'required|string|max:255',
            'field'    => 'required|string|max:255',
            'username' => 'required|string|unique:tb_users,username|max:255',
            'password' => 'required|string|min:8',
        ], [
            'email.unique' => 'The email address is already registered.',
            'username.unique' => 'The username is already taken. Please choose another one.',
            'password.min' => 'The password must be at least 8 characters long.',
        ]);


        DB::beginTransaction();

        try {

            $user = User::create([
                'username'  => $request->username,
                'email'     => $request->email,
                'password'  => Hash::make($request->password), 
                'role'      => 'company',
            ]);

            $company = Company::create([
                'id_users'  => $user->id,
                'company'   => $request->company,
                'country'   => $request->country,
                'field'     => $request->field,
            ]);

            DB::commit();

            return redirect()->route('admin.create-user.client.get')->with('success', 'User Company successfully created!');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback(); 
            return back()->with('error', 'Database error: ' . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback(); 
            return back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }


    public function editUserClient($id)
    {
        $user = User::where('id', $id)->where('role', 'company')->firstOrFail();
        $company = Company::where('id_users', $id)->firstOrFail();

        return view('pages.dashboard.admin.master-user.client.update', compact('user', 'company'));
    }


    public function updateUserClient(Request $request, $id)
    {
        $request->validate([
            'company'  => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:tb_users,email,' . $id,
            'country'  => 'required|string|max:255',
            'field'    => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:tb_users,username,' . $id,
            'password' => 'nullable|string|min:8',
        ], [
            'email.unique' => 'The email address is already registered.',
            'username.unique' => 'The username is already taken. Please choose another one.',
            'password.min' => 'The password must be at least 8 characters long.',
        ]);

        DB::beginTransaction();

        try {

            $user = User::where('id', $id)->where('role', 'company')->firstOrFail();
            $user->username = $request->username;
            $user->email = $request->email;


            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            $company = Company::where('id_users', $id)->firstOrFail();
            $company->company = $request->company;
            $company->country = $request->country;
            $company->field = $request->field;
            $company->save();

            DB::commit();

            return redirect()->route('admin.show-user-client.get')->with('success', 'User Company successfully updated!');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return back()->with('error', 'Database error: ' . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }


    public function blockUser($id)
    {
        try {
            // Cari user dengan ID dan update kolom is_blocked menjadi 1
            $user = User::where('id', $id)->firstOrFail();
            $user->is_blocked = 1;
            $user->save();

            return redirect()->route('admin.show-user-client.get')->with('success', 'User successfully blocked!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to block user: ' . $e->getMessage()]);
        }
    }


}
