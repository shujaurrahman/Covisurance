<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="refresh" content="300" name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SENIOR PROJECT</title>
  <?php
  require "./partials/conn.php";
  require "./partials/link.php";

  ?>
  <link rel="stylesheet" href="./static/css/style.css" />
  <style>
    @media (max-width: 1280px) {
  .hamburger-menu {
    display: flex;
  }

  .header-content {
    margin-top: 1rem;
  }

  .header-title {
    font-size: 2.3rem;
  }

  .header-content .image {
    max-width: 400px;
    margin: 0 auto;
  }

  header .column-1 {
    max-width: 550px;
    margin: 0 auto;
  }

  .links{
    position: fixed;
    width: 100%;
    height: 100vh;
    top: 0;
    right: 0;
    background-color: #252525;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    transform: translateX(100%);
    transition: 0.5s;
  }

  .links ul {
    flex-direction: row;
  }

  .links a {
    color: var(--light-one);
  }

  .links a.active {
    margin-left: 0;
    margin: 0.5rem 0;
  }

  .header-content .container.grid-2 {
    min-height: 80vh;
  }}
  </style>
  <link rel="stylesheet" href="./static/css/modal.css" />
</head>

<body>
  <main>
    <header id="header">

      
      
      
      
      <!-- Navbaar -->
      <?php





      require "./partials/nav.php";




      // Modal code(backend verification) to sign into the profile from index file============================ 
      if (isset($_SESSION) and isset($_SESSION['username'])) {

      }



      $boolUsernameNotFound = false;
      $boolWrongPassword = false;

      $userMssg = "";
      $userError = "";
      $userDisplay = "none";

      $passwordMssg = "";
      $passwordError = "";
      $passwordDisplay = "none";



      $loginMssg = "";
      $loginError = "";
      $loginDisplay = "none";
      
       
      //Alert for user to sign in 
      if(!$boolLoggedIn){
        $loginMssg = "You need to log in first in order to apply/claim policies.";
        $loginError = "class = 'error'";
        $loginDisplay = "block";
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM `alluser` WHERE `username` = '$username'";
        $result = mysqli_query($conn, $sql);

        $aff  = mysqli_affected_rows($conn);
        if ($aff<1) {
          $boolUsernameNotFound = true;
        } 
        else{
          $data='';
           $data = mysqli_fetch_object($result);
          $passwordInDatabase = $data->{'password'};
          $status=$data->{'status'};
          $email=$data->{'email'};
          if (password_verify($password,$passwordInDatabase)) {
            $boolWrongPassword = false;
          }
          else{
            $boolWrongPassword=true;

            // session_start();
          }
          // echo $boolWrongPassword;
          if (!$boolWrongPassword) {
            if($status=='verified'){
            $_SESSION["username"] = $username;
            // $website = "";
            header("Location: $website/user profile/profile.php");
            $sql2="UPDATE `notify` SET `signed_in`= '1' WHERE `username`='$username'";
            $result2=mysqli_query($conn,$sql2);
            $loginMssg = "Logged in Successfully";
            $loginError = "class = 'error'";
            $loginDisplay = "block";
            }
            else{
              $userMssg = "Looks like your email isn't verified Verify Now";
              $userError = "class = 'error'";
              $userDisplay = "block";
              $_SESSION["email"] = $email;
              echo "
              <script>
              setInterval(() => {
                window.location = './authentication/user-otp.php';
              }, 2200);
              </script>
              ";
              // header("Location: ./authentication/user-otp.php");
            }
        
          }
        }



        if ($boolUsernameNotFound) {
          $userMssg = "Username not Found";
          $userError = "class = 'error'";
          $userDisplay = "block";
        }
         elseif($boolWrongPassword) {
          $passwordMssg = "Wrong Password";
          $passwordError = "class = 'error'";
          $passwordDisplay = "block";
        }
      }


      echo "
      <p $userError style='display: $userDisplay;'>$userMssg</p>
      <p $passwordError style='display: $passwordDisplay;'>$passwordMssg</p>
      <p $loginError style='display: $loginDisplay;'>$loginMssg</p>";






      // ===========================================sign in===============================
