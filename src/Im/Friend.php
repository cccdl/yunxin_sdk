<?php

namespace cccdl\yunxin_sdk\Im;


use Exception;

/**
 * 好友管理
 */
class Friend extends Base
{
    /**
     * 加好友，两人保持好友关系
     *
     * @param string $accid 加好友发起者accid
     * @param string $faccid 加好友接收者accid
     * @param int $type 1直接加好友，2请求加好友，3同意加好友，4拒绝加好友
     * @param string $msg 加好友对应的请求消息，第三方组装，最长256字符
     * @param string $serverex 服务器端扩展字段，限制长度256。此字段client端只读，server端读写
     *
     * @throws Exception
     */
    public function add($accid, $faccid, $type, $msg = '', $serverex = '')
    {
        return $this->post('friend/add.action', [
            'accid' => $accid,
            'faccid' => $faccid,
            'type' => $type,
            'msg' => $msg,
            'serverex' => $serverex,
        ]);
    }

    /**
     * 更新好友相关信息
     *
     * @param string $accid 发起者accid
     * @param string $faccid 要修改朋友的accid
     * @param string $alias 给好友增加备注名，限制长度128，可设置为空字符串
     * @param string $ex 修改ex字段，限制长度256，可设置为空字符串
     * @param string $serverex 服务器端扩展字段，限制长度256。此字段client端只读，server端读写
     *
     * @throws Exception
     */
    public function update($accid, $faccid, $alias = '', $ex = '', $serverex = '')
    {
        return $this->post('friend/update.action', [
            'accid' => $accid,
            'faccid' => $faccid,
            'alias' => $alias,
            'ex' => $ex,
            'serverex' => $serverex,
        ]);
    }

    /**
     * 删除好友
     *
     * @param string $accid 发起者accid
     * @param string $faccid 要修改朋友的accid
     * @param bool $isDeleteAlias 是否需要删除备注信息，false:不需要，true:需要
     *
     * @throws Exception
     */
    public function delete(string $accid, string $faccid, $isDeleteAlias = false)
    {
        return $this->post('friend/delete.action', [
            'accid' => $accid,
            'faccid' => $faccid,
            'isDeleteAlias' => $isDeleteAlias,
        ]);
    }

    /**
     * 获取好友关系
     * 查询某时间点起到现在有更新的双向好友
     *
     * @param string $accid 发起者accid
     * @param int $updatetime 更新时间戳，接口返回该时间戳之后有更新的好友列表
     *
     * @return array
     * @throws Exception
     */
    public function get(string $accid, int $updatetime)
    {
        return $this->post('friend/get.action', ['accid' => $accid, 'updatetime' => $updatetime]);
    }

    /**
     * 设置黑名单/静音
     * 拉黑/取消拉黑；设置静音/取消静音
     *
     * @param string $accid 用户帐号
     * @param string $targetAcc 被加黑或加静音的帐号
     * @param int $relationType 本次操作的关系类型,1:黑名单操作，2:静音列表操作
     * @param int $value 操作值，0:取消黑名单或静音，1:加入黑名单或静音
     *
     * @throws Exception
     */
    public function setSpecialRelation(string $accid, string $targetAcc, int $relationType, int $value)
    {
        return $this->post('user/setSpecialRelation.action', [
            'accid' => $accid,
            'targetAcc' => $targetAcc,
            'relationType' => $relationType,
            'value' => $value,
        ]);
    }


    /**
     * 查看指定用户的黑名单和静音列表
     *
     * @param string $accid 发起者accid
     *
     * @return array
     * @throws Exception
     */
    public function listBlackAndMuteList(string $accid)
    {
        $res = $this->post('user/listBlackAndMuteList.action', ['accid' => $accid]);
        return [
            'mutelist' => $res['mutelist'], //被静音的帐号列表
            'blacklist' => $res['blacklist'] //加黑的帐号列表
        ];
    }
}
