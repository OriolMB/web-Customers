<?php
    include "includes/bootstrap.php";
    include "includes/connexio.php";
    $operacio="";
    if (isset($_REQUEST["operacio"])) $operacio=$_REQUEST["operacio"];
    if ($operacio!="new" && $operacio!="edit") header("Location: list_customers.php");
    obrirConnexioBD();
    if ($operacio=="edit") {
        if (isset($_REQUEST["id_customer"])) {
            $id_customer=$_REQUEST["id_customer"];
            $sql = "SELECT * FROM customers WHERE id_customer=" . $id_customer;
            $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                tancarConnexioBD();
                header("Location: list_customers.php?");
            } else {
                $row = $result->fetch_assoc();
            }
        } else {
            header("Location: list_customers.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php bsHead("Llistat"); ?>
    <body>
	<div class="container">
		<h3><center><?php if ($operacio=="new") echo "New Customer"; else echo "Modify Customer"; ?></center></h3>
        <br>
		<div class="row myform">
			<div class="col-md-7 col-md-offset-3">
                <div class="alert alert-info" role="alert">
				<form name="form_customers" action="update_customers.php?operacio=<?=$operacio?>" role="form" method="post">
					<div class="form-group">
						<label class="control-label" for="id_customer">Number of Customer:</label>
						<input required type="number" name="id_customer" id="id_incidencia" min="1" max="10000" class="form-control" placeholder="Introduce the number of Customer" value="<?=$row["id_customer"]?>"<?php if ($operacio=="edit") echo "readonly" ?>/>
					</div>
                    <div class="form-group">
						<label class="control-label" for="surname">Surname:</label>
						<input required type="text" name="surname" id="surname" maxlength="25" class="form-control" placeholder="Introduce the surname" value="<?php if (isset($row)) echo $row["surname"]?>"/>
					</div>
					<div class="form-group">
						<label class="control-label" for="name">Name:</label>
						<input required type="text" name="name" id="name" maxlength="25" class="form-control" placeholder="Introduce the name" value="<?php if (isset($row)) echo $row["name"]?>"/>
					</div>
					<div class="form-group">
						<label class="control-label" for="phonenumber">Phone Number:</label>
						<input required type="text" name="phonenumber" id="phonenumber" maxlength="25" class="form-control" placeholder="Introduce the phone number" value="<?php if (isset($row)) echo $row["phonenumber"]?>"/>
					</div>
                    <br>
					<div class="form-inline">
						<div class="form-group">
							<label class="control-label" for="mail">Mail:</label>
							<input required type="text" name="mail" id="mail" maxlength="50" class="form-control" placeholder="Introduce the mail" value="<?php if (isset($row)) echo $row["mail"]?>"/>
						</div>
                    <br>
					<div class="form-inline">
                        <div class="form-group">
                                <label class="control-label" for="address">Address:</label>
                                <input required type="address" name="address" id="address" class="form-control" placeholder="Introduce the address" value="<?php if (isset($row)) echo $row["address"]?>"/>
                        </div>
                    </div>
                    <br>
					<div class="form-inline">
						<div class="form-group">
							<label class="control-label" for="parroquia">Parroquia:</label>
							<input required type="text" name="parroquia" id="parroquia" min="1" max="31" class="form-control" placeholder="parroquia" value="<?php if (isset($row)) echo $row["parroquia"]?>"/>
						</div>
					</div>
                    <div class="form-group">
                        <label class="control-label" for="parroquia">Parròquia:</label>
                <?php   $sql = "SELECT * FROM parroquies ORDER BY id_parroquia;";
                        $resultSelect = $conn->query($sql);
                        while($rowSelect = $resultSelect->fetch_assoc()) { ?>
                            <div class="radio">
                               <label>
                                    <input type="radio" name="parroquia" id="parroquia" value="<?=$rowSelect["id_parroquia"]?>"<?php if (isset($row)) if ($row["parroquia"]==$rowSelect["id_parroquia"]) echo " checked";?>>
                                    <?=$rowSelect["nom_parroquia"]?>
                               </label>
                            </div>
                <?php   } ?>
                    </div>
            
                    
                    <br>
                    <div class="form-group">
                        <center>
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-send"></span> Enviar</button>
                            <button type="button" onClick="window.print();" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span> imprimir</button>
                        </center>
                    </div>
				</form>
			</div>
            </div>
    	</div>
	</div>
    <?php tancarConnexioBD(); ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
