<?php
    session_start(); 
    require("../Conexion/classConnectionMySQL.php"); 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $correo=$_POST["correo"]; 
    $pass=$_POST["pass"];
    $router=$_POST["router"];  
    $nuevaConexion=new ConnectionMySQL();
    $nuevaConexion->CreateConnection(); 
    $query="select nombre from usuarios where correo='$correo' and password='$pass'"; 

    $result=$nuevaConexion->ExecuteQuery($query); 

    if($result){
        if($nuevaConexion->GetRowCount($result)>0){
            $fila=$nuevaConexion->GetRowsWithColumn($result); 
            $_SESSION["usuario"]=$fila["nombre"];
            echo $_SESSION["usuario"]; 
            if(!isset($_POST["router"])){
                header("Location:buscarVuelos.php"); 
            }
            else{
                header("Location:$router"); 
            }
        }else{
            if(!isset($_POST["router"])){
                header("Location: buscarVuelos.php?err=failed_login");
            }else{
                header("Location:$router?err=faild_login"); 
            }
        }
    }    
    
?>