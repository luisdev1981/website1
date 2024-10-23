<?php 
include ("../../bd.php");

if (isset($_GET['txtID'])){
    
    //Recuperación de los datos del formulario
    
    $txtID=( isset ($_GET['txtID']) )?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_configuraciones` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    
    $nombreconfiguracion=$registro['nombreconfiguracion'];
    $valor=$registro['valor'];
}

        if ($_POST){

            // print_r($_POST);

            $nombreconfiguracion=(isset($_POST['nombreconfiguracion']))?$_POST['nombreconfiguracion']:"";
            $valor=(isset($_POST['valor']))?$_POST['valor']:"";
            
            $sentencia=$conexion->prepare("UPDATE tbl_configuraciones 
            SET nombreconfiguracion=:nombreconfiguracion,valor=:valor WHERE id=:id");
            $sentencia->bindParam(":nombreconfiguracion",$nombreconfiguracion);
            $sentencia->bindParam(":valor",$valor);
            $sentencia->bindParam(":id",$txtID);
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
        <label for="txtID" class="form-label">ID:</label>
        <input readonly value = "<?php echo $txtID;?>"
            type="text"
            class="form-control"
            name="txtID"
            id="txtID"
            aria-describedby="helpId"
            placeholder="ID"
        />

    <div class="mb-3">
        <label for="nombreconfiguracion" class="form-label">Nombre:</label>
        <input value = "<?php echo $nombreconfiguracion;?>"
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
        <input  value = "<?php echo $valor;?>"
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