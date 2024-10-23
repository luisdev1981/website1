<?php 

include ("../../bd.php");

    //Recuperación de los datos del formulario

        if (isset($_GET['txtID'])){



            //Recuperación de los datos del formulario

            $txtID=( isset ($_GET['txtID']) )?$_GET['txtID']:"";
            $sentencia=$conexion->prepare("SELECT * FROM `tbl_equipo` WHERE id=:id");
            $sentencia->bindParam(":id",$txtID);
            $sentencia->execute();
            $registro=$sentencia->fetch(PDO::FETCH_LAZY);

            
            $imagen=$registro['imagen'];
            $nombrecompleto=$registro['nombrecompleto'];
            $puesto=$registro['puesto'];
            $twitter=$registro['twitter'];
            $facebook=$registro['facebook'];
            $linkedin=$registro['linkedin'];
            
            //print_r($registro);
            
        
        }

    if ($_POST){

            $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
           
            $nombrecompleto=(isset($_POST['nombrecompleto']))?$_POST['nombrecompleto']:"";
            $puesto=(isset($_POST['puesto']))?$_POST['puesto']:"";
            $twitter=(isset($_POST['twitter']))?$_POST['twitter']:"";
            $facebook=(isset($_POST['facebook']))?$_POST['facebook']:"";
            $linkedin=(isset($_POST['linkedin']))?$_POST['linkedin']:"";

           /* $destino="../../../assets/img/team/".$_FILES['imagen']['name'];
            move_uploaded_file($archivo,$destino);*/

            $sentencia=$conexion->prepare ("UPDATE tbl_equipo SET
            
            nombrecompleto=:nombrecompleto, 
            puesto=:puesto, 
            twitter=:twitter,
            facebook=:facebook, 
            linkedin=:linkedin 
            WHERE id=:id");
            
            //$sentencia->bindParam(":imagen",$imagen);
            $sentencia->bindParam(":nombrecompleto",$nombrecompleto);
            $sentencia->bindParam(":puesto",$puesto);
            $sentencia->bindParam(":twitter",$twitter);
            $sentencia->bindParam(":facebook",$facebook);
            $sentencia->bindParam(":linkedin",$linkedin);
            $sentencia->bindParam(":id",$txtID);
            $sentencia->execute();

            //print_r($registro);
            

            if($_FILES['imagen']['tmp_name']!=""){
        
                $imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
                $fecha_imagen=new DateTime();
                $nombre_archivo_imagen=($imagen!="")?$fecha_imagen->getTimestamp()."_".$imagen:"";
        
                    $tmp_imagen=$_FILES['imagen']['tmp_name'];
                
                    move_uploaded_file($tmp_imagen,"../../../assets/img/team/".$nombre_archivo_imagen);
        
                    //Eliminamos la imagen anterior
                    $sentencia=$conexion->prepare("SELECT imagen FROM `tbl_equipo` WHERE id=:id");
                    $sentencia->bindParam(":id",$txtID);
                    $sentencia->execute();
                    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);
                
                    if (isset($registro_imagen ['imagen'])){
                        if (file_exists("../../../assets/img/team/".$registro_imagen['imagen'])){
                            unlink("../../../assets/img/team/".$registro_imagen['imagen']);
                            
                            
                            
                            
                        }
                    }
                    
              
                        $sentencia=$conexion->prepare("UPDATE `tbl_equipo` SET `imagen`=:imagen WHERE id=:id");
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
        Datos de la persona
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
    <label for="imagen" class="form-label">Imagen:</label>
    <img width="80" src="../../../assets/img/team/<?php echo $imagen;?>" />
    <input
        type="file"
        class="form-control"
        name="imagen"
        id="imagen"
        aria-describedby="helpId"
        placeholder="Imagen"
    />

            </div>

            <div class="mb-3">
            <label for="nombrecompleto" class="form-label">Nombre Completo:</label>
            <input
                type="texto"
                class="form-control" value="<?php echo $nombrecompleto;?>"
                name="nombrecompleto"
                id="nombrecompleto"
                aria-describedby="helpId"
                placeholder="Nombre Completo"   
                
                />

            </div>

            <div class="mb-3">
            <label for="puesto" class="form-label">Puesto:</label>
            <input
                type="texto"
                class="form-control" value="<?php echo $puesto;?>"
                name="puesto"
                id="puesto"
                aria-describedby="helpId"
                placeholder="Puesto"
                />
            </div>

            <div class="mb-3">
            <label for="descripcion" class="form-label">Twitter:</label>
            <input
                type="texto"
                class="form-control" value="<?php echo $twitter;?>"
                name="twitter"
                id="twitter"
                aria-describedby="helpId"
                placeholder="Twitter"
                />
            </div>

            <div class="mb-3">
            <label for="descripcion" class="form-label">Facebook:</label>
            <input
                type="texto"
                class="form-control" value="<?php echo $facebook;?>"
                name="facebook"
                id="facebook"
                aria-describedby="helpId"
                placeholder="Facebook"
                />
            </div>

            <div class="mb-3">
            <label for="linkedin" class="form-label">Linkedin:</label>
            <input
                type="texto"
                class="form-control" value="<?php echo $linkedin;?>"
                name="linkedin"
                id="linkedin"
                aria-describedby="helpId"
                placeholder="Linkedin"
                />
            </div>

            <button type="submit" class="btn btn-primary" >Actualizar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button" >Cancelar</a>

    </form>   
</div>
<?php include ("../../templates/footer.php"); ?>