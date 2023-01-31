<?php
    class CourseContentModel extends ConnectDatabase {
        use CheckDirSize;

        public function Get($where = null)
        {
            if (is_null($where)) {
                return $this->db->query("SELECT * FROM course_content WHERE id = {$_SESSION['item_id']}");
            } else {
                return $this->db->query("SELECT * FROM course_content WHERE " . array_keys($where)[0] . " = " . $where[array_keys($where)[0]]);
            }
        }

        public function GetView($id)
        {
            $count = $this->db->query("SELECT `count_view` FROM `course_content` WHERE id = '$id'")[0]['count_view'];
            return $count;
        }

        public function AddView($id, $count)
        {
            $count += 1;
            $this->db->execute("UPDATE `course_content` SET `count_view`  = {$count} WHERE id = {$id}");
            return true;
        }

        public function GetVideoAndAuthorId($id)
        {
            return $this->db->query("SELECT course.author_id, course_content.video FROM `course_content` INNER JOIN `course` ON course.id = course_content.course_id WHERE course_content.id = $id");
        }

        public function getCourseVideo($id) {
            $result = $this->db->query("SELECT  
                                                content.name AS 'content_name',
                                                content.description AS 'content_description',
                                                content.video,
                                                course.id,
                                                course.name,
                                                content.thubnails,
                                                content.query_id,   
                                                content.count_view as 'count',
                                                user_info.id as 'user_id',
                                                user_info.avatar,
                                                user_info.email,
                                                user_info.first_name,
                                                content.file_url
                                                FROM `course_content` AS content
                                                INNER JOIN `course` AS course ON content.course_id = course.id
                                                INNER JOIN `user` AS user_info ON course.author_id = user_info.id WHERE content.id = '$id'");
            return $result;
        }
    }