<?php
// 导入文件
require_once 'comm.php';

// 1.根据版块编号取版块信息
function findBoard($boardId){
    $strQuery="select * from tbl_board where boardId='$boardId'";
    $rs=execQuery($strQuery);
    if(count($rs)>0){
        return $rs[0];
    }else{
        return "查询不到此编号信息";
    }
    return $rs;
}

// 显示根据版块编号查询出来的信息
// var_dump(findBoard('2'));


// 2.根据父版块编号取子版块信息
function findListBoard($parentId){
    $strQuery="select * from tbl_board where parentId='$parentId'";
    $rs=execQuery($strQuery);
    if(count($rs)>0){
        return $rs;
    }else{
        return "查询不到此编号信息";
    }
}

// 显示根据父版块编号查询出来的信息
// var_dump(findListBoard('1'));


?>
