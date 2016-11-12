<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/Manage/manageStyles.css">

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


        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">





            <?php

            echo "<a id=\"personalPageLink\" href='' class=\"navbar-left\"  ><p>".$_SESSION['user']->username.", ".$_SESSION['user'] -> department."</p></a>";
            ?>

            <ul class="nav navbar-nav navbar-right">



                <?php

                    //here already authenticated
                    if (strcmp($_SESSION['user']->department,"Sales") ===0){
                        echo "<li><a href='/Manage/sales_specific/hCreateItem.php'><span >Create item</span></a></li>";
                        echo "<li><a href='/Manage/sales_specific/hOrderItem.php'><span >Order item</span></a></li>";
                    }
                    else if (strcmp($_SESSION['user']->department,"Hr") ===0){
                        echo "<li><a href='/Manage/hr_specific/mAddStaff.php'><span onclick=''>Add staff</span></a></li>";
                    }
                    echo "<li><a href='/Manage/mindex.php'><span >Search staff</span></a></li>";
                    echo "<li><a><span onclick='logoutF();'>Logout</span></a></li>";


                ?>



            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
