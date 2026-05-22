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
                echo "Hubo un error al obtener los asientos ocupados :(";
            }
           
            return $asientos; 
        }

        public function getInfo(){
            $query = "CALL sp_buscarVuelo($this->id_vuelo)";
            $result=$this->NewConn->ExecuteQuery($query);  
            $listaDeVuelosFiltrados=null;
            if($result){
                while($fila=$this->NewConn->GetRowsWithColumn($result)){
                    $listaDeVuelosFiltrados=[
                        "id_vuelo"=>$fila["id_vuelo"],
                        "origen"=>$fila["origen"],
                        "destino"=>$fila["destino"],
                        "fecha"=>$fila["fecha"],
                        "precio"=>$fila["precio"],
                        "hora"=>$fila["hora_salida"]
                    ]; 
                }
                $result->free();
                $this->NewConn->ClearResults();
            }else{
                echo "Hubo un error con la api de vuelos :'(";
            }   
            return $listaDeVuelosFiltrados;          
        }

        public function getPrecio(){
            $query="select precio from vuelos where id_vuelo=$this->id_vuelo";
            $result=$this->NewConn->ExecuteQuery($query); 
            $asientos=null;
            if($result){
                while($fila=$this->NewConn->GetRowsWithColumn($result)){
                    $asientos=$fila["precio"];
                }
                $result->free();
                $this->NewConn->ClearResults();
            }else{
                echo "Hubo un error al obtener el precio :(";
            }
           
            return $asientos; 
        }

        public function registrarBoleto($boleto, $usuario){
            $id_vuelo  = $boleto['vuelo'];
            $asiento   = $boleto['asiento'];
            $nombre    = $boleto['nombre'];
            $a_paterno = $boleto['a_paterno'];
            $a_materno = $boleto['a_materno'];
            $query="call sp_insertarBoletos($id_vuelo,'$asiento','$nombre','$a_paterno','$a_materno',$usuario)";
             $this->NewConn->ExecuteQuery($query);
        }

    }
?>