<?php

    abstract class Model{
        private $host = 'localhost';
        private $username = 'root';

        private $password = '';

        private $database = 'cuponera';

        protected $conn;

        protected function open_db(){
            try{
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", $this->username, $this->password);
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        protected function close_db(){
            $this->conn = null;
        }

        protected function get_query($query, $params = array()){
            try{
                $this->open_db();
                $stm = $this->conn->prepare($query);
                $stm->execute($params);
                while($rows[]=$stm->fetch(PDO::FETCH_ASSOC));
                $this->close_db();
                array_pop($rows);
                return $rows;
            }
            catch(Exception $e){
                $this->close_db();
                return [];
            }
        }

        protected function set_query($query, $params = array()){
            try{
                $this->open_db();
                $stm = $this->conn->prepare($query);
                $stm->execute($params);
                $affectedRows = $stm->rowCount();
                $this->close_db();
                return $affectedRows;
            }
            catch(Exception $e){
                $this->close_db();
                return 0;
            }
        }
    }