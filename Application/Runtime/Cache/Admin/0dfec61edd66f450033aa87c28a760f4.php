<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login/Logout animation concept</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
        <link rel="stylesheet" href="/Public/css/style.css">
  </head>
  <body>
    <div class="cont">
  <div class="demo">
    <div class="login">
      <div style="font-size: 45px;padding-top: 20px;padding-left: 50px;color:#1b62b8;">实训管理系统</div>
      <div class="login__form">
        <form action="/Admin/Login/login" method="post">
        <div class="login__row">
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input type="text" name="admin_name" class="login__input name" placeholder="请输入账号"/>
        </div>
        <div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="password" name="admin_password" class="login__input pass" placeholder="请输入密码"/>
        </div>
        <input type="submit" class="login__submit" value="登录">
        </form>
        <p class="login__signup">没有账号吗？ &nbsp;<a>注册</a></p>
      </div>
    </div>
  </div>
</div>
    <script src='/Public/js/loginindex.js'></script>
    <script src='/Public/js/jquery.js'></script>
  </body>
</html>