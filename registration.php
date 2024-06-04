<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-gradient-light">

    <?php
    include('includes/header.php');
    ?>

    <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block register-image"></div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            <?php alertMessage(); ?>
                        </div>
                        <form name="registrationForm" class="user" action="login-code.php" method="POST" onsubmit="return validateForm()">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="FullName" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control form-control-user" name="MobileNo" placeholder="Phone no" required>
                            </div>
                            <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="Address" placeholder="Address" title="City name" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="Password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="registerMember" class="btn btn-primary btn-user btn-block"  onclick="return validateForm()">
                                    Register Account
                                </button>   
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="login.php">Already have an account? Login !</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <script>
            // Function to validate the form
            function validateForm() {
                var fullName = document.forms["registrationForm"]["FullName"].value;
                var mobileNo = document.forms["registrationForm"]["MobileNo"].value;
                var address = document.forms["registrationForm"]["Address"].value;
                var password = document.forms["registrationForm"]["Password"].value;

                // Check if any field is empty
                if (fullName == "" || mobileNo == "" || address == "" || password == "") {
                    alert("All fields must be filled out");
                    return false;
                }
                //Validate name
                var nameRegex = /^[A-Za-z\s]+$/;
                if (!nameRegex.test(fullName)) {
                    alert("Name must contain only letters");
                    return false;
                }

                // Validate phone number
                var phoneRegex = /^[789]\d{9}$/;
                if (!phoneRegex.test(mobileNo)) {
                    alert("Please enter a valid 10-digit phone number");
                    return false;
                }

                // Password length validation
                if (password.length < 6) {
                    alert("Password must be at least 6 characters long");
                    return false;
                }

                // If all validations pass, return true
                return true;
            }
        </script>
        <?php include('includes/footer.php'); ?>
    </body>


</html>