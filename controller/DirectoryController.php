<?php
    class DirectoryController extends ACore {

        private function isUser($checkId)
        {
            return $_SESSION['user']['id'] == $checkId;
        }

        public function setName()
        {
            $res = $this->m->db->query("SELECT * FROM funnel WHERE id = ".$_GET['id']);
            if (!$this->isUser($res[0]['author_id'])) return False;

            $idDir = $_GET['id'];

            if(isset($_POST['title'])) {

                $last_name = $res[0]['name'];

                $name = $_POST['title'];

                rename("./uploads/projects/$idDir". "_" ."$last_name", "./uploads/projects/$idDir" . "_" . "$name");

                $paths = $this->m->db->query("SELECT * FROM funnel_content WHERE funnel_id = '$idDir'");

                $this->m->db->execute("UPDATE funnel SET `name` = '$name' WHERE id = '$idDir'");

                foreach ($paths as $path) {
                    $id = $path['id'];

                    $pages = explode("/", $path['video']);

                    $pages[3] = $idDir . "_" . $name;

                    $changed = implode("/", $pages);

                    $this->m->db->execute("UPDATE `funnel_content` SET `video` = '$changed' WHERE id = '$id'");
                }
            }
            return True;
        }

        public function Create () {
            $uid = $_SESSION['user']['id'];

            $this->m->db->execute("INSERT INTO funnel (`author_id`, `name`, `description`, `price`) VALUES ('$uid', 'Новый проект', 'Описание' , 0)");

            $directory = $this->m->db->query("SELECT * FROM funnel WHERE author_id = '$uid'  ORDER BY ID DESC LIMIT 1");

            mkdir("./uploads/projects/".$directory[0]['id']."_Новый проект");
        }

        public function Delete () {

            $uid = $_SESSION['user']['id'];

            $project = $this->m->db->query("SELECT * FROM funnel WHERE id = ". $_GET['id'] . " LIMIT 1");

            if ($project[0]['author_id'] != $uid) {
                return False;
            }

            $this->m->db->execute("DELETE FROM funnel WHERE id = ". $_GET['id']);
            rmdir("./uploads/projects/".$_GET['id']."_" . $project[0]['name']);

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
                    var method = url.searchParams.get("method");
                    let id = url.searchParams.get("id");
                    let optionName = "";
                    let idNumber = "";
                    
                    if (method === "addVideo" || method === "renameVideo") {
                        optionName = "ProjectEdit"
                    } else {
                        optionName = "Project"
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