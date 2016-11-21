<script src="js/logout.js"></script>
<link rel="stylesheet" href="./css/navStyles.css">
<div class="jumbotron text-center" >
    <h1>Rocky Rackets</h1>
    <p>Tennis equipment to make a racket about!</p>
</div>

<div id="messageDiv">

</div>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Not sure what the heck this is -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>

    <!-- Navbar to the left -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="rackets.php" id="racket">Rackets</a></li>
        <li><a href="menApparel.php" id="man">Men's Apparel</a></li>
        <li><a href="womenApparel.php" id="woman">Women's Apparel</a></li>
		<li><a href="about.php" id="about">About Us</a></li>

      </ul >


	  
<!-- Search button
    <form class ="navbar-form navbar-right">
    <div class="form-group">
      <?php //include 'search.php';?>
    </div>
    </form>  -->
      
	  <!-- Navbar to the right -->
      <ul class="nav navbar-nav navbar-right">
      <li><a href="Index.php" id="home">Home</a></li>



          <?php if (isset($_SESSION['user']) && strcmp($_SESSION['user']->position,"customer")===0): ?>

              <li class="dropdown" >
                  <a href="#" class="dropdown-toggle hoverable" id="profile" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile<span class="caret"></span></a>
                  <ul class="dropdown-menu" >

                      <li><a href="viewOrders.php">View orders</a></li>
                      <li><a href="editProfile.php">Edit profile</a></li>
                      <li><a href="#" onclick='logoutF();'>Logout</a></li>

                  </ul>
              </li>
              <li><a href="shoppingCart.php" id="basket">Basket</a></li>

          <?php else: ?>
              <li><a href="../loginPage.php">Sign in</a></li>
          <?php endif; ?>



	  
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>