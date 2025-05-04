
<?php
require("header.php")
?>


                <!-- Begin Page Content -->
<div class="container-fluid mt-4">
                 <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Historique de Réservations</h1>
                <br>
               <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Statut</th>
                            <th>Montant total</th>
                            <th>Utilisateur</th>
                            <th>Place</th>
                            <th>Parking</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Statut</th>
                            <th>Montant total</th>
                            <th>Utilisateur</th>
                            <th>Place</th>
                            <th>Parking</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2025-04-01</td>
                            <td>2025-04-02</td>
                            <td><span class="badge bg-success">Confirmée</span></td>
                            <td>5000 FCFA</td>
                            <td>Jean Dupont</td>
                            <td>Place 12</td>
                            <td>Parking Central</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary" title="Détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Supprimer cette réservation ?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>2025-04-05</td>
                            <td>2025-04-07</td>
                            <td><span class="badge bg-warning text-dark">En attente</span></td>
                            <td>10000 FCFA</td>
                            <td>Alice Messi</td>
                            <td>Place 7</td>
                            <td>Parking Nord</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary" title="Détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Supprimer cette réservation ?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2025-04-10</td>
                            <td>2025-04-11</td>
                            <td><span class="badge bg-danger">Annulée</span></td>
                            <td>0 FCFA</td>
                            <td>Mohamed Traoré</td>
                            <td>Place 5</td>
                            <td>Parking Sud</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary" title="Détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Supprimer cette réservation ?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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