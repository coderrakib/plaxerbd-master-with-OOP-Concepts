<?php 
  require_once ('admin/config.php');
?>
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
            <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">FREE F<span style="color:#D4AF37;">I</span>RE TOURNAMENT</h1>
            <p><a href="login" class="btn btn-info py-2 px-4 text-light">Let's Play</a></p>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section" id="blog-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ftco-animate">
          <div class="card">
            <h3 class="card-header">Winners Lists</h3>
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered mt-3 text-center" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Player Name</th>
                      <th scope="col">Free Fire Id</th>
                      <th scope="col">Tournament Name</th>
                      <th scope="col">Tournament Level</th>
                      <th scope="col">Tournament Map</th>
                      <th scope="col">Prize Money</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Player Name</th>
                      <th scope="col">Free Fire Id</th>
                      <th scope="col">Tournament Name</th>
                      <th scope="col">Tournament Level</th>
                      <th scope="col">Tournament Map</th>
                      <th scope="col">Prize Money</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php

                        $winner_lists = new Winners;
                        $winner_lists->getwinner(['status','=',1]);
                        $query        = $winner_lists->query;

                        $sl = 1;

                        while ( $result = $query->fetch_assoc()) {
                          
                          $tournament_id = $result['tournament_id'];
                          $player_name   = $result['player_name'];
                          $freefire_id   = $result['freefire_id']; 
                      ?>
                    <tr>
                      <th scope="row"><?php echo $sl++; ?></th>
                      <td><?php echo $player_name; ?></td>
                      <td><?php echo $freefire_id; ?></td>
                      <?php

                        $tournament       = new Tournament;
                        $tournament->gettournament(['tournament_id','=',$tournament_id,'status','=',1]);
                        $tournament_query = $tournament->query;

                        if(mysqli_num_rows($tournament_query) >= 1){

                          while ($tournament_result = $tournament_query->fetch_assoc()) {

                            $tournament_name  = $tournament_result['tournament_name'];
                            $tournament_level = $tournament_result['level'];
                            $tournament_map   = $tournament_result['tournament_map'];
                            $tournament_prize = $tournament_result['prize'];
                          ?>
                          <td><?php echo $tournament_name; ?></td>
                          <td><?php echo $tournament_level; ?></td>
                          <td><?php echo $tournament_map; ?></td>
                          <td><?php echo $tournament_prize; ?></td>
                    </tr>
                    <?php }} ?>

                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div> 
          </div>
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