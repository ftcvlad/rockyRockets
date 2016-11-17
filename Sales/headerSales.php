
<script src="logout.js"></script>
<link rel="stylesheet" href="headerSales.css">

<nav class="navbar navbar-default">
    <div class="container-fluid">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hoverable" href="staffprofile.php"><?php echo $_SESSION['user']->username.", Seller" ?></a>



        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle hoverable" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Stock<span class="caret"></span></a>
                    <ul class="dropdown-menu">

                        <li><a href="hCheck_stock.php">Check Stock in All Locations</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle hoverable" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Customer<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="customerpurchases.php">Check Customer Purchases</a></li>


                    </ul>
                </li>




            </ul>


            <ul class="nav navbar-nav navbar-right">
                <li><a class='hoverable'><span onclick='logoutF();'>Logout</span></a></li>
            </ul>


        </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->

</nav>