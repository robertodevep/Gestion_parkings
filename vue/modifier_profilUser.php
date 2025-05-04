<?php
require("header.php")
?>
<?php
 $base_path="/gestion_parking/";
?>
                <!-- End of Topbar -->

               <!-- Formulaire légèrement remonté -->
               <div class="container mt-5 d-flex justify-content-center">
                    <div class="col-xl-8 col-lg-9">
                        <div class="card o-hidden border-0 shadow-lg">
                            <div class="card-body p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Modifier le profil</h1>
                                </div>
                                <form method="post" class="user" action="<?= $base_path ?>index.php?page=modifier_profilUser&id=<?= $_GET['id'] ?>">
                                <div class="form-group row">
                                 <?php foreach($detailUser as $data){?>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name='nom' id='nom' class="form-control form-control-user" placeholder="Nom" value="<?php echo $data['nom']; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name='prenom' id='prenom' class="form-control form-control-user" placeholder="Prénom" value="<?php echo $data['prenom']; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="number" name='telephone' id='telephone' class="form-control form-control-user" placeholder="Téléphone" value="<?php echo $data['telephone']; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name='ville' id='ville' class="form-control form-control-user" placeholder="Ville" value="<?php echo $data['ville']; ?>">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="email" name='email' id='email' class="form-control form-control-user" placeholder="Email" value="<?php echo $data['email']; ?>">
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit" name='modifier' class="btn btn-primary btn-user px-4">
                                        Modifier
                                    </button>
                                    <a href="password.php" class="btn btn-warning btn-user px-4">
                                        Modifier le mot de passe
                                    </a>
                                </div>
                            </form>
                            
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin du formulaire -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
<?php
require("footer.php")
?>