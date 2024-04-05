<?php 

  require_once ('admin/config.php');

  if(PlayerLogin::PlayerLoged() === false){

    header("Location:login");
    exit();
  }

  $t_id       = (string) $_GET['Tid'];

  if($t_id == 'Tournament75835'){

    header("Location:signup");

  }else{

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
  $counter    = $result['counter_code'];
  $start      = strtotime($result['start_time']);
  $prize      = $result['prize'];

  $date       = date("d M Y h:i:sa", $start);

  $running    = new SingleRegistration;
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
            		<h6 style="color:#fff;">Entry Fee &#2547;<?php echo $fee; ?> and Prize Money &#2547;<?php echo $prize; ?></h6>
            		<p style="font-size:15px; color:#fff;" class="pr-3 d-inline-block"><?php echo $level; ?></p>
                <p style="font-size:15px; color:#fff;" class="pr-3 d-inline-block"><?php echo $map; ?> Map</p>
                <h5 class="pb-0 mb-0" style="border-bottom:1px solid #fff;color:#fff;"><?php echo $row_count; ?></h5>
                <h4 class="pb-0 mb-0" style="color:#fff;"><?php echo $player; ?></h4>
                <h6 style="color:#fff;">Players</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-counter ftco-no-pt ftco-no-pb img" id="">
    	<div class="container">
    		<div class="row d-md-flex align-items-center justify-content-end">
    			<div class="col-lg-12">
    				<div class="ftco-counter-wrap multi_reg">
	    				<div class="row no-gutters d-md-flex align-items-center align-items-stretch">
			          <div class="col-lg-6 offset-lg-3 d-flex justify-content-center counter-wrap ftco-animate" style="border:1px solid #ddd;">
			            <div class="block-18">
			              <div class="text">
			              	<?php

                            if(isset($_POST['submit']) && $_POST['submit'] === 'Submit'){

                              if(isset($_SESSION['player'])){

                                $player_email = $_SESSION['player'];
                                $getplayer    = new Players;
                                $getplayer->getplayers(['email','=',$player_email]);
                                $query        = $getplayer->query;
                                $result       = $query->fetch_assoc();

                                $email_or_phone       = $result['email'];
                                $leder                = $result['id_code'];

                              }

                              $team_name       = $_POST['team_name'];
                              $p_2             = $_POST['p_2'];
                              $p_3             = $_POST['p_3'];
                              $p_4             = $_POST['p_4'];

                              date_default_timezone_set("Asia/Dhaka");
                              $start_time      = date("d M Y").' 6:00 PM';
                              $reg_date        = date("d M Y h:i:sa");
                              
                              $form_data      = array(

                                array(
                                
                                  'field_name'    => 'team_name',
                                  'name'          => 'Team Name',
                                  'required'      => true,
                                  'min'           => 5,
                                  'max'           => 50,
                                  'unique'        => true,
                                  'table'         => 'team_registration',
                                  'column'        => 'team_name'
                                ),

                                array(
                                
                                  'field_name'    => 'p_2',
                                  'name'          => 'Player Two Id',
                                  'required'      => true,
                                  'min'           => 5,
                                  'max'           => 50,
                                  'unique'        => true,
                                  'table'         => 'team_registration',
                                  'column'        => 'p_2_id'
                                ),

                                array(
                                
                                  'field_name'    => 'p_3',
                                  'name'          => 'Player Three Id',
                                  'required'      => true,
                                  'min'           => 5,
                                  'max'           => 50,
                                  'unique'        => true,
                                  'table'         => 'team_registration',
                                  'column'        => 'p_3_id'
                                ),

                                array(
                                
                                  'field_name'    => 'p_4',
                                  'name'          => 'Player Four Id',
                                  'required'      => true,
                                  'min'           => 5,
                                  'max'           => 50,
                                  'unique'        => true,
                                  'table'         => 'team_registration',
                                  'column'        => 'p_4_id'
                                ),

                              );

                              $validation     = new Validation;
                              $validation->validate($form_data);

                              if($validation->hasErrorPassed){
                              
                              $insert = new MultiRegistration;

                              if($insert->collectData($team_name,$email_or_phone,$leder,$p_2,$p_3,$p_4,$start_time,$reg_date)){

                                $message[] = "Successfully Submit";

                                $_SESSION['messages']   = $message;
                                $_SESSION['class_name'] = 'alert-success';

                                require_once ('messages.php');

                                echo "<script>
                                  setTimeout(function(){
                                      window.location.href = 'profile';
                                  }, 700);
                                </script>";

                              }else{

                                $message[] = "Something is Wrong .. Try again";

                                $_SESSION['messages']   = $message;
                                $_SESSION['class_name'] = 'alert-danger';

                                  require_once ('messages.php');
                                }   
                            }
                          }
                        ?>
                      <div class="text-left pl-4 pr-4">
                        <h5 class="pb-3">Team Up Registration</h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?Tid=$t_id"; ?>" method="POST">
                          <div class="form-group">
                            <label for="appointment_email" class="text-black">Team Name<span class="text-danger" style="display:inline;">*</span></label>
                            <input type="text" name="team_name" class="form-control">
                            <label for="appointment_email" class="text-black">Player-2 (Free Fire Id)<span class="text-danger" style="display:inline;">*</span></label>
                            <input type="text" name="p_2" class="form-control">
                            <label for="appointment_email" class="text-black">Player-3 (Free Fire Id)<span class="text-danger" style="display:inline;">*</span></label>
                            <input type="text" name="p_3" class="form-control">
                            <label for="appointment_email" class="text-black">Player-4 (Free Fire Id)<span class="text-danger" style="display:inline;">*</span></label>
                            <input type="text" name="p_4" class="form-control">
                          </div>
                          <div class="form-group text-center">
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                          </div>
                        </form>
                      </div>
			              </div>
			            </div>
			          </div>
		          </div>
		        </div>
          	</div>
        </div>
    	</div>
    </section>
    
    <!--<section class="ftco-counter ftco-no-pt ftco-no-pb img" id="">
    	<div class="container">
    		<div class="row d-md-flex align-items-center justify-content-end">
    			<div class="col-lg-12">
    				<div class="ftco-counter-wrap">
	    				<div class="row no-gutters d-md-flex align-items-center align-items-stretch">
			          <div class="col-lg-6 d-flex justify-content-center counter-wrap ftco-animate">
			            <div class="block-18">
			              <div class="text">
			              	<h2 class="text-danger"><img src="images/404_text_01.gif" width="280"></h2>
			              	<hr>
                      <h2>নিয়মাবলীঃ</h2>
			              	<h6 class="text-left pl-4 pr-4" style="color:#292929;">১। *২৪৭# ডায়াল করে বিকাশ মোবাইল মেন্যুতে যান</h6>
			              	<h6 class="text-left pl-4 pr-4" style="color:#292929;">২। “পেমেন্ট” সিলেক্ট করুন</h6>
			              	<h6 class="text-left pl-4 pr-4" style="color:#292929;">৩। আপনি যে মার্চেন্টকে পেমেন্ট করতে চান তার মার্চেন্ট বিকাশ একাউন্ট নাম্বার দিন</h6>
			              	<h6 class="text-left pl-4 pr-4" style="color:#292929;">৪। আপনি যে পরিমাণ টাকা পেমেন্ট করতে চান তার পরিমাণ লিখুন</h6>
			              	<h6 class="text-left pl-4 pr-4" style="color:#292929;">৫। আপনার কেনাকাটার একটি তথ্যসূত্র দিন (আপনি আপনার লেনদেনের উদ্দেশ্য একটি শব্দের মধ্যে উল্লেখ করতে পারেন, উদাহরণস্বরূপ, বিল)*</h6>
			              	<h6 class="text-left pl-4 pr-4" style="color:#292929;">৬। কাউন্টার নাম্বারটি লিখুন (কাউন্টারে অবস্থানরত বিক্রেতা আপনাকে নাম্বারটি বলে দেবেন)*</h6>
                      <h6 class="text-left pl-4 pr-4" style="color:#292929;">৭। আপনার বিকাশ মোবাইল মেন্যু পিনটি দিয়ে পেমেন্ট সম্পন্ন করুন</h6>
			              	<h6 class="text-left pl-4 pr-4" style="color:#292929;">৮। আপনি বিকাশ থেকে একটি কনফার্মেশন মেসেজ পাবেন।</h6>
                      <h6 class="text-left pl-4 pr-4" style="color:#292929;">৯। সেই মেসেজের Trxid আইডি ডান পাশের Your Trxid ঐখানে লিখে সাবমিট করতে হবে।</h6>
			              	<hr>
                      <h6 class="text-left pl-4 pr-4" style="color:#292929;">*যদি তথ্যসূত্র বা কাউন্টার নাম্বার কিংবা দুটোই প্রযোজ্য না হয়, তাহলে আপনি এই ধাপগুলো “০” প্রবেশ করিয়ে এরিয়ে যান।</h6>
			              	
			              </div>
			            </div>
			          </div>
			          <div class="col-lg-6 d-flex justify-content-center counter-wrap ftco-animate">
			            <div class="block-18">
			              <div class="text">
			              	<h2 class="text-danger"><img src="images/404_text_01.gif" width="280"></h2>
                      <hr>
                      <h2>টাকা পাঠাতে হবেঃ</h2>
                      <h5 class="text-left pl-4 pr-4">আমাদের মার্চেন্ট বিকাশ একাউন্ট নাম্বারঃ 01740006201 </h5>
                      <h5 class="text-left pl-4 pr-4">আমাদের একাউন্টের QR কোডঃ <img src="images/IMG_20201124_200225.jpg" width="250"> </h5>
			              	<h5 class="text-left pl-4 pr-4">আমাদের কাউন্টার নাম্বারঃ <?php //echo $counter; ?> </h5>
			              	<?php

                            /*if(isset($_POST['submit']) && $_POST['submit'] === 'Submit'){

                              if(isset($_SESSION['player'])){

                                $player_email = $_SESSION['player'];
                                $getplayer    = new Players;
                                $getplayer->getplayers(['email','=',$player_email]);
                                $query        = $getplayer->query;
                                $result       = $query->fetch_assoc();

                                $name         = $result['f_name'];
                                $freefire     = $result['id_code'];
                                $bkash        = $result['bkash'];
                              }

                              $trxid          = $_POST['trxid'];
                              $count_code     = $counter;
                  
                              $form_data      = array(

                                array(

                                  'field_name'    => 'trxid',
                                  'name'          => 'Trxid',
                                  'required'      => true,
                                  'min'           => 10,
                                  'max'           => 10,
                                  'unique'        => true,
                                  'table'         => 'running_tournament',
                                  'column'        => 'trxid'
                                ),

                              );

                              $validation     = new Validation;
                              $validation->validate($form_data);

                              if($validation->hasErrorPassed){

                              $insert = new RunningTournament;

                              if($insert->running($name,$freefire,$t_id,$t_name,$level,$trxid,$bkash,$count_code)){

                                $message[] = "Successfully Submit Trxid";

                                $_SESSION['messages']   = $message;
                                $_SESSION['class_name'] = 'alert-success';

                                require_once ('messages.php');

                              }else{

                                $message[] = "Something is Wrong .. Try again";

                                $_SESSION['messages']   = $message;
                                $_SESSION['class_name'] = 'alert-danger';

                                  require_once ('messages.php');
                                }   
                              }
                            }*/
                        ?>
                      <div class="text-left pl-4 pr-4">
                        <form action="<?php //echo htmlspecialchars($_SERVER['PHP_SELF'])."?Tid=$t_id"; ?>" method="POST">
                          <div class="form-group">
                            <label for="appointment_email" class="text-black">Your Trxid</label>
                            <input type="text" name="trxid" class="form-control">
                          </div>
                          <div class="form-group">
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                          </div>
                        </form>
                      </div>
			              </div>
			            </div>
			          </div>
		          </div>
		        </div>
          	</div>
        </div>
    	</div>
    </section>-->
    
    <?php require_once ('includes/contact.php'); ?>
    
    <?php require_once ('includes/footer.php'); ?>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <?php require_once ('includes/js.php'); ?>
    
  </body>
</html>

<?php } ?>