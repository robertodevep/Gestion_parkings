    <?php
        require("header.php");
    ?>

    <?php
     $parking = new parkings();
      $nombreParkings = $parking->getallPard();
      $nbrTotalDispo=$parking->getAllParkIndispo();
      $nbrTotalDisponible=$parking->getAllParkDispo();

      $reservationModel = new ReservationModel();
      $nombreResrvationActive=$reservationModel->getallReservationActive();
      $nombreResrvationTerminer=$reservationModel->getallReservationTerminer();

      $userModel = new UserModel();
     $nombreTotalUser=$userModel->getalluser();

     $paiement = new Paiement();
     $totalPaiement=$paiement->getAllTotalpayement();
     $nbrPaiement=$paiement->getAllNbrPayement();

     
                
    ?>


                    <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                NOMBRE TOTAL DE PARKINGS</div> 
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nombreParkings['total_parkings'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-parking fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                NOMBRE TOTAL DE PARKINGS DISPONIBLE</div> 
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nbrTotalDisponible['total_parkdispo'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-parking fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                NOMBRE TOTAL DE PARKINGS INDISPONIBLE</div> 
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nbrTotalDispo['total_parkindispo'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-parking fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NOMBRE TOTAL DE RESERVATION ENCOURS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nombreResrvationActive['total_reservActif'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NOMBRE TOTAL DE RESERVATION TERMINER</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nombreResrvationTerminer['total_reservTerminer'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                NOMBRE TOTAL D'UTILISATEURS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nombreTotalUser['total_user'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">NOMBRE DE PAYEMENT EFECTUER
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $nbrPaiement['nbr_paiement'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                TOTAL PAYEMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalPaiement['total_paiement'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
           
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <?php
   require("footer.php")
   ?>