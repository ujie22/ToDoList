<?php
require('todoModel.php');

$act=$_REQUEST['act'];
//switch��controller�i�H�B�z�h��
switch ($act) {
	//����controller�n������
	case "addJob":
		$title=$_POST['title'];
		$note=$_POST['note'];

		if ($title) {
			addJob($title,$note);
		}
		//header("Location: 1.listUI.php");
		break;
	case "setFinish":
		$id=(int)$_REQUEST['id'];//�]���@�w�O�Ʀr �ҥH�����নint
		if ($id>0) {
			setFinished($id);
		}
		//header("Location: 1.listUI.php");
		break;
		case "setList":
			$id=(int)$_REQUEST['id'];//�]���@�w�O�Ʀr �ҥH�����নint
			if ($id>0) {
				setFinished($id);
			}
			//header("Location: 1.listUI.php");
			break;
	default:
}
?>