<?php
    class empleado{
        private $id_empleado; 
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

        public function getEmpleadoById($id){
            
            $query="select nombre from empleados where id_empleado=".$id;
            $result=$this->NewConn->ExecuteQuery($query); 
            $empleado = null;
            if($result){
                while($fila=$this->NewConn->GetRows($result)){
                    $empleado=$fila[0]; 
                }
            }
           
            return $empleado; 
        }

        public function insert($nombre, $a_paterno, $a_materno, $sueldo) {

            $sql = "INSERT INTO empleados (nombre, a_paterno, a_materno, hora_entrada, hora_salida, sueldo)
                    VALUES ('$nombre', '$a_paterno', '$a_materno', '0', '0', '$sueldo');";
    
            echo $sql;
            $result = $this->NewConn->ExecuteQuery($sql);
    
            if ($result) {
                return true;
            } else {
                return false;
            }
        }

        public function getEmpleados(){
            
            $query="select id_empleado, nombre, a_paterno, a_materno, sueldo, hora_entrada, hora_salida, id_jefe from empleados";
            $result=$this->NewConn->ExecuteQuery($query); 
            $empleados = array();
            if($result){
                while($fila=$this->NewConn->GetRows($result)){
                    $empleados[]=$fila; 
                }
            }
            return $empleados; 
        }
    }
?>