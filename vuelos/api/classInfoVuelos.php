<?php
    class vuelos{
        private $NewConn;

        public function __construct()
        {
            require('../Conexion/classConnectionMySQL.php');
            $this->NewConn=new ConnectionMySQL(); 
            $this->NewConn->CreateConnection(); 
            
        }

        public function __destruct()
        {
           $this->NewConn->CloseConnection();
        }

        public function getVuelos(){
            $query="call sp_getVuelos()"; 
            $result=$this->NewConn->ExecuteQuery($query); 
            $vuelosActuales=[]; 
            if($result){
                while($fila=$this->NewConn->GetRowsWithColumn($result)){
                    $vuelosActuales[]=[
                        "id_vuelo"=>$fila["id_vuelo"]
                        // "origen"=>$fila["origen"],
                        // "destino"=>$fila["destino"],
                        // "fecha"=>$fila["fecha"],
                        // "precio"=>$fila["precio"]
                    ]; 
                }
            }else{
                echo "Hubo un error con la api de vuelos :'(";
            }
           
            return $vuelosActuales; 
        }

        public function getVuelosBaratos(){
            $query="call sp_getVuelosBaratos()"; 
            $result=$this->NewConn->ExecuteQuery($query); 
            $vuelosBaratos=[]; 
            if($result){
                while($fila=$this->NewConn->GetRowsWithColumn($result)){
                    $vuelosBaratos[]=[
                        "id_vuelo"=>$fila["id_vuelo"],
                        "origen"=>$fila["origen"],
                        "destino"=>$fila["fecha"],
                        "fecha"=>$fila["fecha"]
                    ]; 
                }
            }else{
                echo "Hubo un error con la api de vuelos :'(";
            }   
            return $vuelosBaratos;          
        }
    }
?>