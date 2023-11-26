<html>
<head>
<title>欢迎来到论坛管理系统</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="style/style.css"/>
<?php 
require_once './comm/board.php';
require_once './comm/topic.php';
require_once './comm/user.php';
?>
</head>
<body>
<!-- 显示论坛头部 -->
<?php 
echo do_html_head();
?>
<!-- 项目主体 -->
<div class="t">
<!-- 单元表 -->
<!-- 注：cellspacing代表这单元格之间的距离；cellpadding代表表格内边距 -->
<table cellspacing="0" cellpadding="0" width="100%">
<!-- 注：tr是行标记；td是单元格标记;colspan是所占单元格个数 -->
<tr class="tr2" align="center">
<td colspan="2">论坛</td>
<td style="width: 10%">主题</td>
<td style="width: 30%">最后发表</td>
</tr>
<!-- 主版块内容 -->
<?php 
// 获取板块信息
$boards=findListBoard(0);
$table_html="";
// var_dump($boards);
// 一重遍历
for ($i=0;$i<count($boards);$i++){
//     获取版块名
$boardName=$boards[$i]["boardName"];
$table_html.=<<<HTML_TABLE
<tr class="tr3">
<td colspan="4">
$boardName
</td>
</tr>
HTML_TABLE;
// 获取上一级版块ID
$sonId=$boards[$i]["boardId"];
// 在获取下一级版块信息,放在数组中
$sonBoards=findListBoard($sonId);
// var_dump($sonBoards);
// 二重遍历
for ($j=0;$j<count($sonBoards);$j++){
// 获取子版块名
$boardName=$sonBoards[$j]["boardName"];
// 获取版块id
$boardId=$sonBoards[$j]["boardId"];
// 获取子版块贴子数
$count=findCountTopic($boardId);
// 获取最新的帖子信息
$topic=findLastTopic($boardId);
// 获取发帖人姓名
$user_name=$topic["uName"];
// 获取帖子发布时间
$publishTime=$topic["publishTime"];
// 获取帖子标题
$title=$topic["title"];
// 获取帖子id
$topicId=$topic["topicId"];
// var_dump($topic);
// 显示表格信息
$table_html.=<<<HTML_TABLE
<tr class="tr3">
<td width="5%">
&nbsp;
</td>
<th align="left">
<img src="./image/board.gif" width=60px height=60px>
<a href="list.php?boardId=$boardId&currentPage=0">$boardName
</a>
</th>
<td align="center">$count</td>
<!-- span是单行可重叠标签 -->
<th>
<span><A href="detail.php?boardId=$boardId&currentPage=0&currentReplyPage=1&topicId=$topicId">$title</A></span>
<br/>
<span>$user_name</span>
<span class="gray"><$publishTime></span>
</th>
</tr>
HTML_TABLE;
}
}
echo $table_html;
?>
</table>
</div>
<br/>
<?php 
echo do_html_footer();
?>
</body>
</html>