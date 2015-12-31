<?php

namespace App\Repositories;

use App\User;

/**
 * User Repository.
 */
class UserRepository
{
    use BaseRepository;

    /**
     * User Model.
     *
     * @var User
     */
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * 获取账户列表.
     *
     * @param int $pageSize 分页大小
     *
     * @return \Illuminate\Pagination\Paginator
     */
    public function lists($pageSize)
    {
        return $this->model->orderBy('id', 'desc')->paginate($pageSize);
    }


    /**
     * store.
     *
     * @param App\Models\Menu $menu
     * @param array           $input
     */
    public function store($input)
    {
        return $this->savePost($this->model, $input);
    }


    /**
     * update.
     *
     * @param int   $id
     * @param array $input
     */
    public function update($id, $input)
    {
        $model = $this->model->find($id);

        return $this->savePost($model, $input);
    }

    /**
     * save.
     *
     * @param User $user user
     * @param Request $input   输入
     */
    public function savePost($user, $input)
    {
        return $input;
//        $user->fill($input);
//
//        return $user->save();
    }

}
