<?php
require_once("dbconfig.php");
//名稱，說明
function addJob($title,$note) {
	global $db;
	$sql = "insert into todo (title, note) values (?, ?)";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "ss", $title, $note); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL

	return true;
}

function getJobList($type=0) {
	//db是在dbconfig裡定義的
	//如果沒有告訴她全域變數 他會認為是local，會找不到定義
	//function內要去使用此變數要再定義
	global $db;
	/*
	$a=array();
	$a['id']=10;
	$a['title']='test';
	$a['note']='note';
	$a['start']='123';
	$a['finish']=null;
	$aa[]=$a;
	return  $aa;
	*/
	//擴充Model功能但不破壞原本介面
	if($type==1){//已完成
		$sql = "select * from todo where not isnull(finish) order by id desc;";//以完成的過濾條件
	}else if($type==2){//未完成
		//desc遞減:新的工作排前面
		$sql = "select * from todo where isnull(finish) order by id desc;";
	}else{
     	$sql = "select * from todo order by id desc;";
	}
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt); 
	//回傳的陣列是空陣列
	$retArr=array();
	while (	$rs = mysqli_fetch_assoc($result)) {
		$tArr=array();
		//把需要的欄位塞到我要的結果
		//tempArray 
		$tArr['id']=$rs['id'];
		$tArr['title']=$rs['title'];
		$tArr['note']=$rs['note'];
		$tArr['start']=$rs['start'];
		$tArr['finish']=$rs['finish'];
		//宣告一個陣列 傳回此陣列 裡面只有一筆資料
		//一筆一筆加進去
		$retArr[] = $tArr;
	}
	return $retArr;
}


function setFinished($id){
	global $db;
	$sql = "update todo set finish=now() where id=?;";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "i", $id); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL

	return true;
}
?>