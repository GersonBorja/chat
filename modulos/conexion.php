<?php
class conexionDb {

        private $host = "localhost";
        private $user = "root";
        private $pass = "";
        private $db = "chat";

        protected function conexion(){
            $conexion = new mysqli($this->host, $this->user, $this->pass, $this->db);
            return $conexion;
        }
        
}

?>