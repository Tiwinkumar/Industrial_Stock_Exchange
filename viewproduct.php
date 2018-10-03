<?php 
session_start();
require("config.php");

?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Industrial Stock Exchange</title>
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
    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="vendor/OwlCarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/OwlCarousel/owl.theme.default.min.css">
    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="css/select2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <style type="text/css">
    body{
        font-family: Arail, sans-serif;
    }
    /* Formatting search box */
    .search-box{
        width: 100%;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
        background-color: white;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-products-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
</head>

<body style="background-color: #EBEBEB;">
    <?php
            if(isset($_SESSION["member_id"]) && $_SESSION["status"] == true)
                {
                   ?>

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
    
    <div id="wrapper">
        <div class="container-fluid search-layout3 search-layout3-holder">
            <nav class="navbar navbar-expand-lg  navbar-dark bg-primary"">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
  

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link" href="homepage.php" style="font-size: 18px;">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="about.php" style="font-size: 18px;">Who We Are</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php#how-it-works" style="font-size: 18px;">How It Works?</a>
                    </li>
                </ul>
<?php require_once("include/nav_left.php"); ?>
            </div>
        </nav>
    </div>

        <?php
               require("config.php");



 $id = intval($_GET['id']);
 
//selecting data associated with this particular id
$result = mysqli_query($conn, "SELECT * FROM enquiry WHERE id='$id'");
 
$res = mysqli_fetch_array($result);
?>
        <!-- Product Area Start Here -->
        <section class="s-space-bottom-full bg-accent-shadow-body" style="margin-top: 2%;">
            
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="gradient-wrapper item-mb">
                            <div class="gradient-title">
                                <h2>Buyer Enquiry Detail</h2>
                            </div>
                            <div class="gradient-padding reduce-padding">

                                <div class="section-title-left child-size-xl item-mb">
                                    <p><b>Name :</b> <?php echo $res["name"]; ?>.</p>
                                    <p><b>Email :</b> <?php echo $res["email"]; ?>.</p>
                                    <p><b>Mobile :</b> <?php echo $res["mobile"]; ?>.</p>
                                    <p><b>Location :</b> <?php echo $res["location"]; ?>.</p>
                                    <p><b>Company Name :</b> <?php echo $res["cmpname"]; ?>.</p>
                                </div>
                                <div class="section-title-left-dark child-size-xl">
                                    <h3>Additional Details:</h3>
                                </div>
                                <ul class="specification-layout1">
                                    <li>HSN Code:&nbsp;<?php echo $res["hsncode"]; ?></li>
                                    <li>Quantity: &nbsp;<?php echo $res["quantity"]; ?></li>
                                    <!--<li>Price:&nbsp;<?php echo $res["price"]; ?></li>-->
                                </ul>
                                <b>Message:</b><br/><?php echo $res["message"]; ?>
                            </div>
                        </div>





                    </div>
                </div>
            </div>
        </section>
        <!-- Product Area End Here -->
        <!-- Footer Area Start Here -->
        <footer>
            <div class="footer-area-top s-space-equal">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="footer-box">
                                <h3 class="title-medium-light title-bar-left size-lg">About us</h3>
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
                                        <a href="#">
                                            <img src="img/footer/facebook.jpg" alt="social">
                                        </a>
                                    </li>
                                    <li class="tw-classipost">
                                        <a href="#">
                                            <img src="img/footer/twitter.jpg" alt="social">
                                        </a>
                                    </li>
                                    <li class="yo-classipost">
                                        <a href="#">
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
                                <input id="checkbox1" type="checkbox">
                                <label for="checkbox1">Remember Me</label>
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
                                <input type="text" id="first-name" class="form-control" placeholder="Type your mail here ...">
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
    <?php
                 }
            else{
                    header('Location: signin.php'); //redirect URL
                }
        ?>
    <!-- jquery-->
    <script src="js/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Owl Cauosel JS -->
    <script src="vendor/OwlCarousel/owl.carousel.min.js"></script>
    <!-- Meanmenu Js -->
    <script src="js/jquery.meanmenu.min.js"></script>
    <!-- Srollup js -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- jquery.counterup js -->
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <!-- Select2 Js -->
    <script src="js/select2.min.js"></script>
    <!-- Isotope js -->
    <script src="js/isotope.pkgd.min.js"></script>
    <!-- jQuery Zoom -->
    <script src="js/jquery.zoom.min.js"></script>
    <!-- Google Map js -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <!-- Validator js -->
    <script src="js/validator.min.js"></script>
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