# 网易云信 SDK for PHP  !

### 主要新特性

* 网易云信SDK FOR PHP
* 集成网易云信常用接口【陆续更新中】
* 调用简单，统一原样返回
* 所有方法的实例详细使用examples【1.1.6版本后接口增加，陆续更新中】

### 更新日志

- 1.0.7 发送普通消息增加推送字段 “pushcontent”
- 1.0.8 批量发送点对点普通消息 增加推送字段 “pushcontent”
- 1.0.9 批量发送消息，返回结果
- 1.1.1 朋友关系返回结果
- 1.1.3 全部接口返回完整结果
- 1.1.4 修复偶尔调用接口CheckSum错误
- 1.1.5 增加回调接口
- 1.1.6 增加【在线状态】订阅接口
- 1.1.7 更新guzzlehttp/guzzle至7.0以上版本
- 2.0.0 修改为php7严格模式
- 2.1.0 增加创建群组功能（高级群）
- 2.2.0 增加 拉人进群 功能
- 2.3.0 增加 踢人出群 功能
- 2.4.0 增加 批量踢人出群 功能、增加解散群功能
- 2.5.0 增加 编辑群资料
- 2.6.0-2.6.2 增加 群信息与成员列表查询
- 2.7.0 增加 获取群组详细信息
- 2.8.0 增加 获取群组已读消息的已读详情信息、移交群主
- 2.9.0 增加 任命管理员、移除管理员、获取某用户所加入的群信息、修改群昵称、 修改消息提醒开关
- 2.9.1 增加了普通消息tips类型 #2
- 2.10.0 增加 禁言群成员 主动退群 获取群组禁言列表

## 安装

> 运行环境要求PHP7.1+。

```shell
$ composer require cccdl/yunxin_sdk
```

### 接口对应文件

| 文件|方法|说明|
|---|---|---|
| Friend.php|`add()`|加好友，两人保持好友关系|
| Friend.php|`update()`|更新好友相关信息|
| Friend.php|`delete()`|删除好友|
| Friend.php|`get()`|获取好友关系【查询某时间点起到现在有更新的双向好友】|
| Friend.php|`setSpecialRelation()`|设置黑名单/静音|
| Friend.php|`listBlackAndMuteList()`|设置黑名单/静音|
| User.php|`create()`|创建网易云通信ID|
| User.php|`update()`|更新网易云通信token|
| User.php|`block()`|封禁网易云通信ID|
| User.php|`unblock()`|解禁网易云通信ID|
| User.php|`updateUserInfo()`|更新用户名片|
| User.php|`getUserInfos()`|获取用户名片，可以批量|
| User.php|`setDonnop()`设置桌面端在线时，移动端是否需要推送|
| User.php|`mute()`|账号全局禁言|
| User.php|`muteAv()`|账号全局禁用音视频|
| Msg.php|`sendMsg()`|发送普通消息|
| Msg.php|`sendBatchMsg()`|批量发送点对点普通消息|
| Msg.php|`sendAttachMsg()`|发送自定义系统通知|
| Msg.php|`sendBatchAttachMsg()`|批量发送点对点自定义系统通知|
| Msg.php|`broadcastMsg()`|对在应用内的用户发送广播消息|
| Subscribe.php|`add()`|增加订阅在线状态事件|
| Subscribe.php|`delete()`|取消在线状态事件订阅|
| Subscribe.php|`batchDel()`|取消全部在线状态事件订阅|
| Subscribe.php|`query()`|查询在线状态事件订阅关系|
| Team.php|`create()`|创建群（高级群）|
| Team.php|`add()`|拉人进群|
| Team.php|`kick()`|踢人出群|
| Team.php|`batchKick()`|批量踢人出群|
| Team.php|`remove()`|解散群|
| Team.php|`update()`|编辑群资料|
| Team.php|`query()`|群信息与成员列表查询|
| Team.php|`queryDetail()`|获取群组详细信息|
| Team.php|`getMarkReadInfo()`|获取群组已读消息的已读详情信息|
| Team.php|`changeOwner()`|移交群主|
| Team.php|`addManager()`|任命管理员|
| Team.php|`removeManager()`|移除管理员|
| Team.php|`joinTeams()`|获取某用户所加入的群信息|
| Team.php|`updateTeamNick()`|修改群昵称|
| Team.php|`muteTeam()`|修改消息提醒开关|
| Team.php|`muteTlist()`|禁言群成员|
| Team.php|`leave()`|主动退群|
| Team.php|`listTeamMute()`|获取群组禁言列表|

### 快速使用

在您开始之前，您需要注册网易云信并获取您的[凭证](https://dev.yunxin.163.com)。

```php
<?php

use cccdl\yunxin_sdk\Im\User;

$im = new User($appKey, $appSecrt);

$res = $im->create('100001');
```

## 文档

[网易云信文档中心](https://dev.yunxin.163.com/)

## 问题

[提交 Issue](https://github.com/cccdl/yunxin_sdk/issues)，不符合指南的问题可能会立即关闭。

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/cccdl/yunxin_sdk/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/cccdl/yunxin_sdk/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and
PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
