<?php

namespace cccdl\yunxin_sdk\Test\Chatroom;

use cccdl\yunxin_sdk\Exception\cccdlException;
use cccdl\yunxin_sdk\Im\Chatroom;
use cccdl\yunxin_sdk\Test\TestAppid;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class ChatroomTest extends TestCase
{
    /**
     * 测试发送聊天室消息
     * @return void
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function testSendMsg()
    {
        $c = TestAppid::getTestAppid();
        $this->assertIsArray($c);

        print_r($c);
        $app = new Chatroom($c['appKey'], $c['appSecrt']);

        $json = json_encode([
            'type' =>30012 ,
            'data' => [
                'content' => 'ZMXN《小MZN想念Z《X',
                'render' => [],
                'roomId' => 179,
            ],
        ]);

        //通知婚礼结束
        $result =  $app->sendMsg(
            8480605885,
            (string)'test_41db4ec7906f56fdc84f20366d4',
            Chatroom::MSG_TYPE_CUSTOM,
            ['skipHistory' => 0, 'attach' => $json]
        );

        print_r($result);

        $this->assertIsArray($result);
    }
}