<?php
/**
 * Created by PhpStorm.
 * User: 77849
 * Date: 2015/12/11
 * Time: 17:17
 */



/**
 * 返回成功请求
 *
 * @param string $data
 * @param string $msg
 * @param string $header
 * @param string $value
 * @return mixed
 */
function responseSuccess($data = '', $msg = '成功', $header = 'Content-Type', $value = 'application/json')
{
    $res['status'] = ['errorCode' => 0, 'msg' => $msg];
    $res['data'] = $data;
    return response($content = $res, $status = 200)->header($header, $value);
}

/**
 * 返回错误的请求
 *
 * @param string $msg
 * @param int $code
 * @param string $data
 * @param string $header
 * @param string $value
 * @return mixed
 */
function responseWrong($msg = '失败', $code = 1, $data = '', $header = 'Content-Typeaa', $value = 'application/json')
{
    $res['status'] = ['errorCode' => $code, 'msg' => $msg];
    $res['data'] = $data;
    return response($content = $res, $status = 200)->header($header, $value);
}