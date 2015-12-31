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


    public function getUserList()
    {
        $user = $this->userRepository->lists(config('web.perPage'));
        return responseSuccess($user);
    }

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

    public function getUserById($id)
    {
        $user = $this->userRepository->getById($id);
        if ($user) {
            return responseSuccess($user);
        }
        return responseWrong('不存在');
    }

    public function postCreate(CreateRequest $request)
    {

        $user = $this->userRepository->store($request->all());

        if ($user) {
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

    public function delete($id)
    {
        $res = $this->userRepository->destroy($id);
        return responseSuccess($res);
    }
}