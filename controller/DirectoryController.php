<?php
    class DirectoryController extends ACore {

        private function isUser($checkId)
        {
            return $_SESSION['user']['id'] == $checkId;
        }

        public function setName()
        {
            $folder = $_GET['folder'];
            if (is_null($folder)) return False;

            if ($folder === 'funnel') {
                $res = $this->m->db->query("SELECT * FROM funnel WHERE id = " . $_GET['id']);
            } elseif ($folder === 'course') {
                $res = $this->m->db->query("SELECT * FROM course WHERE id = " . $_GET['id']);
            }

            if (!$this->isUser($res[0]['author_id'])) return False;

            $idDir = $_GET['id'];

            if(isset($_POST['title'])) {

                $last_name = $res[0]['name'];

                $name = $_POST['title'];

                rename("./uploads/$folder/$idDir". "_" ."$last_name", "./uploads/$folder/$idDir" . "_" . "$name");

                if ($folder === 'funnel') {

                    $paths = $this->m->db->query("SELECT * FROM funnel_content WHERE funnel_id = '$idDir'");

                    $this->m->db->execute("UPDATE funnel SET `name` = '$name' WHERE id = '$idDir'");

                } elseif ($folder === 'course') {

                    $paths = $this->m->db->query("SELECT * FROM course_content WHERE course_id = '$idDir'");

                    $this->m->db->execute("UPDATE course SET `name` = '$name' WHERE id = '$idDir'");

                }

                foreach ($paths as $path) {
                    $id = $path['id'];

                    $pages = explode("/", $path['video']);

                    $pages[3] = $idDir . "_" . $name;

                    $changed = implode("/", $pages);

                    if ($folder === 'funnel') {
                        $this->m->db->execute("UPDATE `funnel_content` SET `video` = '$changed' WHERE id = '$id'");
                    } elseif ($folder === 'course') {
                        $this->m->db->execute("UPDATE `course_content` SET `video` = '$changed' WHERE id = '$id'");
                    }

                }
            }
            return True;
        }

        public function Create () {
            $uid = $_SESSION['user']['id'];

            $folder = $_GET['folder'];
            if (is_null($folder)) return False;

            $code = uniqid($more_entropy = true);

            if ($folder == 'funnel') {
                $name = '_Новая воронка';

                $this->m->db->execute("INSERT INTO funnel (`author_id`, `name`, `description`, `price`) VALUES ('$uid', 'Новая воронка', 'Описание' , 0)");

                $directory = $this->m->db->query("SELECT * FROM funnel WHERE author_id = '$uid'  ORDER BY ID DESC LIMIT 1");

            } elseif ($folder == 'course') {

                $name = '_Новый курс';

                $this->m->db->execute("INSERT INTO course (`author_id`, `name`, `description`, `price`, `uniqu_code`) VALUES ('$uid', 'Новый курс', 'Описание' , 0, '$code')");

                $directory = $this->m->db->query("SELECT * FROM course WHERE author_id = '$uid'  ORDER BY ID DESC LIMIT 1");

            } else {
                return False;
            }

            mkdir("./uploads/$folder/".$directory[0]['id']."$name");
            return True;
        }

        public function Delete () {

            $folder = $_GET['folder'];

            if ($folder == 'funnel') {
                $project = $this->m->db->query("SELECT * FROM funnel WHERE id = ". $_GET['id'] . " LIMIT 1");
            } elseif ($folder == 'course') {
                $project = $this->m->db->query("SELECT * FROM course WHERE id = ". $_GET['id'] . " LIMIT 1");
            } else {
                return False;
            }

            if (!$this->isUser($project[0]['author_id'])) return False;

            if ($folder == 'funnel') {
                $this->m->db->execute("DELETE FROM funnel WHERE id = ". $_GET['id']);
            } elseif ($folder == 'course') {
                $this->m->db->execute("DELETE FROM course WHERE id = ". $_GET['id']);
            } else {
                return False;
            }

            rmdir("./uploads/$folder/".$_GET['id']."_" . $project[0]['name']);

            return True;
        }

        public function CreateLink() {

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
				    let ur = document.URL;
                    var url = new URL(ur);
                    var option = url.searchParams.get("option");
                    var folder = url.searchParams.get("folder");
                    var method = url.searchParams.get("method");
                    let id = url.searchParams.get("id");
                    let optionName = "";
                    let idNumber = "";
                    
                    if (method in ["addVideo", "renameVideo", "initVideoButton"]) {
                        if (folder === "funnel") {
                            optionName = "FunnelEdit"
                        } else {
                            optionName = "CourseEdit"
                        }
                    } else {
                        if (folder === "funnel") {
                            optionName = "Funnel"
                        } else {
                            optionName = "Course"
                        }
                    }
                    if (id) {
                        idNumber = \'&id=\' + id;
                    }
				    let a = location.protocol + \'//\' + location.host + location.pathname + \'?option=\' + optionName + idNumber;
					window.location.replace(a);
				</script>
			</body>
			</html>';
        }
    }