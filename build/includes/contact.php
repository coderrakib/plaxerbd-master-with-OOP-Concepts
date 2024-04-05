   <?php      
        $getcontact   = new Settings;
        $getcontact->GetContactSetting(['status','=',1]);
        $query        = $getcontact->query;

        if(mysqli_num_rows($query) >= 1){

            $result       = $query->fetch_assoc();

            $phone         = $result['phone'];        
            $email         = $result['email'];        
            $facebook      = $result['facebook'];        
            $twitter       = $result['twitter'];        
            $ins           = $result['instagram'];        
            $youtube       = $result['youtube']; 
        }       
    ?>
    
    <section class="ftco-section contact-section ftco-no-pb bg-light mt-5" id="contact-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-10 heading-section text-center ftco-animate">
            <h2 class="mt-2">Contact Us</h2>
          </div>
        </div>
        <div class="row d-flex contact-info">
          <div class="col-md-6 col-lg-6 d-flex ftco-animate">
            <div class="align-self-stretch box p-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="icon-phone2"></span>
              </div>
              <h3 class="mb-4">Contact Number</h3>
              <p><a href=""><?php if(isset($phone)){ echo $phone;} ?></a></p>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 d-flex ftco-animate">
            <div class="align-self-stretch box p-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="icon-paper-plane"></span>
              </div>
              <h3 class="mb-4">Email Address</h3>
              <p><a href=""><?php if(isset($email)){ echo $email;} ?></a></p>
            </div>
          </div>
        </div>
        <div class="row no-gutters block-9">
          <div class="col-md-6 offset-md-3 order-md-last d-flex">
            <form id="contactForm" class="bg-primary p-5 contact-form">
              <h5 class="sent-notification text-light text-center"></h5>
              <div class="form-group">
                <input type="text" id="name" class="form-control" placeholder="Your Name" required>
              </div>
              <div class="form-group">
                <input type="email" id="email" class="form-control" placeholder="Your Email" required>
              </div>
              <div class="form-group">
                <input type="text" id="subject" class="form-control" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea id="body" cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
              </div>
              <div class="form-group">
                <button type="button" onclick="sendEmail()" value="Send An Email" class="btn btn-darken py-3 px-5">Send Message</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>