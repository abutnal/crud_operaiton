<?php
include('model.php');
//insert post data
if (isset($_POST['submit'])) {
	$data = [
		'name'=>$_POST['name'],
		'email'=>$_POST['email'],
		'photo'=>$_FILES['photo']['name']
		];
    if($obj->insert('user_tbl',$data))
    {
    	move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/image/'.basename($_FILES['photo']['name']));
    	header('Location:index.php?msg=success');

    }
}

if (isset($_POST['update'])) {
	$where = ['user_id'=>$_POST['user_id']];
	if(empty($_FILES['photo']['name'])){
		$path = $_POST['image_path'];
	}
	else{
		$path = $_FILES['photo']['name'];
	}
	$data = [
		'name'=>$_POST['name'],
		'email'=>$_POST['email'],
		'photo'=>$path
		];
			move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/image/'.basename($_FILES['photo']['name']));	

	if($obj->update('user_tbl',$data,$where)){
		header('Location:index.php?msg=Updated');
	}
}

if (isset($_GET['delete'])) {
	$where  = ['user_id' => $_GET['user_id']];
	if($obj->delete('user_tbl',$where))
	{
		header('Location:index.php?msg=Deleted');
	}
}