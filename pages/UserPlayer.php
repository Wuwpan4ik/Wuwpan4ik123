<?php
class UserPlayer extends ACoreGuess
{
    public function get_content() {
        $getID3 = new getID3;
        $content = $this->course_content->getCourseVideo($_SESSION['item_id']);
        $file = $getID3->analyze($content[0]['video']);
        $duration = $file['playtime_string'];
        array_push($content, $duration);
        return $content;
    }
}