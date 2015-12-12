<?php namespace App\Repositories\DBImplement;

use App\Repositories\DBInterface\UserRepositoryInterface;
use App\User;


class UserRepository extends BaseRepository implements UserRepositoryInterface {

    public function selectAll()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function create($data)
    {
        return User::create($data);
    }

    public function update($data, $id)
    {
        $user = User::findOrFail($id);

        return $user->update($data);
    }

    public function paginate($where, $sort, $perPage = 3)
    {
        return User::paginate($perPage);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }
}