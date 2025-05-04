<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
     <!-- Custom fonts for this template -->
     <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <title>SB Admin 2 - Dashboard</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <div id="wrapper">

       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Bienvenu <sup>Mr/ Mme</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- // menu pour tour les user  -->
            <?php if($_SESSION['roles']=="utilisateur"){ ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesre"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Reservation</span>
                </a>
                <div id="collapsePagesre" class="collapse" aria-labelledby="headingPagesre" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?page=reserver">Reserver</a>
                        <a class="collapse-item" href="index.php?page=listReservationUser">List</a>
                         <!-- <a class="collapse-item" href="index.php?page=liste_reservations.php">List</a> -->
                    </div>
                </div>
            </li>
            <!-- NAV ITEME -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagespye"
                    aria-expanded="true" aria-controls="collapsePagespye">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Paiement</span>
                </a>
                <div id="collapsePagespye" class="collapse" aria-labelledby="headingPagespye" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?page=listReservationUser">payer</a>
                        <a class="collapse-item" href="index.php?page=listpaiement">List</a>
                         <!-- <a class="collapse-item" href="index.php?page=liste_reservations.php">List</a> -->
                    </div>
                </div>
            </li>

            <?php } ?>

            <!-- // fin -->

            <?php if(isset($_SESSION['roles']) && $_SESSION['roles'] == "admin") { ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesre"
                    aria-expanded="true" aria-controls="collapsePagesre">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Reservation</span>
                </a>
                <div id="collapsePagesre" class="collapse" aria-labelledby="headingPagesre" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?page=reserver">Reserver</a>
                        <a class="collapse-item" href="index.php?page=listReservation">List</a>
                         <!-- <a class="collapse-item" href="index.php?page=liste_reservations.php">List</a> -->
                    </div>
                </div>
            </li>
            <!-- NAV ITEME p-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagespye"
                    aria-expanded="true" aria-controls="collapsePagespye">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Paiement</span>
                </a>
                <div id="collapsePagespye" class="collapse" aria-labelledby="headingPagespye" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?page=listReservationUser">payer</a>
                        <a class="collapse-item" href="index.php?page=listpaiementAll">List</a>
                         <!-- <a class="collapse-item" href="index.php?page=liste_reservations.php">List</a> -->
                    </div>
                </div>
            </li>

               
            <!-- Nav Item - Charts p-->
          
            <li class="nav-item">
                <a class="nav-link" href="historique.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Historique</span></a>
            </li>

                    <!-- Nav Item - Users -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                    aria-expanded="true" aria-controls="collapseUsers">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Utilisateurs</span>
                </a>
                <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?page=register">Ajouter</a>
                        <a class="collapse-item" href="index.php?page=list_user">List</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Parking -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseParking"
                    aria-expanded="true" aria-controls="collapseParking">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Parking</span>
                </a>
                <div id="collapseParking" class="collapse" aria-labelledby="headingParking" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?page=ajouter_park">Ajouter</a>
                        <a class="collapse-item" href="index.php?page=liste_parkings">Liste</a>   
                    </div>
                </div>
            </li>
            <?php } ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nom']; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item"  href="<?= $base_path ?>index.php?page=list_profilUser&id=<?= $_SESSION['user_id']; ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <!-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a> -->
                                <div class="dropdown-divider"></div> 
                                <!-- index.php?page=logout -->
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                                <!-- <li><a href="index.php?page=logout"><span class="icon nalika-unlocked author-log-ic"></span> Se Deconnecter</a> -->
                                <!-- data-target="#logoutModal" -->
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
                        <!-- //gsghs  ajout pour la comfirmation-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Voulez-vous vraiment vous déconnecter ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <a class="btn btn-primary" href="index.php?page=logout">Confirmer</a>
                    </div>
                    </div>
                </div>
                </div>
                
