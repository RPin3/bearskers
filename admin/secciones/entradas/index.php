<?php 
include("../../bd.php");
if(isset($_GET['txtID'])){
            
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";
    //borrar segun registro con el ID correspondiente

        $sentencia=$conexion->prepare("SELECT imagen FROM `tbl_entradas` WHERE id = :id ");
        $sentencia->bindParam(":id" ,$txtID);   
        $sentencia-> execute();
        $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($registro_imagen["imagen"]))
        {
            if(file_exists("../../../assets/img/about/".$registro_imagen["imagen"])){
                unlink("../../../assets/img/about/".$registro_imagen["imagen"]);
            }
        }

        $sentencia=$conexion->prepare("DELETE FROM `tbl_entradas` WHERE id = :id ");
        $sentencia->bindParam(":id" ,$txtID);   
        $sentencia-> execute();

    }
    //seleccionar registros
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_entradas`");
    $sentencia->execute();
    $lista_entradas=$sentencia->fetchALL(PDO::FETCH_ASSOC);
    
include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($lista_entradas as $registros){ ?>

                <tr class="">
                    <td scope="col"><?php echo $registros['ID'];?></td>
                    <td scope="col"><?php echo $registros['fecha'];?></td>
                    <td scope="col"><?php echo $registros['titulo'];?></td>
                    <td scope="col"><?php echo $registros['descripcion'];?></td>
                    <td scope="col">
                    <img width="50" src="../../../assets/img/about/<?php echo $registros['imagen'];?>"/></td>
                    <td scope="col">
                    <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID'];?>" role="button">Editar</a>
                            |
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID'];?>" role="button">Eliminar</a>
                    </td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
    

    </div>
    <div class="card-footer text-muted">
    </div>
</div>


<?php include("../../templates/footer.php");?>
