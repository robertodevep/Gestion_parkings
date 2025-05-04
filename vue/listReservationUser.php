<?php
require("header.php")
?>

<!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Liste des Reservations user</h1>
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
                                            <th>Date début</th>
                                            <th>Date fin</th>
                                            <th>Statut</th>
                                            <th>Montant total</th>
                                            <th>Utilisateur</th>
                                            <th>place</th>
                                            <th>Nombre Heure</th>
                                            <th>parking</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Date début</th>
                                            <th>Date fin</th>
                                            <th>Statut</th>
                                            <th>Montant total</th>
                                            <th>User</th>
                                            <th>place</th>
                                            <th>Nombre Heure</th>
                                            <th>parking</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    
                                    <?php foreach($listReservation as $data) { ?>
                                      <tr>
                                         <td><?php echo $data['date_debut'] ?></td>
                                         <td><?php echo $data['date_fin'] ?></td>
                                          <td><?php echo $data['statut'] ?></td>
                                          <td><?php echo $data['montant_total'] ?></td>
                                          <td><?php echo $data['nom_user'] ?></td>
                                          <td><?php echo $data['numero_place'] ?></td>
                                          <td><?php echo $data['nombre_heure'] ?></td>
                                          <td><?php echo $data['localisation_park'] ?></td>

                                          <td>
                                            <div class="d-flex" style="gap: 5px;">
                                                <a href="<?= $base_path ?>vue/voir_reservation.php?id=<?= htmlspecialchars($data['id_reservation']) ?>" 
                                                class="btn btn-sm btn-info p-1 shadow-sm" 
                                                title="Imprimer">
                                                    <i class="fas fa-print fa-xs"></i> 
                                                </a>
                                                <a href="<?= $base_path ?>index.php?page=effectuerPay&id=<?= htmlspecialchars($data['id_reservation']) ?>" 
                                                class="btn btn-sm btn-success p-1 shadow-sm" 
                                                title="Payer">
                                                    <i class="fas fa-credit-card fa-xs"></i>
                                                </a>
                                            </div>
                                        </td>
                                          
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