<?php 
  $conn = new mysqli("localhost","root","", "wp2023");//MySQLサーバへ接続
  // $conn = new mysqli("localhost", "k20rs097", "ksu/2023", "wdb23k20rs097");
  if ($conn->connect_errno) die($conn->connect_error);
  $conn->set_charset('utf8'); //文字コードをutf8に設定（文字化け対策）
?>