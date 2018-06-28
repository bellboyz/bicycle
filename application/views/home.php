<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Back-Office Management System | Rungkit</title>

  <link rel="icon" href="common/img/130276.png" type="image/gif" sizes="16x16">

  <!-- Bootstrap CSS -->
  <link href="common/css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="common/css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="common/css/elegant-icons-style.css" rel="stylesheet" />
  <link href="common/css/font-awesome.min.css" rel="stylesheet" />
  <!-- full calendar css-->
  <link href="common/plugins/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <link href="common/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="common/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />
  <!-- owl carousel -->
  <link rel="stylesheet" href="common/css/owl.carousel.css" type="text/css">
  <link href="common/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
  <!-- Custom styles -->
  <link rel="stylesheet" href="common/css/fullcalendar.css">
  <link href="common/css/widgets.css" rel="stylesheet">
  <link href="common/css/style.css" rel="stylesheet">
  <link href="common/css/style-responsive.css" rel="stylesheet" />
  <link href="common/css/xcharts.min.css" rel=" stylesheet">
  <link href="common/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="common/css/w3.css">
  <link rel="stylesheet" type="text/css" href="common/css/hover.css">

  <!-- =======================================================
    Theme Name: NiceAdmin
    Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
  ======================================================= -->

  <style>
    /* Center the loader */
    #loader {
      position: absolute;
      left: 50%;
      top: 50%;
      z-index: 1;
      width: 150px;
      height: 150px;
      margin: -75px 0 0 -75px;
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 120px;
      height: 120px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Add animation to "page content" */
    .animate-bottom {
      position: relative;
      -webkit-animation-name: animatebottom;
      -webkit-animation-duration: 1s;
      animation-name: animatebottom;
      animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
      from { bottom:-100px; opacity:0 } 
      to { bottom:0px; opacity:1 }
    }

    @keyframes animatebottom { 
      from{ bottom:-100px; opacity:0 } 
      to{ bottom:0; opacity:1 }
    }

    #myDiv {
      display: none;
      text-align: center;
    }

    .home-icon{
      width: 200px; 
      height: 200px;
      display: inline;
      padding: 20px;
    }
    p{
      font-size: 22px;
      color: black
    }

    #picture{
      background-image: url("common/img/animation-02.gif");
      background-repeat: no-repeat;
      background-position: 1100px 420px;
      background-size: 450px 300px;
    } 
       
  </style>

</head>

<body id="picture">
  <!-- container section start -->
  <section id="container" class="">

    <?php include('include/header.php') ?>
    <?php include('include/sidebar.php') ?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">

       <body onload="myFunction()" style="margin:0;">

          <div id="loader"></div>

          <div style="display:none;" id="myDiv" class="animate-bottom">
            <center><h3>WELCOME BACK ! </h3>
              <!-- <br> <?php echo date("l jS \of F Y h:i:s A") ?> </center>  --><br><br>
           <!--  <img src=""> -->
            <div class="col-md-3">
              <a href="/stock" class="hvr-float">
                <img src="common/img/stock.png" class="home-icon" style="background-color: #cab6c7;">
                <center><p>สต๊อกสินค้า</p></center>
              </a>
            </div>

            <div class="col-md-3">
              <a href="/customer" class="hvr-float">
                <img src="common/img/customer.png" class="home-icon" style="background-color: #54c79c;">
                <center><p>ลูกค้า</p></center>
              </a>
            </div>

            <div class="col-md-3">
              <a href="/deposit" class="hvr-float">
                <img src="common/img/deposit.png" class="home-icon" style="background-color: #db5b96;">
                <center><p>ใบฝากสินค้า</p></center>
              </a>
            </div>

            <div class="col-md-3">
              <a href="/billing" class="hvr-float">
                <img src="common/img/billing.png" class="home-icon" style="background-color: #dcf414;">
                <center><p>ใบวางบิล</p></center>
              </a>
            </div>

            <br><br>

            <div class="col-md-3">
              <a href="/report" class="hvr-float">
                <img src="common/img/report.png" class="home-icon" style="background-color: #7c87d9;">
                <center><p>รายงาน</p></center>
              </a>
            </div>

            <div class="col-md-3">
              <a href="/search" class="hvr-float">
                <img src="common/img/search.png" class="home-icon" style="background-color: #9ef2b4;">
                <center><p>ค้นหา</p></center>
              </a>
            </div>


          </div>

      </section>
      
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->

  <script>
  var myVar;

  function myFunction() {
      myVar = setTimeout(showPage, 1500);
  }

  function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
  }
  </script>

  <script src="common/js/jquery.js"></script>
  <script src="common/js/jquery-ui-1.10.4.min.js"></script>
  <script src="common/js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="common/js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="common/js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="common/js/jquery.scrollTo.min.js"></script>
  <script src="common/js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- charts scripts -->
  <script src="common/plugins/jquery-knob/js/jquery.knob.js"></script>
  <script src="common/js/jquery.sparkline.js" type="text/javascript"></script>
  <script src="common/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
  <script src="common/js/owl.carousel.js"></script>
  <!-- jQuery full calendar -->
  <script src="common/js/fullcalendar.min.js"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="common/plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="common/js/calendar-custom.js"></script>
    <script src="common/js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="common/js/jquery.customSelect.min.js"></script>
    <script src="common/plugins/chart-master/Chart.js"></script>

    <!--custome script for all page-->
    <script src="common/js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="common/js/sparkline-chart.js"></script>
    <script src="common/js/easy-pie-chart.js"></script>
    <script src="common/js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="common/js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="common/js/xcharts.min.js"></script>
    <script src="common/js/jquery.autosize.min.js"></script>
    <script src="common/js/jquery.placeholder.min.js"></script>
    <script src="common/js/gdp-data.js"></script>
    <script src="common/js/morris.min.js"></script>
    <script src="common/js/sparklines.js"></script>
    <script src="common/js/charts.js"></script>
    <script src="common/js/jquery.slimscroll.min.js"></script>

</body>

</html>
