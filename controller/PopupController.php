<?php
class PopupController extends ACoreCreator {

    function get_content() {}

    function get_popup()
    {
        $category = $_GET['category'];
        switch ($category) {
            case 'list':
            {
                $content = $this->m->getPopupForPreloader($_GET['id']);
                $div = include './template/default/popup__templates/popup__all-lessons.php';
                $div .= include './template/default/popup__templates/popup__buy.php';
                echo $div;
                return True;
            }
        }
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}