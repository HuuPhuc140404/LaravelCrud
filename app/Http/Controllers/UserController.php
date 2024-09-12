<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadAllUsers()
    {
        $all_users = $this->userRepository->getAllUsers();
        return view('users', compact('all_users'));
    }

    public function loadAddUserForm()
    {
        return view('add-user');
    }

    public function AddUser(Request $request)
    {
        $request->validate([
            'studentId' => 'required|string|unique:users,masv|min:4',
            'studentName' => 'required|string|regex:/^[^\d]*$/',
            'studentEmail' => 'required|email|unique:users,email',
            'studentPhone' => 'required|integer',
            'studentAddress' => 'required|string',
        ]);

        $data = [
            'masv' => $request->studentId,
            'name' => $request->studentName,
            'email' => $request->studentEmail,
            'sdt' => $request->studentPhone,
            'address' => $request->studentAddress,
        ];

        try {
            $this->userRepository->createUser($data);
            return redirect('/users')->with('success', 'User Added Successfully!');
        } catch (\Exception $e) {
            return redirect('/add/user')->with('fail', $e->getMessage());
        }
    }

    public function deleteUser($id)
    {
        try {
            $this->userRepository->deleteUser($id);
            return redirect('/users')->with('success', 'User Deleted Successfully!');
        } catch (\Exception $e) {
            return redirect('/users')->with('fail', $e->getMessage());
        }
    }

    public function loadEditUserForm($id)
    {
        $user = $this->userRepository->findUserById($id);
        return view('edit-user', compact('user'));
    }

    public function EditUser(Request $request)
    {
        $request->validate([
            'studentName' => 'required|string|regex:/^[^\d]*$/',
            'studentEmail' => 'required|email',
            'studentPhone' => 'required|integer',
            'studentAddress' => 'required|string',
        ]);

        $data = [
            'masv' => $request->studentId,
            'name' => $request->studentName,
            'email' => $request->studentEmail,
            'sdt' => $request->studentPhone,
            'address' => $request->studentAddress,
        ];

        try {
            $this->userRepository->updateUser($request->id, $data);
            return redirect('/users')->with('success', 'User Updated Successfully!');
        } catch (\Exception $e) {
            return redirect('/edit/user')->with('fail', $e->getMessage());
        }
    }
}
