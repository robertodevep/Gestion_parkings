<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Font Awesome -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet">
    <!-- SB Admin 2 CSS -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
        }

        .center-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-group-text {
            background-color: #f8f9fc;
            border: none;
        }

        .form-control:focus {
            box-shadow: none;
        }
    </style>

</head>

<body class="bg-gradient-primary">
<?php
// Récupération de la variable base_path depuis les globals
// $base_path = $GLOBALS['base_path'] ?? '/gestion_parking/';
$message = $_SESSION['flash_message'] ?? ''; // on recupere un un message temporairement stocker dans la session
unset($_SESSION['flash_message']); // Supprime la variable de session après utilisation
 $base_path="/gestion_parking/";
 // htmlspecialchars protège contre les injections HTML ou JS
?>

    <div class="container center-container">
        <div class="col-lg-8">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Inscription !</h1>
                    </div>
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
                    <?php endif; ?>
                        
                    <form class="user" action="<?= $base_path ?>index.php?page=register" method="POST" id="loginForm">
                    <!-- <input type="hidden" name="valider" value="1"> -->
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="nom" id="nom" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="prenom" id="prenom" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" name="telephone" id="telephone" class="form-control form-control-user" id="examplePhone" placeholder="Phone Number">
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-city"></i></span>
                                </div>
                                <input type="text" name="ville" id="ville" class="form-control form-control-user" id="exampleCity" placeholder="City">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="passwords" id="passwords" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"></span>
                                    </div>
                                    <input type="text" name="roles" id="roles" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Role">
                                </div>
                            </div>
                        </div>

                        <button type="submit" name="register" class="btn btn-primary btn-user btn-block">
                          Register Account
                        </button>

                        
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="index.php">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
