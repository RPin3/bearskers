<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    //recuperar los datos del registro segun el ID        
        $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";
        $sentencia=$conexion->prepare("SELECT * FROM `tbl_servicios` WHERE id = :id ");
        $sentencia->bindParam(":id",$txtID);   
        $sentencia-> execute();
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);

        $icono = $registro['icono'];
        $titulo = $registro['titulo'];
        $descripcion = $registro['descripcion'];
    }   
    if($_POST){
        //recepcionamos los valores del formulario
        $txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
        $icono = (isset($_POST['icono']))?$_POST['icono']:"";
        $titulo = (isset($_POST['titulo']))?$_POST['titulo']:"";
        $descripcion = (isset($_POST['descripcion']))?$_POST['descripcion']:"";
    
    
        $sentencia=$conexion->prepare("UPDATE tbl_servicios 
        SET 
        icono=:icono,
        titulo=:titulo,
        descripcion=:descripcion
        WHERE id=:id ");
    
        $sentencia->bindParam(":icono" ,$icono);
        $sentencia->bindParam(":titulo" ,$titulo);
        $sentencia->bindParam(":descripcion" ,$descripcion);
        $sentencia->bindParam(":id" ,$txtID);
        $sentencia-> execute();
        $mensaje ="Registro modificado con exito.";
        header("Location:index.php?mensaje=".$mensaje);
    }

include("../../templates/header.php"); ?>

<div class="card">
    
<div class="card-header">
        Editando la informacion de servicios
    </div>   
    
    <div class="card-body">
        
    <form action="" enctype="multipart/form-data" method="post">

    <div class="mb-3">
        <label for="txtID" class="form-label">ID:</label>
        <input readonly value ="<?php echo $txtID;?>" type="text"
        class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
    </div>

    <div class="mb-3">
        <label for="icono" class="form-label">Icono:</label>
        <input value ="<?php echo $icono;?>" type="text"
        class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="Icono">
    </div>

    <div class="mb-3">
        <label for="titulo" class="form-label">Titulo:</label>
        <input value ="<?php echo $titulo;?>" type="text"
        class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo">
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripcion:</label>
        <input value ="<?php echo $descripcion;?>" type="text"
        class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion">    
    </div>



    <button type="submit" class="btn btn-success">Actualizar</button>    

    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>         


    </form>

    </div>

    <div class="card-footer text-muted">
        
    </div>
</div>
<?php include("../../templates/footer.php");?>
