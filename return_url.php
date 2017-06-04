
<?php
/* *
 * 功能：服务器同通知页面
 */
require_once("lib/config.php");
require_once("lib/shanpayfunction.php");
require_once("lib/func.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link  href="images/style.css" rel="stylesheet" type="text/css" />
<title>雷击霹雳-订单系统</title>
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
      <td height="50"  colspan="3"class="td_title"><span class="title">雷击霹雳-订单系统</span></td>
    </tr>
    <tr>
      <td   height="50" colspan="3" class="td_border"> <font color="#FF0000">
<?php
//计算得出通知验证结果
$shanNotify = md5VerifyShan($_REQUEST['out_order_no'],$_REQUEST['total_fee'],$_REQUEST['trade_status'],$_REQUEST['sign'],$shan_config['key'],$shan_config['partner']);
if($shanNotify) {//验证成功
	if(check_input($_REQUEST['trade_status'])=='TRADE_SUCCESS'){
		    /*
			加入您的入库及判断代码;
			判断返回金额与实金额是否想同;
			判断订单当前状态;
			完成以上才视为支付成功
			*/
			//商户订单号
			$out_trade_no = check_input($_REQUEST['out_order_no']);
			//云通付交易号
			$trade_no = check_input($_REQUEST['trade_no']);
			//价格
			$price=check_input($_REQUEST['total_fee']);
			//var_dump($_REQUEST);
			echo orderinfo($out_trade_no, $trade_no, $price);

	}
}
else {
    //验证失败
    echo "验证失败";
}

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
function orderinfo($out_trade_no, $trade_no, $price){
	require_once("lib/dbconf.php");
	if (substr($out_trade_no, -5, 4) != "9999") {
		return "支付成功！您可以关闭此页面了。";
	}
	$type = substr($out_trade_no, -5, 5);

	try{
		$conn = new PDO("mysql:host=$host; dbname=$db_name", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
		//是否为早期订单
		$ordertime=time()-86399;
		$sql = "SELECT * FROM orders WHERE out_order_no='$out_trade_no' AND  pay_time<'$ordertime'";
		$stmt = $conn->query($sql);
		if ($stmt->rowCount() !=0){
			return "请勿刷新";
		}
		
		//是否为24小时内已有订单
		$ordertime=time()-86400;
		$sql = "SELECT * FROM orders WHERE out_order_no='$out_trade_no' AND pay_time>'$ordertime'";
		$stmt = $conn->query($sql);
		if ($stmt->rowCount() !=0){
			$row = $stmt->fetch();
			$uname = $row['uname'];
			$upwd = $row['upwd'];
			$uaddr = $row['uaddr'];

			return "PT盒子初始化中，请在5分钟后通过以上信息登录：<br />地址：". $uaddr. "   用户名：". $uname. "   密码：". $upwd ;
		}
		//判断库存量
		$sql = "SELECT * FROM members WHERE enable = 0 AND type='$type'";
		$stmt = $conn->query($sql);
		if ($stmt->rowCount() ==0){
			return "无库存，请联系退款";
		}

		//列出盒子信息
		$sql = "SELECT * FROM members WHERE enable = 0 AND type='$type' limit 1";
		$stmt = $conn->query($sql);
		$row = $stmt->fetch();
			$uname = $row['username'];
			$uaddr = $row['email'];
			$upwd= $row['password'];
			$init_fee = $row['init_fee'];
		if ($price != $init_fee) {
			return "支付金额错误！";
		}

		//激活服务
		$expire_time=time()+86400;
		$sql= "UPDATE members SET expire_time=:expire_time, enable=1 WHERE username=:username";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':username', $uname);
		$stmt->bindParam(':expire_time', $expire_time);
		$stmt->execute();

		//记录订单
		$sql = "INSERT INTO orders (total_fee, trade_no, out_order_no, uname, upwd, uaddr, pay_time) VALUES (?,?,?,?,?,?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(1, $price);
		$stmt->bindParam(2, $trade_no);
		$stmt->bindParam(3, $out_trade_no);
		$stmt->bindParam(4, $uname);
		$stmt->bindParam(5, $upwd);
		$stmt->bindParam(6, $uaddr);
		$stmt->bindParam(7, time());
		$stmt->execute();
		return "PT盒子初始化中，请在5分钟后通过以上信息登录：<br />*地址：".$uaddr. "   用户名：". $uname. "   密码：". $upwd;

	}
	catch (PDOException $e) {
		echo $e->getMessage();
	}

$conn=null;
}
?>


