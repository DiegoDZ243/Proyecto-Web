<?php
    class vuelo{
        private $id_vuelo; 
        private $NewConn;

        public function __construct($id_vuelo)
        {
            require('../Conexion/classConnectionMySQL.php');
            $this->id_vuelo=$id_vuelo; 
            $this->NewConn=new ConnectionMySQL(); 
            $this->NewConn->CreateConnection(); 
            
        }

        public function __destruct()
        {
           $this->NewConn->CloseConnection();
        }

        public function getAsientosOcupados(){
            
            $query="select asiento from boletos where id_vuelo=".$this->id_vuelo;
            $result=$this->NewConn->ExecuteQuery($query); 
            $asientos=[]; 
            if($result){
                while($fila=$this->NewConn->GetRows($result)){
                    $asientos[]=$fila[0]; 
                }
            }else{
                echo "NOOOO";
            }
           
            return $asientos; 
        }


    }
?>