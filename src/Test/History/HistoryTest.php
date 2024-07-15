<?php

namespace cccdl\yunxin_sdk\Test\History;

use cccdl\yunxin_sdk\Exception\cccdlException;
use cccdl\yunxin_sdk\Im\History;
use cccdl\yunxin_sdk\Test\TestAppid;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class HistoryTest extends TestCase
{
    /**
     * 测试查询聊天室历史消息记录
     * @return void
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function testQueryChatroomMsg()
    {
        $c = TestAppid::getTestAppid();
        $this->assertIsArray($c);

        print_r($c);
        $app = new History($c['appKey'], $c['appSecrt']);
        $result = $app->queryChatroomMsg(
            8480605885,
            'test_41db4ec7906f56fdc84f20366d4',
            1720713600,
            100,
        );

        print_r($result);

        $this->assertIsArray($result);
    }
}