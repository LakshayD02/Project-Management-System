<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="container">
          <div class="col-md-2 text-right">
          <img src="images/logo.jpg" style="height:100px;width:100px" alt="">
          </div>
          <div class="col-md-8">
          <H3 style="color:white">DMLMHS RECORD MANAGEMENT SYSTEM</H3>
        </div>
        
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            
              <a href="#" class="dropdown-toggle btn btn-info" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-user"></span>
              <?php echo $_SESSION['fname'] ?>

              </a>
              <ul class="dropdown-menu">
                <li><a href="students.php">User config</a></li>
                <li><a href="logout.php">Logout</a></li>
              </ul>
             
          </ul>
          </div>
        </div>
      </div>
    </nav>