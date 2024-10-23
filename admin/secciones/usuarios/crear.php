<?php 

include ("../../bd.php");

if ($_POST) {

    $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $password=(isset($_POST['password']))?$_POST['password']:"";
    $correo=(isset($_POST['correo']))?$_POST['correo']:"";

    $sentencia=$conexion->prepare("INSERT INTO `tbl_usuarios` (`ID`, `usuario`, `password`, `correo`) 
    VALUES (NULL, :usuario, :password, :correo);");
    
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->execute();
    $mensaje="Registro agregado con éxito.";
    header("location:index.php?mensaje=".$mensaje);
}

include ("../../templates/header.php");?>


<div class="card">
    <div class="card-header">
        Usuario Nuevo
    </div>
    <div class="card-body">
       <form action="" method="post">
    <div class="form-group">
        <label for="">Nombre del Usuario:</label>
        <input type="text" name="usuario" id="usuario" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="">Password:</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" class="form-control" required>
    </div>
   

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a name="" id="" class="btn btn-danger" href="index.php" role="button" >Cancelar</a>
    
    </div>


</form> 

    </div>
   
</div>


<?php include ("../../templates/footer.php");?>