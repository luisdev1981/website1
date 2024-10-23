<?php 

include ("../../bd.php");


if ($_POST){
    // Recepcionamos los valores del formulario
    //print_r($_POST);
   
    $nombreconfiguracion=(isset($_POST['nombreconfiguracion']))?$_POST['nombreconfiguracion']:"";
    $valor=(isset($_POST['valor']))?$_POST['valor']:"";
    // Para comprobar que los datos esten correctos
    //echo $descripcion;

    //Sentencia de conexión

    $sentencia=$conexion->prepare("INSERT INTO `tbl_configuraciones` (`ID`, `nombreconfiguracion`, `valor`)
     VALUES (NULL, :nombreconfiguracion, :valor);");
    $sentencia->bindParam(":nombreconfiguracion",$nombreconfiguracion);
    $sentencia->bindParam(":valor",$valor);
    $sentencia->execute();
    $mensaje="Registro agregado con éxito.";
    header("location:index.php?mensaje=".$mensaje);
}

include ("../../templates/header.php");?>

<div class="card">
    <div class="card-header">

        Configuración

    </div>
    <div class="card-body">

    <form action="" method="post">

    <div class="mb-3">
        <label for="nombreconfiguracion" class="form-label">Nombre:</label>
        <input
            type="text"
            class="form-control"
            name="nombreconfiguracion"
            id="nombredeconfiguracion"
            aria-describedby="helpId"
            placeholder="Nombre"
        />

    </div>

    <div class="mb-3">
        <label for="valor" class="form-label" >Valor:</label>
        <input
            type="text"
            class="form-control"
            name="valor"
            id="valor"
            aria-describedby="helpId"
            placeholder="Valor de la Configuracion"
        />
    </div>

    <button type="submit" class="btn btn-primary" >Guardar</button>
    <a name="" id="" class="btn btn-danger" href="index.php" role="button" >Cancelar</a>



    


    </form>
    </div>
    
 </div>
 


<?php include ("../../templates/footer.php");?>

