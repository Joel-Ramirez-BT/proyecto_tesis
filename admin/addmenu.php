<?php
	
	//Añadir nuevo menu (categorias)
	if (isset($_POST['addmenu'])) {

		if (!empty($_POST['menuname'])) {
			$menuname = $sqlconnection->real_escape_string($_POST['menuname']);

			$addMenuQuery = "INSERT INTO tbl_menu (menuName) VALUES ('{$menuname}')";

			if ($sqlconnection->query($addMenuQuery) === TRUE) {
				header("Location: menu.php");
			} else {
				
				echo "Algo salió mal";
			}
		}

		
		else {
			echo "No lo dejes vació ";
		}

	}


?>