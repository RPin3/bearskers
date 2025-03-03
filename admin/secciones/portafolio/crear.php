<?php 
include("../../bd.php");
if($_POST){

    //recepcionamos los valores del formulario
    $titulo = (isset($_POST['titulo']))?$_POST['titulo']:"";
    $subtitulo = (isset($_POST["subtitulo"]))?$_POST["subtitulo"]:"";
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $descripcion = (isset($_POST["descripcion"]))?$_POST["descripcion"]:"";
    $cliente = (isset($_POST["cliente"]))?$_POST["cliente"]:"";
    $categoria = (isset($_POST['categoria']))?$_POST['categoria']:"";
    $url = (isset($_POST['URL']))?$_POST['URL']:"";


    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")?$fecha_imagen->getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
        move_uploaded_file($tmp_imagen,"../../../assets/img/portfolio/".$nombre_archivo_imagen);
    }


    $sentencia=$conexion->prepare("INSERT INTO `tbl_portafolio` 
    (`ID`, `titulo`, `subtitulo`, `imagen`, `descripcion`, `cliente`, `categoria`, `URL`) 
    VALUES (NULL, :titulo, :subtitulo, :imagen, :descripcion, :cliente, :categoria, :url);");

    $sentencia->bindParam(":titulo" ,$titulo);
    $sentencia->bindParam(":subtitulo" ,$subtitulo);
    $sentencia->bindParam(":imagen" ,$nombre_archivo_imagen);
    $sentencia->bindParam(":descripcion" ,$descripcion);
    $sentencia->bindParam(":cliente" ,$cliente);
    $sentencia->bindParam(":categoria" ,$categoria);
    $sentencia->bindParam(":url" ,$url);

    $sentencia->execute();
    $mensaje ="Registro agregado con exito.";
    header("Location:index.php?mensaje=".$mensaje);
}
include("../../templates/header.php");
?>


<div class="card">
    <div class="card-header">
        Producto del catalogo
    </div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data" method="post">
<div class="mb-3">
    <label for="titulo" class="form-label">Titulo</label>
    <input type="text"
    class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo">
</div>


<div class="mb-3">
    <label for="subtitulo" class="form-label">Subtitulo</label>
    <input type="text"
    class="form-control" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="Subtitulo">
</div>

<div class="mb-3">
    <label for="imagen" class="form-label">Imagen:</label>
    <input type="file" 
    class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId">
    
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripcion</label>
    <input type="text"
    class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion">
</div>

<div class="mb-3">
    <label for="cliente" class="form-label">Marca</label>
    <input type="text"
    class="form-control" name="cliente" id="cliente" aria-describedby="helpId" placeholder="Marca">
</div>

<div class="mb-3">
    <label for="categoria" class="form-label">Modelo</label>
    <input type="text"
    class="form-control" name="categoria" id="categoria" aria-describedby="helpId" placeholder="Categoria">
</div>

<div class="mb-3">
    <label for="URL" class="form-label">URL</label>
    <input type="text"
    class="form-control" name="URL" id="URL" aria-describedby="helpId" placeholder="URL">
</div>

    <button type="submit" class="btn btn-success">Agregar</button>    
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>     
</form>
    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>







<?php include("../../templates/footer.php");?>