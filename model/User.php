<?php
class User {
    public $db;

    public function __construct() {
        require_once 'connect.php';
        date_default_timezone_set('Europe/Moscow');
        $this->db = $db;
    }

    protected function GetMoneyForWeekInterval($prev = false) {
        if ($prev) {
            $prev_week = "- INTERVAL 1 WEEK";
        } else {
            $prev_week = '';
        }
        return $this->db->query("select sum(give_money) as money, to_char(achivment_date, 'DAY') as day
                                    from clients WHERE YEAR(`achivment_date`) = YEAR(NOW()) AND WEEK(`achivment_date`, 1) = WEEK(NOW() $prev_week, 1) and `creator_id` = ". $_SESSION['user']['id'] ."
                                    group by day order by mod(to_char(achivment_date, 'DAY') + 5, 7)");
    }

    protected function GetMoneyForMonthInterval($prev = false) {
        if ($prev) {
            $prev_month = "- INTERVAL 1 MONTH";
        } else {
            $prev_week = '';
        }
        $days_in_month = date('t');
        return $this->db->query("select sum(give_money) as money, to_char(achivment_date, 'MONTH') as day
                                    from clients WHERE YEAR(`achivment_date`) = YEAR(NOW()) AND MONTH(`achivment_date`) = MONTH(NOW() $prev_month) and `creator_id` = ". $_SESSION['user']['id'] ."
                                    group by day order by mod(to_char(achivment_date, 'MONTH') + 5, $days_in_month)");
    }

    public function getCurrentUser() {
        $result = $this->db->query("SELECT * FROM user WHERE id = " . $_SESSION['user']['id']);
        return $result;
    }

    public function getUserByEmail($email) {
        $result = $this->db->query("SELECT * FROM user WHERE email = '$email'");
        return $result;
    }

    public function getFunnelById($id) {
        $result = $this->db->query("SELECT * FROM funnel WHERE id = $id");
        return $result;
    }

    public function getContactsByUser()
    {
        return $this->db->query("SELECT user.id, user.telephone, user.email, contact.vk, contact.instagram, contact.whatsapp, contact.telegram, contact.facebook, contact.youtube, contact.twitter, contact.site FROM user LEFT JOIN user_contacts as contact ON contact.user_id = user.id WHERE user.id = " . $_SESSION['item_id']);
    }

    public function UserHaveAContacts()
    {
        return $this->db->query("SELECT id FROM user_contacts WHERE user_id = " . $_SESSION['item_id']);
    }

    public function getCheckedNotifications($user_id) {
        $result = $this->db->query("SELECT * FROM notifications WHERE `user_id` = '$user_id' AND `is_checked` = 0");
        return $result;
    }

    public function getNotifications($user_id) {
        $result = $this->db->query("SELECT * FROM notifications WHERE `user_id` = '$user_id' LIMIT 5");
        return $result;
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
                                                user_info.first_name,
                                                content.file_url
                                                FROM `course_content` AS content
                                                INNER JOIN `course` AS course ON content.course_id = course.id
                                                INNER JOIN `user` AS user_info ON course.author_id = user_info.id WHERE content.id = '$id'");
        return $result;
    }

    public function getTariffs () {
        $result = $this->db->query("SELECT * FROM tariffs");
        return $result;
    }

    public function getContentForFunnelEdit() {
        $result = $this->db->query("SELECT * FROM funnel WHERE id = ".$_SESSION['item_id']);
        $videos = $this->db->query("SELECT * FROM funnel_content WHERE funnel_id = ".$result[0]['id']);
        return [$result, $videos];
    }

    public function getContentForUserAuthorPage()
    {
        $purchases = $this->db->query("SELECT `purchase` FROM `purchase` WHERE user_id = " . $_SESSION['user']['id'])[0]['purchase'];
        $course_query = "SELECT user.id, user.email, course.name, user.avatar, user.school_name, course.description, user.first_name, user.second_name, count(course.id) as 'count', course.author_id FROM course AS course INNER JOIN user ON user.id = course.author_id WHERE";
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
        $_SESSION['error'] = $course_query;
        $courses = $this->db->query($course_query);
        return $courses;
    }

    public function getContentForUserCoursePage($author_id)
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

    public function getDisableContentForUserCoursePage($author_id)
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

    public function getContentForCourseListPage($course_id){
        $course_query = "SELECT course_content.id, course_content.description, course_content.thubnails, course_content.name, course_content.description, course_content.video, course_content.course_id FROM course_content WHERE ($course_id = course_content.course_id)";
        $courses = $this->db->query($course_query);
        return $courses;
    }

    public function getContentPriceForCourseListPage($course_id) {
        $course_query = "SELECT price FROM course WHERE ($course_id = course.id)";
        $price = $this->db->query($course_query);
        return $price;
    }

    public function getContentForCourseEdit() {
        $result = $this->db->query("SELECT * FROM course WHERE id = ".$_SESSION['item_id']);
        $videos = $this->db->query("SELECT * FROM course_content WHERE course_id = ".$result[0]['id']);
        return [$result, $videos];
    }

    public function getContentForFunnelPage() {
        $result = $this->db->query("SELECT * FROM funnel WHERE author_id = " . $_SESSION['user']['id'] . " GROUP BY id");
        $videos = $this->db->query("SELECT * FROM funnel_content");
        return [$result, $videos];
    }

    protected function dir_size($path) {
        $path = ($path . '/');
        $size = 0;
        $dir = opendir($path);
        if (!$dir) {
            return 0;
        }

        while (false !== ($file = readdir($dir))) {
            if ($file == '.' || $file == '..') {
                continue;
            } elseif (is_dir($path . $file)) {
                $size += $this->dir_size($path . '//' . $file);
            } else {
                $size += filesize($path . '//' . $file);
            }
        }
        closedir($dir);
        return $size;
    }

    public function CheckInfoTariff()
    {
        $funnel_count = $this->db->query("SELECT * FROM `funnel` WHERE `author_id` = {$_SESSION['user']['id']}");
        $course_count = $this->db->query("SELECT * FROM `course` WHERE `author_id` = {$_SESSION['user']['id']}");
        $children_count = $this->db->query("SELECT * FROM `clients` WHERE `creator_id` = {$_SESSION['user']['id']}");
        $file_size = $this->dir_size('./uploads/users/' . $_SESSION['user']['id']) / 1024 / 1024;

        return ['funnel_count' => $funnel_count, 'course_count' => $course_count, 'children_count' => $children_count, 'file_size' => $file_size];
    }

    public function getCourseUser() {
        $result = $this->db->query("SELECT * FROM course WHERE author_id = " . $_SESSION['user']['id'] . " GROUP BY id");
        return $result;
    }

    public function getContentForCoursePage() {
        $result = $this->db->query("SELECT * FROM course WHERE author_id = " . $_SESSION['user']['id'] . " GROUP BY id");
        $videos = $this->db->query("SELECT * FROM course_content");
        return [$result, $videos];
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

//      Statistic

    public function GetMonthValue()
    {
        $sum = 0;
        $result = $this->GetMoneyForMonthInterval();
        foreach ($result as $item) {
            $sum += $item['money'];
        }
        return $sum;
    }

    public function GetPrevMonthValue()
    {
        $sum = 0;
        $result = $this->GetMoneyForMonthInterval(true);
        foreach ($result as $item) {
            $sum += $item['money'];
        }
        return $sum;
    }

    public function GetWeekValue()
    {
        $sum = 0;
        $result = $this->GetMoneyForWeekInterval();
        foreach ($result as $item) {
            $sum += $item['money'];
        }
        return $sum;
    }

    public function GetPrevWeekValue()
    {
        $sum = 0;
        $result = $this->GetMoneyForWeekInterval(true);
        foreach ($result as $item) {
            $sum += $item['money'];
        }
        return $sum;
    }

    public function GetFullValue()
    {
        $sum = 0;
        $result = $this->db->query("SELECT give_money from clients WHERE `creator_id` = " . $_SESSION['user']['id']);
        foreach ($result as $item) {
            $sum += $item['give_money'];
        }
        return $sum;
    }

    public function GetOneUserValue()
    {
        $sum = 0;
        $result = $this->db->query("SELECT give_money from clients WHERE `creator_id` = " . $_SESSION['user']['id']);
        foreach ($result as $item) {
            $sum += $item['give_money'];
        }
        if ($result) {
            return round($sum / count($result));
        }
        return 0;
    }

    public function GetCountFirstBuy()
    {
        $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
        $result = count($this->db->query("SELECT * from clients WHERE `first_buy` = 1 AND `creator_id` = " . $_SESSION['user']['id'] . " AND `achivment_date` BETWEEN '$current_date' -  interval 1 MONTH AND '$current_date'"));
        return $result;
    }

    public function GetWeekDays()
    {
        $result = $this->GetMoneyForWeekInterval();
        return $result;
    }

//      /Statistic

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
                                                content.count_view as 'count',
                                                content.id as 'video_id',
                                                content.video,
                                                content.button_text,
                                                content.query_id as 'count_slider',
                                                user_info.id as 'author_id',
                                                user_info.avatar,
                                                user_info.first_name
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
        $main__settings = $this->db->query("SELECT style_settings
                                                FROM `funnel` WHERE id = '$id'");
        return ['funnel_content' => $funnel_content, 'course_content' => $course_content, 'course_id' => $course, 'main__settings' => $main__settings[0]['style_settings']];

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

    public function isUserSocials()
    {
        return count($this->db->query("SELECT * FROM `user_contacts` WHERE `user_id` = " . $_SESSION['user']['id'])) == 1;
    }

    public function TakeSocialUrls()
    {
        return $this->db->query("SELECT * FROM `user_contacts` WHERE `user_id` = " . $_SESSION['user']['id']);
    }

    public function GetView($id)
    {
        $count = $this->db->query("SELECT `count_view` FROM `funnel_content` WHERE id = '$id'")[0]['count_view'];
        return $count;
    }

    public function AddView($id, $count)
    {
        $count += 1;
        $this->db->execute("UPDATE `funnel_content` SET `count_view`  = {$count} WHERE id = {$id}");
        return true;
    }

    public function GetCourseView($id)
    {
        $count = $this->db->query("SELECT `count_view` FROM `funnel_content` WHERE id = '$id'")[0]['count_view'];
        return $count;
    }

    public function AddCourseView($id, $count)
    {
        $count += 1;
        $this->db->execute("UPDATE `funnel_content` SET `count_view`  = {$count} WHERE id = {$id}");
        return true;
    }

    public function GetTariff($user_id)
    {
        return $this->db->query("SELECT * FROM `users_tariff` WHERE user_id = {$user_id}");
    }

    public function BuyTariff($user_id, $tariff_id)
    {
        $duration = $this->db->query("SELECT duration FROM `tariffs` WHERE `id` = {$tariff_id}")[0]['duration'];

        if (in_array($duration, ['MONTH', 'WEEK', 'YEAR'])) {
            $date_end =  date("Y-m-d", strtotime("+1 $duration", mktime(0, 0, 0, date('m'), date('d'), date('Y'))));
            if (count($this->GetTariff($user_id)) !== 1) {
                $this->db->execute("INSERT INTO `users_tariff` (`user_id`, `tariff_id`, `date`) VALUES ('$user_id', '$tariff_id', '$date_end')");
            } else {
                $this->db->execute("UPDATE `users_tariff` SET `tariff_id` = '$tariff_id', `date` = '$date_end' WHERE `user_id` = '$user_id'");
            }
        } else {
            $request = 'Невалидное значение даты';
            return false;
        }

        return true;
    }
}
?>
