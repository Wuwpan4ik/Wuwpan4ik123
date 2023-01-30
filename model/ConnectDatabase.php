<?php
    abstract class ConnectDatabase {
        protected $db;
        protected $date;

        public function __construct()
        {
            require_once './connect/connect.php';
            $this->db = new Database();
            date_default_timezone_set('Europe/Moscow');
            $this->date = date("Y-m-d");
        }

        public function InsertQuery(string $database, $data)
        {
            $columns = implode(", ",array_keys($data));
            $escaped_values = array_values($data);
            $values  = implode("', '", $escaped_values);
            $sql = "INSERT INTO `$database`($columns) VALUES ('$values')";
            $this->db->execute($sql);
        }

        public function UpdateQuery(string $database, $data, $where = '')
        {
            foreach (array_keys($data) as $colum) {
                array_push($sql_main, "{$colum} = '{$data[$colum]}'");
            }
            $sql_query = implode(", ", $sql_main);
            $sql = "UPDATE $database SET $sql_query $where";
            $this->db->execute($sql);
        }
    }