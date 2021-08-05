<?php

namespace cccdl\yunxin_sdk\Im;


use cccdl\yunxin_sdk\Exception\cccdlException;
use GuzzleHttp\Exception\GuzzleException;


/**
 * 在线状态订阅
 * 需要向网易云信申请开通
 */
class Subscribe extends Base
{
    /**
     * 增加订阅在线状态事件
     * 订阅指定人员的在线状态事件，每个账号最大有效订阅账号不超过3000个
     * @param string $accId 事件订阅人账号
     * @param array  $pubAccIds 被订阅人的账号列表，最多100个账号，JSONArray格式。示例：["pub_user1","pub_user2"]
     * @param int    $ttl 有效期，单位：秒。取值范围：60～2592000（即60秒到30天）
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function add(string $accId, array $pubAccIds, int $ttl)
    {

        return $this->post('event/subscribe/add.action', [
            'accid' => $accId,
            'eventType' => 1,
            'publisherAccids' => json_encode($pubAccIds),
            'ttl' => $ttl,
        ]);
    }

    /**
     * 取消在线状态事件订阅
     * 取消订阅指定人员的在线状态事件
     * @param string $accId 事件订阅人账号
     * @param array  $pubAccIds 被订阅人的账号列表，最多100个账号，JSONArray格式。示例：["pub_user1","pub_user2"]
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function delete(string $accId, array $pubAccIds)
    {

        return $this->post('event/subscribe/delete.action', [
            'accid' => $accId,
            'eventType' => 1,
            'publisherAccids' => json_encode($pubAccIds),
        ]);
    }

    /**
     * 取消全部在线状态事件订阅
     * 取消指定事件的全部订阅关系
     * @param string $accId 事件订阅人账号
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function batchDel(string $accId)
    {
        return $this->post('event/subscribe/batchdel.action', [
            'accid' => $accId,
            'eventType' => 1,
        ]);
    }

    /**
     * 查询在线状态事件订阅关系
     * 查询指定人员的有效在线状态事件订阅关系
     * @param string $accId 事件订阅人账号
     * @param array  $pubAccIds 被订阅人的账号列表，最多100个账号，JSONArray格式。示例：["pub_user1","pub_user2"]
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function query(string $accId, array $pubAccIds)
    {
        return $this->post('event/subscribe/query.action', [
            'accid' => $accId,
            'eventType' => 1,
            'publisherAccids' => json_encode($pubAccIds),
        ]);
    }
}
