<?php
$server = "root";
$password = "";
$database = new PDO("mysql:host=localhost;dbname=my_database", $server, $password);
if (isset($_POST['send'])) {
    $name_u = $_POST['name_u'];
    $email = $_POST['email'];
    $sql = $database->prepare("INSERT INTO customers (name_u,email) VALUES(:name_u,:email)");
    $sql->bindParam('name_u', $name_u);   /* values :name and :email with bindparam for protection */
    $sql->bindParam('email', $email);
    // var_dump($sql -> errorInfo());  /* for detect error */
    if ($sql->execute()) {
        echo "<h3>Add Correct</h3>";
    } else {
        echo "<h3>Add not Correct</h3>";
    }
}
$getData = $database->prepare("SELECT * FROM  customers ORDER BY ID DESC");
// var_dump($getData -> errorInfo());  /* for detect error */
$getData->execute();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js' defer></script>
    <link rel="icon" href="whatsapp.png">
</head>

<body>
    <div class="form1">
        <form method="POST">
            <br>
            Name :<input type="text" name="name_u" required><br>
            E-mail:<input type="email" name="email" required><br>
            <button type="submit" name="send">SEND INFO</button>
        </form>
    </div>


    <!-- get data frpm database -->
    <div class="table1">
        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>NAME</td>
                    <td>E-MAIL</td>
                </tr>
            </thead>

            <body>
                <?php foreach ($getData as $result) { ?>
                    <tr>
                        <?php echo "<td>" . $result['id'] . "</td>" ?>
                        <?php echo "<td>" . $result['name_u'] . "</td>" ?>
                        <?php echo "<td>" . $result['email'] . "</td>" ?>
                    </tr>
                <?php }; ?>
            </body>

        </table>
    </div>

</body>