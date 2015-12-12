<?php

/**
 * 当前用户控制器
 */
namespace App\Api\Controllers\V1;

use App\Core\Status;
use App\Api\Controllers\BaseController;
use App\Events\UserCreate;
use App\Repositories\DBInterface\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Api\Transformers\UserTransformer;

class UserController extends BaseController
{
    private $_user;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->_user = $repository;
    }

    public function getUsers()
    {
        $users = $this->_user->selectAll();
        return $this->successResponse($users);
    }

    /**
     * @api {get} /user 当前用户信息
     */
    public function show()
    {
        return $this->successResponse($this->me());
        //return $this->response->item($this->me(), new UserTransformer);
    }

    public function getUserById($id)
    {
        $user = $this->_user->find($id);
        if ($user) {
            return $this->successResponse($user);
        }
        return $this->errorResponse(Status::RET_DATA_NOT_EXIST);
    }

    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'username'  => 'required|max:255|min:2',
            'email'    => 'required|email|unique:users',
            'password'     => 'required|min:6',
        ],[
            'email.unique' => trans('demo.email_has_registed'),
            'password.min' => '密码最少为6位字符'
        ]);

        if ($validator->fails()) {
            return $this->response->error($validator->messages(), 403);
        }

        $user = $this->_user->create($request->all());

        if ($user) {
            //给注册用户发邮件
            event(new UserCreate($user));
            return $this->successResponse($user);
        }

    }

    public function getUserList(Request $request)
    {
        $where = $sort = [];
        $user = $this->_user->paginate($where, $sort, config('web.perPage'));
        return $this->response->paginator($user, new UserTransformer);
    }


    /**
     * @api {put} /user 修改个人信息
     */
    public function update(Request $request, $id)
    {
        $user = $this->_user->find($id);
        if (!$user) {
            return $this->errorResponse(Status::RET_DATA_NOT_EXIST);
        }

       $user = $this->_user->update($request->all(), $id);

        return $this->successResponse($user);
    }

    public function delete($id)
    {
        $user = $this->_user->delete($id);
        return $this->successResponse($user);
    }
}