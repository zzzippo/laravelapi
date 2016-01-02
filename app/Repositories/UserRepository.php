<?php

namespace App\Repositories;

use App\User;
use DB;

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
    public function lists($filter, $sorter, $page, $pageSize)
    {
        $users = DB::table('users');
        /*
     * 构建过滤条件
     */
        if (is_array($filter) && count($filter) > 0) {

            foreach ( $filter as $key => $value ) {

                //用户名
                if (strcasecmp($key, 'username') == 0 ) {
                    $users->where('username', 'LIKE', "%{$value}%");
                }

            }
        }

        //构建排序条件
        if (is_array($sorter) && count($sorter) > 0) {
            foreach ($sorter as $key => $value) {
                //ID排序
                if (strcasecmp($key, 'ID') == 0) {
                    $sort = $value ? 'asc' : 'desc';
                    $users->orderBy('id', $sort);
                }
            }
        }
        //查询数据数量
        $count = $users->count();

        //获取符合条件的记录列表
        $t = ($page-1)*$pageSize;
        $pages = $users->skip($t)->take($pageSize)->get();

        $data = [];
        $data['total']  =  $count;
        $data['items'] = $pages;

        return responseSuccess($data);
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

    /**
     * Destroy a model.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->getById($id)->delete();
    }

    /**
     * Get Model by id.
     *
     * @param int $id
     *
     * @return App\Models\Model
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getAll()
    {
        return $this->model->all();
    }

}
