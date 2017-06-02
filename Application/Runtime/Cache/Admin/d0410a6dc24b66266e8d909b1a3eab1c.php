<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="__PUBLIC__/admin/css/style.css" />
    <link rel="stylesheet" href="__PUBLIC__/admin/css/animation.css" />
    <link rel="stylesheet" href="__PUBLIC__/admin/css/login.css">
    <script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
    <title></title>
</head>

<body class="log-body">
<section class="m-login-bg">
    <div class="m-login">
        <form action="__URL__/checkLogin" method="post" >

        <h1>
            用户登录
        </h1>
        <div class="m-login-input">
            <ul>
                <li>
                    <input type="text" name='username'  placeholder="账号" />
                    <i class="bdspfont">&#xe62a;</i>
                </li>
                <li class="m-login-password">
                    <input type="password" name='userpwd' placeholder="密码" />
                    <i class="bdspfont">&#xe618;</i>
                </li>
            </ul>
        </div>
        <div class="m-login-button">
            <button type="submit" class="ui-transition3">登录</button>
        </div>
        </form>
    </div>
</section>
</body>

</html>