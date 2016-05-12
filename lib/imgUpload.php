<?php
/**
 * Created by PhpStorm.
 * User: wzb
 * Date: 2016/5/11
 * Time: 17:21
 * description 该上传方法检验不足，请整合自己的上传方法，或使用repository => dowmload里面的上传代码
 */
    // 允许上传的后缀名.
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    // 获取上传图片的文件名，以.分割
    $temp = explode(".", $_FILES["file"]["name"]);
    // 取上传文件的后缀名
    $extension = end($temp);
    //图片的mime在编辑器中已经检查,在服务器端再次检测
    //面向过程方式取出mime
    //FILEINFO_MIME_TYPE 自php5.3.0可以使用
    //在网络里发现下面报错时，请打开php.ini的php_fileinfo扩展，然后重启服务器
    $finfo = new finfo(FILEINFO_MIME_TYPE);// 返回 mime 类型
    $mime = $finfo->file($_FILES["file"]["tmp_name"]);
    if ((($mime == "image/gif")||($mime == "image/jpeg")||($mime == "image/pjpeg")||($mime == "image/x-png")||($mime == "image/png")) && in_array($extension, $allowedExts)) {
        // 使用微秒并生成哈希值，构造唯一文件名
        $name = sha1(microtime()) . "." . $extension;
        //移动图片到指定目录.
        move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/" . $name);
        //实例化一个一般类
        $response = new StdClass;
        $response->link = "../edit_demo/uploads/" . $name;
        echo stripslashes(json_encode($response));
    }
