<?php
require_once("lib/dbconf.php");

try{
	$conn = new PDO("mysql:host=$host; dbname=$db_name", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM members WHERE enable=0 AND  type='99991'";
	$stmt = $conn->query($sql);
	$stock99991 = $stmt->rowCount();
	$row = $stmt->fetch();
	$init_fee99991 = $row['init_fee'];
	$price_99991 = $row['price'];

	$sql = "SELECT * FROM members WHERE enable=0 AND  type='99992'";
	$stmt = $conn->query($sql);
	$stock99992 = $stmt->rowCount();
	$row = $stmt->fetch();
	$init_fee99992 = $row['init_fee'];
	$price_99992 = $row['price'];

	$sql = "SELECT * FROM members WHERE enable=0 AND  type='99993'";
	$stmt = $conn->query($sql);
	$stock99993 = $stmt->rowCount();
	$row = $stmt->fetch();
	$init_fee99993 = $row['init_fee'];
	$price_99993 = $row['price'];
	
	$sql = "SELECT * FROM members WHERE enable=0 AND  type='99994'";
	$stmt = $conn->query($sql);
	$stock99994 = $stmt->rowCount();
	$row = $stmt->fetch();
	$init_fee99994 = $row['init_fee'];
	$price_99994 = $row['price'];
	}
catch (PDOException $e) {
	echo $e->getMessage();
}
$conn=null;
?>

<?PHP
function checkstock($type){
	include("lib/dbconf.php");

	try{
		$conn = new PDO("mysql:host=$host; dbname=$db_name", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

		$sql = "SELECT * FROM members WHERE enable=0 AND  type='$type'";
		$stmt = $conn->query($sql);
		$instock = $stmt->rowCount();

	}
	catch (PDOException $e) {
		echo $e->getMessage();
	}
	$conn=null;
	return $instock;
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">


function postData(){
  var input = document.getElementById('userphone');
  var input_out_trade_no = document.getElementById('WID_no');
  var uinitfee = document.getElementById('initfee');

  var opt = document.getElementById('opt');
  if (opt.value == "") {
    alert("请选择型号");
    return false;
  }
  if ((input.value.length) < 5) {
    alert("输入的号码长度太短！");
    return false;
    }
  input_out_trade_no.value = checkstr(input.value);
  if (opt.value == "99991") { uinitfee.value = "<?PHP echo $init_fee99991; ?>"; return true; }
  if (opt.value == "99992") { uinitfee.value = "<?PHP echo $init_fee99992; ?>"; return true; }
  if (opt.value == "99993") { uinitfee.value = "<?PHP echo $init_fee99993; ?>"; return true; }
  if (opt.value == "99994") { uinitfee.value = "<?PHP echo $init_fee99994; ?>"; return true; }
  alert("未知错误");
  return false;
}

function checkstr(str){
  var opt = document.getElementById('opt');
  str ='00000000000'+str;
	str = str.substr(str.length-11);
	str = "SO"+String(Date.parse(new Date())/1000)+str+opt.value;
  return str;
}


function orderDetail(obj){
  var txt = document.getElementById('txt');
  var index = obj.selectedIndex;
  switch(index){
    case 1:
    txt.innerHTML="Online机房150M带宽，1T硬盘(可用800G），一次性安装费10元，续费<?PHP echo $init_fee99991; ?>元/30天";
    break;

    case 2:
    txt.innerHTML="Online机房G口，2T硬盘，一次性安装费10元，续费<?PHP echo $init_fee99992; ?>元/30天";
    break;

    case 3:
    txt.innerHTML="OVH机房100M带宽，2T硬盘，一次性安装费10元，续费200元/30天";
    break;

    case 4:
    txt.innerHTML="Online机房200M带宽，100G硬盘，一次性安装费10元，续费200元/30天";
    break;

    default:
    txt.innerHTML="请选择盒子型号";
  }
}

        var system = {
            win: false,
            mac: false,
            xll: false,
            ipad:false
        };
        //检测平台
        var p = navigator.platform;
        system.win = p.indexOf("Win") == 0;
        system.mac = p.indexOf("Mac") == 0;
        system.x11 = (p == "X11") || (p.indexOf("Linux") == 0);
        system.ipad = (navigator.userAgent.match(/iPad/i) != null)?true:false;
        //跳转语句，如果是手机访问就自动跳转到wap.baidu.com页面
        if (system.win || system.mac || system.xll||system.ipad) {

        } else {

            window.location.href = "./mobile.php";
        }	
	
	
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link  href="images/style.css" rel="stylesheet" type="text/css" />
<title>雷击霹雳-订单系统</title>
</head><body style="background:#F3F3F4">
<br />
<br />

<table border="0" cellpadding="0" cellspacing="0" class="tb_style">
  <form action="shanpay.php" method="post" name="shanpayment" target="_blank" id="shanpayment">
    <tr>
      <td width="210"   height="50"  class="td_border"><a href="http://www.lazypt.net"><img src="images/logo.png" border="0"></a></td>
      <td width="412"  class="td_border">&nbsp;</td>
      <td width="178"  class="td_border"><strong><a href="http://www.lazypt.net/pay/get_back.php">过往订单查询</a></strong></td>
    </tr>
  </form>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tb_style">
  <form name="shanpayment" action="shanpay.php" method="post" target="_blank" >
    <tr>
      <td height="50"  colspan="3" class="td_title"><span class="title">雷击霹雳-订单系统</span></td>
    </tr>
    <tr>
	    <td   height="50" colspan="3"  class="td_border"><font color="#FF0000">* </font>
		    购买须知:<br />
		    1.选购本站的PT盒子，需支付两部分费用：安装费和月租。<br />
		    &nbsp;&nbsp;a)安装费在开启每个新PT盒子前收取，续费时无需再缴纳。<br />
		    &nbsp;&nbsp;b)月租可在服务期内任意时间续期，增加服务时长。<br /><br />
		    2.本页面支付的是安装费，支付完成后将获得PT盒子的管理地址和帐户密码，并获得24小时服务时长。<br /><br />
		    3.开通服务后请在24小时内登录管理界面进行续费，否则到期后盒子将被自动回收，并删除用户数据。<br /><br />
		    4.鉴于PT盒子的特性，本站服务不对数据安全负责，请勿存放重要数据。<br />
		    
		      
		    
		    
	    
	    
	    
	    </td>
    </tr>
    <tr>
      <td   height="50"  class="td_border"><font color="#FF0000">* </font>选择商品：</td>
      <td   class="td_border">
        <select onchange="orderDetail(this)" id="opt">
        <option value ="">--请选择--</option>
        <option <?PHP if ($stock99991 == 0){echo 'disabled="disabled"';} ?> value ="99991">PT盒子-型号1  库存<?php echo $stock99991 ?>个  </option>
        <option <?PHP if ($stock99992 == 0){echo 'disabled="disabled"';} ?> value ="99992">PT盒子-型号2  库存<?php echo $stock99992 ?>个 </option>
        <option <?PHP if ($stock99993 == 0){echo 'disabled="disabled"';} ?> value ="99993">PT盒子-型号3  库存<?php echo $stock99993 ?>个 </option>
        <option <?PHP if ($stock99994 == 0){echo 'disabled="disabled"';} ?> value ="99994">PT盒子-型号4  库存<?php echo $stock99994 ?>个 </option>
        </select>

      </td>
      <td   height="50"  class="td_border"><font color="#FF0000">* </font><span id="txt">请选择盒子型号</span></td>
    </tr>

    <tr>
      <td   height="50"  class="td_border"><font color="#FF0000">* </font>请输入手机号或QQ号：</td>
      <td colspan="2"  class="td_border"><input id="userphone" name="phone_no" type="text" value="" maxlength="11"  size="35" onkeyup="value=value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g, ''))"  />        
        <font color="#FF0000">* 必填</font> &nbsp;&nbsp;&nbsp;作为购买凭证</td>
    </tr>
    <tr>
      <td   height="50" colspan="3" class="td_border"><font color="#FF0000">* 请在电脑上操作，付款后请勿关闭页面，将自动跳转到商品信息页面。</font></td>
    </tr>
    <tr>
      <td   height="50"  class="td_border">&nbsp;</td>
      <td  class="td_border">
	  <input id="WID_no" name="WIDout_trade_no" type="hidden" value="000000000000" size="35"  />
	  <input  name="WIDsubject" type="hidden" value="order1" size="35" />
	  <input id="initfee" name="WIDtotal_fee" type="hidden" value="0.1" size="35" />
	  <input name="WIDbody" type="hidden" value="收银" size="35" />
	  <input onclick="return postData()" type="submit" name="Submit" value="立即下单" class="btn_save" id="addnew"/>
      &nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td  class="td_border">&nbsp;</td>
    </tr>
  </form>
</table>

<div class="bottom">
 Powered BY <a href="http://www.lazypt.net" target="_blank">雷击霹雳</a>
 &copy; 2015-2017&nbsp;&nbsp;<a href="http://www.lazypt.net" target="_blank">LazyPT Inc.</a>
  
</div>
</body>
</html>
