<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>回帖测试</title>
    </head>
<body>
<?php 
// 导入文件
require_once 'reply.php';

// 1.发表回帖记录
// addReply('世间美好与你环环相扣', '偏偏秉烛夜游，午夜星辰似奔走之友', '2', '3');

// 2.修改回帖内容
// updateReply('9', '离人愁', '今夜断了肠，今天各一方');

// 3.删除帖子记录
// deleteReply('4');

// 4.根据回帖编号查询回帖详情
// $result=findReplyById('1');

// 5.统计指定帖子的回帖数量
// echo findCountReply('1');

// 6.分页获取指定帖子的回帖表信息
// $result=findListReply(1, '1');

// 查询回贴表的所有信息
// $result=findReply();


?>
<!-- 标题 -->
<h2 align="center">回帖表</h2>
<!-- 表格属性 -->
<table border="1"cellpadding="0" cellspacing="0" align="center">
<tr height="30px">
<td width="10%">回帖编号</td>
<td width="10%">回帖标题</td>
<td width="20%">回帖内容</td>
<td width="20%">回帖时间</td>
<td width="20%">回帖修改时间</td>
<td width="10%">帖子编号</td>
<td width="10%">用户编号</td>
</tr>

<?php 
// // 循环遍历数组
// foreach ($result as $rec){
//     echo"<tr height=27>";
//     echo"<td>".$rec["replyId"]."</td>";
//     echo"<td>".$rec["replyTitle"]."</td>";
//     echo"<td>".$rec["replyContent"]."</td>";
//     echo"<td>".$rec["replyPublishTime"]."</td>";
//     echo"<td>".$rec["replyModifyTime"]."</td>";
//     echo"<td>".$rec["topicId"]."</td>";
//     echo"<td>".$rec["uId"]."</td>";
//     echo"</tr>";
// }
?>
</table>
</body>

</html>