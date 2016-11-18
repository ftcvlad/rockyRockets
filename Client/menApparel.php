
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Male Apparel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>



<?php session_start(); include 'nav.php';?>

<h1>Male Apparel</h1>

<form action="shoppingCart.php">
<button class='btn btn-primary'>Shopping Cart</button><p>
</form>

<?php

include '../includes/db.php';

$query = "SELECT differentItem.Id,
differentItem.Description,
differentItem.Brand,
differentItem.Price,
differentItem.ImagePath,
differentItem.Discount,
differentItem.AvailableOnline,
apparelattribute.Id,
apparelattribute.Size,
apparelattribute.Color,
apparelattribute.ForMen
            FROM differentItem
			INNER JOIN apparelattribute
			ON differentItem.Id=apparelattribute.Id
			WHERE apparelattribute.ForMen ='1' OR apparelattribute.ForMen IS NULL;";

$stmt = $connection->prepare($query);
$stmt->execute();
$res = $stmt->get_result();

$i=0;

while($rows=mysqli_fetch_array($res)){
    $i++;

    $Id= $rows['Id'];
    $Description= $rows['Description'];
    $Brand= $rows['Brand'];
    $Price= $rows['Price'];
    $ImagePath = $rows['ImagePath']==NULL?"noImage.png":$rows['ImagePath'];
    $Discount = $rows['Discount'];
    $AvailableOnline = $rows['AvailableOnline'];
    $Size = $rows['Size'];
    $Color = $rows['Color'];


    echo" 
			<div class='col-sm-6 col-md-4'>
			<div class='thumbnail'>
			<h3 style='padding: 0px 10px;'>$Description</h3>
			<h4 style='padding: 0px 10px;'>£$Price</h3>
			<h4 style='padding: 0px 10px;'>$Brand</h3>
			<h4 style='padding: 0px 10px;'>$AvailableOnline available</h3>
			<img src=../ItemPictures/$ImagePath width='300' height='300' style='padding: 10px 5px;' />
			
<!-- From here until /modal is the pop-up which lets you see more information, buy it, etc. -->
<!-- ID variable here -->
			<div class='modal fade' id='$i' tabindex='-1' role='dialog'>
			<div class='modal-dialog' role='document'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						
			<!-- Update basket -->
				<!-- This is the name of the product -->
						<h3>$Brand</h3>
						<h4 class='modal-title'>$Description</h4>
					</div>

				<!-- This is the image of the item -->
				<!-- Image variable here -->
						<div class='modal-body' align='center'>
							<img src=../ItemPictures/$ImagePath width='300' height='300' style='padding: 10px 5px;' />
							<input type='hidden' value='$ImagePath' name='$ImagePath'>
							<h1>£$Price</h1>
							______
							<h3>Size: $Size</h3>
							<h4>$Color</h4>
						</div>

			<!-- This is the divider for the buttons in the script -->	
					<div class='modal-footer' style='padding: 20px 5px;'>
				
				
				<!-- This part offers a cancel option to close the pop-up -->
						<button type='button' class='btn btn-default' style='float: left;' data-dismiss='modal'>Cancel</button>
							
			<form action='addtoCart.php?'>
					<button type='submit' value='$Description' name='Description' class='btn btn-primary'>
					<input type='hidden' value='$Id' name='Id'>
					<input type='hidden' value='$Brand' name='Brand'>
					<input type='hidden' value='$Price' name='Price'>
					Add to basket</button>			
					</form>
					</div>

				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->  

			
			<!-- More info button to see more information about the product, buy it, etc. -->
			<p><button type='button' class='btn btn-primary btn-lg' data-toggle='modal' data-target='#$i' >
			More info
			</button></p>

			</div>
			</div>	
			
	  
	  ";


}




?>

	
</body>
</html>