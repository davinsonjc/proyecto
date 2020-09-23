<?php

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos


  $sql="SELECT * FROM  persona, empleado where persona.id=empleado.id group by persona.id";
    $query = mysqli_query($con, $sql);
    ?>
	<table>
                    <tr>
                      <td>ID</td>
                      <td>NOMBRE</td>
                      <td>APELLIDOS</td>
                      <td>SALARIO</td>
                    </tr>
                    <?php while ($row=mysqli_fetch_array($query)){ ?>
                     <tr>
                      <td><?php echo $row['id'];?></td>
                      <td><?php echo $row['nombre'];?></td>
                      <td><?php echo $row['apellido'];?></td>
                      <td><?php echo $row['salario'];?></td>
                    </tr>
                  <?php } ?>
                  </table>
			
		
			