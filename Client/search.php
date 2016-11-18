<?php
//	session_start();
//    include '../includes/db.php';
//	include 'nav.php';
//
//	$output = '';
//
//	if(isset($_POST['search'])) {
//		$searchq = $_POST['search'];
//		$searchq = preg-replace("#[^0-9a-z]#i", "", $searchq);
//
//		$query = mysql_query("SELECT * FROM differentItem
//		WHERE Description LIKE '%$searchq%'
//		OR Brand LIKE '%$searchq%'
//		OR Price LIKE '%$searchq%'");
//
//		//Counting how many results.
//		$count = mysql_num_rows($query);
//
//		if($count == 0){
//			$output = 'Your search found no items.';
//		}
//		else{
//			while($row = mysql_fetch_array($query)) {
//				$Description = $row['Description'];
//				$Brand = $row['Brand'];
//				$Price = $row['Price'];
//
//				$output .= '<div> '.$Description.' '.$Brand.' '.$Price.';
//			}
//		}
//
//		}
//	}
//
//	$i=0;
//		  while($rows=mysqli_fetch_array($resultSet)){
//			$i++;
//			$Description = $rows('Description');
//			$Price = $rows('Price');
//			$Brand = $rows('Brand');
//
//			echo"
//			<div class='col-sm-6 col-md-4'>
//			<div class='thumbnail'>
//			<h3 style='padding: 0px 10px;'>$Description</h3>
//			<img src='$image' width='300' height='300' style='padding: 10px 5px;' />
//
//
//			<div class='modal fade' id='$i' tabindex='-1' role='dialog'>
//			<div class='modal-dialog' role='document'>
//				<div class='modal-content'>
//					<div class='modal-header'>
//						<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
//						<h4 class='modal-title'>$Description</h4>
//					</div>
//						<div class='modal-body'>
//							<img src='$ImagePath' width='300' height='300' alt='Lang'>
//						</div>
//					<div class='modal-footer'>
//						<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
//						<button type='button' class='btn btn-primary'>Purchase</button>
//					</div>
//				</div><!-- /.modal-content -->
//			</div><!-- /.modal-dialog -->
//			</div><!-- /.modal -->
//
//
//
//			<p><button type='button' class='btn btn-primary btn-lg' data-toggle='modal' data-target='#$i' >
//			More info
//			</button></p>
//
//			</div>
//			</div>
//
//
//	  ";
//		  }
//
//
//
//header("Location: SearchResults.php");
//
//
//?>
////
////
