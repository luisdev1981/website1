<?php

session_start();
$url_base="http://localhost/website/admin/";

if (!isset($_SESSION['usuario'])){
    header("Location: ".$url_base."login.php");
}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Administrador del Sitio Web</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

        <script type="text/javascript" charset="utf8" src=" http://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"  > </script>
        
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

    </head>

    <body>
        <header>
            <!-- place navbar here -->
            
            <nav class="navbar navbar-expand navbar-success bg-success">
                <div class="nav navbar-nav">
                    <a class="nav-item nav-link active" href="#" aria-current="page">Administrador <span class="visually-hidden">(current)</span></a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/servicios/">Servicios</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/portafolio/"">Portafolio</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/entradas/"">Blog</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/equipo/"">Equipo</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/configuraciones/"">Configuraciones</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/usuarios/"">Usuarios</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>cerrar.php">Cerrar Sesión</a>
                </div>
             </nav> 

             </header>
        <main class="container">
        <br/>

        <script>
            <?php if (isset($_GET['mensaje'])){ ?>
            Swal.fire({icon:'success', title:'<?php echo $_GET['mensaje'];?>'});
            <?php } ?>

        </script> 