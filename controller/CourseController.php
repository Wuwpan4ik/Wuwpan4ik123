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

            $res = $this->course->Get($uid);

            $count_video = count($this->course_content->Get($res[0]['id'])) + 1;

//          Проверка юзера

            if (!$this->isUser($res[0]['author_id'])) return False;
            if (!$this->tariff_class->GetTariff($res[0]['author_id'])) return False;

//          Проверка юзера

            $name_video = hash('md5', $_FILES['video_uploader']['name']);

            $path = $this->url_dir . "courses/$uid/{$count_video}_{$name_video}.mp4";

            $max_file_size = $this->CheckTariff()[0]['file_size'] * 1000 * 1000 * 1000;

            $files_size = $this->course->dir_size($this->url_dir);

            if ($_FILES['video_uploader']['size'] + $files_size > $max_file_size) {
                return False;
            }

            move_uploaded_file($_FILES['video_uploader']['tmp_name'], $path);

            chmod($path, 0777);

            $ffmpeg = FFMpeg\FFMpeg::create([
                'ffmpeg.binaries'  => './settings/ffmpeg.exe',
                'ffprobe.binaries' => './settings/ffprobe.exe',
                'ffplay.binaries' => './settings/ffplay.exe',
            ]);

            $video = $ffmpeg->open($path);

            $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(1));

            $frame_path = $this->url_dir . "thumbnails/$uid/" . $count_video ."_" . $_FILES['video_uploader']['name'] . ".jpg";

            $frame->save($frame_path);

            $image = imagescale(imagecreatefromjpeg($frame_path), 288, 512);

            imagejpeg($image, $frame_path);

            $data = [
                "course_id" => $uid,
                "name" => NULL,
                "description" => NULl,
                "video" => $path,
                "thubnails" => $frame_path,
                "query_id" => $count_video
            ];

            $this->course_content->InsertQuery("course_content", $data);

            $this->local_get_content();

            return true;
        }

        public function AddView()
        {
            $this->course_content->AddView($_SESSION['item_id'], $this->course_content->GetView($_SESSION['item_id']));
            return true;
        }

        public function DeleteVideo()
        {
            $item_id = $_SESSION['item_id'];

            $course = $this->course_content->GetVideoAndAuthorId($item_id);

            if (!$this->isUser($course[0]['author_id'])) return False;

            unlink($course[0]['video']);

            $this->course_content->DeleteQuery("course_content", [$item_id]);

            $this->local_get_content();

            return True;
        }

        public function RenameVideo() {
            $item_id = $_SESSION['item_id'];

            $courseContent = $this->course_content->Get($item_id);

            $res = $this->course->Get($courseContent[0]['course_id']);

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
            }

            if (!is_dir($this->url_dir . "course_files/" . $res[0]['id'])) {
                mkdir($this->url_dir . "course_files/" . $res[0]['id']);
            }

            $data = [
                "name" => $name,
                "description" => $description,
                "price" => $price
            ];

            if ($_FILES['file']['size'] != 0) {
                unlink($courseContent[0]['file_url']);

                $file_url = $this->url_dir . "course_files/" . $res[0]['id'] . "/" . $item_id . '-' . preg_replace("/[^а-яёa-z,.]/iu", '', $_FILES['file']['name']);;

                move_uploaded_file($_FILES['file']['tmp_name'], $file_url);

                $data["file_url"] = $file_url;
            }

            $this->course_content->UpdateQuery("course_content", $data, "WHERE `id` = '$item_id'");

            $this->local_get_content();
            return True;
        }

        public function ChangeVideo()
        {
            require './vendor/autoload.php';

//            if ($_FILES['video_change']['size'] == 0)
//            {
//                return False;
//            }

            $uid = $_SESSION['item_id'];

            $res = $this->course_content->Get($uid);

            $course = $this->course->Get($res[0]['course_id']);

            if (!$this->isUser($course[0]['author_id'])) return False;

            if (file_exists($res[0]['video'])) unlink($res[0]['video']);

            $path = $this->url_dir . "courses/{$res[0]['course_id']}"."/{$res[0]['query_id']}"."_".$_FILES['video_change']['name'];

            move_uploaded_file($_FILES['video_change']['tmp_name'], $path);

            $ffmpeg = FFMpeg\FFMpeg::create([
                'ffmpeg.binaries'  => './settings/ffmpeg.exe',
                'ffprobe.binaries' => './settings/ffprobe.exe',
                'ffplay.binaries' => './settings/ffplay.exe',
            ]);

            $video = $ffmpeg->open($path);

            $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(1));

            $frame_path = $this->url_dir . "thumbnails/{$res[0]['course_id']}/{$res[0]['query_id']}_{$_FILES['video_change']['name']}.jpg";

            $frame->save($frame_path);

            $image = imagescale(imagecreatefromjpeg($frame_path), 288, 512);

            imagejpeg($image, $frame_path);

            $data = [
                "video" => $path,
                "thubnails" => $frame_path
            ];

            $this->course_content->UpdateQuery("course_content", $data, "WHERE id = " . $uid);

            $this->local_get_content();

            return true;
        }

        public function CreateCourse () {
            $uid = $_SESSION['user']['id'];

            $code = uniqid(true);

            if (!$this->tariff_class->GetTariff($uid)) {
                header('Location: /Tariff-absent');
                return false;
            }

            $data = [
                "author_id" => $uid,
                "name" => "Новый курс",
                "description" => "Описание",
                "price" => 0,
                "uniqu_code" => $code
            ];

            $this->course->InsertQuery("course", $data);


            $directory = $this->course->GetLast($uid);

            mkdir($this->url_dir ."courses/" . $directory[0]['id']);

            mkdir($this->url_dir ."thumbnails/" . $directory[0]['id']);

            chmod($this->url_dir ."courses/" . $directory[0]['id'], 0777);

            chmod($this->url_dir ."thumbnails/" . $directory[0]['id'], 0777);

            header("Location: /Course");

            return True;
        }

        public function DeleteCourse () {
            $item_id = $_SESSION['item_id'];

            $project = $this->course->Get($item_id);

            if (!$this->isUser($project[0]['author_id'])) return False;

            $this->course->DeleteQuery("course", [$item_id]);

            rmdir($this->url_dir . "courses/$item_id/");
            rmdir($this->url_dir . "thumbnails/$item_id/");

            $this->local_get_content();

            return True;
        }

        public function RenameCourse()
        {
            $item_id = $_SESSION['item_id'];

            $res = $this->course->Get($item_id);

            if (!$this->isUser($res[0]['author_id'])) return False;

            if(isset($_POST['title']) && strlen($_POST['title']) > 0) {
                $name = $_POST['title'];
            } else {
                $name = $res[0]['title'];
            }
            $this->course->UpdateQuery("course", ["name" => $name], "WHERE id = '$item_id'");

            $this->local_get_content();

            return True;
        }

        public function SetPrice()
        {
            $item_id = $_SESSION['item_id'];

            $res = $this->course->Get($item_id);

            if (!$this->isUser($res[0]['author_id'])) return False;

            if (isset($_POST['course_price']) && strlen($_POST['course_price']) > 0) {
                $price = $_POST['course_price'];
            } else {
                $price = $res[0]['price'];
            }

            $this->course->UpdateQuery("course", ["price" => $price], "WHERE id = '$item_id'");

            $this->local_get_content();

            return True;
        }

        function get_content()
        {
        }

        function local_get_content()
        {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        function obr()
        {
        }
    }