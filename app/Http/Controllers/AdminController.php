<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function viewWithUser(string $view, array $data = [])
    {
        return view($view, array_merge(['user' => auth()->user()], $data));
    }

    public function dashboard()
    {
        return $this->viewWithUser('admin.dashboard');
    }

    public function users()
    {
        return $this->viewWithUser('admin.user-management', [
            'listUsers' => User::all()
        ]);
    }

    public function createUser()
    {
        return $this->viewWithUser('admin.add-user');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // 'role' => 'required',
        ]);

        if ($validated) {
            User::create([
                // 'name' => $validated['name'],
                // 'email' => $validated['email'],
                // 'password' => bcrypt($validated['password']),
                // 'role' => $validated['role'],
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role ?? 'anggota',
            ]);

            return redirect('/admin/user-management')->with('success', 'User created successfully.');

        } else {
            return back()->withErrors($validated)->withInput();
        }
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return $this->viewWithUser('admin.edit-user', ['editUser' => $user]);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|in:admin,petugas,anggota',
        ]);

        if ($validated) {
            $user->update($validated);
            return redirect('/admin/user-management')->with('success', 'User updated successfully.');
        } else {
            return back()->withErrors($validated)->withInput();
        }
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/admin/user-management')->with('success', 'User deleted successfully.');
    }

    public function koperasiManagement()
    {
        return $this->viewWithUser('admin.management-koperasi');
    }
}
