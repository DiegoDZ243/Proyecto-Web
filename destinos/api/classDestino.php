<?php
    class destino{
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

        public function agregarDestinos($ciudad, $imagen){
            $query="insert into destinos (ciudad,imagen) values('$ciudad','$imagen')";
            $this->NewConn->ExecuteQuery($query); 
        }

        public function getDestinos(){
            $query="select id_destino,ciudad,imagen from destinos";
            $result=$this->NewConn->ExecuteQuery($query); 
            $destinos=[]; 
            if($result){
                while($fila=$this->NewConn->GetRowsWithColumn($result)){ 
                    $destinos[]=[
                        "id_destino"=>$fila["id_destino"],
                        "ciudad"=>$fila["ciudad"],
                        "imagen"=>$fila["imagen"]
                    ];
                }
                $result->free();
                $this->NewConn->ClearResults();
            }else{
                echo "Hubo un error al obtener los destinos";
            }
           
            return $destinos; 
        }

        public function updateDestino($id_destino,$ciudad,$imagen){
            $query="update destinos set ciudad='$ciudad', imagen='$imagen' where id_destino=$id_destino";
            $result=$this->NewConn->ExecuteQuery($query); 
        }

        public function deleteDestino($id_destino){
            $query="delete from destinos where id_destino=".$id_destino;
            $result=$this->NewConn->ExecuteQuery($query); 
        }

        public function getDestino($id_destino){
            $query="select ciudad,imagen from destinos where id_destino=$id_destino";
            $result=$this->NewConn->ExecuteQuery($query); 
            $destino=null;
            if($result){
                while($fila=$this->NewConn->GetRowsWithColumn($result)){
                    $destino=[
                        "ciudad"=>$fila["ciudad"],
                        "imagen"=>$fila["imagen"]
                    ];
                }
                $result->free();
                $this->NewConn->ClearResults();
            }else{
                echo "Hubo un error al obtener el el destino :(";
            }
           
            return $destino; 
        }

        public function getDestinoPorNombre($ciudad){
            $query="select id_destino,ciudad,imagen from destinos where ciudad='$ciudad'";
            $result=$this->NewConn->ExecuteQuery($query); 
            $destino=null;
            if($result){
                while($fila=$this->NewConn->GetRowsWithColumn($result)){
                    $destino=[
                        "id_destino"=>$fila["id_destino"],
                        "ciudad"=>$fila["ciudad"],
                        "imagen"=>$fila["imagen"]
                    ];
                }
                $result->free();
                $this->NewConn->ClearResults();
            }else{
                echo "Hubo un error al obtener el el destino :(";
            }
           
            return $destino; 
        }

        public function buscarDestino($ciudad){
            $query="select ciudad,imagen from destinos where ciudad='$ciudad'";
            $result=$this->NewConn->ExecuteQuery($query); 
            if($result){
                $existe=$result->num_rows>0; 
                $result->free();
                $this->NewConn->ClearResults();
                return $existe; 
            }
            return false; 
        }

    }
?>