<?php
class SmallPlayer extends ACoreLogin
{
    public function get_content() {
//        Проверка на покупку
        $content = $this->user->getVideosForPlayer();

//       Подгрузка длительности
        $getID3 = new getID3;
        for ($i = 0; $i < count($content['course_content']); $i += 1) {
            $duration = $getID3->analyze($content['course_content'][$i]['video'])['playtime_string'];
            $content['course_content'][$i]['duration'] = $duration;
        }
		$content['rgb_button'] =  mb_substr("rgb(" . explode("rgb(", explode(":", json_decode($content['main__settings'], true)['button__style-color'])[1])[1], 0, -5);
        return $content;
    }

    public function obr()
    {
        $user_id = $this->funnel->Get();
        if (!$this->tariff_class->GetTariff($user_id[0]['author_id'])) {
            header("Location: /Tariff-absent");
        }
    }
}