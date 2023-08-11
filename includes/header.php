

<header>
  <div class="default-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2">
          <div class="logo"> <a href="index.php"><img src="assets/images/logg.png" alt="logo" /></a> </div>
        </div>
        <div class="col-sm-9 col-md-10">
          <div class="header_info">
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
              <p class="uppercase_text">For Support Mail us : </p>
              <a href="mailto:info@example.com">info@gmail.com</a>
            </div>
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
              <p class="uppercase_text">Service Helpline Call Us: </p>
              <a href="tel:61-1234-5678-09">+91-9876543210</a>
            </div>
            <div class="social-follow">
              <ul>
                <li><a href="https://facebook.com/"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                <li><a href="https://twitter.com/"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                <li><a href="https://www.linkedin.com/"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                </li>
                <li><a href="https://www.google.com/"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
                </li>
                <li><a href="https://www.instagram.com/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
              </ul>
            </div>
            <?php if (strlen($_SESSION['login']) == 0 && strlen($_SESSION['agencylogin']) == 0) {
              ?>
              <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal"
                  data-dismiss="modal">Login / Register</a> </div>
            <?php } else {

              echo " Hii ,Welcome To Car rental portal";
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse"
          class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span
            class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="header_search">
        <div id="search_toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
        <form action="#" method="get" id="header-search-form">
          <input type="text" placeholder="Search..." class="form-control">
          <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
      </div>
    </div>
    <div class="collapse navbar-collapse" id="navigation">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="page.php?type=aboutus">About Us</a></li>

        <?php if ($_SESSION['agencylogin']) { ?>
          <li><a href="agency/manage-vehicles.php" data-toggle="modal" data-dismiss="modal">Add New Car</a></li>
          <li><a href="agency/manage-bookings.php" data-toggle="modal" data-dismiss="modal">View Booked Cars</a></li>
        <?php } else if (!$_SESSION['login']) { ?>
          <li><a href="#regagencyform" data-toggle="modal" data-dismiss="modal">Register Your Agency</a></li>
        <?php } ?>

        <li><a href="contact-us.php">Contact Us</a></li>
        <?php if ($_SESSION['login'] || $_SESSION['agencylogin']) { ?>
          <li><a href="logout.php">Sign Out</a></li>
        <?php } ?>

      </ul>
    </div>

    </div>
  </nav>

  <!-- Navigation end

</header>