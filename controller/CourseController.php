<?php
    class CourseController extends ACoreCreator {

        private function isUser($checkId)
        {
            return $_SESSION['user']['id'] == $checkId;
        }

        public function AddVideo() {

            if (is_null($_FILES['video_uploader'])) {
                return False;
            }

            $uid = $_SESSION['item_id'];
            $res = $this->m->db->query("SELECT * FROM `course` WHERE id = '$uid' ORDER BY `id` DESC LIMIT 1");
            $count_video = count($this->m->db->query("SELECT * FROM `course_content` WHERE course_id = ". $res[0]['id'])) + 1;

            if (!$this->isUser($res[0]['author_id'])) return False;

            move_uploaded_file($_FILES['video_uploader']['tmp_name'], "./uploads/course/".$uid."_".$res[0]['name']."/$count_video"."_".$_FILES['video_uploader']['name']);

            $path = "./uploads/course/$uid"."_".$res[0]['name']."/$count_video"."_".$_FILES['video_uploader']['name'];

            $this->m->db->execute("INSERT INTO course_content (`course_id`, `name`, `description`, `video`, `query_id`) VALUES ($uid,'Укажите заголовок','Укажите описание', '$path', $count_video)");

            return true;
        }

        public function DeleteVideo()
        {
            $item_id = $_SESSION['item_id'];
            $path_in_files = $this->m->db->query("SELECT `video` FROM `course_content` WHERE id = '$item_id'");
//            $author_id = $this->m->db->query("SELECT course.author_id FROM `course_content` AS content INNER JOIN `course` AS course ON (course.id = content.course_id) AND (content.id = '$item_id')");
//            if (!$this->isUser($author_id)) return False;
            $this->m->db->execute("DELETE FROM `course_content` WHERE `id` = '$item_id'");
            unlink($path_in_files[0]['video']);
            return True;
        }

        public function RenameVideo() {
            $item_id = $_SESSION['item_id'];
            $courseContent = $this->m->db->query("SELECT * FROM `course_content` WHERE id = '$item_id'");
            $res = $this->m->db->query("SELECT * FROM `course` WHERE id = ".$courseContent[0]['course_id']);
            if (!$this->isUser($res[0]['author_id'])) return False;

            $name = $_POST['name'];
            $description = $_POST['description'];

            $this->m->db->execute("UPDATE `course_content` SET `name` = '$name', `description` = '$description' WHERE `id` = '$item_id'");
            return True;
        }

        public function CreateCourse () {
            $uid = $_SESSION['user']['id'];

            $code = uniqid($more_entropy = true);

            $name = '_Новый курс';

            $this->m->db->execute("INSERT INTO course (`author_id`, `name`, `description`, `price`, `uniqu_code`) VALUES ('$uid', 'Новый курс', 'Описание' , 0, '$code')");

            $directory = $this->m->db->query("SELECT * FROM course WHERE author_id = '$uid'  ORDER BY ID DESC LIMIT 1");

            mkdir("./uploads/course/".$directory[0]['id']."$name");
            return True;
        }

        public function DeleteCourse () {
            $item_id = $_SESSION['item_id'];

            $project = $this->m->db->query("SELECT * FROM course WHERE id = '$item_id' LIMIT 1");

            if (!$this->isUser($project[0]['author_id'])) return False;

            $this->m->db->execute("DELETE FROM course WHERE id = '$item_id'");

            rmdir("./uploads/course/$item_id" . "_" . $project[0]['name']);

            return True;
        }

        public function RenameCourse()
        {
            $item_id = $_SESSION['item_id'];

            $res = $this->m->db->query("SELECT * FROM course WHERE id = '$item_id'");

            if (!$this->isUser($res[0]['author_id'])) return False;

            if(isset($_POST['title'])) {

                $last_name = $res[0]['name'];

                $name = $_POST['title'];

                rename("./uploads/course/$item_id". "_" ."$last_name", "./uploads/course/$item_id" . "_" . "$name");

                $paths = $this->m->db->query("SELECT * FROM course_content WHERE course_id = '$item_id'");

                $this->m->db->execute("UPDATE course SET `name` = '$name' WHERE id = '$item_id'");

                foreach ($paths as $path) {
                    $id = $path['id'];

                    $pages = explode("/", $path['video']);

                    $pages[3] = $item_id . "_" . $name;

                    $changed = implode("/", $pages);

                    $this->m->db->execute("UPDATE `course_content` SET `video` = '$changed' WHERE id = '$id'");

                }
            }
            return True;
        }

        function get_content()
        {
            echo '<!DOCTYPE html>
			<html lang="en">
			<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Document</title>
			</head>
			<body>
				<script>
				    window.history.go(-1)
				</script>
			</body>
			</html>';
        }

        function obr()
        {
        }
    }