// ======================+++++++++Modal starting+++++++++=========================  -->
      echo   "<div class='modal' id='modal'>
      <span id='closeBtn'>×</span>
      <div class='inner-box'>
      <div class='forms-wrap'>
      <form action='index.php' method='POST' class='sign-in-form'>
      <div class='logo'><img src='./static/img/logo.png' alt='easyclass' />
      <h4>Covisurance</h4></div><div class='heading'>
      <h2>Welcome Back</h2><h6>Not registred yet?
      </h6><a href='./sign up/signup.php' class='toggle-sign'>Sign up</a>

      </div>


      <div class='actual-form'>


      


      <div class='input-wrap'>
      <input type='text'  name='username' class='input-field' required />
      <label>User Name</label>
      </div>



      

      <div class='input-wrap'>
      <input type='password'  name='password' class='input-field' required />
      <label>Password</label>
      </div>

      <input type='submit' value='Sign In' class='sign-btn' />
      <p class='text-l' style='font-size:17px'> Forgotten your password ? 
      <a href='./authentication/forgot-password.php'>Click here</a>
      </p>
      </div></form></div><div class='carousel'>
      <div class='images-wrapper'><img src='./static/img/carasoul/img-5.svg' class='image-modal img-1 show' alt='' />
      <img src='./static/img/carasoul/img-2.svg' class='image-modal img-2' alt='' />
      <img src='./static/img/carasoul/img-1.svg' class='image-modal img-3' alt='' />
      </div><div class='text-slider'><div class='text-wrap'>
      <div class='text-group'><h2>Get insured online</h2>
      <h2>Minimal terms and policies</h2>
      <h2>Claim insurance hassle-free</h2></div>
      </div><div class='bullets'>
      <span class='active' data-value='1'></span>
      <span data-value='2'></span><span data-value='3'>
      </span></div></div></div></div></div>";








      ?>




<!--++++++++++=========Header of the Main Page i.e index.html =================+++++++++++-->

      <div class="header-content">
        <div class="container grid-2">
          <div class="column-1">
            <h1 class="header-title">Covisurance</h1>
            <p class="text">
              Protect your family against the uncertainties of life.
              <br /><br />
              COVID 19 insurance, like many other life insurance products,
              provides financial protection against the most terrifying human
              life event: death. Although human life cannot be measured in
              monetary terms, a precise sum assured aids the deceased’s family
              in dealing with financial matters in case of the insured
              person’s untimely demise.
            </p>
            <br />

            <?php
          $boolLoggedIn = false;
          if (isset($_SESSION) and isset($_SESSION['username'])) {
              $boolLoggedIn = true;
              $currentUser = $_SESSION['username'];
               
          }
            if ($boolLoggedIn) {
              $signUpBlock = "<a href='$userProfile' class='btn'>Apply Insurance</a>";
              echo $signUpBlock;
            } else {
              echo $signUpBlock;
            }
            ?>

          </div>

          <div class="column-2 image">
            <img src="./static/img/person.svg" class="img-element z-index" alt="" />
          </div>
        </div>
      </div>
    </header>

<!-- ==========================================================================================-->






<!-- =============Apply Insurance section Dynamic Function Variable data stored in partial/Nav -->




<?php
if(!$boolLoggedIn){
 echo "$policyCardBlock";
}
?>






