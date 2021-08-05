<?php

namespace cccdl\yunxin_sdk\Im;

use cccdl\yunxin_sdk\Exception\cccdlException;
use cccdl\yunxin_sdk\Traits\Request;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 群组功能（高级群）
 */
class Team extends Base
{

    use Request;

    /**
     * 创建高级群，以邀请的方式发送给用户；
     * custom 字段是给第三方的扩展字段，第三方可以基于此字段扩展高级群的功能，构建自己需要的群；
     * 建群成功会返回tid，需要保存，以便于加人与踢人等后续操作；
     * 每个用户可创建的群数量有限制，限制值由 IM 套餐的群组配置决定，可登录管理后台查看。
     * - announcement    : String , 否    群公告，最大长度1024字符
     * - intro           : String , 否    群描述，最大长度512字符
     * - custom          : String , 否    自定义高级群扩展属性，第三方可以跟据此属性自定义扩展自己的群属性。（建议为json）, 最大长度1024字符
     * - icon            : String , 否    群头像，最大长度1024字符
     * - beinvitemode    : int    , 否    被邀请人同意方式，0-需要同意(默认), 1-不需要同意。其它返回414
     * - invitemode      : int    , 否    谁可以邀请他人入群，0-管理员(默认), 1-所有人。其它返回414
     * - uptinfomode     : int    , 否    谁可以修改群资料，0-管理员(默认), 1-所有人。其它返回414
     * - upcustommode    : int    , 否    谁可以更新群自定义属性，0-管理员(默认), 1-所有人。其它返回414
     * - teamMemberLimit : int    , 否    该群最大人数(包含群主)，范围：2至应用定义的最大群人数(默认: 200)。其它返回414
     * - attach          : String , 否    自定义扩展字段，最大长度512
     * @param string $tname 群名称，最大长度64字符
     * @param string $owner 群主用户帐号，最大长度32字符
     * @param array  $members 邀请的群成员列表。\["aaa", "bbb"\](JSONArray对应的accid，如果解析出错会报414)，members与owner总和上限为200。members中无需再加owner自己的账号。
     * @param string $msg 邀请发送的文字，最大长度150字符
     * @param int    $magree 管理后台建群时，0不需要被邀请人同意加入群，1需要被邀请人同意才可以加入群。其它会返回414
     * @param int    $joinmode 群建好后，sdk操作时，0不用验证，1需要验证, 2不允许任何人加入。其它返回414
     * @param array  $options 上述非必填参数构建的数组,请查看注释内容备注
     * @return array
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function create(string $tname, string $owner, array $members, string $msg, int $magree, int $joinmode, array $options = []): array
    {
        $data = [
            'tname' => $tname,
            'owner' => $owner,
            'members' => json_encode($members),
            'msg' => $msg,
            'magree' => $magree,
            'joinmode' => $joinmode,
        ];

        $data = array_merge($data, $options);

        return $this->post('team/create.action', $data);

    }

    /**
     * 拉人入群
     * 1.可以批量邀请，邀请时需指定群主；
     * 2.当群成员达到上限时，再邀请某人入群返回失败；
     * 3.当群成员达到上限时，被邀请人“接受邀请"的操作也将返回失败。
     * - attach          : String , 否    自定义扩展字段，最大长度512
     * @param string $tid 网易云信服务器产生，群唯一标识，创建群时会返回，最大长度128字符
     * @param string $owner 用户帐号，最大长度32字符，按照群属性invitemode传入
     * @param array  $members \["aaa","bbb"\](JSONArray对应的accid，如果解析出错会报414)，一次最多拉200个成员
     * @param int    $magree 管理后台建群时，0不需要被邀请人同意加入群，1需要被邀请人同意才可以加入群。其它会返回414
     * @param string $msg 邀请发送的文字，最大长度150字符
     * @param array  $options 上述非必填参数构建的数组,请查看注释内容备注
     * @return array
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function add(string $tid, string $owner, array $members, int $magree, string $msg, array $options = []): array
    {
        $data = [
            'tid' => $tid,
            'owner' => $owner,
            'members' => json_encode($members),
            'msg' => $msg,
            'magree' => $magree,
        ];

        $data = array_merge($data, $options);

        return $this->post('team/add.action', $data);

    }

    /**
     * 踢人出群
     * 1.高级群踢人出群，需要提供群主accid以及要踢除人的accid。
     * - attach          : String , 否    自定义扩展字段，最大长度512
     * @param string $tid 网易云信服务器产生，群唯一标识，创建群时会返回，最大长度128字符
     * @param string $owner 用户帐号，最大长度32字符，按照群属性invitemode传入
     * @param string $member 被移除人的accid，用户账号，最大长度32字符;注：member或members任意提供一个，优先使用member参数
     * @param array  $options 上述非必填参数构建的数组,请查看注释内容备注
     * @return array
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function kick(string $tid, string $owner, string $member, array $options = []): array
    {
        $data = [
            'tid' => $tid,
            'owner' => $owner,
            'member' => $member,
        ];

        $data = array_merge($data, $options);

        return $this->post('team/kick.action', $data);
    }


    /**
     * 批量踢人出群
     * 1.高级群踢人出群，需要提供群主accid以及要踢除人的accid。
     * - attach          : String , 否    自定义扩展字段，最大长度512
     * @param string $tid 网易云信服务器产生，群唯一标识，创建群时会返回，最大长度128字符
     * @param string $owner 用户帐号，最大长度32字符，按照群属性invitemode传入
     * @param array  $members ["aaa","bbb"]（JSONArray对应的accid，如果解析出错，会报414）一次最多操作200个accid; 注：member或members任意提供一个，优先使用member参数
     * @param array  $options 上述非必填参数构建的数组,请查看注释内容备注
     * @return array
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function batchKick(string $tid, string $owner, array $members, array $options = []): array
    {
        $data = [
            'tid' => $tid,
            'owner' => $owner,
            'member' => json_encode($members),
        ];

        $data = array_merge($data, $options);

        return $this->post('team/kick.action', $data);
    }

    /**
     * 解散群
     * 删除整个群，会解散该群，需要提供群主accid，谨慎操作！
     * - attach          : String , 否    自定义扩展字段，最大长度512
     * @param string $tid 网易云信服务器产生，群唯一标识，创建群时会返回，最大长度128字符
     * @param string $owner 用户帐号，最大长度32字符，按照群属性invitemode传入
     * @param array  $options
     * @return array
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function remove(string $tid, string $owner, array $options = []): array
    {
        $data = [
            'tid' => $tid,
            'owner' => $owner,
        ];

        $data = array_merge($data, $options);

        return $this->post('team/remove.action', $data);
    }

    /**
     * 编辑群资料
     * 高级群基本信息修改
     * tname           : String , 否    群名称，最大长度64字符
     * announcement    : String , 否    群公告，最大长度1024字符
     * intro           : String , 否    群描述，最大长度512字符
     * joinmode        : int    , 否    群建好后，sdk操作时，0不用验证，1需要验证, 2不允许任何人加入。其它返回414
     * custom          : String , 否    自定义高级群扩展属性，第三方可以跟据此属性自定义扩展自己的群属性。（建议为json） , 最大长度1024字符
     * icon            : String , 否    群头像，最大长度1024字符
     * beinvitemode    : int    , 否    被邀请人同意方式，0-需要同意(默认), 1-不需要同意。其它返回414
     * invitemode      : int    , 否    谁可以邀请他人入群，0-管理员(默认), 1-所有人。其它返回414
     * uptinfomode     : int    , 否    谁可以修改群资料，0-管理员(默认), 1-所有人。其它返回414
     * upcustommode    : int    , 否    谁可以更新群自定义属性，0-管理员(默认), 1-所有人。其它返回414
     * teamMemberLimit : int    , 否    该群最大人数(包含群主)，范围：2至应用定义的最大群人数(默认: 200)。其它返回414
     * attach          : String , 否    自定义扩展字段，最大长度512
     * @param string $tid 网易云信服务器产生，群唯一标识，创建群时会返回，最大长度128字符
     * @param string $owner 群主用户帐号，最大长度32字符
     * @param array  $options 上述非必填参数构建的数组,请查看注释内容备注
     * @return array
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function update(string $tid, string $owner, array $options = []): array
    {
        $data = [
            'tid' => $tid,
            'owner' => $owner,
        ];

        $data = array_merge($data, $options);

        return $this->post('team/update.action', $data);
    }

    /**
     * 群信息与成员列表查询
     * 高级群信息与成员列表查询，一次最多查询30个群相关的信息，跟据ope参数来控制是否带上群成员列表；
     * 查询群成员会稍微慢一些，所以如果不需要群成员列表可以只查群信息；
     * 此接口受频率控制，某个应用一分钟最多查询30次，超过会返回416，并且被屏蔽一段时间；
     * 群成员的群列表信息中增加管理员成员admins的返回。
     * @param string $tid 网易云信服务器产生，群唯一标识，创建群时会返回，最大长度128字符
     * @param int    $ope 1表示带上群成员列表，0表示不带群成员列表，只返回群信息
     * @param bool   $ignoreInvalid 是否忽略无效的tid，默认为false。设置为true时将忽略无效tid，并在响应结果中返回无效的tid
     * @return array
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function query(string $tid, int $ope, bool $ignoreInvalid = false): array
    {
        $data = [
            'tid' => $tid,
            'ope' => $ope,
            'ignoreInvalid' => $ignoreInvalid,
        ];

        return $this->post('team/query.action', $data);
    }
}