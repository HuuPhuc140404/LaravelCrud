<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Ramsey\Uuid\Type\Integer;

class UserController extends Controller
{

    public function loadAllUsers()
    {
        $all_users = User::all();
        return view('users', compact('all_users'));
    }

    public function loadAddUserForm()
    {
        return view('add-user');
    }

    public function AddUser(Request $request)
    {
        $request->validate([
            'studentId' => 'required|string|unique:users,masv|min:4', // Sử dụng cột 'masv' cho mã sinh viên
            'studentName' => 'required|string|regex:/^[^\d]*$/',
            'studentEmail' => 'required|email|unique:users,email', // Sử dụng cột 'email'
            'studentPhone' => 'required|integer',
            'studentAddress' => 'required|string',
        ]);

        try {
            $new_user = new User;
            $new_user->masv = $request->studentId; // Nếu bạn sử dụng 'masv' cho mã sinh viên
            $new_user->name = $request->studentName;
            $new_user->email = $request->studentEmail; // Sử dụng 'email' để lưu email
            $new_user->sdt = $request->studentPhone; // 'sdt' cho số điện thoại
            $new_user->address = $request->studentAddress; // 'address' cho địa chỉ
            $new_user->save();

            return redirect('/users')->with('success', 'User Added Successfully!');
        } catch (\Exception $e) {
            return redirect('/add/user')->with('fail', $e->getMessage());
        }
    }

    public function deleteUser($id)
    {
        try {
            User::where('id', $id)->delete();
            return redirect('/users')->with('success', 'User Deleted Successfully!');
        } catch (\Exception $e) {
            return redirect('/users')->with('fail', $e->getMessage());
        }
    }

    public function loadEditUserForm($id)
    {
        $user = User::find($id);
        return view('edit-user', compact('user'));
    }
    public function EditUser(Request $request)
    {
        $request->validate([
            // Sử dụng cột 'masv' cho mã sinh viên
            // 'studentId' => 'required|string|unique:users,masv|min:4',
            'studentName' => 'required|string|regex:/^[^\d]*$/',
            'studentEmail' => 'required|email',
            'studentPhone' => 'required|integer',
            'studentAddress' => 'required|string',
        ]);

        try {
            $user = User::find($request->id);

            if (!$user) {
                return redirect('/users')->with('fail', 'User not found.');
            }

            $user->masv = $request->studentId;
            $user->name = $request->studentName;
            $user->email = $request->studentEmail;
            $user->sdt = $request->studentPhone;
            $user->address = $request->studentAddress;
            $user->save();

            return redirect('/users')->with('success', $user->name . ' User Updated Successfully!');
        } catch (\Exception $e) {
            return redirect('/edit/user')->with('fail', $e->getMessage());
        }
    }
}
