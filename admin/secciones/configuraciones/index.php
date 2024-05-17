<?php 
include("../../bd.php");

  //seleccionar registros
  $sentencia=$conexion->prepare("SELECT * FROM `tbl_configuraciones`");
  $sentencia->execute();
  $lista_configuraciones=$sentencia->fetchALL(PDO::FETCH_ASSOC);


include("../../templates/header.php");?>

<div class="card">
    <div class="card-header">
        Configuracion
    </div>
    <div class="card-body">
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre de la configuracion</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($lista_configuraciones as $registros){ ?>
                <tr class="">
                    <td><?php echo $registros['ID']?></td>
                    <td><?php echo $registros['nombreconfiguracion']?></td>
                    <td><?php echo $registros['valor']?></td>
                    <td><a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID'];?>" role="button">Editar</a>
                            
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
    

    </div>
    <div class="card-footer text-muted">
    </div>
</div>



<?php include("../../templates/footer.php");?>