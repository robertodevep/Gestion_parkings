<?php
require("header.php")
?>

<!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Liste des Reservations</h1>
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
                                    <?php foreach($listReservatio as $data) { ?>
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
                                             <?php if ($data['statut'] === 'active') : ?>
                                                <a href="index.php?page=cloturer_reservation&id=<?= $data['id_reservation'] ?>"
                                                onclick="return confirm('Clôturer cette réservation ?');">
                                                    Fermer
                                                </a>
                                                <?php else : ?>
                                                     Terminer
                                                <?php endif; ?>
                                                  
                                                    <a href="vue/voir_reservation.php?id=<?php echo $data['id_reservation']; ?>" title="Voir et imprimer">
                                                        👁️
                                                    </a>
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