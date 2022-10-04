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
        }

        public function createDir () {
            $uid = $_SESSION['user']['id'];

            $this->m->db->execute("INSERT INTO course (`id`, `author_id`, `name`, `price`) VALUES (NULL, '$uid', 'Новый проект', 0)");

            $directory = $this->m->db->query("SELECT * FROM course WHERE author_id = ". $uid . " ORDER BY ID DESC LIMIT 1");

            mkdir("./uploads/projects/".$directory[0]['id']."_Новый проект");
        }

        public function addVideo () {
            $res = $this->m->db->query("SELECT * FROM course WHERE author_id = ".$_SESSION['user']['id']." ORDER BY `id` DESC LIMIT 1");

            move_uploaded_file($_FILES['video_uploader']['tmp_name'], "./uploads/projects/".$_SESSION['user']['id']."_".$res[0]['name']."/".$_FILES['video_uploader']['name']);

            $path = "./uploads/projects/".$_SESSION['user']['id']."_".$res[0]['name']."/".$_FILES['video_uploader']['name'];

            $this->m->db->execute("INSERT INTO course_content (`course_id`, `name`, `description`, `video`) VALUES (".$res[0]['id'].",'Укажите заголовок','Укажите описание', '$path')");
        }

        public function deleteDir () {

            $uid = $_SESSION['user']['id'];

            $project = $this->m->db->query("SELECT * FROM course WHERE id = ". $_GET['id'] . " LIMIT 1");

            if ($project[0]['author_id'] != $uid) {
                return False;
            }

            $this->m->db->execute("DELETE FROM course WHERE id = ". $_GET['id']);
            rmdir("./uploads/projects/".$_SESSION['user']['id']."_" . $project[0]['name']);

            return True;
        }

        public function get_content()
        {
            header("location:javascript://history.go(-1)");
        }
    }