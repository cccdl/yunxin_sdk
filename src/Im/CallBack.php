<?php

namespace cccdl\yunxin_sdk\Im;


use cccdl\yunxin_sdk\Exception\cccdlNotiftException;
use Exception;


/**
 * 回调处理
 */
class CallBack extends Base
{

    /**
     * @var array
     */
    private $header;

    public function __construct($appKey, $appSecrt)
    {
        parent::__construct($appKey, $appSecrt);

        //获取头部信息
        $this->header = $this->getHeader();
    }

    public function notify()
    {

        if(empty($this->header)){
            throw new cccdlNotiftException('header is empty');
        }

        if ($this->header['checksum'] != sha1($this->AppSecret . $this->header['md5'] . $this->header['curtime'])) {
            throw new cccdlNotiftException('signature verification failed');
        }

        $data = json_decode(file_get_contents ( "php://input"),true);


        return $data;
    }

    /**
     * 获取头部信息
     */
    public function getHeader()
    {
        $server = $_SERVER;
        $header = [];
        foreach ($server as $key => $val) {
            if (0 === strpos($key, 'HTTP_')) {
                $key = str_replace('_', '-', strtolower(substr($key, 5)));
                $header[$key] = $val;
            }
        }
        if (isset($server['CONTENT_TYPE'])) {
            $header['content-type'] = $server['CONTENT_TYPE'];
        }
        if (isset($server['CONTENT_LENGTH'])) {
            $header['content-length'] = $server['CONTENT_LENGTH'];
        }

        return $header;

    }
}
