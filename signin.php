<?php
session_start();
if(!empty($_POST["login"])) {
require("config.php");
    $sql = "Select * from login where email = '" . $_POST["member_name"] . "' and password = '" . ($_POST["member_password"]) . "'";
    $result = mysqli_query($conn,$sql);
    $user = mysqli_fetch_array($result);
    if($user) {
            $_SESSION["member_id"]         = $user["id"];
            $_SESSION["status"] = true;
            
            if(!empty($_POST["remember"])) {
                setcookie ("member_login",$_POST["member_name"],time()+ (10 * 365 * 24 * 60 * 60));
                setcookie ("member_password",$_POST["member_password"],time()+ (10 * 365 * 24 * 60 * 60));
            header("Location: homepage.php");

            } else {
                if(isset($_COOKIE["member_login"])) {
                    setcookie ("member_login","");
                }
                if(isset($_COOKIE["member_password"])) {
                    setcookie ("member_password","");
                }
            }
            header("Location: homepage.php");

    } else {
?>
    <script>alert('Enter Correct UserID and Password')</script>
<?php   }
}
?>
<!doctype html>
<html class="no-js" lang="">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Industrial Stock Exchange| Signin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="css/select2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <style>
    #frmLogin {
        padding: 20px 60px;
        background: #B6E0FF;
        color: #555;
        display: inline-block;      
        border-radius: 4px;
        width: 100%;
    }
    .field-group {
        margin-top:15px;
        width: 100%;
    }
    .input-field {
        padding: 8px;
        width: 200px;
        border: #A3C3E7 1px solid;
        border-radius: 4px;
    }
    .form-submit-button {
        background: #65C370;
        border: 0;
        padding: 8px 20px;
        border-radius: 4px;
        color: #FFF;
        text-transform: uppercase;
    }
    .member-dashboard {
        padding: 40px;
        background: #D2EDD5;
        color: #555;
        border-radius: 4px;
        display: inline-block;
    }
    .member-dashboard a {
        color: #09F;
        text-decoration:none;
    }
    .error-message {
        text-align:center;
        color:#FF0000;
    }
</style>
</head>

