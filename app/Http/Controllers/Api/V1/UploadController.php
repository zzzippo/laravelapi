<?php
namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Api\BaseController;
class UploadController extends BaseController
{

    //Ajax上传图片
    public function imgUpload()
    {
        //图片最大上传大小
        $maxImgSize = 10485760;
        //允许上传图片类型
        $allowed_extensions = ["png", "jpg"];

        if (!Request::hasFile('file_data')) {
            return response()->json(['errorCode' => 1, 'msg' => '请选择上传文件']);
        }

        $file =Request::file('file_data');

        if ($file->getError() != 0) {
            switch ($file->getError()) {
                case 1 :
                    $msg = '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值';
                    break;
                case 2 :
                    $msg = '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值';
                    break;
                case 3 :
                    $msg = '文件只有部分被上传';
                    break;
                case 4 :
                    $msg = '没有文件被上传';
                    break;
                case 6 :
                    $msg = '找不到临时文件夹';
                    break;
                default:
                    $msg = '文件写入失败';

            }
            return response()->json(['errorCode' => 1, 'msg' => $msg]);
        }
        $img_suffix = $file->getClientOriginalExtension();

        if ($img_suffix && !in_array($img_suffix, $allowed_extensions)) {
            return response()->json(['errorCode' => 1, 'msg' => '请选择png、jpg、jpeg后缀的图片']);
        }

        if ($file->getSize() > $maxImgSize) {
            return response()->json(['errorCode' => 1, 'msg' => '请选择小于10M的图片']);
        }

        $destinationPath = 'uploads/images/';
        $date = date('Ymd');
        if (!file_exists($destinationPath.$date)) {
            mkdir($destinationPath.$date, 0777, true);
        }
        $savePath = $destinationPath.$date.'/';
        $fileName = str_random(15).'.'.$img_suffix;
        $file->move($savePath, $fileName);

        return response()->json(['errorCode' => 0, 'path' => $savePath.$fileName]);
    }
}