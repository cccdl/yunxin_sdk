<?php

namespace cccdl\yunxin_sdk\Im;

use cccdl\yunxin_sdk\Exception\cccdlException;
use GuzzleHttp\Exception\GuzzleException;

class History extends Base
{

    /**
     * 查询存储在网易云信服务器中的群聊历史消息，只能查询在保存时间范围内的消息。
     *
     * 根据时间段查询群消息，每次最多返回 100 条。
     * 不提供分页支持，第三方需要根据时间段来查询。
     * begintime 需要早于 endtime，否则会返回{"desc": "bad time", "code": 414}。
     * 单个应用默认最高调用频率：100 次/秒。如超限，将被屏蔽 10 秒。
     *
     * @param int $roomId 聊天室id
     * @param string $accId 用户账号
     * @param int $timetag //查询的时间戳锚点，13位。reverse=1时timetag为起始时间戳，reverse=2时timetag为终止时间戳
     * @param int $limit 本次查询的消息条数上限(最多200条),小于等于0，或者大于200，会提示参数错误
     * @param array $options
     *  reverse 1按时间正序排列，2按时间降序排列。其它返回参数414错误。默认是2按时间降序排列
     *  type    查询指定的多个消息类型，类型之间用","分割，不设置该参数则查询全部类型消息。
     *          格式示例： 0,1,2,3
     *          支持的消息类型：0:文本，1:图片，2:语音，3:视频，4:地理位置，5:通知，6:文件，10:提示，11:智能机器人消息，100:自定义消息。用英文逗号分隔。
     *
     * @return array
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function queryChatroomMsg(int $roomId, string $accId, int $timetag, int $limit,  array $options = []): array
    {
        $data = [
            'roomid' => $roomId,
            'accid' => $accId,
            'timetag' => $timetag,
            'limit' => $limit,
        ];

        return $this->post('history/queryChatroomMsg.action', array_merge($data, $options));

    }

}