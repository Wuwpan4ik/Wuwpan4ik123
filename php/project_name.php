<?php
include 'core.php';

$request = "SELECT * FROM course WHERE author_id = ".$_SESSION['user']['id']." ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($db, $request);
$res = mysqli_fetch_assoc($result);
	if($_POST['title'] != ""){
		$name = $_POST['title'];
		rename("../uploads/projects/".$_SESSION['user']['id']."_".$res['name'], "../uploads/projects/".$_SESSION['user']['id']."_".$name);
		$query = "UPDATE `course` SET `name`='$name' WHERE id = ". $res['id'];
		$query = "UPDATE `course` SET `name`='$name' WHERE id = ". $res['id'];
		mysqli_query($db, $query);
		$check = mysqli_query($db, "SELECT * FROM course_content WHERE course_id = ".$res['id']);
			$pathname = mysqli_fetch_all($check);
			$term = "UPDATE `course_content` SET `video` = ? WHERE id = ?";
			$updater = $db -> prepare($term);
			foreach($pathname as $path){
				$pages = explode("/", $path[4]);
				$pages[2] = $res['author_id']."_".$name;
				$changed = implode("/",$pages);
				$updater-> bind_param("ss", $changed, $path[0]);
				$updater->execute();
				echo $ter;
			}
		header ("Location: ../new_project.php");
}
?>