<body style="background-image: url(img/sky.jpg);background: cover;">
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div class="nav-container nav-transparent mb-2" style="background-color: #EBEBEB;" >
        <!--start mobile navigation-->
         <div class="nav visible-xs">
            <div class="container">
               <div class="row">
                  <div class="col-xs-12 col-sm-12 text-center">
                     <a>
                        <!--place for mobile logo-->
                        <img class="logo" alt="logo" src="img/logomobile.png">
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <!--end mobile navigation-->
         <!--start desktop navigation-->
         <nav class="nav hidden-xs" id="deskNav">
            <div class="container">
               <div class="row">
                  <div class="col-md-12 col-sm-12 hidden-xs text-center">
                     <a>
                        <!--place for desktop logo-->
                        <img class="logo" alt="logo" src="img/logo.png">
                     </a>
                  </div>
               </div>
               <!--end of row-->
            </div>
            <!--end of container-->
         </nav>
         <!--end desktop navigation-->
      </div>
    
    
    <div id="wrapper" style="margin-top: 5%;">        
        <!-- Login Area Start Here -->
        <section class="s-space-bottom-full ">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12"></div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="gradient-wrapper mb--sm">
                            <div class="gradient-title" align="center">
                                <h2>SIGN IN</h2>
                            </div>
                            <div class="input-layout1 gradient-padding">
                            <?php if(empty($_SESSION["member_id"])) { ?>
<form action="" method="post" id="frmLogin" >
    <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>    
    <div class="field-group">
        <div><label for="login">Email</label></div>
        <div><input name="member_name" type="email" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" class="input-field">
    </div>
    <div class="field-group">
        <div><label for="password">Password</label></div>
        <div><input name="member_password" type="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" class="input-field"> 
    </div>
    <div class="field-group">
        <div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
        <label for="remember-me">Remember me</label>
    </div>
    <div class="field-group">
        <div><input type="submit" name="login" value="Login" class="cp-default-btn-sm"></span></div>
    </div>
    <div class="field-group">
    <label class="lost-password"><a href="signup.html" style="font-size: 16px;;margin-top: 100px;">Create New Account<span style="text-decoration: underline;"> Click Here</span></a></label> 
    </div>
    <div class="field-group">
    <label class="lost-password"><a href="forgot.html" style="font-size: 16px;;margin-top: 100px;">Forgot Password<span style="text-decoration: underline;"> Click Here</span></a></label> 
    </div> 

</form>
<?php } else {          header("Location: homepage.php");
?>
<!--<div class="member-dashboard">You have Successfully logged in!. <a href="logout.php">Logout</a></div>-->
<?php } ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12"></div>
                </div>
            </div>
        </section>
        <!-- Login Area End Here -->
        <!-- Footer Area Start Here -->
        <footer>
            <div class="footer-area-top s-space-equal">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="footer-box">
                                <h3 class="title-medium-light title-bar-left size-lg">Terms&Conditions</h3>
                                <ul class="useful-link">
                                    <li>
                                        <a href="terms.php">Terms &amp; Conditions</a>
                                    </li>
                                   </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="footer-box">
                                <h3 class="title-medium-light title-bar-left size-lg">Contact us</h3>
                                <ul class="useful-link">
                                    
                                    <li>
                                        <a>feedback@industrialstockexchange.com</a>
                                    </li>
                                    <li>
										<a> industrialstockexchange@gmail.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="footer-box">
                                <h3 class="title-medium-light title-bar-left size-lg">Follow Us On</h3>
                                <ul class="social-link">
                                    <li class="fa-classipost">
                                        <a href="https://www.facebook.com/vishal.patwa.779205">
                                            <img src="img/footer/facebook.jpg" alt="social">
                                        </a>
                                    </li>
                                  <li class="tw-classipost">
                                        <a href="https://twitter.com/VishalJ33693082">
                                            <img src="img/footer/twitter.jpg" alt="social">
                                        </a>
                                    </li>
                                    <li class="yo-classipost">
                                        <a href="https://www.instagram.com/industrialstockexchange/">
                                            <img src="img/footer/youtube.jpg" alt="social">
                                        </a>
                                    </li>
                                    <li class="pi-classipost">
                                        <a href="#">
                                            <img src="img/footer/pinterest.jpg" alt="social">
                                        </a>
                                    </li>
                                    <li class="li-classipost">
                                        <a href="#">
                                            <img src="img/footer/linkedin.jpg" alt="social">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-area-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center-mb">
                            <p>Copyright © Deivatech</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Area End Here -->
    </div>
    <!-- Modal Start-->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="title-default-bold mb-none">Login</div>
                </div>
                <div class="modal-body">
                    <div class="login-form">
                        <form>
                            <label>Username or email address *</label>
                            <input type="text" placeholder="Name or E-mail" />
                            <label>Password *</label>
                            <input type="password" placeholder="Password" />
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox2" type="checkbox">
                                <label for="checkbox2">Remember Me</label>
                            </div>
                            <button class="default-big-btn" type="submit" value="Login">Login</button>
                            <button class="default-big-btn form-cancel" type="submit" value="">Cancel</button>
                            <label class="lost-password"><a href="#">Lost your password?</a></label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End-->
    <!-- Report Abuse Modal Start-->
    <div class="modal fade" id="report_abuse" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content report-abuse-area radius-none">
                <div class="gradient-wrapper">
                    <div class="gradient-title">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="item-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>There's Something Wrong With This Ads?</h2>
                    </div>
                    <div class="gradient-padding reduce-padding">
                        <form id="report-abuse-form">
                            <div class="form-group">
                                <label class="control-label" for="first-name">Your E-mail</label>
                                <input type="text" id="first-name3" class="form-control" placeholder="Type your mail here ...">
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label" for="first-name">Your Reason</label>
                                    <textarea placeholder="Type your reason..." class="textarea form-control" name="message" id="form-message" rows="7" cols="20" data-error="Message field is required" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="cp-default-btn-sm">Submit Now!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Report Abuse Modal End-->
    <!-- jquery-->
    <script src="js/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Meanmenu Js -->
    <script src="js/jquery.meanmenu.min.js"></script>
    <!-- Srollup js -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- Select2 Js -->
    <script src="js/select2.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>
    <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.FloatPosition.TOP_LEFT}, 'google_translate_element');
    }

    function triggerHtmlEvent(element, eventName) {
      var event;
      if (document.createEvent) {
        event = document.createEvent('HTMLEvents');
        event.initEvent(eventName, true, true);
        element.dispatchEvent(event);
      } else {
        event = document.createEventObject();
        event.eventType = eventName;
        element.fireEvent('on' + event.eventType, event);
      }
    }

    jQuery('.lang-select').click(function() {
      var theLang = jQuery(this).attr('data-lang');
      jQuery('.goog-te-combo').val(theLang);

      //alert(jQuery(this).attr('href'));
      window.location = jQuery(this).attr('href');
      location.reload();

    });
  </script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>

</html>