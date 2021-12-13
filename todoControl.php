<?php
require('todoModel.php');

$act=$_REQUEST['act'];
//switch讓controller可以處理多個
switch ($act) {
	//對應controller要做的事
	case "addJob":
		$title=$_POST['title'];
		$note=$_POST['note'];

		if ($title) {
			addJob($title,$note);
		}
		header("Location: 1.listUI.php");
		break;
	case "setFinish":
		$id=(int)$_REQUEST['id'];//因為一定是數字 所以直接轉成int
		if ($id>0) {
			setFinished($id);
		}
		header("Location: 1.listUI.php");
		break;
	default:
}
?>