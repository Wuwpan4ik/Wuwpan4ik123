<?php
    class ProjectController extends ACore
    {
        private function isUser($checkId) {
            return $_SESSION['user']['id'] == $checkId;
        }

        public function setName()
        {
            $res = $this->m->db->query("SELECT * FROM course WHERE id = ".$_GET['id']);
            if (!$this->isUser($res[0]['author_id'])) return False;

            $idDir = $_GET['id'];

            if($_POST['title'] != "") {

                $name = $_POST['title'];

                rename("./uploads/projects/" . $idDir . "_" . $res[0]['name'], "./uploads/projects/" . $idDir . "_" . $name);

                $pathname = $this->m->db->query("SELECT * FROM course_content WHERE course_id = ".$res[0]['id']);

                $this->m->db->execute("UPDATE `course` SET `name`='$name' WHERE id = " . $res[0]['id']);

                $updater = $this->m->db->link->prepare("UPDATE `course_content` SET `video` = ? WHERE id = ?");

                foreach ($pathname as $path) {

                    $pages = explode("/", $path[4]);

                    $pages[2] = $res['author_id'] . "_" . $name;

                    $changed = implode("/", $pages);

                    $updater->bind_param("ss", $changed, $path[0]);

                    $updater->execute();

                }
            }
            return True;
        }

        public function createDir () {
            $uid = $_SESSION['user']['id'];

            $this->m->db->execute("INSERT INTO course (`id`, `author_id`, `name`, `price`) VALUES (NULL, '$uid', 'Новый проект', 0)");

            $directory = $this->m->db->query("SELECT * FROM course WHERE author_id = ". $uid . " ORDER BY ID DESC LIMIT 1");

            mkdir("./uploads/projects/".$directory[0]['id']."_Новый проект");
        }

        public function addVideo () {
            $uid = $_GET['id'];

            $res = $this->m->db->query("SELECT * FROM course WHERE author_id = ".$_SESSION['user']['id']." ORDER BY `id` DESC LIMIT 1");

            move_uploaded_file($_FILES['video_uploader']['tmp_name'], "./uploads/projects/".$uid."_".$res[0]['name']."/".$_FILES['video_uploader']['name']);

            $path = "./uploads/projects/".$uid."_".$res[0]['name']."/".$_FILES['video_uploader']['name'];

            $this->m->db->execute("INSERT INTO course_content (`course_id`, `name`, `description`, `video`) VALUES (".$res[0]['id'].",'Укажите заголовок','Укажите описание', '$path')");
        }

        public function deleteDir () {

            $uid = $_SESSION['user']['id'];

            $project = $this->m->db->query("SELECT * FROM course WHERE id = ". $_GET['id'] . " LIMIT 1");

            if ($project[0]['author_id'] != $uid) {
                return False;
            }

            $this->m->db->execute("DELETE FROM course WHERE id = ". $_GET['id']);
            rmdir("./uploads/projects/".$_GET['id']."_" . $project[0]['name']);

            return True;
        }

        public function renameVideo() {
            $courseContent = $this->m->db->query("SELECT * FROM `course_content` WHERE id = ".$_GET['id']);
            $res = $this->m->db->query("SELECT * FROM `course` WHERE id = ".$courseContent[0]['course_id']);
            if (!$this->isUser($res[0]['author_id'])) return False;

            $name = $_POST['name'];
            $description = $_POST['description'];
            $button_text = $_POST['button_text'];
            $this->m->db->execute("UPDATE `course_content` SET `name` = '$name', `description` = '$description',
                            `button_text` = '$button_text' WHERE `id` = " . $_GET['id']);
            return True;
        }

        public function initVideoButton() {
            //Форма
            $id_video = $_POST['id_item'];
            if (!$this->isUser($id_video)) return False;
            if (isset($_POST['first_do'])) {
                $first_do = $_POST['first_do'];
            } else {
                return False;
            }
            if (isset($_POST['form_id-1'])) {
                $form_input_1 = $_POST['form_id-1'];
            }
            if (isset($_POST['form_id-2'])) {
                $form_input_2 = $_POST['form_id-2'];
            }
            if (isset($_POST['form_id-3'])) {
                $form_input_3 = $_POST['form_id-3'];
            }
            switch ($_POST['first_do']) {
                case "form": {
                    $videoBtnHTML = "";
                }
                case "list": {
                    $videoBtnHTML = "";
                }
                case "nextLesson": {
                    $videoBtnHTML = "";
                }
            }
            $this->m->db->execute("UPDATE `course_content` SET `after_video_view` = '$videoBtnHTML' WHERE id = '$id_video'");
            return True;
        }


        public function get_content()
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
				    let a = location.protocol + \'//\' + location.host + location.pathname + \'?option=project\';
					window.location.replace(a);
				</script>
			</body>
			</html>';
        }
    }