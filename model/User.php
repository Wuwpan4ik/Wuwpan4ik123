<?php
class User extends ConnectDatabase{

    public function getCurrentUser($where = null) {
        if (is_null($where)) {
            return $this->db->query("SELECT * FROM user WHERE id = {$_SESSION['user']['id']}");
        } else {
            return $this->db->query("SELECT * FROM user WHERE " . array_keys($where)[0] . " = " . $where[array_keys($where)[0]]);

        }
    }
    
    public function GetCreatorUsersWithoutTariff()
    {
        return $this->db->query("SELECT * FROM user WHERE NOT EXISTS(SELECT * FROM users_tariff WHERE users_tariff.user_id = user.id) GROUP BY user.email");
    }

    public function getUserByEmail($email) {
        return $this->db->query("SELECT * FROM user WHERE email = '$email'");
    }

    public function getUserByUsername($username) {
        return $this->db->query("SELECT * FROM `user` WHERE `username` = '$username'");
    }

    public function getAuthorizationUserByEmail($email, $password, $is_creator) {
        return $this->db->query("SELECT * FROM user WHERE email = '$email' AND password = '$password' AND is_creator = $is_creator");
    }

    public function GetUserWithUsername($username)
    {
        return $this->ClearQuery("SELECT * FROM user WHERE LOWER( username ) LIKE '%$username%'")['id'];
    }

    public function getAuthorizationUserByUsername($username, $password, $is_creator) {
        return $this->db->query("SELECT * FROM user WHERE username = '$username' AND password = '$password' AND is_creator = $is_creator");
    }

    public function getUserIntegrations()
    {
        return $this->db->query("SELECT * FROM `user_integrations` WHERE user_id = {$_SESSION['user']['id']}");
    }

    public function getUserById($id = null)
    {
        if (is_null($id)) {
            $id = $_SESSION['user']['id'];
        }
        return $this->db->query("SELECT * FROM user WHERE id = {$id}");

    }

    public function getIntegrationsByUser($id = null)
    {
        $result = $this->db->query("SELECT user_integraions.albato_key,
                                                FROM `user_integraions` ON user_info.id = user_integraions.user_id WHERE content.id = '$id'");
        return $result;
    }

    public function getAPIByUser($id)
    {
        return $this->db->query("SELECT * FROM `user_integrations` WHERE user_id = $id");
    }

    public function getCourseUser() {
        $result = $this->db->query("SELECT * FROM course WHERE author_id = " . $_SESSION['user']['id'] . " GROUP BY id");
        return $result;
    }

    public function getUserMessengers() {
        $user_id = $_SESSION['user']['id'];
        $result = $this->db->query("SELECT * FROM chats WHERE `user_from` = '$user_id' OR `user_to` = '$user_id'");
        return $result;
    }

    public function getAuthorInfo() {
        $user_id = $_SESSION['item_id'];
        $result = $this->db->query("SELECT * FROM user WHERE `id` = '$user_id'");
        return $result;
    }


    public function getVideosForPlayer()
    {
        $id = $_SESSION['item_id'];
        $author_id = $this->db->query("SELECT funnel.author_id FROM funnel WHERE id = '$id'")[0]['author_id'];
        $course_temp = $this->db->query("SELECT course_id FROM funnel WHERE id = '$id'")[0]['course_id'];
        $course_have_id = (is_null($course_temp) && !isset($course_temp));
        if (!$course_have_id) {
            $course_id = $course_temp;
        } else {
            $course_id = $this->db->query("SELECT course.id FROM course WHERE author_id = '$author_id'")[0]['id'];
        }
        $funnel_content = $this->db->query("SELECT  
                                                course.id,
                                                course.name,
                                                course.description,
                                                course.price,
                                                content.name AS 'content_name',
                                                content.description AS 'content_description',
                                                content.popup,
                                                content.id as 'video_id',
                                                content.video,
                                                content.button_text,
                                                content.query_id as 'count_slider',
                                                content.disabled__transition as 'dis_trans',
                                                user_info.id as 'author_id',
                                                user_info.avatar,
                                                user_info.first_name,
                                                user_info.second_name,
                                                user_info.currency
                                                FROM `course` AS course
                                                INNER JOIN `funnel` AS funnel ON course.id = '$course_id' AND funnel.id = '$id'
                                                INNER JOIN `user` AS user_info ON funnel.author_id = user_info.id
                                                INNER JOIN `funnel_content` AS content ON content.funnel_id = funnel.id GROUP BY content.id");
        $course_content = $this->db->query("SELECT course_content.name,
                                                course_content.id,
                                                course_content.description,
                                                course_content.video,
                                                course_content.price,
                                                course_content.thubnails,
                                                course.author_id,
                                                funnel.id as 'funnel_id'
                                                FROM `funnel` AS funnel
                                                INNER JOIN `course_content` ON course_content.course_id = '$course_id' AND funnel.id = '$id'
                                                INNER JOIN `course` ON course.id = course_content.course_id");
        $course = $this->db->query("SELECT course.id,
                                                course.author_id,
                                                course.price
                                                FROM `funnel` AS funnel
                                                INNER JOIN `course_content` ON course_content.course_id = '$course_id' AND funnel.id = '$id'
                                                INNER JOIN `course` ON course.id = course_content.course_id LIMIT 1");
        $main__settings = $this->db->query("SELECT style_settings, head__settings
                                                FROM `funnel` WHERE id = '$id'");
        $user_info = $this->db->query("SELECT * FROM `user_integrations` WHERE user_id = '$author_id'");
        return ['funnel_content' => $funnel_content, 'course_content' => $course_content, 'course_id' => $course, 'main__settings' => $main__settings[0]['style_settings'], 'html_code' => $main__settings[0]['head__settings'], 'user_info' => $user_info[0]];

    }

    public function getCurrency($id)
    {
        return $this->db->query("SELECT currency FROM user WHERE id = $id")[0]['currency'];
    }

    public function getPopupForPreloader($id)
    {
        $funnel_content = $this->db->query("SELECT  
                                                course.id,
                                                course.name,
                                                course.description,
                                                course.price,
                                                content.name AS 'content_name',
                                                content.description AS 'content_description',
                                                content.popup,
                                                content.video,
                                                content.button_text,
                                                user_info.id as 'author_id',
                                                user_info.avatar,
                                                user_info.first_name
                                                FROM `course` AS course
                                                INNER JOIN `funnel` AS funnel ON course.id = funnel.course_id AND funnel.id = '$id'
                                                INNER JOIN `user` AS user_info ON funnel.author_id = user_info.id
                                                INNER JOIN `funnel_content` AS content ON content.funnel_id = funnel.id GROUP BY content.id");
        $course_content = $this->db->query("SELECT course_content.name,
                                                course_content.description,
                                                course_content.video,
                                                course_content.price 
                                                FROM `funnel` AS funnel
                                                INNER JOIN `course_content` AS course_content ON course_content.course_id = funnel.course_id AND funnel.id = $id");
        $course_sum = $this->db->query("SELECT
                                                course.price
                                                FROM `course` AS course
                                                INNER JOIN `funnel` AS funnel ON funnel.course_id = course.id AND funnel.id = '$id'");
        return ['funnel_content' => $funnel_content, 'course_content' => $course_content, 'course_sum' => $course_sum[0]['price']];
    }

    public function getPopupJson($id) {
        $json = $this->db->query("SELECT * FROM `funnel_content` WHERE `id` = '$id'");
        return $json;
    }
}
?>
