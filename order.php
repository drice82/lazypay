<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">

function dont(){
	var input = document.getElementById('userphone');
	if ((input.value.length) < 5) {
		alert("长度太短！")
		return false;
		}
	return true;
	}

function postData(){
var input = document.getElementById('userphone');
var input_out_trade_no = document.getElementById('WID_no');
input_out_trade_no.value = checkstr(input.value);
}

function checkstr(str){
    str ='00000000000'+str;
	str = str.substr(str.length-11);
	str = "SO"+String(Date.parse(new Date())/1000)+str+"99991";
    return str;
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
      <td width="178"  class="td_border"><strong><a href="http://www.lazypt.net">官方网站</a></strong></td>
    </tr>
  </form>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tb_style">
  <form name="shanpayment" onsubmit="return dont()" action="shanpay.php" method="post" target="_blank" >
    <tr>
      <td height="50"  colspan="3"class="td_title"><span class="title">雷击霹雳-订单系统</span></td>
    </tr>
    <tr>
      <td   height="50"  class="td_border"><font color="#FF0000">* </font>请输入手机号或QQ号：</td>
      <td colspan="2"  class="td_border"><input id="userphone" name="phone_no" type="text" value="" maxlength="11"  size="35" onkeyup="value=value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g, ''))"  />        
        <font color="#FF0000">* 必填</font> &nbsp;&nbsp;&nbsp;作为购买凭证</td>
    </tr>
    <tr>
      <td   height="50" colspan="3" class="td_border"><font color="#FF0000">* 付款后请勿关闭页面，将自动跳转到商品信息页面。</font></td>
    </tr>
    <tr>
      <td   height="50"  class="td_border">&nbsp;</td>
      <td  class="td_border">
	  <input id="WID_no" name="WIDout_trade_no" type="hidden" value="000000000000" size="35"  />
	  <input  name="WIDsubject" type="hidden" value="order1" size="35" />
	  <input name="WIDtotal_fee" type="hidden" value="0.1" size="35" />
	  <input name="WIDbody" type="hidden" value="收银" size="35" />
	  <input onclick="postData()" type="submit" name="Submit" value="立即下单" class="btn_save" id="addnew"/>
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
