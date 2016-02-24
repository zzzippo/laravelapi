<?php

/**
 * 当前用户控制器
 */
namespace App\Http\Controllers\Api\V1;

use App\Events\UserCreate;
use App\Http\Requests\Admin\CreateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Repositories\UserRepository;

class UserController extends BaseController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * 用户分页
     *
     * @param Request $request
     * @return mixed
     */
    public function getUserList(Request $request)
    {
        $filter     = $request->get('filter');
        $sorter     = $request->get('sorter');
        $perPage    = $request->get('perPage')?$request->get('perPage'):config('web.perPage');
        $user = $this->userRepository->lists($filter, $sorter, $request->get('page'), $perPage);
        return responseSuccess($user);
    }

    /**
     * 所有用户
     *
     * @return mixed
     */
    public function getUsers()
    {
        $users = $this->userRepository->getAll();
        return responseSuccess($users);
    }

    /**
     * @api {get} /user 当前用户信息
     */
    public function show()
    {
        return responseSuccess($this->me());
    }

    /**
     * 根据ID获取用户信息
     *
     * @param $id
     * @return mixed
     */
    public function getUserById($id)
    {
        $user = $this->userRepository->getById($id);
        if ($user)
        {
            return responseSuccess($user);
        }
        return responseWrong('不存在');
    }

    /**
     * 添加用户
     *
     * @param CreateRequest $request
     * @return mixed
     */
    public function postCreate(Request $request)
    {
        $user = $this->userRepository->store($request->all());

        if ($user)
        {
            //给注册用户发邮件
            //event(new UserCreate($user));
            return responseSuccess($user);
        }
        return responseWrong();

    }


    /**
     * @api {put} /user 修改个人信息
     */
    public function update(Request $request, $id)
    {
        $user = $this->userRepository->update($id, $request->all());
        return responseSuccess($user);
    }

    /**
     * 删除用户
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $this->userRepository->destroy($id);
        return responseSuccess();
    }
}