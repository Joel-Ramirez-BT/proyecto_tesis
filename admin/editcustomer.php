<?php
  include("../functions.php");
  include("../config.php");

  if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
    header("Location: login.php");

  if($_SESSION['user_level'] != "admin")
    header("Location: login.php");

  if (!empty($_POST['role'])) {
    $role = $sqlconnection->real_escape_string($_POST['role']);
    $staffID = $sqlconnection->real_escape_string($_POST['staffID']);

    $updateRoleQuery = "UPDATE tbl_staff SET role = '{$role}'  WHERE staffID = {$staffID}  ";

      if ($sqlconnection->query($updateRoleQuery) === TRUE) {
        echo "";
      } 

      else {
        //handle
        echo "someting wong";
        echo $sqlconnection->error;
      }
  }
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Administración de Mesas - Brazos Tecnologias</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">


    <script>
		function Eliminar() {
			// Mostrar una alerta con un mensaje de confirmación y botones Aceptar y Cancelar
				window.location.href = "addtables.php";
			} 
	</script>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Restaurante | Casa de Watta</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!------------------ Sidebar ------------------->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel de Control</span>
          </a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link" href="menu.php">
            <i class="fas fa-fw fa-utensils"style="color: #2dfb31;"></i>
            <span>Menú</span></a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="../staff/order.php">
            <i class="fas fa-duotone fa-table"style="color: #2dfb31;"></i>
            <span>Ordenar</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="facturar.php">
          <i class="fas fa-regular fa-print" style="color: #2dfb31;"></i>
            <span>Facturar</span></a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link" href="sales.php">
            <i class="fas fa-fw fa-chart-area"style="color: #2dfb31;"></i>
            <span>Finanzas</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="tables.php">
            <i class="fas fa-duotone fa-table" style="color: #2dfb31;"></i>
            <span>Mesas</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="customer.php">
            <i class="fas fa-fw fa-user-circle"></i>
            <span>Clientes</span>
          </a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-power-off" style="color: #FF0000;"></i>
            <span>Cerrar Sesión</span>
          </a>
        </li>
        </ul>


      <div id="content-wrapper">
        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Panel de Control</a>
            </li>
            <li class="breadcrumb-item active">clientes</li>
          </ol>

          <h1>Editando Cliente</h1>
<hr>
<p>Gestión de Clientes.</p>

<div class="row">
  <div class="col-lg-6">
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-chart-bar"></i>
        Agregar cliente
      </div>
      <div class="card-body">
        <form action="updatecustomer.php" method="POST">
        <?php
            require("../config.php");
  
            $conn = new mysqli($servername, $username, $password, $dbname);
          
            $consulta = "SELECT * FROM tbl_customer where id = '{$_GET["id"]}'";
            $resultado = mysqli_query($conn, $consulta);

            $row = mysqli_fetch_array($resultado);
             
            ?>
          </tbody>
          <div class="form-group">
            <label for="id"></label>
            <input type="hidden" name="id" id="id" class="form-control"  value="<?php echo $row['id']; ?>" required>
          </div>
          <div class="form-group">
            <label for="nombre_cliente">Nombre del Cliente:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ejemplo: Joel Ramirez" value="<?php echo $row['nombre']; ?>" required>
          </div>
          <div class="form-group">
              <label for="direccion">Dirección:</label>
              <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese una direccion" value="<?php echo $row['direccion']; ?>" required>
            </div>
            <div class="form-group">
              <label for="telefono">Telefono:</label>
              <input type="tel" name="telefono" id="telefono" class="form-control" placeholder="Ingrese un número" value="<?php echo $row['telefono']; ?>">
            </div>
            <div class="form-group">
              <label for="capacidad">Fecha de Creacion:</label>
              <input type="date" name="fecha_creacion" id="fecha_creacion" class="form-control" placeholder="" value="<?php echo $row['id']; ?>" required  >
            </div>
          
          <div class="text-center">
            <input class="btn btn-success" type="submit" name="agregar" id="agregar" value="Editar">
          </div>
        </form>
      </div>
    </div>
  </div>



        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Sistema de Restaurante Brazos Tecnologías</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>


    
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">¿Deseas cerrar tu sesión?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="logout.php">Cerrar Sesión</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

  </body>

</html>