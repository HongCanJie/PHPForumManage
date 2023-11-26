<?php
//导入文件
require_once 'comm.php';

// 1.新增帖子记录
function addTopic($title,$content,$uId,$boardId){
    $insertStr="insert into tbl_topic(title,content,publishTime,modifyTime,uId,boardId) value";
    //     获取系统时间（字符型）
    $format="%Y-%m-%d %H:%M:%S";
    $publishTime=strftime($format);
    $modifyTime=$publishTime;
    $insertStr.="('$title','$content','$publishTime','$modifyTime','$uId','$boardId')";
    $rs=execUpdate($insertStr);//执行插入操作
    return $rs;
}

// 执行新增帖子操作显示受影响行数
// var_dump(addTopic("国王与乞丐","抱紧你的我~比国王富有。曾多么快乐。","5", "2"));


// 2.修改帖子内容
function updateTopic($topicId,$title,$content){
    //     获取系统时间（字符型）
    $format="%Y-%m-%d %H:%M:%S";
    $modifyTime=strftime($format);
    $publishTime=$modifyTime;
    $updateStr="update tbl_topic set content='$content',publishTime='$publishTime',modifyTime='$modifyTime' where topicId='$topicId' and title='$title' ";
    $rs=execUpdate($updateStr);// 执行更新操作
    return "有".$rs."行受到影响。";
}


// 执行修改操作显示受影响的行数
// var_dump(updateTopic('3', '逃与追', 'hahahahahaha'))
   
// 3.删除帖子内容
function deleteTopic($topicId){
    $deleteStr="delete from tbl_topic where topicId='$topicId'";
    $rs=execUpdate($deleteStr);//执行删除操作
    return "有".$rs."行受到影响。";
}

// 删除操作显示受影响的行数
// var_dump(deleteTopic('6'));

// 4.根据编号查询帖子详情信息
function findTopicById($topicId){
    $strQuery="select * from tbl_topic join tbl_user on tbl_topic.uId=tbl_user.uId where topicId='$topicId'";
    $rs=execQuery($strQuery);
    if(count($rs)>0){
        return $rs[0];
    }else{
        return "查询无结果";
    }
}

// 显示根据帖子编号查询的帖子信息
// var_dump(findTopicById('4'));


// 5.统计指定版块发表的帖子的总数
function findCountTopic($boardId){
    $strQuery="select * from tbl_topic where boardId='$boardId'";
    $rs=execQuery($strQuery);
    return count($rs);
}

// 显示帖子数
// var_dump(findCountTopic('1'));


// 6.取指定版块最新帖子信息
function findLastTopic($boardId){
    $strQuery="select * from tbl_topic join tbl_user on tbl_topic.uId=tbl_user.uId where boardId='$boardId' order by publishTime desc limit 0,1";
    $rs=execQuery($strQuery);
    if(count($rs)>0){
        return $rs[0];
    }
    return $rs;
}

// 显示最新的帖子信息
// var_dump(findLastTopic(2));



// 7.分页获取指定模板的帖子列表信息
function findListTopic($page,$boardId){
//     获取页面条目数
    $pageSize=$GLOBALS ["cfg"]["server"]["page_size"];
    if($page>=1){
        $page--;
    }
//     计算当前条目位置
    $page*=$pageSize;
    $strQuery="select * from tbl_topic,tbl_user where tbl_topic.uId=tbl_user.uId and boardId='$boardId'order by publishTime desc limit $page,$pageSize";
    $rs=execQuery($strQuery);
    if(count($rs)>0){
        return $rs;
    }else{
        return "查无信息";
    }
}

// 分页显示信息
// var_dump(findListTopic(1, '1'));

















?>