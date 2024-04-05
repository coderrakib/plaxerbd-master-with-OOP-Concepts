<?php require_once ('admin/config.php'); ?>
<!DOCTYPE html>
    <html lang="en">
    <?php require_once ('includes/header.php'); ?>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    
    <?php require_once ('includes/chatbox.php'); ?>

    <?php require_once ('includes/navbar.php'); ?>

	  <section class="hero-wrap js-fullheight" style="background-image: url('images/garena_free_fire_2020_4k_hd.jpg');" data-section="home">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
          <div class="col-md-6 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
            <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">FREE F<span style="color:#FFFF00;">I</span>RE TOURNAMENT</h1>
            <p><a href="login" class="btn btn-info py-2 px-4 text-light">Let's Play</a></p>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section" id="blog-section">
      <div class="container">
        <div class="row d-flex">
          <?php 
              $tournament = new OrderByTournament;
              $tournament->OrderBy(['status','=',1],'id','DESC');
              $query      = $tournament->query;

              while ($result = $query->fetch_assoc()) {
                  
              $name     = $result['tournament_name'];
              $id       = $result['tournament_id'];
              $fee      = $result['entry_fee'];  
              $prize    = $result['prize'];  
              $level    = $result['level'];  
              $map      = $result['tournament_map'];  
              $players  = $result['players'];  
              $image    = $result['image']; 

              $running    = new SingleRegistration;
              $running->getrunning(['tournament_id','=',$id,'status','=',1]);
              $run_query  = $running->query;

              $row_count  = mysqli_num_rows($run_query);
          ?>
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end bg-dark">
              <a href="info?Tid=<?php echo $id; ?>" class="block-20" style='background-image: url("admin/images/tournament/<?php echo $image; ?>");'>
              </a>
              <div class="text mt-3 float-right d-block">
                <h4 class="p-3 pb-0"><a class="text-light" href="info?Tid=<?php echo $id; ?>"><?php echo $name; ?></a></h4>
                <p style="font-size:20px;" class="pl-3 pr-3 mb-0">Entry Fee &#2547;<?php echo $fee; ?> and Prize Money &#2547;<?php echo $prize; ?></p>
                <p style="font-size:18px;" class="pl-3 pr-3 d-inline-block"><?php echo $level; ?></p>
                <p style="font-size:18px;" class="pl-3 pr-3 d-inline-block"><?php echo $map; ?> Map</p>
                <div class="d-flex align-items-center mt-4 meta">
                  <?php if($row_count <= $players){ ?>
	                 <p class="ml-3"><a href="registration?Tid=<?php echo $id; ?>" class="btn btn-primary">Registration Tournament</a></p>
                	<?php }else{ ?>
                    <h6 class="ml-3 mt-2">Registration FillUp</h6>
                  <?php } ?>
                  <p class="ml-auto mb-0 pr-3">
	                	<a href="#" class="mr-2">Players</a>
	                	<a href="#" class="meta-chat"><?php echo $row_count; ?>/<?php echo $players; ?></a>
	                </p>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
    
    <?php require_once ('includes/contact.php'); ?>
    
    <?php require_once ('includes/footer.php'); ?>
  
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
  
  <?php require_once ('includes/js.php'); ?>
  </body>
</html>