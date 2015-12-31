<?php

/**
 * 当前用户控制器
 */
namespace App\Api\Controllers\V1;

use App\Core\Status;
use App\Events\UserCreate;
use App\Http\Requests\Admin\CreateRequest;
use Illuminate\Http\Request;
use App\Api\Controllers\BaseController;
use App\Api\Transformers\UserTransformer;
use App\Repositories\UserRepository;

class UserController extends BaseController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers()
    {
        $users = $this->userRepository->lists(config('web.perPage'));
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
        $user = $this->userRepository->find($id);
        if ($user) {
            return $this->successResponse($user);
        }
        return $this->errorResponse('不存在');
    }

    public function create(CreateRequest $request)
    {

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