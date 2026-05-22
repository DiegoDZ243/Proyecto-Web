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
                        "id_vuelo"=>$fila["id_vuelo"],
                        "origen"=>$fila["origen"],
                        "destino"=>$fila["destino"],
                        "fecha"=>$fila["fecha"],
                        "precio"=>$fila["precio"]
                    ]; 
                }
                $result->free();
                $this->NewConn->ClearResults();
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
                        "destino"=>$fila["destino"],
                        "fecha"=>$fila["fecha"],
                        "precio"=>$fila["precio"],
                        "hora"=>$fila["hora_salida"],
                        "imagen"=>$fila["imagen"]
                    ]; 
                }
                $result->free();
                $this->NewConn->ClearResults();
            }else{
                echo "Hubo un error con la api de vuelos :'(";
            }   
            return $vuelosBaratos;          
        }

        public function getDestinos(){
            $query="call sp_getDestinos()"; 
            $result=$this->NewConn->ExecuteQuery($query); 
            $listaDestinos=[]; 
            if($result){
                while($fila=$this->NewConn->GetRowsWithColumn($result)){
                    $listaDestinos[]=[
                        "id_destino"=>$fila["id_destino"],
                        "ciudad"=>$fila["ciudad"]
                    ]; 
                }
                $result->free();
                $this->NewConn->ClearResults();
            }else{
                echo "Hubo un error con la api de vuelos :'(";
            }   
            return $listaDestinos;          
        }

        public function getVuelosFiltrado($origen,$destino,$fecha,$pasajeros){
            $query = "CALL sp_buscarVuelos($origen, $destino, '$fecha', $pasajeros)";
            $result=$this->NewConn->ExecuteQuery($query); 
            $listaDeVuelosFiltrados=[]; 
            if($result){
                while($fila=$this->NewConn->GetRowsWithColumn($result)){
                    $listaDeVuelosFiltrados[]=[
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
        
        public function getVuelosMas(){
            $query="call sp_getVuelosMas()"; 
            $result=$this->NewConn->ExecuteQuery($query); 
            $vuelosActuales=[]; 
            if($result){
                while($fila=$this->NewConn->GetRowsWithColumn($result)){
                    $vuelosActuales[]=[
                        "id_vuelo"=>$fila["id_vuelo"],
                        "id_origen"=>$fila["id_origen"],
                        "origen"=>$fila["origen"],
                        "img_origen"=>$fila["img_origen"],
                        "id_destino"=>$fila["id_destino"],
                        "destino"=>$fila["destino"],
                        "img_destino"=>$fila["img_destino"],
                        "fecha"=>$fila["fecha"],
                        "hora_salida"=>$fila["hora_salida"],
                        "precio"=>$fila["precio"]
                    ]; 
                }
                $result->free();
                $this->NewConn->ClearResults();
            }else{
                echo "Hubo un error con la api de vuelos extendida :'(";
            }
           
            return $vuelosActuales; 
        }

        public function agregarVuelo($id_origen,$id_destino,$fecha,$hora_salida,$precio){
            $query = "CALL sp_insertarVuelo($id_origen, $id_destino, '$fecha', '$hora_salida', $precio)";
            $this->NewConn->ExecuteQuery($query); 
        }

        public function actualizarVuelo($id_vuelo, $id_origen, $id_destino, $fecha, $hora_salida, $precio, $embarque, $cupo) {
            // Recuerda que fecha, hora y embarque van entre comillas simples en el SQL
            $query = "CALL sp_actualizarVuelo($id_vuelo, $id_origen, $id_destino, '$fecha', '$hora_salida', $precio)";
            $this->NewConn->ExecuteQuery($query); 
        }
    }
?>