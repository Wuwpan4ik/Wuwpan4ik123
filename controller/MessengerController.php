<?php
    class MessengerController extends ACore {

        protected $messenger;
        protected $uid;

        public function __construct()
        {
            $this->messenger = $this->m->getUserMessengers();
            $this->uid = $_SESSION['user']['id'];
        }

        public function Create() {
            if (count($this->messenger) != 0) {
                $this->m->db->execute("INSERT INTO `chats` (`user_from`, `user_to`) VALUES ('$this->uid', '1')");
            }
        }

        public function get_content()
        {

        }

        function obr()
        {
            // TODO: Implement obr() method.
        }
    }