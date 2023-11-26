<?php
require_once 'comm.php';
//1.根据用户名查询用户信息
function findUser(string $name){
    $strQuery="select * from tbl_user where uName='$name'";
    $rs=execQuery($strQuery);
    if(count($rs)>0){
        return $rs[0];
    }else{
        return "查无此人";
    }
    return $rs;
}

// 显示根据用户名查询的用户信息
// var_dump(findUser("小明"));

// 2.根据用户编号查询用户信息
function findUserById(int $Id){
    $strQuery="select * from tbl_user where uId='$Id'";
    $rs=execQuery($strQuery);
    if(count($rs)>0){
        return $rs[0];
    }
    return $rs;
}

// 显示根据用户编号查询的用户信息
// var_dump(findUserById(1));

// 3.注册新用户
function addUser($uName,$uPass,$head,$gender){
    $insertStr="insert into tbl_user(uName,uPass,head,regTime,gender) value";
//     获取系统时间（字符型）
    $format="%Y-%m-%d %H:%M:%S";
    $regTime=strftime($format);
    $insertStr.="('$uName','$uPass','$head','$regTime','$gender')";
    $rs=execUpdate($insertStr);//执行插入操作
    return $rs;
}

// 插入操作显示受影响的行数
// var_dump(addUser("小高","123456", "8.jpg", 1));

// 3.修改用户信息
function updateUser($uId,$uName,$uPass,$head,$gender){
    //     获取系统时间（字符型）
    $format="%Y-%m-%d %H:%M:%S";
    $regTime=strftime($format);
    if($uPass!=""){
    $updateStr="update tbl_user set uName='$uName',uPass='$uPass',head='$head',regTime='$regTime',gender='$gender' where uId='$uId' ";
    }else{
    $updateStr="update tbl_user set uName='$uName',head='$head',regTime='$regTime',gender='$gender' where uId='$uId' ";
    }
    $rs=execUpdate($updateStr);// 执行更新操作
    return $rs;
}

// 更新操作显示受影响的行数
// var_dump(updateUser('8', '小亮', '123', '8.jpg', 1));

// 4.删除用户信息
function deleteUser($uName){
    $deleteStr="delete from tbl_user where uName='$uName'";
    $rs=execUpdate($deleteStr);//执行删除操作
    return "有".$rs."行受到影响。";
}


// 删除操作显示受影响的行数
// var_dump(deleteUser('小亮'));

?>