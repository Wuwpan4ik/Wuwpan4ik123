<?php
    class UserModel extends ConnectDatabase {
        public function GetContentForUserCoursePage($author_id)
        {
            $purchases = $this->db->query("SELECT `purchase` FROM `purchase` WHERE user_id = " . $_SESSION['user']['id'])[0]['purchase'];
            $purchases_array = json_decode($purchases, true)['course_id'];
            $course_query = "SELECT course.id, course.name, course_content.thubnails as 'preview', count(course_content.id) as 'count', course.description, course.author_id FROM course INNER JOIN course_content on course_content.course_id = course.id WHERE (";
            foreach ($purchases_array as $course_id) {
                $course_query .= " course.id = $course_id ";
                if (count($purchases_array) != 1) {
                    $course_query .= " OR ";
                } else {
                    $course_query .= ") AND course.author_id = {$author_id} GROUP BY course.id";
                }
                array_shift($purchases_array);
            }
            $courses = $this->db->query($course_query);
            $_SESSION['error'] = $course_query;
            return $courses;
        }

        public function getContentForUserAuthorPage()
        {
            $purchases = $this->db->query("SELECT `purchase` FROM `purchase` WHERE user_id = " . $_SESSION['user']['id'])[0]['purchase'];
            $course_query = "SELECT user.id, user.email, course.name, user.avatar, user.school_name, user.school_desc, course.description, user.first_name, user.second_name, count(course.id) as 'count', course.author_id FROM course AS course INNER JOIN user ON user.id = course.author_id WHERE";
            $purchases_array = json_decode($purchases, true)['course_id'];
            foreach ($purchases_array as $course_id) {
                $course_query .= " course.id = $course_id ";
                if (count($purchases_array) != 1) {
                    $course_query .= " OR ";
                } else {
                    $course_query .= " GROUP BY user.id ";
                    break;
                }
                array_shift($purchases_array);
            }
            $courses = $this->db->query($course_query);
            return $courses;
        }

        public function GetDisableContentForUserCoursePage($author_id)
        {
            $purchases = $this->db->query("SELECT `purchase` FROM `purchase` WHERE user_id = " . $_SESSION['user']['id'])[0]['purchase'];
            $purchases_array = json_decode($purchases, true)['course_id'];
            foreach (json_decode($purchases, true)['video_id'] as $item) {
                $video_course_id = $this->db->query("SELECT `course_id` FROM `course_content` WHERE id = $item")[0]['course_id'];
                if (!in_array($video_course_id, $purchases_array)) {
                    array_push($purchases_array, $video_course_id);
                }
            }
            $course_query = "SELECT course.id, course.name, (course_content.thubnails) as 'preview', count(course_content.id) as 'count', course.description, course.author_id FROM course INNER JOIN course_content on course_content.course_id = course.id AND course.author_id = {$author_id} WHERE NOT (";
            foreach ($purchases_array as $course_id) {
                $course_query .= " course.id = $course_id ";
                if (count($purchases_array) != 1) {
                    $course_query .= " OR ";
                } else {
                    $course_query .= ") AND course.author_id = {$author_id} GROUP BY course.id";
                }
                array_shift($purchases_array);
            }
            $courses = $this->db->query($course_query);
            return $courses;
        }

        public function GetContentForCourseEdit() {
            $result = $this->db->query("SELECT * FROM course WHERE id = ".$_SESSION['item_id']);
            $videos = $this->db->query("SELECT * FROM course_content WHERE course_id = ".$result[0]['id']);
            return [$result, $videos];
        }

        public function getContentForFunnelEdit() {
            $result = $this->db->query("SELECT * FROM funnel WHERE id = ".$_SESSION['item_id']);
            $videos = $this->db->query("SELECT * FROM funnel_content WHERE funnel_id = ".$result[0]['id']);
            return [$result, $videos];
        }

        public function GetContentForFunnelPage() {
            $result = $this->db->query("SELECT * FROM funnel WHERE author_id = " . $_SESSION['user']['id'] . " GROUP BY id");
            $videos = $this->db->query("SELECT * FROM funnel_content");
            return [$result, $videos];
        }

        public function GetContentForCoursePage() {
            $result = $this->db->query("SELECT * FROM course WHERE author_id = " . $_SESSION['user']['id'] . " GROUP BY id");
            $videos = $this->db->query("SELECT * FROM course_content");
            return [$result, $videos];
        }


        public function GetContentForCourseListPage($course_id){
            $course_query = "SELECT course_content.id, course_content.description, course_content.thubnails, course_content.name, course_content.description, course_content.video, course_content.course_id FROM course_content WHERE ($course_id = course_content.course_id)";
            $courses = $this->db->query($course_query);
            return $courses;
        }

        public function GetContentPriceForCourseListPage($course_id) {
            $course_query = "SELECT price FROM course WHERE ($course_id = course.id)";
            $price = $this->db->query($course_query);
            return $price;
        }
    }