
<?php
require("header.php")
?>

<?php
 $base_path="/gestion_parking/";
?>



<div class="container mt-5 d-flex justify-content-center">
    <div class="col-xl-8 col-lg-9">
        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Effectuer Payements</h1>
                </div>
                <form class="user" action="index.php?page=effectuerPay&id=<?= $data['id_reservation'] ?>" method="POST">
                
                <div class="form-group row">
                        <div class="col-md-6 mb-3">
                            <input type="number" name="numero_pay" id="numero_pay" class="form-control form-control-user" placeholder="Numero du payement" required>
                        </div>
                       
                        <div class="col-md-6 mb-3">
                            <select name="moyen_pay" id="moyen_pay" class="form-control form-control-user">
                                 <option value="" selected disabled >--Sélectionnez un moyen de paiement --</option>
                                 <option value="MTN">MTN</option>
                                 <option value="ORANGE">ORANGE</option>
                                 <option value="CARTE BANCAIRE">CARTE BANCAIRE</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <input type="date" name="datepaiement" id="datepaiement" class="form-control form-control-user" placeholder="date payement" required>
                        </div>

                        
                         
                        <div class="col-md-6 mb-3">
                            <input type="number" name="montant_total" id="montant_pay" class="form-control form-control-user" placeholder="Montant du paiement"  value="<?php echo $data['montant_total'] ?>" readonly required>
                        </div>
                        
                        
                        <div class="col-md-6 mb-3">
                            <input type="text" name="localisation_part" id="localisation_part" class="form-control form-control-user" placeholder="localisation" value="<?php echo $data['localisation_park'] ?>" readonly required>
                        </div>
                        
                       
                        
                    </div>
                    <button type="submit" name ="valider" class="btn btn-primary btn-user btn-block mt-3">
                        Payer
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
