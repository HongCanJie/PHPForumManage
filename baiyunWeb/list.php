<!-- 版块页面 -->
<html>
	<head>
	<title>帖子列表</title>
	<meta http-equiv=Content-Type content="text/html;charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style/style.css"/>
	<?php 
	require_once './comm/board.php';
	require_once './comm/topic.php';
	require_once './comm/reply.php';
	?>
	</head>
<body>
<!-- 显示头部信息 -->
<?php  echo do_html_head();?>
<!-- 主体 -->
<div>
<br/>
</div>
<div>
<?php 
// 获取版块编号
$boardId=$_GET["boardId"];
// echo $_GET["boardId"];
// 定义现在是第几页
$currentPage=$_GET["currentPage"];
// echo $_GET["currentPage"];
// 定义版块名称
$boardName="";
// 定义版块信息
$curBoard=array();
// 出错信息
$msg="";
// 判断版块参数是否存在
if ($boardId!=""){
//     查询版块信息
    $curBoard=findBoard($boardId);
//     判断版块中是否有信息
    if(count($curBoard)>=0){
        $boardName=$curBoard["boardName"];
    }else {
        $msg="版块信息不存在！";
    }
}else {
    $msg="版块编号不存在！";
}
// 发送错误信息
if($msg!=""){
    header("location:../error.php?msg=$msg");
}
// 分页取出指定版块的信息
$topicList=findListTopic($currentPage,$boardId);
// 统计版块帖子数
$topicNums=findCountTopic($boardId);
// 页面帖子容量
$pageSize=$GLOBALS["cfg"]["server"]["page_size"];
// 计算总页数
$pages=ceil($topicNums/$pageSize);

$explor=<<<HTML_STR
&gt;&gt;<B><a href="index.php">论坛首页</a></B>&gt;&gt;
<B><a href="list.php?boardId=$boardId&currentPage=0">$boardName</a></B>
HTML_STR;
echo $explor;
?>
</div>
<br/>
<!-- 发表新帖 -->
<div>
<a href="./post.php?boardId=<?php echo $boardId?>">
	<img src="./image/post1.gif" name="id_post" border="0" id="td_post" width="2%" height="4%" title="发表话题"></a>
</div>
<p></p>
<div class="t">
<table cellspacing="0" cellpadding="0" width="100%">
<!-- 表头 -->
<tr class="tr2">
<td>
&nbsp;
</td>
<td style="width: 80%" align="center">
文章
</td>
<td style="width: 10%" align="center">
作者
</td>
<td style="width: 10%" align="center">
回复
</td>
</tr>
<!-- 主题 -->
<?php 
$html_topic="";
// 遍历帖子记录
foreach ($topicList as $topic){
    $topicId=$topic["topicId"];
    $topicTitle=$topic["title"];
    $userName=$topic["uName"];
    $replyCount=findCountReply($topicId);
//     帖子表信息
    $html_topic.=<<<HTML_TABLE
    <tr class="tr3">
    <td>
    <img src="./image/topic1.gif" border=0  width=40px height=40px>
    </td>
    <td style="FONT_SIZE:15px">
        <A href="detail.php?boardId=$boardId&currentPage=$currentPage&currentReplyPage=1&topicId=$topicId">$topicTitle</A>
    </td>
    <td align="center">
    $userName
    </td>
    <td align="center">
    $replyCount
    </td>
    </tr>
HTML_TABLE;
 }
    
echo $html_topic;

?>
</table>
</div>

<div>
 <?php 
// 上一页
$page_previous=($currentPage<=1)?1:$currentPage-1;
// 下一页
$page_next=($currentPage>=$pages)?$pages:$currentPage+1;
// 如果没有查询到记录，直接显示一页
$page_next=($currentPage==0)?1:$page_next;

// 超链接跳转
$navigator="<a href='list.php?boardId=$boardId&currentPage=$page_previous'>上一页</a>|";

// 显示页码
for ($i=0;$i<$pages;$i++){
    $j=$i+1;
    $navigator.="<a href='list.php?boardId=$boardId&currentPage=$j'>$j</a>";
}
$navigator.="<a href='list.php?boardId=$boardId&currentPage=$page_next'>下一页</a><br/>";
$navigator.="共".$topicNums."条记录，共".$pages."页,当前是第".$currentPage."页";
echo $navigator;

?>
</div>
<br/>
<?php  echo do_html_footer()?>
</body>	
</html>