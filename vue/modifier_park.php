
<?php
require("header.php")
?>

<?php
 $base_path="/gestion_parking/";
?>

<!-- Formulaire pour ajouter un parking -->
<div class="container mt-5 d-flex justify-content-center">
    <div class="col-xl-8 col-lg-9">
        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Modifier Parking</h1>
                </div>
                <form class="user" action="<?= $base_path ?>index.php?page=modifier_park&id=<?= $_GET['id'] ?>" method="POST">
                    <div class="form-group row">
                    <?php foreach($detailparkings as $data) { ?>
                        <div class="col-md-6 mb-3">
                            <input type="number" name="nbplace" id="nbplace" class="form-control form-control-user" placeholder="Nombre de places"  required value="<?php echo $data['nbplace']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" name="localisation" id="localisation" class="form-control form-control-user" placeholder="Localisation" required value="<?php echo ($data['localisation']) ?>">
                        </div>
                         
                        <div class="col-md-6 mb-3">
                            <input type="text" name="numero" id="numero" class="form-control form-control-user" placeholder="Numéro" required value="<?php echo $data['numero']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="number" name="nbplace_disponible" id="nbplace_disponible" class="form-control form-control-user" placeholder="Nombre de places disponible" required value="<?php echo ($data['nbplace_disponible']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="number" name="tarifhoraire" id="tarifhoraire" class="form-control form-control-user" placeholder="Tarif horaire" required value="<?php echo $data['tarifhoraire']; ?>">
                        </div>
                        <?php } ?>
                    </div>
                    <button type="submit" name ="modifier" class="btn btn-primary btn-user btn-block mt-3">
                        Modifier
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin du formulaire -->

</div>

<!-- footer -->
<?php
require("footer.php")
?>
