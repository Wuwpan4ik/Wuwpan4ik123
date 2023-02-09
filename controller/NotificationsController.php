<?php

class NotificationsController extends ACoreCreator
{

    public function getCheckedNotifications() {
        $notifications = $this->notifications_class->getCheckedNotifications($_SESSION['user']['id']);
        foreach ($notifications as $item) {
            $div .= '
                <div class="popupBell-item not-bell '. $item['class'] .'">
                    <img src="'. $item['image'] .'">
                    <div class="popupBell-item__info ">
                        <span>'. $item['title'] . '</span>
                        <p>'. $item['body'] . '</p>
                    </div>
                </div>';
        }
        echo $div;
    }

    public function getNotifications() {
        $notifications = $this->notifications_class->getNotifications($_SESSION['user']['id']);
        foreach ($notifications as $item) {
            $div .= '
                <div class="popupBell-item not-bell '. $item['class'] .'">
                    <img src="'. $item['image'] .'">
                    <div class="popupBell-item__info ">
                        <span>'. $item['title'] . '</span>
                        <p>'. $item['body'] . '</p>
                    </div>
                </div>';
        }
        echo $div;
    }

    public function getCountNotifications()
    {
        $notifications = $this->notifications_class->getCheckedNotifications($_SESSION['user']['id']);
        echo json_encode($notifications);
    }

    public function checkNotifications() {
        $this->notifications_class->checkNotifications();
    }

    public function obr()
    {

    }

    public function get_content(){}
}