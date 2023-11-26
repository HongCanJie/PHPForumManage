<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>示例3.1.26</title>
    </head>
    <body>
        <?php
        /*
        * 建立与数据库的连接
        */
        function get_Connect() {
           //创建与数据库的连接
            $connection = mysqli_connect("localhost","root","","baiyun",3306) or die("连接创建错误！");
          //选择数据库
            mysqli_select_db($connection,"baiyun") or die("无法选择数据库！");
            return $connection;
        }
        /*
         * 获取所有用户信息
         */
        function getUsers(){
            $conn = get_Connect();//创建与数据库的连接
            $query = "select * from tbl_user";//查询语句
            $result = array();//定义查询结果
            $rs = mysqli_query($conn,$query) or  die("查询错误！");//执行查询
             for ($i=0;$i<mysqli_num_rows($rs);$i++) {//循环读取查询结果集
                 $result[$i] = mysqli_fetch_assoc($rs);//从结果集中读取一行记录，保存到数组中
             }
             mysqli_free_result($rs);//释放结果集
             mysqli_close($conn);//关闭连接
             return $result;//返回查询结果
        }
        $result = getUsers();//读取用户信息
        //输出数组的信息
//         var_dump($result);
        ?>
        <h2 align="center">用户列表</h2>
        <table border="1" cellpadding="0" cellspacing="0" align="center">
            <tr height="30px">
                <td width="10%">序号</td>
                <td width="10%">姓名</td>
                <td width="20%">账号</td>
                <td width="20%">头像</td>
                <td width="30%">注册时间</td>
                <td width="10%">性别</td>
            </tr>
            <?php
              //$bgcolor = "#ffffff";
              foreach($result as $rec){//显示查询到的各行记录
                  /* if($bgcolor=="#ffffff"){
                      $bgcolor = "#dddddd";
                  }else{
                      $bgcolor = "#ffffff";
                  } */
                  echo "<tr  height=27>";
                  echo "<td>". $rec["uId"]."</td>";
                  echo "<td>". $rec["uName"]."</td>";
                  echo "<td>". $rec["uPass"]."</td>";
                  echo "<td>". $rec["head"]."</td>";
                  echo "<td>". $rec["regTime"]."</td>";
                  echo "<td>". ($rec["gender"]==1?"男":"女")."</td>";
                  echo "</tr>";
              }
            ?>
        </table>
    </body>
 </html>
