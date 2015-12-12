<?php
namespace App\Core;

class Status {
    /**
     * 统一抛出错误提示
     *
     */
    const RET_SUCCESS           = 0; // 成功

    const RET_ERROR             = -1; // 失败

    const RET_DATA_NOT_EXIST    = -100; // 数据不存在

    const RET_DATA_EXIST        = -101; // 数据重复
    //token错误
    const RET_COUNT_NOT_CREATE  = 10001;//token没有创建
    //用户登录错误
    const RET_ACCOUNT_WRONG     = 40001;//用户名或密码错误

    const RET_ACCOUNT_EXIST     = 40002;//用户名重复




    static public $ERROR_MSG = array(
        self::RET_SUCCESS               => "成功",
        self::RET_ERROR                 => "失败",
        self::RET_DATA_NOT_EXIST        => "数据不存在",
        self::RET_DATA_EXIST            => "数据重复",
        self::RET_ACCOUNT_WRONG         => "用户名或密码错误",
        self::RET_ACCOUNT_EXIST         => "用户名重复",
        self::RET_COUNT_NOT_CREATE      => "token没有创建"
    );
}