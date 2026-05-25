<?php
    class empleado{
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
            $query="select id_empleado, nombre, a_paterno, a_materno, sueldo, hora_entrada, hora_salida, id_jefe from empleados where id_empleado=$id";
            $result=$this->NewConn->ExecuteQuery($query); 
            $empleado = null;
            if($result){
                while($fila=$this->NewConn->GetRowsWithColumn($result)){
                    $empleado=[
                        "id_empleado"=>$fila["id_empleado"],
                        "nombre"=>$fila["nombre"],
                        "a_paterno"=>$fila["a_paterno"],
                        "a_materno"=>$fila["a_materno"],
                        "sueldo"=>$fila["sueldo"],
                        "hora_entrada"=>$fila["hora_entrada"],
                        "hora_salida"=>$fila["hora_salida"],
                        "id_jefe"=>$fila["id_jefe"]
                    ]; 
                }
            }
           
            return $empleado; 
        }

        public function insert($nombre, $a_paterno, $a_materno, $sueldo, $hora_entrada, $hora_salida, $id_jefe,$correo,$password) {

            $sql = "INSERT INTO empleados (nombre, a_paterno, a_materno, hora_entrada, hora_salida, sueldo, id_jefe,correo,password)
                    VALUES ('$nombre', '$a_paterno', '$a_materno', '$hora_entrada', '$hora_salida', $sueldo, $id_jefe,'$correo','$password');";
    
            echo $sql;
            $result = $this->NewConn->ExecuteQuery($sql);

            if (!$result) {
                echo "No se pudo insertar el empleado :("; 
            }

        }
        public function actualizarEmpleado($id,$nombre,$a_paterno,$a_materno,$sueldo,$hora_entrada,$hora_salida,$id_jefe){
            $sql = "UPDATE empleados SET
            nombre='$nombre',
            a_paterno='$a_paterno',
            a_materno='$a_materno',
            sueldo='$sueldo',
            hora_entrada='$hora_entrada',
            hora_salida='$hora_salida',
            id_jefe='$id_jefe'
            WHERE id_empleado='$id'
            ";
            $result=$this->NewConn->ExecuteQuery($sql); 
            if(!$result){
                echo "Hubo un error al actualizar el empleado"; 
            }
        }

        public function eliminarEmpleado($id_empleado){
            $query="delete from empleados where id_empleado=$id_empleado"; 
            $result=$this->NewConn->ExecuteQuery($query); 
            if(!$result){
                echo "Ocurrio un error al eliminar el empleado"; 
            }
        }

        public function getEmpleados(){
            
            $query="call sp_getEmpleados()";
            $result=$this->NewConn->ExecuteQuery($query); 
            $empleados = array();
            if($result){
                while($fila=$this->NewConn->GetRowsWithColumn($result)){
                    $empleados[]=[
                        "id_empleado"=>$fila["id_empleado"],
                        "nombre"=>$fila["nombre"],
                        "a_paterno"=>$fila["a_paterno"],
                        "a_materno"=>$fila["a_materno"],
                        "sueldo"=>$fila["sueldo"],
                        "hora_entrada"=>$fila["hora_entrada"],
                        "hora_salida"=>$fila["hora_salida"],
                        "id_jefe"=>$fila["jefe"]
                    ]; 
                }
            }
            return $empleados; 
        }

        public function getNombresEmpleados($id_empleado){
            
            $query="call sp_getNombresEmpleados($id_empleado)";
            $result=$this->NewConn->ExecuteQuery($query); 
            $empleados=[]; 
            if($result){
                while($fila=$this->NewConn->GetRowsWithColumn($result)){
                    $empleados[]=[
                        "id_jefe"=>$fila["id_jefe"],
                        "nombreCompleto"=>$fila["nombreCompleto"]
                    ]; 
                }
            }
            return $empleados; 
        }

    }
?>