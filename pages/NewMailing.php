<?php
    class NewMailing extends ACoreCreator {
        function get_content()
        {
            $mailing = $this->mailing->Get($_SESSION['item_id']);
            $name = $mailing['name'];
            $message__text = $mailing['text'];
            $buttons = $mailing['buttons'];
            $file = $mailing['file'];
            $date__send = $mailing['date__send'];
            $indexs = $mailing['indexs'];
            $data = [
                'name' => $name,
                'message__text' => $message__text,
                'buttons' => $buttons,
                'file' => $file,
                'date__send' => $date__send,
                'indexs' => $indexs
            ];
            return $data;
        }
    }