
<?php
session_start();
include '../class/Conn.class.php';
$db = new Conn();
$db_conn = $db->openConn();
$sql = "SELECT * FROM products";
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Rotary Event Manager System</title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/4-col-portfolio.css" rel="stylesheet">

    </head>

    <body>

        <?php include 'includes/nav.php'; ?>

        <!-- Page Content -->
        <div class="container">

            <!-- Page Heading -->
            <h1 class="my-4">Seja bem-vindo(a),
                <small>faça o seu pedido aqui!</small>
            </h1>

            <div class="row">
                <?php
                foreach ($db_conn->query($sql) as $row) {
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top" src="<?php echo $row['image_url']; ?>" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#"><?php echo $row['name']; ?></a>
                                </h4>
                                <p class="card-text"><?php echo $row['inputs']; ?></p>
                            </div>
                        </div>
                    </div>

    <?php
}
?>
            </div>
        </div>
        <!-- /.container -->

        <!-- Footer -->
<?php include 'includes/footer.php'; ?>

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>

</html>
