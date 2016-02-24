<?php
/**
 * 接口基础控制器
 */
namespace App\Http\Controllers\Api;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    // 接口帮助调用
    use Helpers;


    protected function me()
    {
        if ($token = JWTAuth::getToken()) {
            return  JWTAuth::parseToken()->toUser();
        }

        return false;
    }
}
