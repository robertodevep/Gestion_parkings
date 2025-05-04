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
                    <h1 class="h4 text-gray-900 mb-4">Ajouter un Parking</h1>
                </div>
                <form class="user" action="<?= $base_path ?>index.php?page=ajouter_park" method="POST">
                    <div class="form-group row">
                        <div class="col-md-6 mb-3">
                            <input type="number" name="nbplace" id="nbplace" class="form-control form-control-user" placeholder="Nombre de places" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" name="localisation" id="localisation" class="form-control form-control-user" placeholder="Localisation" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" name="numero" id="numero" class="form-control form-control-user" placeholder="Numéro" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="number" name="nbplace_disponible" id="nbplace_disponible" class="form-control form-control-user" placeholder="Nombre de places disponible" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="number" name="tarifhoraire" id="tarifhoraire" class="form-control form-control-user" placeholder="Tarif horaire" required>
                        </div>
                    </div>
                    <button type="submit" name ="valider" class="btn btn-primary btn-user btn-block mt-3">
                        Ajouter
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
