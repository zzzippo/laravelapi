<?php namespace App\Repositories\DBInterface;

interface UserRepositoryInterface  {


    public function selectAll();

    public function find($id);

    public function create($data);

    public function paginate($where, $sort, $perPage);

    public function update($data, $id);

    public function delete($id);
}