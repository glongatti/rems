<?php
include 'class/Conn.class.php';
session_start();
$error_message = '';
$user_email = @$_POST['email'];
$user_password = @$_POST['password'];

if (!empty($user_email) && !empty($user_password)) {
    try {
        $db = new Conn();
        $db_conn = $db->openConn();
        $query = $db_conn->prepare("SELECT * FROM users WHERE (email=:email) AND password=:password");
        $query->bindParam("email", $user_email, PDO::PARAM_STR);
        $query->bindParam("password", $user_password, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            // echo 'LOGADO';
            $result = $query->fetch(PDO::FETCH_OBJ);
            $_SESSION['user_id'] = $result->id; // Set Session
            // header("Location: home/index.php");

            if ($result->acess_level == 1) {
                header("Location: home/index.php");
            } else {
                header("Location: admin/products.php");
            }
            echo $result->acess_level;
        } else {
            $error_message = "Dados incorretos para fazer login, por favor tente novamente.";
        }
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
?>


<?php
include 'includes/scripts.php';
include 'includes/styles.php';
?>



<html>
    <head>






        <!------ MEUS INCLUDES ---------->


    </head>




    <body id="LoginForm">
        <div class="container">
            <h1 class="form-heading">Rotary Event Manager System</h1>
            <div class="login-form">
                <div class="main-div">
                    <div class="panel">
                        <h2>Página de Acesso</h2>
                        <p>Por favor, entre com os seus dados de acesso.</p>
                    </div>
                    <form id="Login" action="login.php" method="post">

                        <div class="form-group">


                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Endereço de E-mail">

                        </div>

                        <div class="form-group">

                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Senha">

                        </div>
                        <?php
                        if ($error_message != "") {
                            echo '<div class="alert alert-danger"><strong>Erro: </strong> ' . $error_message . '</div>';
                        }
                        ?>
                        <br>
                        <button type="submit" class="btn btn-primary">Fazer Login</button>

                    </form>
                </div>

            </div></div></div>
</body>
</html>
