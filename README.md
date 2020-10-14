#  网易云信 SDK for PHP  !
###### 由于官方没有提供，自己开发一个

### 主要新特性

* 

### 更新日志
- 1.0.7  发送普通消息增加推送字段 “pushcontent”
- 1.0.8  批量发送点对点普通消息 增加推送字段 “pushcontent”
- 1.0.9  批量发送消息，返回结果
- 1.1.1  朋友关系返回结果
- 1.1.3  全部接口返回完整结果
- 1.1.4  修复偶尔调用接口CheckSum错误
- 1.1.5  增加回调接口

## 安装
> 运行环境要求PHP7.1+。
```shell
$ composer require cccdl/yunxin_sdk
```

### 接口对应文件

| 文件                       | 方法                 |  说明    |
| :-----------------------  | --------------         |  :----    |
| Friend.php        | `add()`       | 加好友，两人保持好友关系 |
| User.php        | `create()`       | 创建网易云通信ID |
| Msg.php        | `sendMsg()`       | 发送普通消息 |



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

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
