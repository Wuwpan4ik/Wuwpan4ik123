<?php

    class CourseController extends ACoreCreator {

        private $sec = 2;

        private function isUser($checkId)
        {
            return $_SESSION['user']['id'] == $checkId;
        }

        public function AddVideo() {
            include '/vendor/autoload.php';
            if (is_null($_FILES['video_uploader'])) {
                return False;
            }

            $uid = $_SESSION['item_id'];
            $res = $this->m->db->query("SELECT * FROM `course` WHERE id = '$uid' ORDER BY `id` DESC LIMIT 1");
            $count_video = count($this->m->db->query("SELECT * FROM `course_content` WHERE course_id = ". $res[0]['id'])) + 1;

            if (!$this->isUser($res[0]['author_id'])) return False;

            $path = $this->url_dir . "/courses/$uid"."/$count_video"."_".$_FILES['video_uploader']['name'];

            move_uploaded_file($_FILES['video_uploader']['tmp_name'], $path);

//            $ffmpeg = FFMpeg\FFMpeg::create();
//            $video = $ffmpeg->open($path);
//            $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($this->sec));
//            $frame_path = $this->url_dir . "/thumbnails/" . $_FILES['video_uploader']['name'];
//            $frame->save($frame_path);

            $this->m->db->execute("INSERT INTO course_content (`course_id`, `name`, `description`, `video`, `thubnails` , `query_id`) VALUES ($uid,'Укажите заголовок','Укажите описание', '$path', '$frame_path' ,$count_video)");

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

            if (isset($_POST['description'])) {
                $name = $_POST['name'];
            } else {
                $name = $res[0]['name'];
            }

            if (isset($_POST['description'])) {
                $description = $_POST['description'];
            } else {
                $description = $res[0]['description'];
            }

            $this->m->db->execute("UPDATE `course_content` SET `name` = '$name', `description` = '$description' WHERE `id` = '$item_id'");
            return True;
        }

        public function CreateCourse () {
            $uid = $_SESSION['user']['id'];

            $code = uniqid(true);

            $this->m->db->execute("INSERT INTO course (`author_id`, `name`, `description`, `price`, `uniqu_code`) VALUES ('$uid', 'Новый курс', 'Описание' , 0, '$code')");

            $directory = $this->m->db->query("SELECT * FROM course WHERE author_id = '$uid'  ORDER BY ID DESC LIMIT 1");

            mkdir($this->url_dir ."/courses/" . $directory[0]['id']);

            return True;
        }

        public function DeleteCourse () {
            $item_id = $_SESSION['item_id'];

            $project = $this->m->db->query("SELECT * FROM course WHERE id = '$item_id' LIMIT 1");

            if (!$this->isUser($project[0]['author_id'])) return False;

            $this->m->db->execute("DELETE FROM course WHERE id = '$item_id'");

            rmdir($this->url_dir . "/courses/$item_id");

            return True;
        }

        public function RenameCourse()
        {
            $item_id = $_SESSION['item_id'];

            $res = $this->m->db->query("SELECT * FROM course WHERE id = '$item_id'");

            if (!$this->isUser($res[0]['author_id'])) return False;

            if(isset($_POST['title'])) {

                $name = $_POST['title'];

                $this->m->db->execute("UPDATE course SET `name` = '$name' WHERE id = '$item_id'");
            }
            return True;
        }

        function get_content()
        {
            header("Location: /Funnel");
        }

        function obr()
        {
        }
    }