<?php
//导入文件
require_once '../comm/comm.php';
// 销毁session文件
session_destroy();
// 跳转到首页
header("location:../index.php");
?>