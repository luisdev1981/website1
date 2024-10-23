<?php 
include ("../../bd.php");

if (isset($_GET['txtID'])){



    //Recuperación de los datos del formulario

    $txtID=( isset ($_GET['txtID']) )?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `tbl_entradas` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $fecha=$registro['fecha'];
    $titulo=$registro['titulo'];
    $imagen=$registro['imagen'];
    $descripcion=$registro['descripcion'];
    //$txtID=$registro['txtID'];

   // print_r($registro);
}

if ($_POST){
    
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $fecha=(isset($_POST['fecha']))?$_POST['fecha']:"";
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    
    $destino="../../../assets/img/about/".$_FILES['imagen']['name'];
    move_uploaded_file($archivo,$destino);

    $sentencia=$conexion->prepare("UPDATE `tbl_entradas`
     SET fecha=:fecha, titulo=:titulo, descripcion=:descripcion WHERE id=:id");

   
    $sentencia->bindParam(":fecha",$fecha);
    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    if($_FILES['imagen']['tmp_name']!=""){
        
            $imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
            $fecha_imagen=new DateTime();
            $nombre_archivo_imagen=($imagen!="")?$fecha_imagen->getTimestamp()."_".$imagen:"";

            $tmp_imagen=$_FILES['imagen']['tmp_name'];
        
            move_uploaded_file($tmp_imagen,"../../../assets/img/about/".$nombre_archivo_imagen);

            //Eliminamos la imagen anterior
            $sentencia=$conexion->prepare("SELECT imagen FROM `tbl_entradas` WHERE id=:id");
            $sentencia->bindParam(":id",$txtID);
            $sentencia->execute();
            $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);
        
            if (isset($registro_imagen ['imagen'])){
                if (file_exists("../../../assets/img/about/".$registro_imagen['imagen'])){
                    unlink("../../../assets/img/about/".$registro_imagen['imagen']);
                    
                    
                }
            }
        
        

                $sentencia=$conexion->prepare("UPDATE `tbl_entradas` SET `imagen`=:imagen WHERE id=:id");
                $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
                $sentencia->bindParam(":id",$txtID);
                $sentencia->execute();
                

    }

               
    $mensaje="Registro agregado con éxito.";
    header("location:index.php?mensaje=".$mensaje);


    

}


include ("../../templates/header.php");?>

<div class="card">
    <div class="card-header">

        Entradas

    </div>
    <div class="card-body">

    <form action="" enctype="multipart/form-data"  method="post">

   <div class="mb-3">
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

 <div class="mb-3">
    <label for="fecha" class="form-label">Fecha:</label>
    <input
        type="date"
        class="form-control" value="<?php echo $fecha;?>"
        name="fecha"
        id="fecha"
        aria-describedby="helpId"
        placeholder="Fecha"
    />  

</div>

<div class="mb-3">
    <label for="titulo" class="form-label">Título:</label>
    <input 
        type="text"
        class="form-control" value="<?php echo $titulo;?>"
        name="titulo"
        id="titulo"
        aria-describedby="helpId"
        placeholder="Título"
    />


</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripcion:</label>
    <input
        type="descripcion"
        class="form-control" value="<?php echo $descripcion;?>"
        name="descripcion"
        id="descripcion"
        aria-describedby="helpId"
        placeholder="Descripcion"
    />

</div>

</div>

<div class="mb-3">
    <label for="imagen" class="form-label">Imagen:</label>
    <img width="80" src="../../../assets/img/about/<?php echo $imagen;?>" />
    <input
        type="file"
        class="form-control"
        name="imagen"
        id="imagen"
        aria-describedby="helpId"
        placeholder="Imagen"
    />

    <button type="submit" class="btn btn-primary" >Actualizar</button>
    <a name="" id="" class="btn btn-danger" href="index.php" role="button" >Cancelar</a>

</div>
     
    </form>
    </div>
</div>

<?php include ("../../templates/footer.php");?>