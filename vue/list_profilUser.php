<?php
require("header.php")
?>

<?php
 $base_path="/gestion_parking/";
?>

            <!-- End of Topbar -->

                <!-- Begin Page Content -->
             <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Profil Utilisateurs</h1>
                <br>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Ville</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Ville</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot> 
                            <tbody>
                                <?php foreach($listuser as $data){?>
                                <tr>
                                    <td><?php echo $data['nom']?></td>
                                    <td><?php echo $data['prenom']?></td>
                                    <td><?php echo $data['ville']?></td>
                                    <td><?php echo $data['email']?></td>
                                    <td><?php echo $data['telephone']?></td>
                                    <td> 
                                        <a href="<?= $base_path ?>index.php?page=modifier_profilUser&id=<?= $data['id_user']?>" class="btn btn-sm btn-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
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

            <!-- End of Main Content -->

            <!-- Footer -->
<?php
require("footer.php")
?>