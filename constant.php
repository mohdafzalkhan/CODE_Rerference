<?php
define('SITE_NAME','Food Ordering Admin');
define('FRONT_SITE_NAME','Food Ordering');

define('FRONT_SITE_PATH','http://127.0.0.1/CODE/');
define('SERVER_IMAGE',$_SERVER['DOCUMENT_ROOT']."/CODE/");

define('SERVER_DISH_IMAGE',SERVER_IMAGE."media/dish/");
define('SITE_DISH_IMAGE',FRONT_SITE_PATH."media/dish/");

define('SERVER_BANNER_IMAGE',SERVER_IMAGE."media/banner/");
define('SITE_BANNER_IMAGE',FRONT_SITE_PATH."media/banner/");

$IMG_DISPLAY='media/dish/';
$SITE_BANNER_IMG='media/banner/';



function getDeliveryBoyNameById($id){
	global $con;
	$sql="select name,mobile from delivery_boy where id='$id'";
	$data=array();
	$res=mysqli_query($con,$sql);
	if(mysqli_num_rows($res)>0){
		$row=mysqli_fetch_assoc($res);
		return $row['name'].'('.$row['mobile'].')';	
	}else{
		return 'Not Assign';
	}
}


function getSetting(){
	global $con;
	$sql="select * from setting where id='1'";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($res);
	return $row;
}

function getRatingList($did,$oid){
	$arr=array('Bad','Below Average','Average','Good','Very Good');
	$html='<select onchange=updaterating("'.$did.'","'.$oid.'") id="rate'.$did.'">';
		$html.='<option value="">Select Rating</option>';
		foreach($arr as $key=>$val){
			$id=$key+1;
			$html.="<option value='$id'>$val</option>";	
		}
	$html.='</select>';
	return $html;
}

function getRating($did,$oid){
	global $con;
	$sql="select * from rating where order_id='$oid' and dish_detail_id='$did'";
	$res=mysqli_query($con,$sql);
	if(mysqli_num_rows($res)>0){
		$row=mysqli_fetch_assoc($res);
		$rating=$row['rating'];
		$arr=array('','Bad','Below Average','Average','Good','Very Good');
		echo "<div class='set_rating'>".$arr[$rating]."</div>";
	}else{
		echo getRatingList($did,$oid);
	}
}

function getRatingByDishId($id){
	global $con;
	$sql="select id from dish_details where dish_id='$id'";
	$res=mysqli_query($con,$sql);
	$arr=array();
	$str='';
	while($row=mysqli_fetch_assoc($res)){
		$str.="dish_detail_id='".$row['id']."' or ";
	}
	$str=rtrim($str," or");
	$arr=array('','Bad','Below Average','Average','Good','Very Good');
	$sql="select sum(rating) as rating,count(*) as total from rating where $str";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($res);
	if($row['total']>0){
		$totalRate=$row['rating']/$row['total'];
		echo "<span class='rating'> (".$arr[round($totalRate)]." rated by ".$row['total']." users)</span>";
	}
}


function manageWallet($uid,$amt,$type,$msg,$payment_id=''){
	global $con;
	$added_on=date('Y-m-d h:i:s');
	$sql="insert into wallet(user_id,amt,msg,type,added_on,payment_id) values('$uid','$amt','$msg','$type','$added_on','$payment_id')";
	$res=mysqli_query($con,$sql);
}


function getWallet($uid){
	global $con;
	$sql="select * from wallet where user_id='$uid' order by id desc";
	$res=mysqli_query($con,$sql);
	$arr=array();
	while($row=mysqli_fetch_assoc($res)){
		$arr[]=$row;
	}
	return $arr;
}

function getWalletAmt($uid){
	global $con;
	$sql="select * from wallet where user_id='$uid'";
	$res=mysqli_query($con,$sql);
	$in=0;
	$out=0;
	while($row=mysqli_fetch_assoc($res)){
		if($row['type']=='in'){
			$in=$in+$row['amt'];
		}
		if($row['type']=='out'){
			$out=$out+$row['amt'];
		}
	}
	return $in-$out;
}


function getSale($start,$end){
	global $con;
	$sql="select sum(final_price) as final_price from order_master where added_on between '$start' and '$end' and order_status=4";
	$res=mysqli_query($con,$sql);
	
	while($row=mysqli_fetch_assoc($res)){
		return $row['final_price'].' Rs';
	}
}
?>