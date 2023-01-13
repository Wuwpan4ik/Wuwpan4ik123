<?php

class TariffController extends ACoreCreator
{
    public function Buy()
    {   
        $user_id = $_SESSION['user']['id'];
        $tariff_id = $_POST['tariff_id'];
        $this->m->BuyTariff($user_id, $tariff_id);

        $_SESSION['user']['tariff'] = $tariff_id;
        $this->get_content();
    }

    public function Check()
    {
        $funnel_count = $this->m->db->query("SELECT count(`id`) FROM `funnel` WHERE `author_id` = {$_SESSION['user']['id']}");
        $course_count = $this->m->db->query("SELECT count(`id`) FROM `course` WHERE `author_id` = {$_SESSION['user']['id']}");
        $children_count = $this->m->db->query("SELECT count(`id`) FROM `clients` WHERE `creator_id` = {$_SESSION['user']['id']}");
        $file_size = $this->dir_size('./uploads/users/' . $_SESSION['user']['id']) / 1024 / 1024;

        return ['funnel_count' => $funnel_count, 'course_count' => $course_count, 'children_count' => $children_count, 'file_size' => $file_size];
    }

    public function Remove()
    {
        
    }

    public function get_content()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    

}