<?php

    class CourseController extends ACoreCreator {

        private $sec = 2;

        private function isUser($checkId)
        {
            return $_SESSION['user']['id'] == $checkId;
        }

        public function AddVideo() {
            require './vendor/autoload.php';
            if ($_FILES['video_uploader']['size'] == 0)
            {
                return False;
            }

            $uid = $_SESSION['item_id'];
            $res = $this->m->db->query("SELECT * FROM `course` WHERE id = '$uid' ORDER BY `id` DESC LIMIT 1");
            $count_video = count($this->m->db->query("SELECT * FROM `course_content` WHERE course_id = ". $res[0]['id'])) + 1;

            if (!$this->isUser($res[0]['author_id'])) return False;

            $path = $this->url_dir . "courses/$uid"."/$count_video"."_".$_FILES['video_uploader']['name'];

            move_uploaded_file($_FILES['video_uploader']['tmp_name'], $path);

            $ffmpeg = FFMpeg\FFMpeg::create([
                'ffmpeg.binaries'  => './settings/ffmpeg.exe',
                'ffprobe.binaries' => './settings/ffprobe.exe',
                'ffplay.binaries' => './settings/ffplay.exe',
            ]);

            $video = $ffmpeg->open($path);

            $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(1));

            $frame_path = $this->url_dir . "thumbnails/$uid/" . $count_video ."_" . $_FILES['video_uploader']['name'] . ".jpg";

            $frame->save($frame_path);

            $image = imagescale(imagecreatefromjpeg($frame_path), 512, 288);

            imagejpeg($image, $frame_path);

            $_SESSION['error'] = $frame_path;

            $this->m->db->execute("INSERT INTO course_content (`course_id`, `name`, `description`, `video`, `thubnails`, `query_id`) VALUES ($uid,'Укажите заголовок','Укажите описание', '$path', '$frame_path' , $count_video)");

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

            if (isset($_POST['name']) && strlen($_POST['name']) > 0) {
                $name = $_POST['name'];
            } else {
                $name = $courseContent[0]['name'];
            }

            if (isset($_POST['description']) && strlen($_POST['description']) > 0) {
                $description = $_POST['description'];
            } else {
                $description = $courseContent[0]['description'];
            }

            if (isset($_POST['price']) && strlen($_POST['price']) > 0) {
                $price = $_POST['price'];
            } else {
                $price = $courseContent[0]['price'];
            }

//          Проверить наличие course_files
            if (!is_dir($this->url_dir . "course_files")) {
                mkdir($this->url_dir . "course_files");
                mkdir($this->url_dir . "course_files/" . $res[0]['id']);
            }

//            if ($_FILES['file']['size'] != 0) {
//                unlink($courseContent[0]['file_url']);

                move_uploaded_file($_FILES['file']['tmp_name'], $this->url_dir . "course_files/" . $res[0]['id'] . "/" . $_FILES['file']['name']);

                $file_url = $this->url_dir . "course_files/" . $res[0]['id'] . "/" . $_FILES['file']['name'];

                $_SESSION['error'] = $_FILES['file'];
//            }

            $this->m->db->execute("UPDATE `course_content` SET `name` = '$name', `description` = '$description', `price` = '$price', `file_url` = '$file_url' WHERE `id` = '$item_id'");
            return True;
        }

        public function ChangeVideo()
        {
            require './vendor/autoload.php';

            if ($_FILES['video_change']['size'] == 0)
            {
                return False;
            }

            $uid = $_SESSION['item_id'];
            $res = $this->m->db->query("SELECT * FROM `course_content` WHERE id = '$uid'");
            $course = $this->m->db->query("SELECT * FROM `course` WHERE id = " . $res[0]['course_id']);
            $count_video = $this->m->db->query("SELECT `query_id` FROM `course_content` WHERE id = ". $uid)[0]['query_id'];

            if (!$this->isUser($course[0]['author_id'])) return False;

            unlink($res[0]['video']);
            unlink($res[0]['thubnails']);

            $path = $this->url_dir . 'courses/' . $res[0]['course_id']. "/$count_video" ."_" . $_FILES['video_change']['name'];

            move_uploaded_file($_FILES['video_change']['tmp_name'], $path);

            $ffmpeg = FFMpeg\FFMpeg::create([
                'ffmpeg.binaries'  => './settings/ffmpeg.exe',
                'ffprobe.binaries' => './settings/ffprobe.exe',
                'ffplay.binaries' => './settings/ffplay.exe',
            ]);

            $video = $ffmpeg->open($path);

            $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(1));

            $frame_path = $this->url_dir . "thumbnails/". $res[0]['course_id'] ."/" . $count_video ."_" . $_FILES['video_change']['name'] . ".jpg";

            $frame->save($frame_path);

            $image = imagescale(imagecreatefromjpeg($frame_path), 288, 512);

            imagejpeg($image, $frame_path);

            $this->m->db->execute("UPDATE course_content SET `video` = '$path', `thubnails` = '$frame_path' WHERE id = " . $uid);

            return true;
        }

        public function CreateCourse () {
            $uid = $_SESSION['user']['id'];

            $code = uniqid(true);

            $this->m->db->execute("INSERT INTO course (`author_id`, `name`, `description`, `price`, `uniqu_code`) VALUES ('$uid', 'Новый курс', 'Описание' , 0, '$code')");

            $directory = $this->m->db->query("SELECT * FROM course WHERE author_id = '$uid'  ORDER BY ID DESC LIMIT 1");

            mkdir($this->url_dir ."courses/" . $directory[0]['id']);
            mkdir($this->url_dir ."thumbnails/" . $directory[0]['id']);

            return True;
        }

        public function DeleteCourse () {
            $item_id = $_SESSION['item_id'];

            $project = $this->m->db->query("SELECT * FROM course WHERE id = '$item_id' LIMIT 1");

            if (!$this->isUser($project[0]['author_id'])) return False;

            $this->m->db->execute("DELETE FROM course WHERE id = '$item_id'");

            rmdir($this->url_dir . "courses/$item_id");
            rmdir($this->url_dir . "thumbnails/$item_id");

            return True;
        }

        public function RenameCourse()
        {
            $item_id = $_SESSION['item_id'];

            $res = $this->m->db->query("SELECT * FROM course WHERE id = '$item_id'");

            if (!$this->isUser($res[0]['author_id'])) return False;

            if(isset($_POST['title']) && strlen($_POST['title']) > 0) {
                $name = $_POST['title'];
            } else {
                $name = $res[0]['title'];
            }
            $this->m->db->execute("UPDATE course SET `name` = '$name' WHERE id = '$item_id'");
            return True;
        }

        public function SetPrice()
        {
            $item_id = $_SESSION['item_id'];

            $res = $this->m->db->query("SELECT * FROM course WHERE id = '$item_id'");

            if (isset($_POST['course_price']) && strlen($_POST['course_price']) > 0) {
                $price = $_POST['course_price'];
            } else {
                $price = $res[0]['price'];
            }
            $this->m->db->execute("UPDATE course SET `price` = '$price' WHERE id = '$item_id'");
        }

        function get_content()
        {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        function obr()
        {
        }
    }