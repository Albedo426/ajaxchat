<?php 
session_start();
	include"ayar.php";
	header("Content-type: text/html ; charset=iso-8859-9");
	$mesaj="";
	$tip= strip_tags($_POST['tip']);

	if(isset($_POST['mesaj'])){
		
		if($_POST['mesaj']!=""){
		$mesaj=iconv("UTF-8","ISO-8859-9",strip_tags(trim($_POST['mesaj'])));

		}
	}
	$kullanici= $_SESSION["uyeadi"];
	$kullaniciID= $_SESSION["ID"];
	$rutbe= $_SESSION["rutbe"];
	$tarih=date("H:i:s");
	switch ($tip) {
		//mesaj gönderme

		case 'gonder':
			if($_POST['mesaj']!=""){
				$query = $db->prepare("INSERT INTO chet SET
				GUser = ?,
				Reviews = ?,
				Huser = ?,
				GuserName=?	,
				Date = ?");
				$insert = $query->execute(array(
				     $kullaniciID, $mesaj, "0", $kullanici,$tarih
				));
				if ( $insert ){
				    $last_id = $db->lastInsertId();
				   
				}
			}
			else{
				echo "bos";
			}
			break;
		//mesaj güncelle
		case 'guncelle':
			$query = $db->query("SELECT * FROM chet", PDO::FETCH_ASSOC);
				if ( $query->rowCount() ){
				     foreach( $query as $row ){
				     	echo"<b>".$row['GuserName']."</b> <font color='black'>".$row['Reviews']."</font><br />";
				         
				     }
				}
			break;
		//mesaj temizle
		case 'temizle':
			# code...
			break;
		
	}
 ?>