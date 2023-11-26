<?php
function testError($errno,$errstr){
    //使用header函数将错误信息转发到显示页面
    die(header("location:./error.php?msg=$errstr"));
}
// 数据库服务器的配置参数(二维数组)
$cfg["server"]["adds"]="localhost";
$cfg["server"]["db_user"]="root";
$cfg["server"]["db_psw"]="";
$cfg["server"]["db_name"]="baiyun";
$cfg["server"]["db_port"]="3306";
$cfg["server"]["page_size"]=3;
// 设置错误捕获器
set_error_handler("testError",E_ERROR);
?>