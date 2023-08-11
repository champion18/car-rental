<?php
//error_reporting(0);
if (isset($_POST['usersignup'])) {
  $fname = $_POST['userfullname'];
  $email = $_POST['useremail'];
  $contactno = $_POST['usercontactno'];
  $password = md5($_POST['userpassword']);
  $sql = "INSERT INTO users(FullName,Email,Password,ContactNo) VALUES(:fname,:email,:password,:contactno)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':fname', $fname, PDO::PARAM_STR);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->bindParam(':contactno', $contactno, PDO::PARAM_INT);
  $query->bindParam(':password', $password, PDO::PARAM_STR);
  $query->execute();
  $lastInsertId = $dbh->lastInsertId();
  if ($lastInsertId) {
    echo "<script>alert('Registration successful. Now you can login');</script>";
  } else {
    echo "<script>alert('Something went wrong. Please try again');</script>";
  }
}
?>


<script>
  function checkAvailability() {
    console.log("check")
    jQuery.ajax({
      url: "check_availability.php",
      data: 'email=' + $("#useremail").val(),
      type: "POST",
      success: function (data) {
        $(".user-availability-status").html(data);
      },
      error: function () { }
    });
  }
</script>
<script type="text/javascript">
  function valid() {
    if (document.signup.userpassword.value != document.signup.confirmuserpassword.value) {
      alert("Password and Confirm Password fields do not match. Please try again.");
      document.signup.confirmpassword.focus();
      return false;
    }
    return true;
  }
</script>
<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Sign Up</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post" name="signup" onSubmit="return valid();">
                <div class="form-group">
                  <input type="text" class="form-control" name="userfullname" placeholder="Full Name" required="required">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="useremail" id="useremail" onBlur="checkAvailability()" placeholder="Email Address" required="required">
                   <span class="user-availability-status" style="font-size:12px;"></span> 
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="usercontactno" placeholder="Contact Number" maxlength="10"
                    required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="userpassword" placeholder="Password"
                    required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmuserpassword" placeholder="Confirm Password"
                    required="required">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
                </div>
                <div class="form-group">
                  <input type="submit" value="Sign Up" name="usersignup" id="submit" class="btn btn-block">
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </div>
</div>