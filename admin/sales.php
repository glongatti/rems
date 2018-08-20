<?php
include '../class/Conn.class.php';
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

    <script type="text/javascript">
        var products_array = new Array();
        var total_value = 0;
    </script>

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
                    if (empty($_GET['action'])) {


                        $db = new Conn();
                        $db_conn = $db->openConn();

                        if (empty(@$_GET['sales_date'])) {
                            $sql = "SELECT * FROM sales";
                        } else {
                            $sql = "SELECT * FROM sales WHERE sale_date = '{$_GET['sales_date']}'";
                        }

                        //  echo $sql;
                        ?>
                        <!-- DataTables Example -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-table"></i>
                                Tabela de Vendas &nbsp; <button class="btn" onclick="location.href = 'sales.php?action=create'">Registrar Venda</button>
                                <div class="col-md-3 mb-3">
                                    <form action="sales.php">
                                        Filtrar vendas por data:
                                        <input type="date" class="form-control"  name="sales_date"><br>
                                        <button class="btn btn-primary" type="submit">Filtrar</button>
                                        <button type="button"class="btn" onclick="location.href = 'sales.php'">Limpar</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID da Venda</th>
                                                <th>Produtos da Venda</th>
                                                <th>Quantidade do Produto</th>
                                                <th>Preço Unitário</th>
                                                <th>Valor total</th>
                                                <th>Data da Venda</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID da Venda</th>
                                                <th>Produtos da Venda</th>
                                                <th>Quantidade do Produto</th>
                                                <th>Preço Unitário</th>
                                                <th>Valor total</th>
                                                <th>Data da Venda</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
    <?php
    foreach ($db_conn->query($sql) as $row) {
        $data_nova = explode("-", $row['sale_date']);
        $data_final = [
            "dia" => substr($data_nova[2], 0, 2),
            "mes" => $data_nova[1],
            "ano" => $data_nova[0]
        ];
        ?>
                                                <tr>
                                                    <td><?php echo $row['sale_id']; ?></td>
                                                    <td><?php echo $row['sale_product']; ?></td>
                                                    <td><?php echo $row['product_amount']; ?></td>
                                                    <td>R$<?php echo $row['unit_price']; ?></td>
                                                    <td>R$<?php echo $row['sale_value']; ?></td>
                                                    <td><?php echo $data_final["dia"] . "/" . $data_final["mes"] . "/" . $data_final["ano"]; ?></td>
                                                </tr>
    <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
<?php
} // FIM EMPTY ACTION
elseif (@$_GET['action'] == "create") {

    $db = new Conn();
    $db_conn = $db->openConn();
    $sql = "SELECT * FROM products";
    ?>

                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-pencil-alt"></i> &nbsp;Registro de Venda &nbsp;</div>
                            <div class="card-body">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Preço</th>
                                            <th>Insumos</th>
                                            <th>Ação</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Preço</th>
                                            <th>Insumos</th>
                                            <th class="sale_total">TOTAL: R$00.00</th>


                                        </tr>
                                    </tfoot>
                                    <tbody>
    <?php foreach ($db_conn->query($sql) as $row) { ?>
                                            <tr>
                                                <td><?php echo $row['product_id']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td>R$<?php echo $row['price']; ?></td>
                                                <td><?php echo $row['inputs']; ?></td>
                                                <td><button class="btn btn-success btn-add" type="button"data-toggle="modal" data-target="#exampleModal" onclick="addProduct('<?php echo $row['product_id']; ?>', '<?php echo $row['name']; ?>',<?php echo $row['price']; ?>)">Adicionar Venda</button>&nbsp;</td>

                                            </tr>
                                        <script type="text/javascript">
                                            products_array[<?php echo json_encode($row['product_id']); ?>] = [<?php echo json_encode($row['name']); ?>,<?php echo json_encode($row['price']); ?>, 0];
                                        </script>

    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Histórico</div>
                            <div class="card-body historic">

                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Registro de Venda</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="sales_register.php" method="POST">
                                            Digite a quantidade do Produto: <input type="text" name="product_amount" id="product_amount" value="">
                                            <input type="hidden" name="product_id" id="product_id" value="">
                                            <input type="hidden" name="product_name" id="product_name" value="">
                                            <input type="hidden" name="product_price" id="product_price" value="">


                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-default">Registrar Venda</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>




    <?php
}// FIM ACTION CRIAR
?>

                </div>
                <!-- /.container-fluid -->

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


        <script type="text/javascript">


            function addProduct(productId, productName, productPrice) {
                $('#product_id').val(productId);
                $('#product_name').val(productName);
                $('#product_price').val(productPrice);
            }


        </script>

    </body>

</html>
