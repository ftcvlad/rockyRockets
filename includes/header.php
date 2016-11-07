<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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


            <div class="navbar-form navbar-left"  >
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="Search" name="searchUsername">
                </div>
                <button type="submit" class="btn btn-default"  onclick="">Submit</button>
            </div>




            <ul class="nav navbar-nav navbar-right">



                <?php


                if (isset($_SESSION['user'])){
                    echo "<li><a><span onclick='logoutF();'>Logout</span></a></li>";
                }
                else{

                    echo "<li><a href='Register.php'>Register</a></li>"."\n";
                    echo "<li><a href='Login.php'>Login</a></li>"."\n";
                }

                ?>



            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>