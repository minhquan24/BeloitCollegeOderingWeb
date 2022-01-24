<?php
include 'includes/connect.php';
include 'includes/wallet.php';

	if($_SESSION['customer_sid']==session_id())
	{
		?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Past Orders</title>

  <!-- Favicons-->
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body>
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
  <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="index.php" class="brand-logo darken-1"><img src="images/materialize-logo.png" alt="logo"></a> <span class="logo-text">Logo</span></h1></li>
                    </ul>
                    <ul class="right hide-on-med-and-down">                        
                        <li><a href="#"  class="waves-effect waves-block waves-light"><i class="mdi-editor-attach-money"><?php echo $balance;?></i></a>
                        </li>
                    </ul>						
                </div>
            </nav>
        </div>
        <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
            <div class="row">
                <div class="col col s4 m4 l4">
                    <img src="images/avatar.jpg" alt="" class="circle responsive-img valign profile-image">
                </div>
				<div class="col col s8 m8 l8">
                    <ul id="profile-dropdown" class="dropdown-content">
                        <li><a href="routers/logout.php"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col col s8 m8 l8">
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $name;?> <i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <p class="user-roal"><?php echo $role;?></p>
                </div>
            </div>
            </li>
            <li class="bold"><a href="index.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i> Order Items</a>
            </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan "><i class="mdi-editor-insert-invitation"></i> Orders</a>
                            <div class="collapsible-body">
                                <ul>
								<li class="<?php
								if(!isset($_GET['status'])){
										echo 'active';
									}?>
									"><a href="orders.php">All Orders</a>
                                </li>
								<?php
									$sql = mysqli_query($con, "SELECT DISTINCT status FROM orders  WHERE customer_id = $user_id;;");
									while($row = mysqli_fetch_array($sql)){
									if(isset($_GET['status'])){
										$status = $row['status'];
									}
                                    echo '<li class='.(isset($_GET['status'])?($status == $_GET['status'] ? 'active' : ''): '').'><a href="orders.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
									}
									?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-question-answer"></i> Reports</a>
                            <div class="collapsible-body">
                                <ul>
								<li><a href="tickets.php">All Reports</a>
                                </li>
								<?php
									$sql = mysqli_query($con, "SELECT DISTINCT status FROM tickets WHERE poster_id = $user_id AND not deleted;");
									while($row = mysqli_fetch_array($sql)){
                                    echo '<li><a href="tickets.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
									}
									?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>				
            <li class="bold"><a href="details.php" class="waves-effect waves-cyan"><i class="mdi-social-person"></i> Edit Details</a>
            </li>
            <li class="bold active"><a href="check_out.php" class="waves-effect waves-cyan"><i class="mdi-navigation-check"></i> Check Out</a>
            </li>
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </aside>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
            </div>
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">eCommerce Products Page</h5>
                <ol class="breadcrumbs">
                    <li><a href="index.html">Dashboard</a></li>
                    <li><a href="#">Pages</a></li>
                    <li class="active">eCommerce Products Page</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        

        <!--start container-->
        <div class="container">
          <div class="section">
            <!-- statr products list -->
            <div id="products" class="row" style="position: relative; height: 1296.27px;">
                <div class="product-sizer"></div>
                <div class="product" style="position: absolute; left: 0px; top: 0px;">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">$189</a>
                            

                            <a href="#"><img src="images/img2.jpg" alt="product-img">
                            </a>
                        </div>
                        <ul class="card-action-buttons">
                            <li><a class="btn-floating waves-effect waves-light green accent-4"><i class="mdi-av-repeat"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                            </li>
                        </ul>
                        <div class="card-content">

                            <div class="row">
                                <div class="col s8">
                                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Apple MacBook Pro A1278 13"</a>
                                    </p>
                                </div>
                                <div class="col s4 no-padding">
                                    <a href=""></a><img src="images/amazon.jpg" alt="amazon" class="responsive-img">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal" style="display: none; transform: translateY(0px);">
                            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> Apple MacBook Pro A1278 13"</span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                    </div>
                </div>

                <div class="product" style="position: absolute; left: 236px; top: 0px;">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">$189</a>
                            

                            <a href="#"><img src="images/img5.jpg" alt="product-img">
                            </a>
                        </div>
                        <ul class="card-action-buttons">
                            <li><a class="btn-floating waves-effect waves-light green accent-4"><i class="mdi-av-repeat"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                            </li>
                        </ul>
                        <div class="card-content">

                            <div class="row">
                                <div class="col s8">
                                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Apple MacBook Pro A1278 13"</a>
                                    </p>
                                </div>
                                <div class="col s4 no-padding">
                                    <a href=""></a><img src="images/amazon.jpg" alt="amazon" class="responsive-img">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> Apple MacBook Pro A1278 13"</span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                    </div>
                </div>

                <div class="product" style="position: absolute; left: 473px; top: 0px;">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">$189</a>
                            

                            <a href="#"><img src="images/img7.jpg" alt="product-img">
                            </a>
                        </div>
                        <ul class="card-action-buttons">
                            <li><a class="btn-floating waves-effect waves-light green accent-4"><i class="mdi-av-repeat"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                            </li>
                        </ul>
                        <div class="card-content">

                            <div class="row">
                                <div class="col s8">
                                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Apple MacBook Pro A1278 13"</a>
                                    </p>
                                </div>
                                <div class="col s4 no-padding">
                                    <a href=""></a><img src="images/amazon.jpg" alt="amazon" class="responsive-img">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> Apple MacBook Pro A1278 13"</span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                    </div>
                </div>

                <div class="product" style="position: absolute; left: 710px; top: 0px;">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">$189</a>
                            

                            <a href="#"><img src="images/img3.jpg" alt="product-img">
                            </a>
                        </div>
                        <ul class="card-action-buttons">
                            <li><a class="btn-floating waves-effect waves-light green accent-4"><i class="mdi-av-repeat"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                            </li>
                        </ul>
                        <div class="card-content">

                            <div class="row">
                                <div class="col s8">
                                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Apple MacBook Pro A1278 13"</a>
                                    </p>
                                </div>
                                <div class="col s4 no-padding">
                                    <a href=""></a><img src="images/amazon.jpg" alt="amazon" class="responsive-img">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> Apple MacBook Pro A1278 13"</span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                    </div>
                </div>

                <div class="product" style="position: absolute; left: 946px; top: 0px;">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">$189</a>
                            

                            <a href="#"><img src="images/img4.jpg" alt="product-img">
                            </a>
                        </div>
                        <ul class="card-action-buttons">
                            <li><a class="btn-floating waves-effect waves-light green accent-4"><i class="mdi-av-repeat"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                            </li>
                        </ul>
                        <div class="card-content">

                            <div class="row">
                                <div class="col s8">
                                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Apple MacBook Pro A1278 13"</a>
                                    </p>
                                </div>
                                <div class="col s4 no-padding">
                                    <a href=""></a><img src="images/amazon.jpg" alt="amazon" class="responsive-img">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> Apple MacBook Pro A1278 13"</span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                    </div>
                </div>

                <div class="product" style="position: absolute; left: 710px; top: 251px;">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">$189</a>
                            

                            <a href="#"><img src="images/img5.jpg" alt="product-img">
                            </a>
                        </div>
                        <ul class="card-action-buttons">
                            <li><a class="btn-floating waves-effect waves-light green accent-4"><i class="mdi-av-repeat"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                            </li>
                        </ul>
                        <div class="card-content">

                            <div class="row">
                                <div class="col s8">
                                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Apple MacBook Pro A1278 13"</a>
                                    </p>
                                </div>
                                <div class="col s4 no-padding">
                                    <a href=""></a><img src="images/amazon.jpg" alt="amazon" class="responsive-img">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> Apple MacBook Pro A1278 13"</span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                    </div>
                </div>

                <div class="product" style="position: absolute; left: 946px; top: 251px;">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">$189</a>
                            

                            <a href="#"><img src="images/img6.jpg" alt="product-img">
                            </a>
                        </div>
                        <ul class="card-action-buttons">
                            <li><a class="btn-floating waves-effect waves-light green accent-4"><i class="mdi-av-repeat"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                            </li>
                        </ul>
                        <div class="card-content">

                            <div class="row">
                                <div class="col s8">
                                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Apple MacBook Pro A1278 13"</a>
                                    </p>
                                </div>
                                <div class="col s4 no-padding">
                                    <a href=""></a><img src="images/amazon.jpg" alt="amazon" class="responsive-img">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> Apple MacBook Pro A1278 13"</span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                    </div>
                </div>

                <div class="product" style="position: absolute; left: 0px; top: 305px;">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">$189</a>
                            

                            <a href="#"><img src="images/img7.jpg" alt="product-img">
                            </a>
                        </div>
                        <ul class="card-action-buttons">
                            <li><a class="btn-floating waves-effect waves-light green accent-4"><i class="mdi-av-repeat"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                            </li>
                        </ul>
                        <div class="card-content">

                            <div class="row">
                                <div class="col s8">
                                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Apple MacBook Pro A1278 13"</a>
                                    </p>
                                </div>
                                <div class="col s4 no-padding">
                                    <a href=""></a><img src="images/amazon.jpg" alt="amazon" class="responsive-img">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> Apple MacBook Pro A1278 13"</span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                    </div>
                </div>

                <div class="product" style="position: absolute; left: 473px; top: 414px;">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">$189</a>
                            

                            <a href="#"><img src="images/img8.jpg" alt="product-img">
                            </a>
                        </div>
                        <ul class="card-action-buttons">
                            <li><a class="btn-floating waves-effect waves-light green accent-4"><i class="mdi-av-repeat"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                            </li>
                        </ul>
                        <div class="card-content">

                            <div class="row">
                                <div class="col s8">
                                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Apple MacBook Pro A1278 13"</a>
                                    </p>
                                </div>
                                <div class="col s4 no-padding">
                                    <a href=""></a><img src="images/amazon.jpg" alt="amazon" class="responsive-img">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> Apple MacBook Pro A1278 13"</span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                    </div>
                </div>

                <div class="product" style="position: absolute; left: 236px; top: 522px;">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">$189</a>
                            

                            <a href="#"><img src="images/img2.jpg" alt="product-img">
                            </a>
                        </div>
                        <ul class="card-action-buttons">
                            <li><a class="btn-floating waves-effect waves-light green accent-4"><i class="mdi-av-repeat"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                            </li>
                        </ul>
                        <div class="card-content">

                            <div class="row">
                                <div class="col s8">
                                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Apple MacBook Pro A1278 13"</a>
                                    </p>
                                </div>
                                <div class="col s4 no-padding">
                                    <a href=""></a><img src="images/amazon.jpg" alt="amazon" class="responsive-img">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> Apple MacBook Pro A1278 13"</span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                    </div>
                </div>

                <div class="product" style="position: absolute; left: 0px; top: 719px;">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">$189</a>
                            

                            <a href="#"><img src="images/img7.jpg" alt="product-img">
                            </a>
                        </div>
                        <ul class="card-action-buttons">
                            <li><a class="btn-floating waves-effect waves-light green accent-4"><i class="mdi-av-repeat"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                            </li>
                        </ul>
                        <div class="card-content">

                            <div class="row">
                                <div class="col s8">
                                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Apple MacBook Pro A1278 13"</a>
                                    </p>
                                </div>
                                <div class="col s4 no-padding">
                                    <a href=""></a><img src="images/amazon.jpg" alt="amazon" class="responsive-img">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> Apple MacBook Pro A1278 13"</span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                    </div>
                </div>

                <div class="product" style="position: absolute; left: 710px; top: 773px;">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">$189</a>
                            

                            <a href="#"><img src="images/img4.jpg" alt="product-img">
                            </a>
                        </div>
                        <ul class="card-action-buttons">
                            <li><a class="btn-floating waves-effect waves-light green accent-4"><i class="mdi-av-repeat"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                            </li>
                        </ul>
                        <div class="card-content">

                            <div class="row">
                                <div class="col s8">
                                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Apple MacBook Pro A1278 13"</a>
                                    </p>
                                </div>
                                <div class="col s4 no-padding">
                                    <a href=""></a><img src="images/amazon.jpg" alt="amazon" class="responsive-img">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> Apple MacBook Pro A1278 13"</span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                    </div>
                </div>

                <div class="product" style="position: absolute; left: 946px; top: 773px;">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">$189</a>
                            

                            <a href="#"><img src="images/img6.jpg" alt="product-img">
                            </a>
                        </div>
                        <ul class="card-action-buttons">
                            <li><a class="btn-floating waves-effect waves-light green accent-4"><i class="mdi-av-repeat"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                            </li>
                        </ul>
                        <div class="card-content">

                            <div class="row">
                                <div class="col s8">
                                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Apple MacBook Pro A1278 13"</a>
                                    </p>
                                </div>
                                <div class="col s4 no-padding">
                                    <a href=""></a><img src="images/amazon.jpg" alt="amazon" class="responsive-img">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> Apple MacBook Pro A1278 13"</span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                    </div>
                </div>

            </div>
            <!--/ end items list -->
          </div>
          <!-- Floating Action Button -->
            <div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
                <a class="btn-floating btn-large">
                  <i class="mdi-action-stars"></i>
                </a>
                <ul>
                  <li><a href="css-helpers.html" class="btn-floating red"><i class="large mdi-communication-live-help"></i></a></li>
                  <li><a href="app-widget.html" class="btn-floating yellow darken-1"><i class="large mdi-device-now-widgets"></i></a></li>
                  <li><a href="app-calendar.html" class="btn-floating green"><i class="large mdi-editor-insert-invitation"></i></a></li>
                  <li><a href="app-email.html" class="btn-floating blue"><i class="large mdi-communication-email"></i></a></li>
                </ul>
            </div>
            <!-- Floating Action Button -->
        </div>
        <!--end container-->
      </section>
    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START FOOTER -->
  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span>Copyright © 2021 <a class="grey-text text-lighten-4" href="#" target="_blank">Minh Quan</a> All rights reserved.</span>
        <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="#">Minh Quan</a></span>
        </div>
    </div>
  </footer>
    <!-- END FOOTER -->



    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>    
    <!--angularjs-->
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>       
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
</body>

</html>
<?php
	}
	else
	{
		if($_SESSION['admin_sid']==session_id())
		{
			header("location:all-orders.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>
