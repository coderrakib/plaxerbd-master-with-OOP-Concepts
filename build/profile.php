<?php 
  require_once ('admin/config.php');

  if(!isset($_SESSION['player'])){

    header('Location: home');
    exit();

  }else{

    $player_email = $_SESSION['player'];
    $getplayer    = new Players;
    $getplayer->getplayers(['email','=',$player_email]);
    $query        = $getplayer->query;
    $result       = $query->fetch_assoc();

    $name         = $result['f_name'];
    $free_fire    = $result['id_code'];
    $email        = $result['email'];
    $bkash        = $result['bkash'];
  }

  $running    = new SingleRegistration;
  $running->getrunning(['name','=',$name,'free_fire_id','=',$free_fire]);
  $run_query  = $running->query;

?>
<!DOCTYPE html>
<html lang="en">
  <?php require_once ('includes/header.php'); ?>

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
	  
    <?php require_once ('includes/chatbox.php'); ?>

    <?php require_once ('includes/navbar.php'); ?>

	  <section class="hero-wrap js-fullheight" style="background-image: url('images/garena_free_fire_2020_4k_hd.jpg');" data-section="home" style="height:400px;">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-end profile_height" data-scrollax-parent="true">
          <div class="col-md-6 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
            <div style="background:#000;padding:20px;opacity: 0.7;">
              <h1 class="mb-3 mt-3" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo $name; ?></h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-counter ftco-no-pt ftco-no-pb img profile_info" id="section-counter">
    	<div class="container">
    		<div class="row d-md-flex align-items-center justify-content-end">
    			<div class="col-lg-12">
    				<div class="ftco-counter-wrap">
	    				<div class="row no-gutters d-md-flex align-items-center align-items-stretch">
			          <div class="col-md-6 d-flex justify-content-center counter-wrap ftco-animate">
			            <div class="block-18">
			              <div class="text">
			              	<h2 class="text-left pl-4 pr-4">Your Personal Infomation</h2>
			              	<hr>
			              	<h6 class="text-left pl-4 pr-4"> Name : <?php echo $name; ?></h6>
			              	<h6 class="text-left pl-4 pr-4">Phone or Email : <?php echo $email; ?></h6>
			              	<h6 class="text-left pl-4 pr-4"> Free Fire ID : <?php echo $free_fire; ?></h6>
			              	<h6 class="text-left pl-4 pr-4"> Bkash  : <?php echo $bkash; ?></h6>
			              </div>
			            </div>
			          </div>
			          <div class="col-md-6 d-flex justify-content-center counter-wrap ftco-animate">
			            <div class="block-18">
			              <div class="text">
                      <h2 class="text-left pl-4 pr-4">Tournament Information</h2>
                      <hr>
                      <?php
                        if(isset($run_query)){
                          
                          if(mysqli_num_rows($run_query) >= 1){

                            $sl = 1;

                            while ($result = $run_query->fetch_assoc()) {
                              $t_id       = $result['tournament_id'];
                              $checked    = $result['checked'];
                              $status     = $result['status'];
                              echo "<h4 class='d-inline-block mb-4' style='border-bottom:2px solid #000;'>Tournament-$sl</h4>";
                              if($checked == 0){
                                echo '<h5 class="text-left pl-4 pr-4 text-danger"> আপনার সকল ইনফরমেশন চেকিং অবস্থায় আছে। কিছু সময়পর আপনার প্রোফাইল এ পরবর্তী মেসেজ পাবেন। ধন্যবাদ।</h5>';
                              }else{
                                if($status == 0){
                                  echo '<h5 class="text-left pl-4 pr-4 text-danger">দুঃখিত ! আপনি ডিসকোয়ালিফাই হয়েছেন।</h5>';
                                }else{

                                  $tournament    = new Tournament;
                                  $tournament->gettournament(['tournament_id','=',$t_id,'status','=',1]);
                                  $tor_query     = $tournament->query;

                                  if(mysqli_num_rows($tor_query) >= 1){

                                    $custom    = new Custom;
                                    $custom->getcustom(['tournament_id','=',$t_id,'status','=',1]);
                                    $cus_query = $custom->query;

                                    if(mysqli_num_rows($cus_query) >= 1){

                                        while ($result = $cus_query->fetch_assoc()) {
                                          
                                          $custom_id = $result['custom_id'];
                                          $pass      = $result['password'];

                                          echo "<h5 class='text-left pl-4 pr-4 text-danger'>Custom Id : $custom_id</h5>";
                                          echo "<h5 class='text-left pl-4 pr-4 text-danger'>Password :  $pass</h5>";
                                        }
                                    }else{
                                      echo '<h5 class="text-left pl-4 pr-4 text-danger"> আপনার সকল ইনফরমেশন সফল হয়েছে। টুর্নামেন্ট শুরুর ১ ঘন্টা আগে টুর্নামেন্টের কাস্টম কোড আর পাসওয়ার্ড পাবেন। ধন্যবাদ।</h5>';
                                    }

                                      while ($result = $tor_query->fetch_assoc()) {
                                      
                                      $t_name     = $result['tournament_name'];
                                      
                                      $fee        = $result['entry_fee'];
                                      $type       = $result['tournament_type'];
                                      $map        = $result['tournament_map'];
                                      $player     = $result['players'];
                                      $level      = $result['level'];
                                      $start      = strtotime($result['start_time']);
                                      $prize      = $result['prize'];

                                      $date       = date("d M Y, h:i:sa", $start);

                                        echo "<h5 class='text-left pl-4 pr-4'>Tournament Name : $t_name</h5>";
                                        echo "<h5 class='text-left pl-4 pr-4'>Entry Fee : $fee</h5>";
                                        echo "<h5 class='text-left pl-4 pr-4'>Tournament Type : $type</h5>";
                                        echo "<h5 class='text-left pl-4 pr-4'>Tournament Map : $map</h5>";
                                        echo "<h5 class='text-left pl-4 pr-4'>Tournament Level : $level</h5>";
                                        echo "<h5 class='text-left pl-4 pr-4'>Prize Money : $prize tk.</h5>";
                                        echo "<h5 class='text-left pl-4 pr-4'>Tournament Start Time : $date</h5>";
                                      }
                                  }
                                }
                              }

                              $sl++;
                              echo "<hr>";
                            }
                          }else{
                            echo '<h5 class="text-left pl-4 pr-4 text-danger"> আপনি কোন টুর্নামেন্টে এ অংশগ্রহণ করেন নাই। অংশগ্রহণ করতে <a href="home"> এখানে ক্লিক করুন </a></h5>';
                          }
                        }
                      ?>
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