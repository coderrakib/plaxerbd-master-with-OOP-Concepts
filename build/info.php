<?php 
  require_once ('admin/config.php');

  $t_id = (string) $_GET['Tid'];
  $tournament = new Tournament;
  $tournament->gettournament(['tournament_id','=',$t_id,'status','=',1]);
  $query      = $tournament->query;
  $result     = $query->fetch_assoc();

  $t_name     = $result['tournament_name'];
  $open       = $result['open_time'];
  $fee        = $result['entry_fee'];
  $type       = $result['tournament_type'];
  $map        = $result['tournament_map'];
  $player     = $result['players'];
  $level      = $result['level'];
  $start      = strtotime($result['start_time']);
  $prize      = $result['prize'];

  $date       = date("d M Y, h:i:sa", $start);

  $running    = new RunningTournament;
  $running->getrunning(['tournament_id','=',$t_id,'status','=',1]);
  $run_query  = $running->query;

  $row_count  = mysqli_num_rows($run_query);
?>
<!DOCTYPE html>
<html lang="en">
  <?php require_once ('includes/header.php'); ?>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
	  
  <?php require_once ('includes/chatbox.php'); ?>

  <?php require_once ('includes/navbar.php'); ?>

	  <section class="hero-wrap js-fullheight" style="background-image: url('images/garena_free_fire_2020_4k_hd.jpg');" data-section="home">
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
          <div class="col-md-6 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
            <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo $t_name; ?></h1>
            <div style="background:#000;padding:20px;opacity: 0.7;">
            	<div class="entry-fee">
            		<h6 style="color:#fff;">Registration Open Time</h6>
            		<p style="color:#fff;font-size:15px;">until <?php echo $open; ?></p>
            	  <h5 class="pb-0 mb-0" style="border-bottom:1px solid #fff;color:#fff;"><?php echo $row_count; ?></h5>
                <h4 class="pb-0 mb-0" style="color:#fff;"><?php echo $player; ?></h4>
                <h6 style="color:#fff;">Players</h6>
              </div>
            </div>
            <?php if($row_count <= $player){ ?>
              <p class="mt-3 mb-5"><a href="registration?Tid=<?php echo $t_id; ?>" class="btn btn-info py-2 px-4 text-light">Registration Open</a></p>
            <?php }else{ ?>
              <h6 class="ml-3 mt-2 mb-5">Registration FillUp</h6>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-counter ftco-no-pt ftco-no-pb img" id="">
    	<div class="container">
    		<div class="row d-md-flex align-items-center justify-content-end">
    			<div class="col-lg-12">
    				<div class="ftco-counter-wrap">
	    				<div class="row no-gutters d-md-flex align-items-center align-items-stretch">
			          <div class="col-md-6 d-flex justify-content-center counter-wrap ftco-animate">
			            <div class="block-18">
			              <div class="text">
			              	<h2 class="text-left pl-4 pr-4">Tournament Description</h2>
			              	<hr>
			              	<h5 class="text-left pl-4 pr-4"> Tournament Name : <?php echo $t_name; ?></h5>
			              	<h5 class="text-left pl-4 pr-4">Entry Fee : <?php echo $fee; ?> tk.</h5>
			              	<h5 class="text-left pl-4 pr-4">Tournament Type : <?php echo $type; ?></h5>
			              	<h5 class="text-left pl-4 pr-4">Tournament Map  : <?php echo $map; ?></h5>
			              	<h5 class="text-left pl-4 pr-4">Players   : <?php echo $player; ?></h5>
			              	<h5 class="text-left pl-4 pr-4">Level     : <?php echo $level; ?></h5>
			              	<h5 class="text-left pl-4 pr-4">Only for players in Bangladesh.</h5>
			              	<hr>
			              	<h6 class="text-left pl-4 pr-4">To register contact me through mobile at +8801715177188</h6>
			              </div>
			            </div>
			          </div>
			          <div class="col-md-6 d-flex justify-content-center counter-wrap ftco-animate">
			            <div class="block-18">
			              <div class="text">
                      <h2 class="text-left pl-4 pr-4">Tournament Description</h2>
                      <hr>
                      <h5 class="text-left pl-4 pr-4"> Tournament Start : <?php if($start == 0){
                      echo 'Start Soon.';}else{echo $date;} ?></h5>
			              	<h5 class="text-left pl-4 pr-4"> Prize Money : <?php echo $prize; ?> tk.</h5>
			              	<hr>
                      <h2 class="text-left pl-4 pr-4">Conditions / শর্ত</h2>

			              	<h6 style="font-size:17px;color:#292929; text-align: justify;" class="text-left pl-4 pr-4">Audi's level of free fire must be at the level set by the tournament. Anyone who registers outside the scheduled level of the tournament will be disqualified. In this case, the authorities will not be responsible.</h6>
			              	<h6 style="font-size:17px;color:#292929; text-align: justify;" class="text-left pl-4 pr-4">অবশ্যই খেলোয়ারের ফ্রি ফায়ারের আইডির লেভেল টুর্নামেন্টের নির্ধারিত লেভেলের মধ্যে হতে হবে। যদি কেউ টুর্নামেন্টের নির্ধারিত লেভেলের বাইরে রেজিষ্টেশন করে তবে তাকে ডিসকোয়ালিফাই করা হবে। এক্ষেত্রে কৃর্তপক্ষ কোনো দায়ী থাকবে না।</h6>
			              </div>
			            </div>
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