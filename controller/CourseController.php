<?php
    class CourseController extends ACore {

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

        public function renameVideo() {
            $item_id = $_SESSION['item_id'];
            $funnelContent = $this->m->db->query("SELECT * FROM `funnel_content` WHERE id = $item_id");
            $res = $this->m->db->query("SELECT * FROM `funnel` WHERE id = ".$funnelContent[0]['funnel_id']);
            if (!$this->isUser($res[0]['author_id'])) return False;

            $name = $_POST['name'];
            $description = $_POST['description'];

            $this->m->db->execute("UPDATE `funnel_content` SET `name` = '$name', `description` = '$description' WHERE `id` = '$item_id'");
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