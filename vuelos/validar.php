<?php
    session_start(); 
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $correo=$_POST["correo"]; 
    $pass=$_POST["pass"];
    $router=$_POST["router"];  
    require("../Conexion/classConnectionMySQL.php"); 
    $nuevaConexion=new ConnectionMySQL();
    $nuevaConexion->CreateConnection(); 
    $query="call sp_buscarCorreo('$correo','$pass')"; 

    $result=$nuevaConexion->ExecuteQuery($query); 

    if($result){
        if($nuevaConexion->GetRowCount($result)>0){
            $fila=$nuevaConexion->GetRowsWithColumn($result); 
            $_SESSION["id_usuario"]=$fila["id_usuario"]; 
            $_SESSION["usuario"]=$fila["nombre"];
            $_SESSION['usuario_tipo']=$fila["tipo"]; 
            $_SESSION["usuario_nombre"]=$fila["nombre"]; 
            $_SESSION["usuario_id"]=$fila["id_usuario"]; 
            $result->free();
            $nuevaConexion->ClearResults();
            if($_SESSION["usuario_tipo"]==="empleado"){
                header("Location: ../dashboard_empleado.php"); 
                exit;
            }

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