

<header>
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse"
          class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span
            class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
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
    <?php if (strlen($_SESSION['login']) == 0 && strlen($_SESSION['agencylogin']) == 0) {
              ?>
              <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal"
                  data-dismiss="modal">Login / Register</a> </div>
            <?php } else {

              echo " Hii ,Welcome To Car rental portal";
            } ?>

    </div>
  </nav>

</header>