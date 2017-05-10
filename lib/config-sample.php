<?php
//商户号（6位数字）
$shan_config['user_seller'] = '';

//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
//合作身份者PID，签约账号，由16位纯数字组成的字符串，请登录商户后台查看
$shan_config['partner']		= '';

// MD5密钥，安全检验码，由数字和字母组成的32位字符串，请登录商户后台查看
$shan_config['key']			= '';

// 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
$shan_config['notify_url'] = "";

// 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
$shan_config['return_url'] = "";

//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
//DATABASE CONNECTION VARIABLES
$host = "127.0.0.1"; // Host name
$username = ""; // Mysql username
$password = ""; // Mysql password
$db_name = ""; // Database name
?>
