<?php
require_once("dbconfig.php");
//�W�١A����
function addJob($title,$note) {
	global $db;
	$sql = "insert into todo (title, note) values (?, ?)";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "ss", $title, $note); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //����SQL

	return true;
}

function getJobList($type=0) {
	//db�O�bdbconfig�̩w�q��
	//�p�G�S���i�D�o�����ܼ� �L�|�{���Olocal�A�|�䤣��w�q
	//function���n�h�ϥΦ��ܼƭn�A�w�q
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
	//�X�RModel�\������}�a�쥻����
	if($type==1){//�w����
		$sql = "select * from todo where not isnull(finish) order by id desc;";//�H�������L�o����
	}else if($type==2){//������
		//desc����:�s���u�@�ƫe��
		$sql = "select * from todo where isnull(finish) order by id desc;";
	}else{
     	$sql = "select * from todo order by id desc;";
	}
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt); 
	//�^�Ǫ��}�C�O�Ű}�C
	$retArr=array();
	while (	$rs = mysqli_fetch_assoc($result)) {
		$tArr=array();
		//��ݭn�������ڭn�����G
		//tempArray 
		$tArr['id']=$rs['id'];
		$tArr['title']=$rs['title'];
		$tArr['note']=$rs['note'];
		$tArr['start']=$rs['start'];
		$tArr['finish']=$rs['finish'];
		//�ŧi�@�Ӱ}�C �Ǧ^���}�C �̭��u���@�����
		//�@���@���[�i�h
		$retArr[] = $tArr;
	}
	return $retArr;
}


function setFinished($id){
	global $db;
	$sql = "update todo set finish=now() where id=?;";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "i", $id); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //����SQL

	return true;
}
?>