<?php
/* *
 * 功能：服务器异步通知页面
 */
require_once("../dbconf.php");
require_once("../shanpayconfig.php");
require_once("lib/shanpayfunction.php");
require_once("func.php");
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
			//用户id
			$uname=substr($out_trade_no, -5,5);
			if (substr($out_trade_no, -5,4) == "9999"){exit("success");}
			try {
				$conn = new PDO("mysql:host=$host; dbname=$db_name", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//是否为老订单
				$sql = "SELECT * FROM orders WHERE out_order_no='$out_trade_no' ";
				$stmt = $conn->query($sql);
				if ($stmt->rowCount() != 0){exit ("fail");}
				//是否有此用户
				$sql = "SELECT * FROM members WHERE username='$uname'";
				$stmt = $conn->query($sql);
				if ($stmt->rowCount() ==0){exit ("fail");}
				//读取用户定价及帐户信息
				foreach ($stmt as $row) {
					$unitprice=$row['price'];
					$expire_time=$row['expire_time'];
				}
				//计算时间增值
				$moretime = $price*2592000/$unitprice;
				if ($expire_time >time()) {$expire_time = $expire_time+$moretime;}
				else {$expire_time = time()+$moretime;}
				//增加时间
				$sql= "UPDATE members SET expire_time=:expire_time, enable=1 WHERE username=:username";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':username', $uname);
				$stmt->bindParam(':expire_time', $expire_time);
				$stmt->execute();
				//记录订单
				$sql = "INSERT INTO orders (total_fee, trade_no, out_order_no, uname, pay_time) VALUES(?,?,?,?,?)";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(1, $price);
				$stmt->bindParam(2, $trade_no);
				$stmt->bindParam(3, $out_trade_no);
				$stmt->bindParam(4, $uname);
				$stmt->bindParam(5, time());
				$stmt->execute();

			}
			catch (PDOException $e) {
				echo $e->getMessage();
			}
			$conn = null;

		}
		echo 'success';

}else {
   //验证失败
    echo "fail";//请不要修改或删除
}

?>
