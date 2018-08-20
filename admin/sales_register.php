<?php
include '../class/Conn.class.php';



$final_price = $_POST['product_price'] * $_POST['product_amount'];
$date = date('Y-m-d H:i:s');
$sale_info = [
  "product_id" => $_POST['product_id'],
  "product_name" => $_POST['product_name'],
  "product_amount" => $_POST['product_amount'],
  "product_price" => $_POST['product_price'],
  "product_final_price" => $final_price
];

// var_dump($sale_info);

$db = new Conn();
$db_conn = $db->openConn();


$query = $db_conn->prepare("INSERT INTO `sales`(`sale_product`, `product_amount`, `unit_price`,`sale_value`,`sale_date`) VALUES (:sale_product,:product_amount,:unit_price,:sale_value,:sale_date)");

$query->bindParam("sale_product", $sale_info['product_name']);
$query->bindParam("product_amount", $sale_info['product_amount']);
$query->bindParam("unit_price", $sale_info['product_price']);
$query->bindParam("sale_value", $sale_info['product_final_price']);
$query->bindParam("sale_date", $date);
$query->execute();

$query = $db_conn->prepare("SELECT * FROM products WHERE product_id=:product_id");
$query->bindParam("product_id", $sale_info['product_id']);
$query->execute();

if ($query->rowCount() > 0) {
  // echo 'LOGADO';
  $result = $query->fetch(PDO::FETCH_OBJ);
  $sales_number = $result->sales_number+$sale_info['product_amount'];
}


$query = $db_conn->prepare("UPDATE products SET sales_number = :sales_number WHERE product_id = :id");
$query->bindParam("sales_number", $sales_number);
$query->bindParam("id", $sale_info['product_id']);
$query->execute();

?>

<!DOCTYPE html>
<html lang="br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Dashboard</title>

  <?php include 'includes/styles.php'; ?>


</head>


<body id="page-top">

  <?php include 'includes/nav.php'; ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Painel</a>
          </li>
          <li class="breadcrumb-item active">Produtos</li>
        </ol>





        <?php
        echo "<div class='alert alert-success'>Venda registrada com sucesso! <a href='sales.php'>Clique aqui para voltar.</a></div>";
        include 'includes/footer.php';
        ?>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>




    <?php include 'includes/scripts.php'; ?>


  </body>

  </html>
