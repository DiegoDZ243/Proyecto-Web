<?php
    class empleado{
        private $id_empleado; 
        private $NewConn;

        public function __construct($id_empleado)
        {
            require('../Conexion/classConnectionMySQL.php');
            $this->id_empleado=$id_empleado; 
            $this->NewConn=new ConnectionMySQL(); 
            $this->NewConn->CreateConnection(); 
            
        }

        public function __destruct()
        {
           $this->NewConn->CloseConnection();
        }

        public function getEmpleados(){
            
            $query="select nombre from empleados where id_empleado=".$this->id_empleado;
            $result=$this->NewConn->ExecuteQuery($query); 
            $empleados=[]; 
            if($result){
                while($fila=$this->NewConn->GetRows($result)){
                    $empleados[]=$fila[0]; 
                }
            }else{
                echo "NOOOO";
            }
           
            return $empleados; 
        }


    }
?>