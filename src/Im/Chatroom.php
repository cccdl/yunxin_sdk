<?php

namespace cccdl\yunxin_sdk\Im;

use cccdl\yunxin_sdk\Exception\cccdlException;

class Chatroom extends Base
{
    const MSG_TYPE_TEXT = 0; // 文本类型
    const MSG_TYPE_IMAGE = 1; // 图片消息
    const MSG_TYPE_VOICE = 2; // 语音消息
    const MSG_TYPE_VIDEO = 3; // 视频消息
    const MSG_TYPE_LOCATION = 4; // 地理位置消息
    const MSG_TYPE_FILE = 6; // 文件消息
    const MSG_TYPE_TIP = 10; // 提示tip消息
    const MSG_TYPE_CUSTOM = 100; // 自定义消息

    /**
     * @param int $roomId
     * @param string $fromAccid
     * @param int $msgType
     * @param array $options
     * @return array
     * @throws cccdlException
     */
    public function sendMsg(int $roomId, string $fromAccid, int $msgType, array $options = []): array
    {
        $data = [
            'roomid' => $roomId,
            'msgId' => $this->getNonce(16) . $roomId . $fromAccid . time(),
            'fromAccid' => $fromAccid,
            'msgType' => $msgType,
        ];

        return $this->post('chatroom/sendMsg.action', array_merge($options, $data));

    }

}