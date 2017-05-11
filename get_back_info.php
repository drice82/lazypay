
<?php
/* *
 * 功能：服务器同通知页面
 */
require_once("lib/config.php");
require_once("lib/dbconf.php");
require_once("lib/shanpayfunction.php");
require_once("lib/func.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link  href="images/style.css" rel="stylesheet" type="text/css" />
<title>雷击霹雳</title>
</head><body style="background:#F3F3F4">
<br />
<br />

<table border="0" cellpadding="0" cellspacing="0" class="tb_style">

    <tr>
      <td width="210"   height="50"  class="td_border"><a href="http://www.lazypt.net"><img src="images/logo.png" border="0"></a></td>
      <td width="412"  class="td_border">&nbsp;</td>
      <td width="178"  class="td_border"><strong><a href="http://www.lazypt.net">官方网站</a></strong></td>
    </tr>

</table>
<table border="0" cellpadding="0" cellspacing="0" class="tb_style">

    <tr>
      <td height="50"  colspan="3"class="td_title"><span class="title">订单系统-找回订单信息</span></td>
    </tr>
    <tr>
      <td   height="50" colspan="3" class="td_border"> <font color="#FF0000">
<?php
	echo orderinfo(check_input($_REQUEST['get_back_no']));
?>

</font>
  </td>
    </tr>

    <tr>
      <td   height="50"  class="td_border">&nbsp;</td>
      <td  class="td_border">      &nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td  class="td_border">&nbsp;</td>
    </tr>

</table>

<div class="bottom">
 Powered BY <a href="http://www.lazypt.net" target="_blank">雷击霹雳</a>
 &copy; 2015-2017&nbsp;&nbsp;<a href="http://www.lazypt.net" target="_blank">LazyPT Inc.</a>
  
</div>
</body>
</html>

<?php
function orderinfo($out_trade_no){
	include("lib/dbconf.php");

	try{
		$conn = new PDO("mysql:host=$host; dbname=$db_name", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
		
		//是否为24小时内已有订单
		$ordertime=time()-86400;
		$sql = "SELECT * FROM orders WHERE out_order_no LIKE '%$out_trade_no' AND pay_time>'$ordertime'";
		$stmt = $conn->query($sql);
		if ($stmt->rowCount() !=0){
			$row = $stmt->fetch();
			$uname = $row['uname'];
			$upwd = $row['upwd'];
			$uaddr = $row['uaddr'];

			return "地址：". $uaddr. "   用户名：". $uname. "   密码：". $upwd;
		}
		else {
			return "无记录，或订单时间超过24小时，请联系客服。";
	
		}

	}
	catch (PDOException $e) {
		echo $e->getMessage();
	}

$conn=null;
}
?>