<!-- ++++++++======about section ============================================-->

    <section class="about section" id="about">
      <div class="container">
        <div class="section-header">
          <h3 class="title" data-title="About">Covid-19</h3>
        </div>

        <div class="section-body grid-2">
          <div class="column-1">
            <h3 class="title-sm">What is COVID-19?</h3>
            <p class="text">
              Coronavirus disease (COVID-19) is an infectious disease caused
              by the SARS-CoV-2 virus. Most people who fall sick with COVID-19
              will experience mild to moderate symptoms and recover without
              special treatment. However, some will become seriously ill and
              require medical attention.
            </p>
            <br />
            <h3 class="title-sm">How it Spreads?</h3>
            <p class="text">
              The virus can spread from an infected person’s mouth or nose in
              small liquid particles when they cough, sneeze, speak, sing or
              breathe. These particles range from larger respiratory droplets
              to smaller aerosols. You can be infected by breathing in the
              virus if you are near someone who has COVID-19, or by touching a
              contaminated surface and then your eyes, nose or mouth. The
              virus spreads more easily indoors and in crowded settings.
            </p>
            <br />

            <h3 class="title-sm">How does Insurance helps?</h3>
            <p class="text">
              Purchasing COVID-19 insurance policy ensures that your loved
              ones have a financial safety net in case something unforeseen
              occurs to you. The earlier you purchase this sort of life
              insurance, the better the coverage and the lower the premium. It
              would be beneficial if you researched about the various types of
              coronavirus insurance policies available in the market and then
              purchased a life insurance policy as part of your financial
              planning. Also, before making a selection, you should thoroughly
              examine the benefits of COVID insurance.
            </p>
            <br />
            <h3 class="title-sm">Covid-19 Symtoms</h3>
            <div class="skills">
              <div class="skill html">
                <h3 class="skill-title">Fever</h3>
                <div class="skill-bar">
                  <div class="skill-progress" data-progress="98.6%"></div>
                </div>
              </div>
              <div class="skill css">
                <h3 class="skill-title">Fatigue</h3>
                <div class="skill-bar">
                  <div class="skill-progress" data-progress="69.6%"></div>
                </div>
              </div>
              <div class="skill js">
                <h3 class="skill-title">Dry cough</h3>
                <div class="skill-bar">
                  <div class="skill-progress" data-progress="59.4%"></div>
                </div>
              </div>
            </div>
            <a href="https://www.who.int/health-topics/coronavirus#tab=tab_3" target="blank" class="btn">More Info</a>
          </div>

          <div class="column-2 image">
            <img src="./static/img/about1.svg" alt="" /><br /><br />
            <img src="./static/img/about2.svg" alt="" />
          </div>
        </div>
      </div>
    </section>





 <!-- <!============================= END ABOUT=============================================== --> 

    <section class="records">
      <div class="container">
        <div class="wrap">
          <div class="record-circle">
            <h2 class="number" data-num="1589">0</h2>
            <h4 class="sub-title">Customers</h4>
          </div>
        </div>

        <div class="wrap">
          <div class="record-circle active">
            <h2 class="number" data-num="342">0</h2>
            <h4 class="sub-title">Happy Clients</h4>
          </div>
        </div>

        <div class="wrap">
          <div class="record-circle">
            <h2 class="number" data-num="892">0</h2>
            <h4 class="sub-title">Active</h4>
            <h4 class="sub-title">Insurances</h4>
          </div>
        </div>

        <div class="wrap">
          <div class="record-circle">
            <h2 class="number" data-num="745">0</h2>
            <h4 class="sub-title">Insurances</h4>
            <h4 class="sub-title">Claimed</h4>
          </div>
        </div>
      </div>
    </section>

    <!-- =======================================================record clients served detail
      ================================================================================================= -->


    <section class="testimonials section" id="testimonials">
      <div class="container">
        <div class="section-header">
          <h3 class="title" data-title="What People Say">Testimonials</h3>
        </div>

        <div class="testi-content grid-2">
          <div class="column-1 reviews">
            <div class="swiper-container">
              <div class="swiper-wrapper">
                    <?php
                    
                              $fetch = false;
                              $testimonialCard ="";
                              $sql = "SELECT * FROM `testimonial`";
                              $result = mysqli_query($conn,$sql);
                              $aff = mysqli_affected_rows($conn);
                              if($aff<1){
                                  $fetch = false;
                              }
                              else{
                                  $fetch = true;
                              }

                              if ($fetch) {

                                  while($data = mysqli_fetch_object($result)){

                                      $testimonialName = $data->{'name'};
                                      $testimonialPlace = $data->{'place'};
                                      $testimonialmessage = $data->{'message'};
                                      $testimonialdate = $data->{'date'};
                                      $rate=$data->{'rate'};
                                      $newDatetest = date("j-F Y", strtotime($date));
                                      $newTimetest = date("l, g:i a", strtotime($date));

                                      if($boolLoggedIn){
                                        $testCurrentUser="<h5 class='review-small'>$currentUser</h5>
                                        <h6 class='review-small'>user registered with us</h6>";
                                      }
                                      else{
                                        $testCurrentUser="";
                                      }
                                      //rating code
                                      if($rate==1){
                                        $userRating="<i class='fas fa-star'></i>";
                                      }
                                      elseif($rate==2){
                                        $userRating="<i class='fas fa-star'></i>
                                        <i class='fas fa-star'></i>
                                        ";
                                      }
                                      elseif($rate==3){
                                        $userRating="<i class='fas fa-star'></i>
                                        <i class='fas fa-star'></i>
                                        <i class='fas fa-star'></i>";
                                      }
                                      elseif($rate==4){
                                        $userRating="<i class='fas fa-star'></i>
                                        <i class='fas fa-star'></i>
                                        <i class='fas fa-star'></i>
                                        <i class='fas fa-star'></i>";
                                      }
                                      else{
                                        $userRating="<i class='fas fa-star'></i>
                                        <i class='fas fa-star'></i>
                                        <i class='fas fa-star'></i>
                                        <i class='fas fa-star'></i>
                                        <i class='fas fa-star'></i>";
                                      }


                                      $testimonialCard.="<div class='swiper-slide review'>
                                      <i class='fas fa-quote-left quote'></i>
                                      <div class='rate'>
                                              $userRating
                                      </div>
                    
                                      <p class='review-text'>
                                      $testimonialmessage
                                      </p>
                    
                                      <div class='review-info'>
                                        <h3 class='review-name'>$testimonialName</h3>
                                        <h5 class='review-small'>Posted on $newDatetest</h5>
                                        <h5 class='review-small'>at $newTimetest</h5>
                                        $testCurrentUser
                                      </div>
                                    </div>";
                                  }}


                               
                                  echo $testimonialCard;
                            
                    ?>

                



              </div>


            <!-- Testimonial swipe buttons============================================================== -->
              <div class="review-nav swiper-button-prev">
                <i class="fas fa-long-arrow-alt-left"></i>
              </div>
              <div class="review-nav swiper-button-next">
                <i class="fas fa-long-arrow-alt-right"></i>
              </div>
            </div>
          </div>

          <div style="flex-direction: row" class="column-2 image">
                                         
            <?php

              $random1=rand(1,8);
              $random2=rand(1,8);
              echo "<img src='./static/img/testimonial/$random1.svg' alt='Image' class='img-element'>";
              echo "<img src='./static/img/testimonial/$random2.svg' alt='Image' class='img-element'>";

              ?>
              
              <!-- randomized these images  -->
            <!-- <img src="./static/img/testimonial3.svg" alt="" class="img-element" />
            <img src="./static/img/testimonial4.svg" alt="" class="img-element" /> -->
          </div>
        </div>
          <?php
                echo"<h3 class='review-small' style='margin-bottom: 15px;'>Post your review
                People might find it helpful.</h3>";
          echo"      <a href='$testimonial' class='btn'>Post testimonial</a>";
          
          ?>    

      </div>

    </section>


