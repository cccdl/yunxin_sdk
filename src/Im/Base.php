<?php

namespace cccdl\yunxin_sdk\Im;

use cccdl\yunxin_sdk\Traits\Request;

class Base
{
    use Request;

    /**
     * 请求域名
     * @var string
     */
    private $baseUrl = 'https://api.netease.im/nimserver/';

    /**
     * 开发者平台分配的appkey
     * @var
     */
    private $AppKey;

    /**
     * 密钥
     * @var
     */
    private $AppSecret;

    /**
     * 随机数（最大长度128个字符）
     * @var
     */
    private $Nonce;

    /**
     * SHA1(AppSecret + Nonce + CurTime)，三个参数拼接的字符串，进行SHA1哈希计算，转化成16进制字符(String，小写)
     * @var
     */
    private $CheckSum;


    public function __construct($appKey, $appSecrt)
    {
        $this->AppKey = $appKey;
        $this->AppSecret = $appSecrt;
        $this->Nonce = self::getNonce(128);
    }

    /**
     * 获取随机字符串
     * @param int $length 位数
     * @return string
     */
    private function getNonce($length = 128)
    {
        // 密码字符集，可任意添加你需要的字符
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            // 这里提供两种字符获取方式
            // 第一种是使用 substr 截取$chars中的任意一位字符；
            // 第二种是取字符数组 $chars 的任意元素
            // $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
            $password .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $password;
    }

    /**
     * 将数组中的bool值转换为字符类型
     *
     * @param array $data
     *
     * @return array
     */
    private function bool2String(array $data)
    {
        foreach ($data as &$datum) {
            if (is_bool($datum)) {
                $datum = $datum ? 'true' : 'false';
            } elseif (is_array($datum)) {
                $datum = $this->bool2String($datum);
            }
        }

        return $data;
    }


}