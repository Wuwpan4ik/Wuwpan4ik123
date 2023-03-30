<?php
    class CourseModel extends ConnectDatabase {
        use CheckDirSize;

        public function Get($where = null)
        {
            if (is_null($where)) {
                return $this->db->query("SELECT * FROM course WHERE id = {$_SESSION['item_id']}");
            } else {
                return $this->db->query("SELECT * FROM course WHERE " . array_keys($where)[0] . " = " . $where[array_keys($where)[0]]);
            }
        }
	
	    public function GetAuthorCourse()
	    {
		    return $this->db->query("SELECT * FROM course WHERE author_id = {$_SESSION['user']['id']}");
		}

        public function GetLast($author_id)
        {
            return $this->db->query("SELECT * FROM course WHERE author_id = '$author_id'  ORDER BY ID DESC LIMIT 1");
        }

        public function GetCourseInfoForNotifications($course_id)
        {
            return $this->db->query("SELECT course.name, course.price, user.email, count(course_content.id) as 'count' FROM course INNER JOIN user ON user.id = course.author_id INNER JOIN course_content on course_content.course_id = course.id WHERE course.id = $course_id")[0];
        }
    }