<?php 
/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos


if (isset($_GET['id'])){
		$id_empleado=intval($_GET['id']);
		$query=mysqli_query($con, "select * from persona where id='".$id_empleado."'");
		$count=mysqli_num_rows($query);
		if ($count==1){
			if ($delete1=mysqli_query($con,"DELETE FROM persona WHERE id=".$id_empleado."")){
				$delete2=mysqli_query($con,"DELETE FROM empleado WHERE id=".$id_empleado."");
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else{?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento el ID no se encuentra
			</div>
		<?php }
	}
		?>