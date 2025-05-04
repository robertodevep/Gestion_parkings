
    
<?php
require("header.php")
?>

<!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Liste des Paiement user</h1>
                    <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- <h6 class="m-0 font-weight-bold text-primary">Liste des réservations</h6> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>	
                                            <th>Numero De Paiement</th>
                                            <th>Moyen De Paiement</th>
                                            <th>Montant Paiement</th>
                                            <th>Statut</th>
                                            <th>Date paiement</th>
                                            <th>localisation Parkings</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Numero De Paiement</th>
                                            <th>Moyen De Paiement</th>
                                            <th>Montant Paiement</th>
                                            <th>Statut</th>
                                            <th>Date paiement</th>
                                            <th>localisation Parkings</th>
                                        </tr>
                                    </tfoot>
                                    <tbody> 
                                    
                                    <?php foreach($listpaiementAll as $data) { ?>
                                      <tr>
                                         <td><?php echo $data['numero_pay'] ?></td>
                                         <td><?php echo $data['moyen_pay'] ?></td>
                                          <td><?php echo $data['montantpaiement'] ?></td>
                                          <td><?php echo $data['statut'] ?></td>
                                          <td><?php echo $data['datepaiement'] ?></td>
                                          <td><?php echo $data['localisation_park'] ?></td>
                                          
                                        </tr>
                                   <?php } ?>

                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            
            <!-- End of Main Content -->

            <!-- Footer -->
<?php
require("footer.php")
?>