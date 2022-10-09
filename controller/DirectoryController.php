<?php
    class DirectoryController extends ACore {

        public function Create () {
            $uid = $_SESSION['user']['id'];

            $this->m->db->execute("INSERT INTO course (`id`, `author_id`, `name`, `price`) VALUES (NULL, '$uid', 'Новый проект', 0)");

            $directory = $this->m->db->query("SELECT * FROM course WHERE author_id = ". $uid . " ORDER BY ID DESC LIMIT 1");

            mkdir("./uploads/projects/".$directory[0]['id']."_Новый проект");
        }

        public function Delete () {

            $uid = $_SESSION['user']['id'];

            $project = $this->m->db->query("SELECT * FROM course WHERE id = ". $_GET['id'] . " LIMIT 1");

            if ($project[0]['author_id'] != $uid) {
                return False;
            }

            $this->m->db->execute("DELETE FROM course WHERE id = ". $_GET['id']);
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