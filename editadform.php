<?php 
session_start();
require("config.php");

if(isset($_REQUEST["action"])) {
    if($_REQUEST["action"] == "edit") {
        $adid = intval($_REQUEST["id"]);

        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $hsncode = mysqli_real_escape_string($conn, $_POST['hsncode']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $companyname = mysqli_real_escape_string($conn, $_POST['companyname']);
        $sellermail = mysqli_real_escape_string($conn, $_POST['sellermail']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);

        $img_sql = "SELECT img1,img2,img3,img4 FROM advertisement WHERE userid='".$_SESSION["member_id"]."' AND id='".$adid."'";
        $img_exec = mysqli_query($conn, $img_sql);
        $img_res = mysqli_fetch_array($img_exec);

        if(isset($_FILES['img1']['name']) && ($_FILES['img1']['name'] != "")) {
            unlink("product_image/".$img_res["img1"]);
            $img1 = $adid."img1".$_FILES['img1']['name'];
            $target1 = "product_image/".basename($img1);
            move_uploaded_file($_FILES['img1']['tmp_name'], $target1);
        } else {
            $img1 = $img_res["img1"];
        }

        if(isset($_FILES['img2']['name']) && ($_FILES['img2']['name'] != "")) {
            unlink("product_image/".$img_res["img2"]);
            $img2 = $adid."img2".$_FILES['img2']['name'];
            $target2 = "product_image/".basename($img2);
            move_uploaded_file($_FILES['img2']['tmp_name'], $target2);
        } else {
            $img2 = $img_res["img2"];
        }

        if(isset($_FILES['img3']['name']) && ($_FILES['img3']['name'] != "")) {
            unlink("product_image/".$img_res["img3"]);
            $img3 = $adid."img3".$_FILES['img3']['name'];
            $target3 = "product_image/".basename($img3);
            move_uploaded_file($_FILES['img3']['tmp_name'], $target3);
        } else {
            $img3 = $img_res["img3"];
        }

        if(isset($_FILES['img4']['name']) && ($_FILES['img4']['name'] != "")) {
            unlink("product_image/".$img_res["img4"]);
            $img4 = $adid."img4".$_FILES['img4']['name'];
            $target4 = "product_image/".basename($img4);
            move_uploaded_file($_FILES['img4']['tmp_name'], $target4);
        } else {
            $img4 = $img_res["img4"];
        }
        
        $sql = "UPDATE advertisement SET title='".$title."',hsncode='".$hsncode."',description='".$description."',name='".$name."',companyname='".$companyname."',sellermail='".$sellermail."',phone='".$phone."',location='".$location."',country='".$country."',zipcode='".$zipcode."',img1='".$img1."',img2='".$img2."',img3='".$img3."',img4='".$img4."',price='".$price."',quantity='".$quantity."' WHERE userid='".$_SESSION["member_id"]."' AND id='".$adid."'";
        mysqli_query($conn, $sql);

        echo "<script>
                alert('Successfully Updated');
                window.location.href='products.php';
        </script>";
    }
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
            $.get("backend-search.php", {term: inputVal}).done(function(data){
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

<body style="background-color: #EBEBEB">

    <?php
            if(isset($_SESSION["member_id"]) && $_SESSION["status"] == true)
                {
                   ?>


    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div class="nav-container nav-transparent mb-2" style="background-color: #EBEBEB" >
        
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

        <!-- Post Ad Page Start Here -->
        <section class="s-space-bottom-full bg-accent-shadow-body" style="margin-top: 2%;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb--sm">
                        <div class="gradient-wrapper">
                            <div class="gradient-title">
                                <h2>Post A Free Add</h2>
                            </div>
                            <div class="input-layout1 gradient-padding post-ad-page">
<?php
$adid = intval($_REQUEST["id"]);
$sql = "SELECT * FROM advertisement WHERE userid='".$_SESSION["member_id"]."' AND id='".$adid."'";
$exec = mysqli_query($conn, $sql);
$res = mysqli_fetch_array($exec);
?>                                
                                <form method="POST" action="editadform.php?id=<?php echo $adid; ?>&action=edit" enctype="multipart/form-data">
                                    <div class="border-bottom-2 mb-50 pb-30">
                                        <div class="section-title-left-dark border-bottom d-flex">
                                            <h3><img src="img/post-add1.png" alt="post-add" class="img-fluid"> Product Information</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="add-title">Ad Title <span> *</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <input type="text" id="add-title" value="<?php echo $res['title']; ?>" class="form-control" name="title" placeholder="Product Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label" for="ad-code">HSN/TARIFF Code<span> *</span></label>
                                                <div class="search-box form-group search-input-area ">
                                                <input type="text" name="hsncode" value="<?php echo $res['hsncode']; ?>" autocomplete="off" class="form-control" placeholder="Search by HSN/TARIFF Code..." />
                                                <div class="result"></div>
                                            </div>
                                            </div>
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label" for="price">Price<span> *</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="price" value="<?php echo $res['price']; ?>" class="form-control" name="price" placeholder="Price" >
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label" for="quanitity">Quantity<span> *</span></label>
                                                <div class="form-group">
                                                    <input type="number" id="quantity" value="<?php echo $res['quantity']; ?>" class="form-control" name="quantity" placeholder="quantity">
                                                </div>
                                            </div>
                                        </div>                                       
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label">Description<span> *</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <textarea placeholder="What makes your ad unique" class="textarea form-control" name="description" id="description" rows="4" cols="20" data-error="Message field is required" required><?php echo $res['description']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="add-title">Upload Picture<span> *</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <ul class="picture-upload">
                                                        <li>
                                                            <input type="file" id="img-upload1" name="img1" class="form-control">
                                                            <?php if(($res['img1'] != "") && (file_exists("product_image/".$res['img1']))) { ?>
                                                            <img src="product_image/<?php echo $res['img1']; ?>" width="100" height="100"/>
                                                            <?php } ?>
                                                        </li>
                                                        <li>
                                                            <input type="file" id="img-upload2" name="img2" class="form-control">
                                                            <?php if(($res['img2'] != "") && (file_exists("product_image/".$res['img2']))) { ?>
                                                            <img src="product_image/<?php echo $res['img2']; ?>" width="100" height="100"/>
                                                            <?php } ?>
                                                        </li>
                                                        <li>
                                                            <input type="file" id="img-upload3" name="img3" class="form-control">
                                                            <?php if(($res['img3'] != "") && (file_exists("product_image/".$res['img3']))) { ?>
                                                            <img src="product_image/<?php echo $res['img3']; ?>" width="100" height="100"/>
                                                            <?php } ?>
                                                        </li>
                                                        <li>
                                                            <input type="file" id="img-upload4" name="img4" class="form-control">
                                                            <?php if(($res['img4'] != "") && (file_exists("product_image/".$res['img4']))) { ?>
                                                            <img src="product_image/<?php echo $res['img4']; ?>" width="100" height="100"/>
                                                            <?php } ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-bottom-2 mb-50 pb-30">
                                        <div class="section-title-left-dark border-bottom d-flex">
                                            <h3><img src="img/post-add2.png" alt="post-add" class="img-fluid"> Seller Information</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="seller-name">Name<span> *</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <input type="text" id="seller-name" value="<?php echo $res['name']; ?>" class="form-control" name="name" placeholder="Seller Name">
                                                </div>
                                            </div>
                                       </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="seller-company">Company Name<span> *</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <input type="text" id="seller-company" value="<?php echo $res['companyname']; ?>" name="companyname" class="form-control" placeholder="Seller Company">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="seller-mail">Seller Email<span> *</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <input type="text" id="seller-mail" value="<?php echo $res['sellermail']; ?>" class="form-control" name="sellermail" placeholder="Enter Your E-mail Address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="phone">Phone<span> *</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <input type="text" id="phone" value="<?php echo $res['phone']; ?>" class="form-control" name="phone" placeholder="Enter your Mobile">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="location">Location<span> *</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <input type="text" id="location2" value="<?php echo $res['location']; ?>" class="form-control" name="location" placeholder="Type Your Location">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="country">Country<span> *</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <input type="text" id="location2" value="<?php echo $res['country']; ?>" class="form-control" name="country" placeholder="Type Your Location">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="zip-code">ZIP Code<span> *</span></label>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-12">
                                                <div class="form-group">
                                                    <input type="text" id="zip-code" value="<?php echo $res['zipcode']; ?>" class="form-control" name="zipcode" placeholder="Enter Your ZIP Code">
                                                </div>
                                           </div>
                                            <div class="form-group mt-20" style="margin-left: 48%;">
                                            <button type="submit" name="submit" class="cp-default-btn-sm " >Submit Now!</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Post Ad Page End Here -->
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