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
    public function lists($filter, $sorter, $pageSize)
    {
        /*
     * 构建过滤条件
     */
        if (is_array($filter) && count($filter) > 0) {

            foreach ( $filter as $key => $value ) {

                //用户名
                if (strcasecmp($key, 'username') == 0 ) {
                    $this->model->where('username', 'LIKE', "%{$value}%");
                }

            }
        }

        //构建排序条件
        if (is_array($sorter) && count($sorter) > 0) {
            foreach ($sorter as $key => $value) {
                //ID排序
                if (strcasecmp($key, 'ID') == 0) {
                    $sort = $value ? 'asc' : 'desc';
                    $this->model->orderBy('id', $sort);
                }
            }
        }
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
        $user->fill($input);

        return $user->save();
    }

}
