<?php 

include ("../../bd.php");

if ($_POST){
    // Recepcionamos los valores del formulario
    //print_r($_POST);
    $icono=(isset($_POST['icono']))?$_POST['icono']:"";
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    // Para comprobar que los datos esten correctos
    //echo $descripcion;

    //Sentencia de conexión

    $sentencia=$conexion->prepare("INSERT INTO `tbl_servicios` (`ID`, `icono`, `titulo`, `descripcion`) VALUES (NULL, :icono, :titulo, :descripcion);");

    $sentencia->bindParam(":icono",$icono);
    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->execute();
    $mensaje="Registro agregado con éxito.";
    header("location:index.php?mensaje=".$mensaje);
}



include ("../../templates/header.php");?>

<div class="card">
    <div class="card-header">
        Crear Servicios
    </div>
    <div class="card-body">

    <form action="" entype="multipart/form-data" method="post">

        

        <div class="mb-3">
        <label for="icono" class="form-label">Icono:</label>
        <input
            type="text"
            class="form-control"
            name="icono"
            id="icono"
            aria-describedby="helpId"
            placeholder="Icono"
        />
       
        </div>
    
        <div class="mb-3">
        <label for="icono" class="form-label">Titulo:</label>
        <input
            type="text"
            class="form-control"
            name="titulo"
            id="titulo"
            aria-describedby="helpId"
            placeholder="Título"
        />

        </div>

        <div class="mb-3">
        <label for="icono" class="form-label">Descripción:</label>
        <input
            type="text"
            class="form-control"
            name="descripcion"
            id="descripcion"
            aria-describedby="helpId"
            placeholder="Descripción"
        />

        <br/>

        <button
            type="submit"
            class="btn btn-primary"
        >
            Agregar
        </button>

            <a
            name=""
            id=""
            class="btn btn-danger"
            href="Index.php"
            role="button"
            >Cancelar</a
        >
        
        

    </form>
       
</div>



<?php include ("../../templates/footer.php");?>
 