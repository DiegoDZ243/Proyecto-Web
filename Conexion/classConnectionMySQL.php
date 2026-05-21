<?php
    class ConnectionMySQL{
        private $host; 
        private $user; 
        private $password; 
        private $database; 
        private $conn; 


        public function __construct(){
            //Constructor
            require_once "config_db.php"; 
            $this->host=HOST; 
            $this->user=USER;
            $this->password=PASSWORD;
            $this->database=DATABASE;  
        }

        public function CreateConnection(){
            //Metodo que crea y retorna la conexión
            $this->conn= new mysqli($this->host,$this->user,$this->password, $this->database); 
            if($this->conn->connect_errno){
                die("Error al conectarse a MySQL: (". $this->conn->connect_errno .") ".$this->conn->connect_error); 
            }
        }

        public function CloseConnection(){
            $this->conn->close(); 
        }

        public function ExecuteQuery($sql){
            $result=$this->conn->query($sql); 
            return $result; 
        }

        public function GetCountAffectedRows(){
            return $this->conn->affected_rows; 
        }

        public function GetRows($result){
            return $result->fetch_row(); 
        }

        public function GetRowsWithColumn($result){
            return $result->fetch_assoc(); 
        }

        public function SetFreeResult($result){
            return $result->free_result(); 
        }

        public function ClearResults(){

            while($this->conn->more_results()){

                $this->conn->next_result();

                $extraResult = $this->conn->store_result();

                if($extraResult){
                    $extraResult->free();
                }
            }
        }
        

    }

?>