<?php
/**
 * 接口基础控制器
 */
namespace App\Controllers\Api;

use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Core\Status;

class BaseController extends Controller
{

    // 接口帮助调用
    use Helpers;

        // 请求
    protected $request;

    protected function me()
    {
        if ($token = JWTAuth::getToken()) {
            return  JWTAuth::parseToken()->toUser();
        }

        return false;
    }

    //返回成功请求
    protected function successResponse($data = '', $errorCode = Status::RET_SUCCESS, $header = 'Content-Type', $value = 'application/json')
    {
        return $this->response->array(['status' => ['errorCode' => $errorCode, 'msg' => Status::$ERROR_MSG[$errorCode]], 'data' => $data])->withHeader($header, $value);
    }
    // 返回错误的请求
    protected function errorResponse($errorCode = Status::RET_ERROR, $data = '', $header = 'Content-Type', $value = 'application/json')
    {
        return $this->response->array(['status' => ['errorCode' => $errorCode, 'msg' => Status::$ERROR_MSG[$errorCode]], 'data' => $data])->withHeader($header, $value);
    }

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
