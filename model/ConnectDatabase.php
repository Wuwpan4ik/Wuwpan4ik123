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
	        $sql_main = [];
	
	        foreach (array_keys($data) as $colum) {
		        if (empty($data[$colum])) {
			        array_push($sql_main, "{$colum} = NULL");
			        continue;
		        }
		        array_push($sql_main, "{$colum} = '{$data[$colum]}'");
	        }
	        $sql_query = implode(", ", $sql_main);

            $sql = "UPDATE $database SET $sql_query $where";
            $this->db->execute($sql);
        }

        public function GetQuery(string $database, $data, $where = '')
        {
            $sql_main = [];

            foreach (array_keys($data) as $colum) {
                array_push($sql_main, "{$colum} = '{$data[$colum]}'");
            }
            $sql_query = implode(" AND ", $sql_main);

            $sql = "SELECT * FROM $database WHERE $sql_query $where";
            return $this->db->query($sql);
        }

        public function GetAllQuery(string $database)
        {
            return $this->db->query("SELECT * FROM $database");
        }

        public function DeleteQuery(string $database, $data, $key = "id")
        {
            $values = [];
            foreach ($data as $item) {
                array_push($values, $item);
            }
            $sql_query = implode(', ', $values);

            $sql = "DELETE FROM $database WHERE $key IN ($sql_query)";
            $this->db->execute($sql);
        }

        public function ClearQuery($sql)
        {
            return $this->db->query($sql);
        }

        public function GetApi()
        {
            return $this->db->query("SELECT * FROM api_email")[0];
        }
    }