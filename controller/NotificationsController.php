<?php

class NotificationsController extends ACoreCreator
{
    public function addNotifications($class, $message, $image, $user_id = null) {
        if (is_null($user_id)) $user_id = $_SESSION['user']['id'];
        $date = date("d.m.Y");
        $time = date("H:i");
        $this->m->db->execute("INSERT INTO `notifications` (`user_id`, `class`, `body`, `image`, `date`, `time`, `is_checked`) VALUES ('$user_id', '$class', '$message', '$image', '$date', '$time', 0)");
    }

    public function getNotifications() {
        $notifications = $this->m->getNotifications($_SESSION['user']['id']);
        foreach ($notifications as $item) {
            $div .= '
                <div class="popupBell-item">
                    <img style="width: 32px;" src="'. $item['image'] .'">
                    <div class="popupBell-item__info">
                        <span>'. $item['class'] .'</span>
                        <p>'. $item['body'] . ' ' . $item['date'] .'</p>
                    </div>
                </div>';
        }
        echo $div;
    }
    public function obr()
    {
    }

    public function get_content(){}
}