<?php 
session_start();
require("config.php");

if (isset($_POST['submit'])) {
    
$hsncode = mysqli_real_escape_string($conn, $_POST['hsncode']);

//echo "$hsncode";

}

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
    <!-- Magnific CSS -->
    <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
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
            $.get("backend-buyer-search.php", {term: inputVal}).done(function(data){
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

<body style="background-color: #F4F6F5; ">
    <?php
            if(isset($_SESSION["member_id"]) && $_SESSION["status"] == true)
                {
                   ?>

    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div class="nav-container nav-transparent mb-2" style="background-color: #F4F6F5;" >
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
         <!-- Search Area Start Here -->
        <div class="search-layout3 searchmargin" >
                        <div class="search-layout3-holder">
                            <div class="container">
                                <form id="cp-search-form2" class="bg-primary search-layout3-inner" method="POST" action="buyersearchview.php" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-xl-9 col-lg-9 col-12">
                                            <div class="search-box form-group search-input-area ">
                                                <input type="text" name="hsncode" autocomplete="off" placeholder="Search by HSN Code..." />
                                                <div class="result"></div>
                                            </div>
                                                
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-12 text-center searchbutton">
                                            <button type="submit" name="submit" class="cp-search-btn"><i class="fa fa-search" aria-hidden="true"></i>Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        <!-- Search Area End Here -->
        <div class="section-title-dark" style="margin-top: 125px;">
                    <h2>Buyer Details</h2>
                    <p>Browse To Our Top Queries</p>
                </div>
        <?php
            // connect to the database
              require("config.php");

            $per_page = 10;

            // figure out the total pages in the database
            if ($result = $conn->query("SELECT * FROM enquiry where hsncode='$hsncode' ORDER BY id DESC"))
            {
            if ($result->num_rows != 0)
            {
            $total_results = $result->num_rows;
            // ceil() returns the next highest integer value by rounding up value if necessary
            $total_pages = ceil($total_results / $per_page);

            // check if the 'page' variable is set in the URL (ex: viewpg.php?page=1)
            if (isset($_GET['page']) && is_numeric($_GET['page']))
            {
            $show_page = $_GET['page'];

            // make sure the $show_page value is valid
            if ($show_page > 0 && $show_page <= $total_pages)
            {
            $start = ($show_page -1) * $per_page;
            $end = $start + $per_page;
            }
            else
            {
            // error - show first set of results
            $start = 0;
            $end = $per_page;
            }
            }
            else
            {
            // if page isn't set, show first set of results
            $start = 0;
            $end = $per_page;
            }?>
      
<div class="row">
                    

                            <div class="col-lg-1"></div>
        <div class="col-lg-10" > 
        <div class="row">
     
                <?php



            // display data in table
            //echo "<table  cellpadding='10'>";
            //echo "<tr> <th>ID</th> <th>Event Name</th> <th>College</th> <th>District</th> <th></th> <th></th></tr>";

            // loop through results of database query, displaying them in the table
            for ($i = $start; $i < $end; $i++)
            {
            // make sure that PHP doesn't try to show results that don't exist
            if ($i == $total_results) { break; }

            // find specific row
            $result->data_seek($i);
            $row = $result->fetch_array();

            // echo out the contents of each row into a table
            //echo "<tr>";
            ?>
<div class="col-lg-4 col-md-6 col-sm-6 col-12 menu-item">
                        <div class="product-box item-mb zoom-gallery">
                            <div class="item-mask-wrapper" style="border:1px solid #329afc; min-height: 150px; padding:2px; cursor:pointer; " onclick="window.location.href='viewproduct.php?id=<?php echo $row["id"] ?>';">
                                <h3 class="short-title"><a href='viewproduct.php?id=<?php echo $row["id"] ?>'><?php echo $row["name"] ?></a>
                                </h3>
                                <p><?php echo $row["hsncode"]; ?></p>
                            </div>
                            <div class="item-content">

                            </div>
                        </div>
                    </div> <?php }
     ?></div></div>
            <div class="col-lg-1"></div></div>  </div>
 <?php
            

            // close table>
            
            }
            else
            {
            echo "No results to display!";
            }
            }
            // error with the query
            else
            {
            echo "Error: " . $conn->error;
            }
            // display pagination
            ?>
            <p style="font-weight: 300px; font-size: 20px; margin-left: 28%;"><b>Page:</b>
            <?php
            for ($i = 1; $i <= $total_pages; $i++)
            {
            if (isset($_GET['page']) && $_GET['page'] == $i)
            {
            echo $i . " ";
            }
            else
            {
            echo "<a href='buyerview.php?page=$i'>$i</a> ";
            }
            }
            

            // close database connection
            $conn->close();

            ?></p>
                   

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
                                        <a href="#">feedback@industrialstockexchange.com</a>
                                    </li>
                                    <li>
                                        <a href="#">industrialstockexchange@gmail.com</a>
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
    <!-- Magnific Popup -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>
    <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({layout: google.translate.TranslateElement.FloatPosition.TOP_LEFT}, 'google_translate_element');
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