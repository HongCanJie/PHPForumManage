<html>
	<head>
		<title>发布帖子</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style/style.css"/>
		
		<script charset="utf-8" src="kindeditor/kindeditor.js"></script>
		<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
		<script type="text/javascript">
// 		初始化文件编辑器
		var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="content"]');
          }); 
// 		表单域校验
		function valid() {
// 			判断标题是否有值
			if(document.postForm.title.value==""){
// 				弹窗提示
				alert("标题不能为空");
				return false;
			}
// 			获取编辑框中的值
			content=editor.html();
			if(content==""){
				alert("内容不能为空");
				return false;
			}
// 			编辑框中的长度不超过1000
			if(content.length>1000){
				alert("长度不能大于1000");
			}
		}

// 		初始化函数，判断发表的是新帖还是回帖
		function init() {
// 			判断是否为回复
			if(document.postForm.topicId.value!=""){
// 				设置为回帖操作
// 				设置表单请求
				document.postForm.action="manage/doReply.php";
			}
		}
		</script>
		<?php 
// 		引入文件
		require_once './comm/board.php';
		require_once './comm/topic.php';
// 		定义版块名称
		$boardName="";
// 		定义版块编号
        $boardId="";
// 		获取帖子编号
        $topicId=empty($_GET["topicId"])?"":$_GET["topicId"];
//      获取当前页码
		$currentPage=empty($_GET["currentPage"])?0:$_GET["currentPage"];
// 		判断版块编号是否存在
        if(!empty($_GET["boardId"])){
            $boardId=$_GET["boardId"];
        }else {
            $msg="版块编号不存在！";
//             转入出错页面
            die(header("location:../error.php?msg=$msg"));
        }
        $board=findBoard($boardId);
        $boardName=$board["boardName"];
		?>
	</head>
	<body onload="init()">
        <!-- 页面头部 -->
		<div>
		<?php  echo do_html_head();?>
		</div>
        <!--主体 -->
        <div>
        <br/>
        <!--导航 -->
        <div>
        <?php 
//      设置导航标语
        $html_str=<<<HTML_STR
        &gt;&gt;
        <b><a href="index.php">论坛首页</a></b>&gt;&gt;
        <b><a href="list.php?boardId=$boardId&currentPage=0">$boardName</a></b>
HTML_STR;
        echo $html_str;
        ?>        
        </div>
        <br/>
        <div>
        <?php 
        $tmp="发表新帖";
//         判断是否为回贴
        if($topicId!=""){
            $topic=findTopicById($topicId);
            $tmp=$topic["title"];
            $tmp="回复:".$tmp;
        }       
        $html_str=<<<HTML_STR
        <form name="postForm" onsubmit="return valid()" action="manage/doPost.php" method="post">
            <!--隐藏域用来传递数据 -->
            <input type="hidden" name="boardId" value="$boardId" />
            <input type="hidden" name="topicId" value="$topicId"/>
            <input type="hidden" name="currentPage" value="$currentPage"/>
            <div class="t">
                <table cellSpacing="0" cellPadding="0" align="center">
                    <tr>
                        <td width="10%" class="h" colSpan="3">
                            <b>$tmp</b>
                        </td>
                    </tr>
                    <tr class="tr3">
                        <th width="10%">
                            <b>标题</b>
                        </th>
                        <th>
                            <input class="input" type="text" size="105" name="title"/>
                        </th>
                    </tr>
                    <tr class="tr3">
                        <th vAlign=top>
                            <div>
                                <b>内容</b>
                            </div>
                        </th>
                    <th colSpan=2>
                        <div>
                            <span><textarea id="content" name="content" style="width:900px;height:400px;visibility:hidden;"></textarea></span>
                        </div>
                    (不能大于：<font color="blue">1000</font>字)
                    </th>
                    </tr>
                </table>
            </div>
            <div style="margin:15px 0px; text-align:center">
                <input class="btn" tabIndex="3" type="submit" value="提交">
                <input class="btn" tabIndex="4" type="reset" value="重置">
            </div>
        </form>
HTML_STR;
        echo $html_str;     
        ?>        
        </div>
        </div>
        <!--页面尾部 -->
        <br/>
        <?php echo do_html_footer();?>
	</body>
</html>