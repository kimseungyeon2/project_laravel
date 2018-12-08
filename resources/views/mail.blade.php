<?php
  $randomNum = mt_rand(0,10000);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1 style='color:red'>회원님</h1>
    <img src="'img/home_image.jpg'" alt="" witdh="200" height="200">
    <h2>인증번호는 : {{$randomNum}}</h2>
    <a href="">인증하로 가기</a>
  </body>
</html>
