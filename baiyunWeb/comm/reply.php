<?php
//导入文件
require_once 'comm.php';

// 1.发表回帖记录
function addReply($replyTitle,$replyContent,$topicId,$uId){
    $insertStr="insert into tbl_reply(replyTitle,replyContent,replyPublishTime,replyModifyTime,topicId,uId) value";
    //     获取系统时间（字符型）
    $format="%Y-%m-%d %H:%M:%S";
    $replyPublishTime=strftime($format);
    $replyModifyTime=$replyPublishTime;
    $insertStr.="('$replyTitle','$replyContent','$replyPublishTime','$replyModifyTime','$topicId','$uId')";
    $rs=execUpdate($insertStr);//执行插入操作
    return $rs;
}

// 显示插入操作受影响的行数
// var_dump(addReply('世间美好与你环环相扣', '偏偏秉烛夜游，午夜星辰似奔走之友', '2', '3'));


// 2.修改回帖内容
function updateReply($replyId,$replyTitle,$replyContent){
    //     获取系统时间（字符型）
    $format="%Y-%m-%d %H:%M:%S";
    $replyModifyTime=strftime($format);
    $replyPublishTime=$replyModifyTime;
    $updateStr="update tbl_reply set replyTitle='$replyTitle',replycontent='$replyContent',replyPublishTime='$replyPublishTime',replyModifyTime='$replyModifyTime' where replyId='$replyId' ";
    $rs=execUpdate($updateStr);// 执行更新操作
    return $rs;
}

// 显示受影响的行数
// var_dump(updateReply('9', '离人愁', '今夜断了肠，今天各一方'));



// 3.删除帖子记录
function deleteReply($replyId){
    $updateStr="delete from tbl_reply where replyId='$replyId'";
    $rs=execUpdate($updateStr);// 执行更新操作
    return $rs;
}


// 显示受影响的行数
// var_dump(deleteReply('4'));


// 4.根据回帖编号查询回帖详情
function findReplyById($replyId){
    $strQuery="select * from tbl_reply where replyId='$replyId'";
    $rs=execQuery($strQuery);
//     判断数组中是否有值
    if(count($rs)>0){
        return $rs;
    }
}


// 显示根据编号查询的回帖结果
// var_dump(findReplyById('1'));


// 5.统计指定帖子的回帖数量
function findCountReply($topicId){
    $strQuery="select * from tbl_reply where topicId='$topicId'";
    $rs=execQuery($strQuery);
    return count($rs);
}

// 显示帖子数
// var_dump(findCountReply('1'));


// 6.分页获取指定帖子的回帖表信息
function findListReply($page,$topicId){
    //     获取页面条目数
    $pageSize=$GLOBALS ["cfg"]["server"]["page_size"];
    //     计算当前条目位置
    $page=($page-1)*$pageSize;
    $strQuery="select * from tbl_reply join tbl_user on tbl_reply.uId=tbl_user.uId where topicId='$topicId' order by replyPublishTime desc limit $page,$pageSize";
    $rs=execQuery($strQuery);
    if(count($rs)>0){
        return $rs;
    }else{
        return "查无信息";
    }
}

// 显示分页的回帖信息
// var_dump(findListReply(1, '1'));



// 查询回帖表全部内容
function findReply(){
    $strQuery="select * from tbl_reply";
    $rs=execQuery($strQuery);
    //     判断数组中是否有值
    if(count($rs)>0){
        return $rs;
    }else{
        return "查询无结果";
    }
}




?>