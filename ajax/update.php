<?php 
/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos


if (isset($_GET['id'])){
		$id_empleado=intval($_GET['id']);
		$query=mysqli_query($con, "select * from persona where id='".$id_empleado."'");
		$count=mysqli_num_rows($query);
		$row=mysqli_fetch_array($query);


		if ($count==1){ 
			$query2=mysqli_query($con, "select * from empleado where id='".$id_empleado."'");
			$row2=mysqli_fetch_array($query2);
			?>
			<br>
			<form class="form-horizontal" method="post" id="editar_empleado" name="editar_empleado">
			<div id="resultados_ajax2"></div>
			  <div class="form-group">
				<label for="mod_nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_nombre" name="mod_nombre" value="<?php echo $row['nombre']; ?>"  required>
					<input type="hidden" name="mod_id" id="mod_id">
				</div>
			  </div>
			   <div class="form-group">
				<label for="mod_apellidos" class="col-sm-3 control-label">apellidos</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_apellidos" value="<?php echo $row['apellido']; ?>" name="mod_apellidos">
				  <input type="hidden" value="<?php echo $id_empleado; ?>" name="mod_id">
				</div>
			  </div>
			   <div class="form-group">
				<label for="mod_salario" class="col-sm-3 control-label">Salario</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_salario" value="<?php echo $row2['salario']; ?>" name="mod_salario">
				</div>
			  </div>
		  </div>
		  <div class="modal-footer">
		  	<br>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  <div id="resultados_ajax2"></div>
		  </form>
		<?php } else{?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento el ID no se encuentra
			</div>
		<?php }
	}
		?>
<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript">    $( "#editar_empleado" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/editar_empleado.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_ajax2").html(datos);
      $('#actualizar_datos').attr("disabled", false);
      load(1);
      }
  });
  event.preventDefault();
})

            </script>