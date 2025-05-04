<?php
        require("header.php")
        ?>
           
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-info"><?= $_SESSION['flash_message']; unset($_SESSION['flash_message']); ?></div>
        <?php endif; ?>

        
                    <?php
                    // Récupération des parkings pour le menu déroulant
                    $parkings = $parkingModel->getAllParkings();
                    ?>

                
                <div class="container mt-5 d-flex justify-content-center">
                    <div class="col-xl-8 col-lg-9">
                        <div class="card o-hidden border-0 shadow-lg">
                            <div class="card-body p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Réservation de Parking</h1>
                                
                                </div>
                                <form class="user" method="POST" action="<?= $base_path ?>index.php?page=reserver">
                                    <div class="form-group row">
                                        <div class="col-md-6 mb-3">
                                            <input type="date" name="date_debut" id="date_debut" class="form-control form-control-user" placeholder="Date debut">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="date" name="date_fin" id="date_fin" class="form-control form-control-user" placeholder="date fin">
                                        </div>
                                        <!-- <div class="col-md-6 mb-3">
                                            <input type="number" name="montant_total" id="montant_total" class="form-control form-control-user" placeholder="Montant 1000f jour">
                                        </div> -->
                                        <div class="col-md-6 mb-3">
                                            <input type="number" name="nombre_heure" id="nombre_heure" class="form-control form-control-user" placeholder="nombre d'heur">
                                        </div>
                                    
                                        <div class="col-md-6 mb-3">
                                            <select name="id_parking" id="id_parking" class="form-control form-control-user">
                                                <option value="">-- Sélectionnez un parking exemple Makepe --</option>
                                                <?php foreach ($parkings as $parking): ?>
                                                    <option value="<?= $parking['id_parking'] ?>">
                                                        <?= htmlspecialchars($parking['localisation']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    </div>
                                    <button type="submit" name="valider" class="btn btn-primary btn-user btn-block mt-3">
                                        Valider la réservation
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin du formulaire -->

            </div>

<?php
require("footer.php")
?>