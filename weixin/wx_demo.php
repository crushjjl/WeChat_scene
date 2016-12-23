<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx78d084359ca8148f", "d0c26e8bbde3e4f81938a0a16875d855");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>weixin_chat</title>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
		wx.config({
		  debug: true,
		  appId: '<?php echo $signPackage["appId"];?>',
		  timestamp: <?php echo $signPackage["timestamp"];?>,
		  nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		  signature: '<?php echo $signPackage["signature"];?>',
		  jsApiList: [
		    // 所有要调用的 API 都要加到这个列表中
		    'scanQRCode',
		    'onMenuShareAppMessage',
		    'getLocation',
		    'openLocation'
		  ]
		});
		//调用微信的接口
		wx.ready(function () {
		  // 在这里调用 API
		  var btn1 =  document.getElementById("btn1"),
		  	  btn2 =  document.getElementById("btn2"),
		  	  btn3 = document.getElementById("btn3");
		  btn1.onclick = function () {
		  	// alert("message");
		  	wx.scanQRCode({
		  	    needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
		  	    scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
		  	    success: function (res) {
		  	    var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
		  	}
		  	});
		  }

		  btn2.onclick = function () {
		  		console.log('message');
		  		wx.onMenuShareAppMessage({
		  		    title: 'DSB', // 分享标题
		  		    desc: 'sb', // 分享描述
		  		    link: 'http://jiangjialin.duapp.com', // 分享链接
		  		    imgUrl: 'images/pic (23).jpg', // 分享图标
		  		    type: 'link', // 分享类型,music、video或link，不填默认为link
		  		    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
		  		    success: function () { 
		  		        // 用户确认分享后执行的回调函数
		  		        alert("message");
		  		    },
		  		    cancel: function () { 
		  		        // 用户取消分享后执行的回调函数
		  		        alert("GG");
		  		    }
		  		});
		  }	

		  btn3.onclick = function () {
		  		wx.getLocation({
		  		    type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
		  		    success: function (res) {
		  		        var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
		  		        var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
		  		        var speed = res.speed; // 速度，以米/每秒计
		  		        var accuracy = res.accuracy; // 位置精度
		  		        // alert(latitude,longitude);
		  		        wx.openLocation({
		  		            latitude: latitude, // 纬度，浮点数，范围为90 ~ -90
		  		            longitude: longitude, // 经度，浮点数，范围为180 ~ -180。
		  		            name: '蒋佳林', // 位置名
		  		            address: 'jjl', // 地址详情说明
		  		            scale: 22, // 地图缩放级别,整形值,范围从1~28。默认为最大
		  		            infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
		  		        });
		  		    }
		  		});
		  }
		});
	</script>
</head>
<body>
	<button type="" id="btn1">点我</button>
	<button type="" id="btn2">想点我</button>
	<button type="" id="btn3">位置</button>
	<div id="map">
		
	</div>
	<a href="http://jiangjialin.duapp.com" title="">点我有惊喜！</a>
</body>
</html>