<!-- ==============================Payments ================================================ -->
            

        <?php

          if($boolLoggedIn){
            echo $payments;
          }
        
        ?>
  
  
  
  <!-- ====================================Footere====================================================== -->
  <footer class="footer">
    <div class="container">
      <div class="footer-links">
        <h3 class="title-sm">Links</h3>
        <a href="https://www.who.int/health-topics/coronavirus#tab=tab_3">Covid-19</a>
        <a href="https://www.who.int/">WHO</a>
        <a href="https://www.worldometers.info/coronavirus/">Covid Cases</a>
        <a href="https://www.cowin.gov.in/">Covid vacine</a>
        <a href="https://www.youtube.com/watch?v=5gRFVZcUvlY">Importance of Insurance</a>
        <a href="#">Our Policies</a>
        <p class="text">Copyright &copy; 2022 All rights reserved</p>
        <p class="text" style="font-size: 15px; color:white;">This Webiste is designed and Coded by shuja ur Rahman,BCA FINAL YEAR</p>
        <p class="text" style="font-size: 15px; color:white;">Contribute on github or connect with me, Follow these socials</p>


      </div>


    </div>
    <div class="followme-wrap">
      <div class="followme">
        <div class="social-media">
          <a href="https://github.com/shujaurrahman">
            <i class="fa fa-brands fa-github"></i>
          </a>
          <a href="https://shujaurrahman.github.io/shuja-on-web/">
            <i class="fas fa-solid fa-globe"></i>
          </a>
          <a href="https://www.instagram.com/shujaurrahman_/">
            <i class="fab fa-instagram"></i>
          </a>
        </div>
      </div>

      <div class="back-btn-wrap">
        <a href="#" class="back-btn">
          <i class="fas fa-chevron-up"></i>
        </a>
      </div>
    </div>
  </footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="static/js/isotope.pkgd.min.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="./static/js/index.js"></script>
  <script src="./static/js/modal.js"></script>
</body>

</html>