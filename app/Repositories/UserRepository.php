<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
  public function getAllUsers()
  {
    return User::all();
  }

  public function createUser(array $data)
  {
    return User::create($data);
  }

  public function deleteUser($id)
  {
    return User::destroy($id);
  }

  public function findUserById($id)
  {
    return User::find($id);
  }

  public function updateUser($id, array $data)
  {
    $user = User::find($id);
    if ($user) {
      $user->update($data);
    }
    return $user;
  }
}
