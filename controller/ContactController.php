<?php
class ContactController extends ACoreCreator {
	
	public function SendQuestion() {
		    $uid = $_SESSION["user"]["id"];
			$question = $_POST["question"];
            $author_id = $_POST['author_id'];
			$this->m->db->execute("INSERT INTO `contact` (`user_id`, `author_id`, `body`) VALUES ('$uid', `$author_id`, '$question')");
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
							window.location.replace("/UserContacts");
						</script>
					</body>
					</html>';
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}