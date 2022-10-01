<?php
include 'core.php';

mkdir("../uploads/projects/".$_SESSION['user']['id']."_Новый проект");

$uid = $_SESSION['user']['id'];
mysqli_query($db, "INSERT INTO course (`id`, `author_id`, `name`, `price`) VALUES (NULL, '$uid', 'Новый проект', 0)");

header ("Location: ../new_project.php");
?>