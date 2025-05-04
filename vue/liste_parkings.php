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
    <h1 class="h3 mb-2 text-gray-800">Liste des Parkings</h1>
    <br>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a class="m-0 font-weight-bold text-primary" href="<?= $base_path ?>index.php?page=ajouter_park">Nouveau parking</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                           <th>Nombre De Place</th>
                            <th>Localisation</th>
                            <th>Statut</th>
                            <th>Numero</th>
                            <th>Nombre Place Disponible</th>
                            <th>Tarif horaire</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nombre De Place</th>
                            <th>Localisation</th>
                            <th>Statut</th>
                            <th>Numero</th>
                            <th>Nombre Place Disponible</th>
                            <th>Tarif horaire</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach($listparkings as $data) { ?>
                        <tr>
                            <td><?php echo $data['nbplace'] ?></td>
                            <td><?php echo $data['localisation']?></td>
                            
                            <td>
                               <span class="badge <?= $data['statut'] == 'disponible' ? 'bg-success text-white' : 'bg-danger text-white' ?>">
                                 <?php echo $data['statut'] ?>
                               </span>
                            </td>
                            <td><?php echo $data['numero']?></td>
                            <td><?php echo $data['nbplace_disponible']?></td>
                            <td><?php echo $data['tarifhoraire']?></td>
                            <td>
                                <a href="<?= $base_path ?>index.php?page=modifier_park&id=<?= $data['id_parking'] ?>" class="btn btn-sm btn-primary" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= $base_path ?>index.php?page=suspendre_park&id=<?= $data['id_parking'] ?>" class="btn btn-sm btn-warning" title="Suspendre" onclick="return confirm('Voulez-vous vraiment suspendre ce parking ?');">
                                    <i class="fas fa-ban"></i>
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

<?php
require("footer.php")
?>