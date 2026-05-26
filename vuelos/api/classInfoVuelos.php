<?php
    class vuelos{
        private $NewConn;

        public function __construct()
        {
            require_once('../Conexion/classConnectionMySQL.php');
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

        public function eliminarBoleto($id_boleto){
            $query="delete from boletos where id_boleto=$id_boleto"; 
            $result=$this->NewConn->ExecuteQuery($query); 
            if(!$result){
                echo "Ocurrió un error al eliminar :("; 
            }
        }
        
        public function insertarUsuario($nombre, $apellidoPat, $apellidoMat, $fecha_nac, $correo, $pass){

            $query = "INSERT INTO usuarios(
                nombre,
                a_paterno,
                a_materno,
                fecha_nac,
                correo,
                password
            )
            VALUES('$nombre','$apellidoPat','$apellidoMat','$fecha_nac','$correo','$pass')"; 

            $result = $this->NewConn->ExecuteQuery($query);

            if($result){
                $this->NewConn->ClearResults();
                return true;
            }else{
                echo "Error al insertar usuario";
                return false;
            }
        }

        public function getBoletoById($id_boleto){
            $query="select * from boletos where id_boleto=$id_boleto"; 
            $result=$this->NewConn->ExecuteQuery($query); 
            if($result){
                if($this->NewConn->GetRowCount($result)>0){
                    $boleto=$this->NewConn->GetRowsWithColumn($result); 
                    $result->free();
                    $this->NewConn->ClearResults();
                    return $boleto; 
                }else{
                    return null; 
                }
            }else{
                echo "Ocurrió un error al obtener el boleto :("; 
                return null; 
            }
        }

        public function actualizarBoleto($id_boleto, $id_vuelo, $asiento, $nombre, $a_paterno, $a_materno){

            $id_boleto = intval($id_boleto);
            $id_vuelo = intval($id_vuelo);

            $asiento = $asiento;
            $nombre = $nombre;
            $a_paterno = $a_paterno;
            $a_materno = $a_materno;

            $query = "CALL sp_actualizarBoleto(
                $id_boleto,
                $id_vuelo,
                '$asiento',
                '$nombre',
                '$a_paterno',
                '$a_materno'
            )";

            $result = $this->NewConn->ExecuteQuery($query);

            if($result){
                $this->NewConn->ClearResults();
                return true;
            }

            return false;
        }

        public function correoExiste($correo){

            $query = "CALL sp_validarCorreoDuplicado('$correo')";
            $result = $this->NewConn->ExecuteQuery($query);

            $existe = false;

            if($result){
                if($this->NewConn->GetRowCount($result) > 0){
                    $existe = true;
                }

                $result->free();
                $this->NewConn->ClearResults();
            }

            return $existe;
        }

        public function getDestinoNombre($id_destino){
            $query="select ciudad from destinos where id_destino=$id_destino"; 
            $result = $this->NewConn->ExecuteQuery($query);
            if($result){
                $fila=$this->NewConn->GetRowsWithColumn($result); 
                $destino=$fila["ciudad"]; 
                $result->free();
                $this->NewConn->ClearResults();
                return $destino; 
            }
            return null; 
        }

    }
?>