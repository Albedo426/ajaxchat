<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">
		document.onkeydown=mesajGonder;
		function mesajGonder(x){
			var tus;
			tus=x.which;
			if(tus==13){
				
				$("textarea[name=mesaj]").attr("disabled","disabled");
				var mesaj= $("textarea[name=mesaj]").val();
				$.ajax({
					type:"POST",
					url:"chet.php",
					data:{"tip":"gonder","mesaj":mesaj},
					success:function(sonuc){
						if(sonuc=="bos"){
							alert('boş mesaj göndermeyiniz');
							$("textarea[name=mesaj]").removeAttr("disabled");

						}
						else{
							$("textarea[name=mesaj]").removeAttr("disabled");
							$("textarea[name=mesaj]").val("");
							sohbetguncelle();
						}
					}
				});
			}
		}
		function sohbetguncelle(){
			$.ajax({
				type:"POST",
				url:"chet.php",
				data:{"tip":"guncelle"},
				success:function(sonuc){
					$("#sohbetIcerik").html(sonuc);
				}
			});
		}
		setInterval("sohbetguncelle()",1500);
	</script>
</head>
<body>
<?php  include "ayar.php";
 session_start();
	if(isset($_POST['kadi'])&&isset($_POST['sifre'])){
		if($_POST['kadi']!="" && $_POST['sifre']!=""){
				$uyeadi=strip_tags(trim($_POST['kadi']));
			  	$uyesifre=strip_tags(trim($_POST['sifre']));
				$query = $db->query("SELECT * FROM uye WHERE Uname = '{$uyeadi}' and 	Upassword='{$uyesifre}'")->fetch(PDO::FETCH_ASSOC);
				if ( $query ){
				   $_SESSION["oturum2"]=true;
				   $_SESSION["uyeadi"]=$query['Uname'];
				   $_SESSION["ID"]=$query['ID'];
				   $_SESSION["rutbe"]=$query['part'];
				  header("Location:index.php");
				}
				else{
					echo '<font folor="red">giriş başarısız....</font>';
					 header("Refresh:2;url=index.php");
				}
		}

	}
	
	if(isset($_SESSION["oturum2"])){
	if($_SESSION["oturum2"]==true){ ?>
		<div id="sohbetGenel">
			<div id="sohbetIcerik"></div>	
				<div id="mesajgonder">
					<h3>mesaj gönder</h3>
					<textarea rows="0" cols="0" name="mesaj" ></textarea>
				</div>
		</div>
	<?php }}
		else{ ?>
		<form action="" method="post">
			<span style="color: white">Kullanici adi</span>
			<span><input type="text" name="kadi"></span>
			<span style="color: white">şifre</span>
			<span><input type="password" name="sifre"></span>
			<span><input type="submit" name="giris tap" value="giriş"></span>
		</form>

	<?php  } ?>
</body>
</html>