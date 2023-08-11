<?php
//error_reporting(0);
if (isset($_POST['signup'])) {
    $agencyname = $_POST['agencyname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $password = md5($_POST['password']);
    $sql = "INSERT INTO agencies(AgencyName,Email,ContactNo,Password) VALUES(:agencyname,:email,:contactno,:password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':agencyname', $agencyname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
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
        jQuery.ajax({
            url: "check_availability.php",
            data: 'email=' + $("#email").val(),
            type: "POST",
            success: function (data) {
                $("#user-availability-status").html(data);
            },
            error: function () { }
        });
    }
</script>
<script type="text/javascript">
    function valid() {
        if (document.signup.password.value != document.signup.confirmpassword.value) {
            console.log("document.signup.password.value", document.signup.password.value)
            console.log("document.signup.confirmpassword.value", document.signup.confirmpassword.value)

            alert("Password and Confirm Password Field do not match  !!");
            document.signup.confirmpassword.focus();
            return false;
        }
        return true;
    }
</script>
<div class="modal fade" id="regagencyform">
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
                                <label for="agencyname" class="text-uppercase text-sm">Agency Name</label>
                                <input type="text" placeholder="Agency name" name="agencyname" class="form-control mb" required="required">

                                <div class="form-group">
                                    <label for="email" class="text-uppercase text-sm">Email Address</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        onBlur="checkAvailability()" placeholder="Email Address" required="required">
                                    <span id="user-availability-status" style="font-size:12px;"></span>
                                </div>

                                <label for="contactno" class="text-uppercase text-sm">Contact No.</label>
                                <input type="text" placeholder="Contact Number" name="contactno"
                                    class="form-control mb" required="required">

                                <label for="password" class="text-uppercase text-sm">Password</label>
                                <input type="password" placeholder="Password" name="password" class="form-control mb" required="required">

                                <label for="confirmpassword" class="text-uppercase text-sm">Confirm Password</label>
                                <input type="password" class="form-control" name="confirmpassword"
                                    placeholder="Confirm Password" required="required">

                                <button class="btn btn-primary btn-block" name="signup" type="submit">Register
                                    Agency</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a>
                </p>
            </div>
        </div>
    </div>
</div>