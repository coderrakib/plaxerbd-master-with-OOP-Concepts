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
            <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">FREE F<span style="color:#FFFF00;">I</span>RE TOURNAMENT</h1>
            <p><a href="login" class="btn btn-info py-2 px-4 text-light">Let's Play</a></p>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section" id="blog-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2 ftco-animate">
            <div class="card">
              <h3 class="card-header">Reset Password</h3>
              <div class="card-body">
                <form id="contactForm">
                <div class="form-group">
                  <h5 class="sent-notification text-center text-danger"></h5>
                  <label for="appointment_email" class="text-black">Email <span class="text-danger">*</span></label>
                  <input type="email" id="email" placeholder="Email address" class="form-control">
                </div>
                <div class="form-group">
                  <button type="button" onclick="sendEmail()" value="Reset" class="btn btn-primary">Reset</button>
                </div>
              </form>
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