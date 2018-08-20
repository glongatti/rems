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
  <style media="screen">
  #errmsg
  {
    color: red;
  }
  </style>

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
        if (@$_POST['txt_action'] == "update") {
          $products_info = [
            'id' => @$_POST['product_id'],
            'name' => @$_POST['product_name'],
            'price' => @$_POST['product_price'],
            'inputs' => @$_POST['product_inputs'],
            'link' => @$_POST['product_link']
          ];


          $db = new Conn();
          $db_conn = $db->openConn();
          $query = $db_conn->prepare("UPDATE products SET name = :name, price = :price, inputs = :inputs, image_url = :image_url WHERE product_id = :id");
          $query->bindParam("id", $products_info['id']);
          $query->bindParam("name", $products_info['name']);
          $query->bindParam("price", $products_info['price']);
          $query->bindParam("inputs", $products_info['inputs']);
          $query->bindParam("image_url", $products_info['link']);
          $query->execute();

          echo "<div class='alert alert-success' role='alert'>O item foi editado com sucesso! <a href='products.php'> Clique aqui para voltar</a></div>";
        } elseif (@$_POST['txt_action'] == "create") {
          $products_info = [
            'id' => @$_POST['product_id'],
            'name' => @$_POST['product_name'],
            'price' => @$_POST['product_price'],
            'inputs' => @$_POST['product_inputs'],
            'link' => @$_POST['product_link']
          ];


          $db = new Conn();
          $db_conn = $db->openConn();
          $query = $db_conn->prepare("INSERT INTO products(name,price,inputs,sales_number,image_url) VALUES (:name,:price,:inputs,0,:image_url)");

          $query->bindParam("name", $products_info['name']);
          $query->bindParam("price", $products_info['price']);
          $query->bindParam("inputs", $products_info['inputs']);
          $query->bindParam("image_url", $products_info['link']);
          $query->execute();

          echo "<div class='alert alert-success' role='alert'>O item foi criado com sucesso!<a href='products.php'> Clique aqui para voltar</a></div>";
        }

        if (@$_GET['action'] == "create") {
          ?>

          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-pencil-alt"></i> &nbsp; Criação de Produto &nbsp;</div>
              <div class="card-body">
                <form action="edit.php" method="POST">
                  <div class="row">
                    <div class="col">
                      <label for="name">Nome do Produto:</label>
                      <input type="text" class="form-control" id="product_name" name="product_name" required="true" >
                    </div>

                    <div class="col">
                      <label for="price">Preço do Produto:</label>
                      <input type="text" class="form-control" id="product_price" name="product_price" required="true"><span id="errmsg"></span>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <label for="inputs">Insumos:</label>
                      <input type="text" class="form-control" id="product_inputs" name="product_inputs" >
                    </div>

                    <div class="col">
                      <label for="link">Link da Imagem:</label>
                      <input type="text" class="form-control" id="product_link" name="product_link" required="true">
                      <input type="hidden" name="product_id" >
                      <input type="hidden" name="txt_action" value="create">
                    </div>
                  </div><br>
                  <button type="submit" class="btn btn-default">Criar</button>
                </form>
              </div>
            </div>



            <?php
          } elseif (@$_GET['action'] == "edit") {

            if (!empty($_GET['product_id'])) {


              $db = new Conn();
              $db_conn = $db->openConn();
              $query = $db_conn->prepare("SELECT * FROM products WHERE (product_id=:id)");
              $query->bindParam("id", $_GET['product_id']);
              $query->execute();

              if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_OBJ);
                //var_dump($result);
              }
              ?>

              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-pencil-alt"></i> &nbsp; Edição de Produto &nbsp;</div>
                  <div class="card-body">
                    <form action="edit.php" method="POST">
                      <div class="row">
                        <div class="col">
                          <label for="name">Nome do Produto:</label>
                          <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $result->name; ?>">
                        </div>

                        <div class="col">
                          <label for="price">Preço do Produto:</label>
                          <input type="text" class="form-control" id="product_price" name="product_price" value="<?php echo $result->price; ?>"><span id="errmsg"></span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <label for="inputs">Insumos:</label>
                          <input type="text" class="form-control" id="product_inputs" name="product_inputs" value="<?php echo $result->inputs; ?>">
                        </div>

                        <div class="col">
                          <label for="link">Link da Imagem:</label>
                          <input type="text" class="form-control" id="product_link" name="product_link" value="<?php echo $result->image_url; ?>">
                          <input type="hidden" name="product_id" value="<?php echo $result->product_id; ?>">
                          <input type="hidden" name="txt_action" value="update">
                        </div>
                      </div><br>
                      <button type="submit" class="btn btn-default">Editar</button>
                    </form>
                  </div>
                </div>
                <?php
              }
            } elseif (@$_GET['action'] == "delete") {

              $db = new Conn();
              $db_conn = $db->openConn();
              $query = $db_conn->prepare("DELETE FROM products WHERE (product_id=:id)");
              $query->bindParam("id", $_GET['product_id']);
              $query->execute();

              echo "Produto " . $_GET['product_id'] . " deletado com sucesso! <a href='products.php'> Clique aqui para voltar</a>";
            }
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
      $(document).ready(function () {
        //called when key is pressed in textbox
        $("#product_price").keypress(function (e) {
          //if the letter is not digit then display error and don't type anything
          if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $("#errmsg").html("Apenas números!").show().fadeOut("slow");
            return false;
          }
        });
      });
      </script>
    </body>

    </html>
