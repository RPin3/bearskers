
<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    
    $txtID=(isset($_GET['txtID']) )?$_GET['txtID']:"";
    
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_equipo` WHERE id = :id ");
    $sentencia->bindParam(":id",$txtID);   
    $sentencia-> execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $imagen=$registro['imagen'];
    $nombrecompleto=$registro['nombrecompleto'];
    $puesto=$registro['puesto'];
    $twitter=$registro['twitter'];
    $facebook=$registro['facebook'];
    $linkedin=$registro['linkedin'];
}

if($_POST){
//recepcionamos los valores del formulario
$txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";
$imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
$nombrecompleto = (isset($_POST["nombrecompleto"]))?$_POST["nombrecompleto"]:"";
$puesto = (isset($_POST['puesto']))?$_POST['puesto']:"";
$twitter = (isset($_POST["twitter"]))?$_POST["twitter"]:"";
$facebook = (isset($_POST["facebook"]))?$_POST["facebook"]:"";
$linkedin = (isset($_POST["linkedin"]))?$_POST["linkedin"]:"";


$sentencia=$conexion->prepare("UPDATE `tbl_equipo` SET
nombrecompleto=:nombrecompleto,
puesto=:puesto,
twitter=:twitter,
facebook=:facebook,
linkedin=:linkedin 
WHERE ID=:id");

$sentencia->bindParam(":nombrecompleto" ,$nombrecompleto);
$sentencia->bindParam(":puesto" ,$puesto);
$sentencia->bindParam(":twitter" ,$twitter);
$sentencia->bindParam(":facebook" ,$facebook);
$sentencia->bindParam(":linkedin" ,$linkedin);
$sentencia->bindParam(":id" ,$txtID);

$sentencia->execute();
if($_FILES["imagen"]["name"] != "")
{
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    
    move_uploaded_file($tmp_imagen,"../../../assets/img/team/".$nombre_archivo_imagen);
    
            //Borrar el archivo anterior
            $sentencia=$conexion->prepare("SELECT imagen FROM `tbl_equipo` WHERE id = :id ");
            $sentencia->bindParam(":id" ,$txtID);   
            $sentencia-> execute();
            $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);
            if(isset($registro_imagen["imagen"]))
            {
                if(file_exists("../../../assets/img/team/".$registro_imagen["imagen"]))
                {
                    unlink("../../../assets/img/team/".$registro_imagen["imagen"]);
                }
            }
            
            $sentencia=$conexion->prepare("UPDATE tbl_equipo SET imagen = :imagen WHERE id = :id");
            $sentencia->bindParam(":imagen" ,$nombre_archivo_imagen);
            $sentencia->bindParam(":id" ,$txtID);
            $sentencia->execute();
            $imagen=$nombre_archivo_imagen;

}
$mensaje ="Registro modificado con exito.";
header("Location:index.php?mensaje=".$mensaje);
}
include("../../templates/header.php");?>
<div class="card">
    <div class="card-header">
        Datos del personal
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="" class="form-label">ID:</label>
        <input readonly value="<?php echo $txtID;?>" type="text"
        class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
    </div>
    <div class="mb-3">
    <img width="50" src="../../../assets/img/team/<?php echo $imagen;?>" />
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file"
                class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen">
        </div>
        <div class="mb-3">
            <label for="nombrecompleto" class="form-label">Nombre Completo:</label>
            <input type="text"
                class="form-control" value="<?php echo $nombrecompleto;?>" name="nombrecompleto" id="nombrecompleto" aria-describedby="helpId" placeholder="Nombre">
        </div>
        <div class="mb-3">
            <label for="puesto" class="form-label">Puesto:</label>
            <input type="text"
                class="form-control"  value="<?php echo $puesto;?>" name="puesto" id="nombrecompleto" aria-describedby="helpId" placeholder="puesto">
        </div>   
        <div class="mb-3">
            <label for="twitter" class="form-label">Twitter:</label>
            <input type="text"
                class="form-control"  value="<?php echo $twitter;?>" name="twitter" id="twitter" aria-describedby="helpId" placeholder="Twitter">
        </div>
        <div class="mb-3">
            <label for="facebook" class="form-label">Instagram:</label>
            <input type="text"
                class="form-control"  value="<?php echo $facebook;?>" name="facebook" id="facebook" aria-describedby="helpId" placeholder="Instagram">
        </div>
        <div class="mb-3">
            <label for="linkedin" class="form-label">LinkedIn:</label>
            <input type="text"
                class="form-control"  value="<?php echo $linkedin;?>" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="LinkedIn">
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>    
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>     
    </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>




<?php include("../../templates/footer.php");?>
