<?php
/**
 * Created by PhpStorm.
 * User: wzb
 * Date: 2016/5/11
 * Time: 17:21
 */
    // �����ϴ��ĺ�׺��.
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    // ��ȡ�ϴ�ͼƬ���ļ�������.�ָ�
    $temp = explode(".", $_FILES["file"]["name"]);
    // ȡ�ϴ��ļ��ĺ�׺��
    $extension = end($temp);
    //ͼƬ��mime�ڱ༭�����Ѿ����,�ڷ��������ٴμ��
    //������̷�ʽȡ��mime
    //FILEINFO_MIME_TYPE ��php5.3.0����ʹ��
    //�������﷢�����汨��ʱ�����php.ini��php_fileinfo��չ��Ȼ������������
    $finfo = new finfo(FILEINFO_MIME_TYPE);// ���� mime ����
    $mime = $finfo->file($_FILES["file"]["tmp_name"]);
    if ((($mime == "image/gif")||($mime == "image/jpeg")||($mime == "image/pjpeg")||($mime == "image/x-png")||($mime == "image/png")) && in_array($extension, $allowedExts)) {
        // ʹ��΢�벢���ɹ�ϣֵ������Ψһ�ļ���
        $name = sha1(microtime()) . "." . $extension;
        //�ƶ�ͼƬ��ָ��Ŀ¼.
        move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/" . $name);
        //ʵ����һ��һ����
        $response = new StdClass;
        $response->link = "../edit_demo/uploads/" . $name;
        echo stripslashes(json_encode($response));
    }