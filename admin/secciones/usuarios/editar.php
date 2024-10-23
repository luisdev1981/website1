<?php 
include ("../../bd.php");

if (isset($_GET['txtID'])){
    
    //Recuperación de los datos del formulario
    
    $txtID=( isset ($_GET['txtID']) )?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_usuarios` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    
    $usuario=$registro['usuario'];
     $correo=$registro['correo'];
    $password=$registro['password'];
   
}

        if ($_POST){

            // print_r($_POST);

            $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
            $password=(isset($_POST['password']))?$_POST['password']:"";
            $correo=(isset($_POST['correo']))?$_POST['correo']:"";
            
            $sentencia=$conexion->prepare("UPDATE tbl_usuarios SET usuario=:usuario,password=:password,correo=:correo WHERE id=:id");
            $sentencia->bindParam(":usuario",$usuario);
            $sentencia->bindParam(":password",$password);
            $sentencia->bindParam(":correo",$correo);
            $sentencia->bindParam(":id",$txtID);
            $sentencia->execute();
            $mensaje="Registro Modificado con éxito.";
            header("location:index.php?mensaje".$mensaje);
        }

include ("../../templates/header.php");
?>


<div class="card">
    <div class="card-header">
        Editar Usuario
    </div>
    <div class="card-body">

       <form action="" method="post">

       <div class="form-group">
    <label for="" class="form-label">ID:</label>
    <input 
        type="txtID"
        class="form-control" value="<?php echo $txtID;?>"
        readonly
        name="txtID"
        id="txtID"
        aria-describedby="helpId"
        placeholder=""
    />
   
</div>



    <div class="form-group">
        <label for="">Nombre del Usuario:</label>
        <input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo $usuario;?>"  required>
    </div>
    <div class="form-group">
        <label for="">Password:</label>
        <input type="password" name="password" id="password" class="form-control" value="<?php echo $password;?>" required>
    </div>
    <div class="form-group">
        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" class="form-control" value= "<?php echo $correo;?>" required>
    </div>
   

    <button type="submit" class="btn btn-primary">Update</button>
    <a name="" id="" class="btn btn-danger" href="index.php" role="button" >Cancelar</a>
    
    </div>


</form> 

    </div>
   
</div>
<?php include ("../../templates/footer.php");?>