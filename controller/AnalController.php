<?php
    class AnalController extends ACore {

        public function delClient () {

            $delid = $_GET['id'];

            $this->m->db->execute("DELETE FROM clients WHERE id = ". $delid);

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
					window.location.replace("?option=Analytics");
				</script>
			</body>
			</html>';
        }

        function obr()
        {
            // TODO: Implement obr() method.
        }
    }