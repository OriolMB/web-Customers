<?php
    include "includes/bootstrap.php";
    include "includes/connexio.php";
    $operacio="";
    if (isset($_REQUEST["operacio"])) $operacio=$_REQUEST["operacio"];
    if ($operacio!="new" && $operacio!="edit") header("Location: list_customers.php");
    $id_customer=$_REQUEST["id_customer"];
	$surname=$_REQUEST["surname"];
	$name=$_REQUEST["name"];
	$phonenumber=$_REQUEST["phonenumber"];
	$mail=$_REQUEST["mail"];
    $address=$_REQUEST["address"];
	$parroquia=$_REQUEST["parroquia"];
    if ($operacio=="new") {
        $sql="INSERT INTO customers (id_customer,surname,name,phonenumber,mail,address,parroquia) VALUES ($id_customer, \"$surname\", \"$name\", \"$phonenumber\", \"$mail\", \"$address\", \"$parroquia\");";
    } else {
        $sql="UPDATE customers SET surname=\"$surname\",name=\"$name\",phonenumber=\"$phonenumber\",mail=\"$mail\",address=\"$address\",parroquia=\"$parroquia\" WHERE id_customer=$id_customer;";
    }
    obrirConnexioBD();
    if ($conn->query($sql) === TRUE) {
        tancarConnexioBD();
        header("Location: list_customers.php");
    } else { ?>
        <!DOCTYPE html>
        <html lang="en">
            <?php bsHead("Creat/modificat"); ?>
            <body>
                <div class="alert alert-danger" role="alert">
                    <h3>Error creant/modificant incidència</h3>
                    <p><?=$conn->error?></p>
                </div>
            </body>
        </html>
<?php
    }
    tancarConnexioBD();
?>
