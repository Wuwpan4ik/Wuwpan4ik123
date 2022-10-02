<?php
    class ProjectController extends ACore
    {
        public function setName()
        {
            $res = $this->m->db->query("SELECT * FROM course WHERE author_id = " . $_SESSION['user']['id'] . " ORDER BY `id` DESC LIMIT 1");

            if (isset($_POST['title'])) {

                $name = $_POST['title'];

                rename("../uploads/projects/" . $_SESSION['user']['id'] . "_" . $res['name'], "../uploads/projects/" . $_SESSION['user']['id'] . "_" . $name);
                $this->m->db->execute("UPDATE `course` SET `name`='$name' WHERE id = " . $res['id']);

                $term = "UPDATE `course_content` SET `video` = ? WHERE id = ?";

                $updater = $this->m->db -> prepare($term);
                $pathnames = $this->m->db->query("SELECT * FROM course_content WHERE course_id = " . $res['id']);

                foreach ($pathnames as $path) {

                    $pages = explode("/", $path[4]);

                    $pages[2] = $res['author_id'] . "_" . $name;

                    $changed = implode("/", $pages);

                    $updater->bind_param("ss", $changed, $path[0]);

                    $updater->execute();
                }
            }
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
                window.location.replace("?option=main");
            </script>
        </body>
        </html>';
        }
    }