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
            
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section signup" id="blog-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2 ftco-animate">
          <?php

                if(isset($_POST['submit']) && $_POST['submit'] === 'SignUp'){

                  $name           = ucwords($_POST['name']);
                  $email          = $_POST['email'];
                  $pass           = $_POST['pass'];
                  $con_pass       = $_POST['con_pass'];
                  $hash_pass      = hash('sha512', $pass);
                  $id             = $_POST['id'];
                  $bkash          = $_POST['bkash'];
                                                    
                  $form_data      = array(

                    array(

                      'field_name'    => 'name',
                      'name'          => 'Player Name',
                      'required'      => true,
                      'min'           => 5,
                      'max'           => 30
                    ),

                    array(

                      'field_name'    => 'email',
                      'name'          => 'Email',
                      'required'      => true,
                      'min'           => 11,
                      'max'           => 30,
                      'unique'        => true,
                      'table'         => 'players',
                      'column'        => 'email'
                    ),

                    array(

                      'field_name'    => 'pass',
                      'name'          => 'Password',
                      'required'      => true,
                      'min'           => 6,
                      'max'           => 50,
                      'matching'      => $pass 
                    ),

                    array(

                      'field_name'    => 'con_pass',
                      'name'          => 'Confirm Password',
                      'required'      => true,
                      'min'           => 6,
                      'max'           => 50,
                      'matching'      => $pass 
                    ),

                    array(

                      'field_name'    => 'id',
                      'name'          => 'Free Fire Id',
                      'required'      => true,
                      'min'           => 5,
                      'max'           => 50
                    ),

                    array(

                      'field_name'    => 'bkash',
                      'name'          => 'Bkash Number',
                      'required'      => true,
                      'min'           => 11,
                      'max'           => 11
                    ),

                  );

                  $validation     = new Validation;
                  $validation->validate($form_data);

                  if($validation->hasErrorPassed){

                  $insert = new Players;

                  if($insert->addplayers($name, $email, $hash_pass, $id, $bkash)){

                    $message[] = "Successfully Add Players";

                    $_SESSION['player'] = $email;

                    $_SESSION['messages']   = $message;
                    $_SESSION['class_name'] = 'alert-success';

                    require_once ('messages.php');

                    echo "<script>
                     setTimeout(function(){
                        window.location.href = 'profile';
                     }, 500);
                    </script>" ;

                  }else{

                    $message[] = "Something is Wrong .. Try again";

                    $_SESSION['messages']   = $message;
                    $_SESSION['class_name'] = 'alert-danger';

                      require_once ('messages.php');
                    }   
                  }
                }
              ?>
            <div class="card">
              <h3 class="card-header">Register</h3>
              <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                  <div class="form-group">
                    <label for="appointment_name" class="text-black">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" >
                  </div>
                  <div class="form-group">
                    <label for="appointment_email" class="text-black">Phone or Email <span class="text-danger">* (Only for BD)</span></label>
                    <input type="text" name="email" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="appointment_password" class="text-black">Password <span class="text-danger">* (Minimum 6 Characters)</span></label>
                    <input type="password" name="pass" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="appointment_password" class="text-black">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" name="con_pass" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="appointment_password" class="text-black">Free Fire Id code <span class="text-danger">*</span></label>
                    <input type="text" name="id" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="appointment_number" class="text-black">Bkash Number <span class="text-danger">*</span></label>
                    <input type="text" name="bkash" class="form-control">
                  </div>
                  <div class="form-group">
                    <input type="submit" name="submit" value="SignUp" class="btn btn-primary">
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <p>You alreday have an signup ? please <a href="login">Login</a></p>
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