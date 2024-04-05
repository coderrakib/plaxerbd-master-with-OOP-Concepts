<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
	<div class="container">
	    <a class="navbar-brand" href="home">PL<span class="text-danger">A</span>XER</a>
      <a class="d-flex justify-content-center" href="live"><a href="#"><img src="images/live.png" width="65px"></a>
	      <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav nav ml-auto">
              <li class="nav-item"><a href="home" class="nav-link"><span>Home</span></a></li>
	          <li class="nav-item"><a href="winner_lists" class="nav-link"><span>Winner Lists</span></a></li>
	          <li class="nav-item"><a href="#contact-section" class="nav-link"><span>Contact</span></a></li>
            <?php 
              if(isset($_SESSION['player'])){

                $player_email = $_SESSION['player'];
                $getplayer    = new Players;
                $getplayer->getplayers(['email','=',$player_email]);
                $query        = $getplayer->query;
                $result       = $query->fetch_assoc();

                $name         = $result['f_name'];
            
            ?>
              <div class="dropdown">
                <li class="nav-item">
                  <a style="padding-top:10px;" href="#" class="nav-link text-light" data-toggle="dropdown"><img src="images/585e4bf3cb11b227491c339a.png" width="20px">&nbsp;&nbsp;<span style="font-size:14px;"><?php echo $name; ?></span></a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="profile">Your Profile</a>
                    <a class="dropdown-item" href="logout">Logout</a>
                  </div>
                </li>
              </div>
            <?php }else{ ?>
              <li class="nav-item"><a href="login" class="nav-link"><span>Login</span></a></li>
              <li class="nav-item"><a href="signup" class="nav-link"><span>Register</span></a></li>
            <?php } ?>
	        </ul>
	      </div>
	    </div>
	</nav>