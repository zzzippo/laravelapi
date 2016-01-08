<?php namespace App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface{

    public function lists($filter, $sorter,$page, $pageSize);

    public function selectAll();

    public function getById($id);

    public function create($input);

    public function update($input, $id);

}