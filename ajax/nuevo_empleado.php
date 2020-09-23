<?php

	if (empty($_POST['nombre'])) {
           $errors[] = "Nombre vacío";
        } else if (!empty($_POST['nombre'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$apellido=mysqli_real_escape_string($con,(strip_tags($_POST["apellidos"],ENT_QUOTES)));
		$id=mysqli_real_escape_string($con,(strip_tags($_POST["id"],ENT_QUOTES)));
		$salario=mysqli_real_escape_string($con,(strip_tags($_POST["salario"],ENT_QUOTES)));
		
		 $sql = "SELECT * FROM persona WHERE id = '" . $id . "';";
                $query_check_user_name = mysqli_query($con,$sql);
				$query_check_user=mysqli_num_rows($query_check_user_name);
                if ($query_check_user == 1) {
                    $errors[] = "Lo sentimos , el ID ya está en uso.";
                } else {
		$sql="INSERT INTO persona (id, nombre, apellido) VALUES ('$id','$nombre','$apellido')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$sql2="INSERT INTO empleado (id, salario) VALUES ('$id','$salario')";
		$query_new_insert2 = mysqli_query($con,$sql2);
				$messages[] = "Empleado ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>