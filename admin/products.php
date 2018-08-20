<?php
include '../class/Conn.class.php';
$db = new Conn();
$db_conn = $db->openConn();
$sql = "SELECT * FROM products";
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


                    <!-- DataTables Example -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-table"></i>
                            Tabela de Produtos &nbsp; <button class="btn"onclick="location.href = 'edit.php?action=create'">Novo Produto</button></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Preço</th>
                                            <th>Insumos</th>
                                            <th>Número de Vendas</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Preço</th>
                                            <th>Insumos</th>
                                            <th>Número de Vendas</th>
                                            <th>Ação</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?php foreach ($db_conn->query($sql) as $row) { ?>
                                            <tr>
                                                <td><?php echo $row['product_id']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td>R$<?php echo $row['price']; ?></td>
                                                <td><?php echo $row['inputs']; ?></td>
                                                <td><?php echo $row['sales_number']; ?></td>
                                                <td> &nbsp;<a href="edit.php?action=edit&product_id=<?php echo $row['product_id']; ?>"><i class="fas fa-pencil-alt"></i></a> &nbsp; <a href="edit.php?action=delete&product_id=<?php echo $row['product_id']; ?>"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                </div>
                <!-- /.container-fluid -->


                <div id="myModal" class="modal fade">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="icon-box">
                                    <i class="material-icons"></i>
                                </div>
                                <h4 class="modal-title">Você tem certeza?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Você quer mesmo deletar o produto? Esta ação não pode ser desfeita.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger">Deletar</button>
                                <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>


<?php include 'includes/footer.php'; ?>

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
