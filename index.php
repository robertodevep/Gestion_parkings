<?php
  
// 1. Initialisation de la session et chargement des dépendances
session_start();
require_once __DIR__.'/modele/user.php';
require_once __DIR__.'/modele/parking.php';
require_once __DIR__.'/modele/paiement.php';



// Reservation
require_once __DIR__.'/modele/ReservationModel.php';
$reservationModel = new ReservationModel();


$base_path = '/gestion_parking/'; // la base du projet
$GLOBALS['base_path'] = $base_path; // Rend la variable accessible dans les vues

 //Gestion des messages flash
$message = $_SESSION['flash_message'] ?? '';
unset($_SESSION['flash_message']);

//Initialisation des modèles
$userModel = new UserModel();

$parking = new parkings();

$paiement = new Paiement();


// Récupération de la page demandée
$page = $_GET['page'] ?? 'login'; // Par défaut, page de login

//  Routeur principal - Toutes les pages passent par ici
switch ($page) {
    //  Page de login
    case 'login':
        // Traitement du formulaire de connexion
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valider'])) {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
            $passwords = $_POST['passwords'] ?? '';

            if (empty($nom) || empty($passwords)) {
                $_SESSION['flash_message'] = 'Veuillez remplir tous les champs';
                header('Location: '.$base_path.'index.php?page=login');
                exit();
            }

            if ($userModel->isUser($nom, $passwords)) {
                $_SESSION['user_id'] = $userModel->getIduser($nom);
                $_SESSION['nom'] = $nom;
                $_SESSION['roles'] = $userModel->getRolesUser($nom);
                
                // Redirection après connexion réussie
                $redirect = ($_SESSION['roles'] === 'admin') ? 'admin' : 'accueil';
                header('Location: '.$base_path.'index.php?page='.$redirect);
                exit();
            } else {
                $_SESSION['flash_message'] = 'Identifiants incorrects';
                header('Location: '.$base_path.'index.php?page=login');
                exit();
            }
        }
        require_once __DIR__.'/vue/login.php';
        break;

    //  Page d'inscription
    case 'register':

            // Traitement du formulaire d'inscription
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
                // Nettoyage des données
                $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
                $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
                $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
                $passwords = $_POST['passwords'] ?? '';
                $roles = $_POST['roles'] ?? 'utilisateur';
        
                // Validation des champs obligatoires
                if (empty($nom) || empty($email) || empty($passwords)) {
                    $_SESSION['flash_message'] = 'Veuillez remplir tous les champs obligatoires';
                    header('Location: '.$base_path.'index.php?page=register');
                    exit();
                }
        
                //  Tentative d'enregistrement
                $result = $userModel->enregistrer_user($nom, $prenom, $ville, $email, $telephone, $passwords, $roles, $statut);
                
                // Gestion du résultat
                if ($result === true) {
                    $_SESSION['flash_message'] = 'Inscription réussie! Vous pouvez maintenant vous connecter';
                    header('Location: '.$base_path.'index.php?page=login');
                    exit();
                } 
                
                // Gestion des erreurs
                if (is_string($result)) {
                    $_SESSION['flash_message'] = $result; // Message d'erreur spécifique
                } else {
                    $_SESSION['flash_message'] = 'Une erreur est survenue lors de l\'inscription';
                }
                
                header('Location: '.$base_path.'index.php?page=register');
                exit();
            }
        
            //  Affichage de la vue d'inscription (pour les requêtes GET)
         require_once __DIR__.'/vue/register.php'; 
        break;

    //  Page d'accueil
    case 'accueil':
        // Vérification de la connexion
        if (!isset($_SESSION['user_id'])) {
            header('Location: '.$base_path.'index.php?page=login');
            exit();
        }
        require_once __DIR__.'/vue/accueil.php';
        break;

    //  Page admin
    case 'admin':
        // Vérification des droits admin
        if (!isset($_SESSION['user_id']) || $_SESSION['roles'] !== 'admin') {
            header('Location: '.$base_path.'index.php?page=login');
            exit();
        }
        
    
        require_once __DIR__.'/vue/accueil.php';
        break;

        // LISTE DES USER
        case 'list_user':
          
            
            $listuserp = $userModel->listuser();
            require_once __DIR__.'/vue/list_user.php';
        break;

        // GESTION PROFIL USER LISTE PROFIL USER
        case 'list_profilUser':
            if (isset($_SESSION['user_id'])) {
                $id = $_SESSION['user_id'];
                $listuser = $userModel->listuserParId($id);
                require_once __DIR__.'/vue/list_profilUser.php';
            } else {
                header('Location: '.$base_path.'index.php?page=login');
                exit();
            }
            break;

            // MODIFIER PROFIL USER 
            case 'modifier_profilUser':
            // Vérification que l'ID existe et est valide
            if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                $_SESSION['flash_message'] = "ID du profil invalide";
                header('Location: '.$base_path.'index.php?page=list_profilUser');
                exit();
            }
            
            $id = (int)$_GET['id'];
            // Traitement du formulaire de modification
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
                // Nettoyage et validation des données
                $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
                $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
                $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
                
                // Validation des données obligatoires
                if(empty($nom) || empty($email)) {
                    $_SESSION['flash_message'] = "Tous les champs obligatoires doivent être remplis";
                    header('Location: '.$base_path.'index.php?page=modifier_profilUser&id='.$id);
                    exit();
                }
                
                // Appel de la méthode de modification
                $result = $userModel->modifierUser($id,$nom,$prenom,$ville,$email,$telephone);
                
                if($result === true) {
                    $_SESSION['flash_message'] = "user modifié avec succès";
                    header('Location: '.$base_path.'index.php?page=list_profilUser');
                    exit();
                } else {
                    $_SESSION['flash_message'] = "Erreur lors de la modification du user";
                    header('Location: '.$base_path.'index.php?page=modifier_profilUser&id='.$id);
                    exit();
                }
            }
            
            
            $detailUser = $userModel->detailUser($id);
            
            if(!$detailUser) {
                $_SESSION['flash_message'] = "user introuvable";
                header('Location: '.$base_path.'index.php?page=list_profilUser');
                exit();
            }
            
            require_once __DIR__.'/vue/modifier_profilUser.php';
         break;

        case 'edit_user':
            // Vérification que l'ID existe et est valide
            if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                $_SESSION['flash_message'] = "ID de parking invalide";
                header('Location: '.$base_path.'index.php?page=list_user');
                exit();
            }
            
            $id = (int)$_GET['id'];
            
            // Traitement du formulaire de modification
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
                // Nettoyage et validation des données
                $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
                $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
                $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
                $passwords = $_POST['passwords'] ?? '';
                $roles = $_POST['roles'] ?? 'utilisateur';
                
                // Validation des données obligatoires
                if(empty($nom) || empty($roles) || empty($email)) {
                    $_SESSION['flash_message'] = "Tous les champs obligatoires doivent être remplis";
                    header('Location: '.$base_path.'index.php?page=edit_user&id='.$id);
                    exit();
                }
                
                // Appel de la méthode de modification
                $result = $userModel->modifierUser($id,$nom,$prenom,$ville,$email,$telephone,$passwords,$roles);
                
                if($result === true) {
                    $_SESSION['flash_message'] = "Parking modifié avec succès";
                    header('Location: '.$base_path.'index.php?page=list_user');
                    exit();
                } else {
                    $_SESSION['flash_message'] = "Erreur lors de la modification du parking";
                    header('Location: '.$base_path.'index.php?page=edit_user&id='.$id);
                    exit();
                }
            }
            
            $detailUser = $userModel->detailUser($id);
            
            if(!$detailUser) {
                $_SESSION['flash_message'] = "Parking introuvable";
                header('Location: '.$base_path.'index.php?page=list_user');
                exit();
            }
            
            require_once __DIR__.'/vue/edit_user.php';
         break;

         // SUSPENDRE USER 

         case 'suspendre_user':
            if ($page == "suspendre_user") {
                // Vérification de l'ID et des droits ici (important pour la sécurité)
                $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
                
                if ($id > 0) {
                    $userModel->suspendreUser($id);
                }
                
                header('Location: '.$base_path.'index.php?page=list_user');
                exit;
            }
            break; 

        // FIN GESTION USER

        //  GESTIONS PARKINGS 
        // AJOUTER PARKINGS

        case 'ajouter_park':
                   	
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valider'])) {
                // Nettoyage des données
                $nbplace = filter_input(INPUT_POST, 'nbplace', FILTER_SANITIZE_NUMBER_INT);
                $localisation = filter_input(INPUT_POST, 'localisation', FILTER_SANITIZE_STRING);
                $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
                $nbplace_disponible = filter_input(INPUT_POST, 'nbplace_disponible', FILTER_SANITIZE_NUMBER_INT);
                $tarifhoraire = filter_input(INPUT_POST, 'tarifhoraire', FILTER_SANITIZE_NUMBER_INT);
                 
                // Validation des champs obligatoires
                if (empty($nbplace) || empty($localisation) || empty($tarifhoraire)) {
                    $_SESSION['flash_message'] = 'Veuillez remplir tous les champs obligatoires';
                    header('Location: '.$base_path.'index.php?page=ajouter_park');
                    exit();
                }
        
                $result = $parking->enregistrer_parking($nbplace,$localisation,$statut,$numero,$nbplace_disponible,$tarifhoraire);
                
                if ($result === true) {
                    $_SESSION['flash_message'] = 'Parkings ajouter avec succes';
                    header('Location: '.$base_path.'index.php?page=');
                    exit();
                } 
                
                // Gestion des erreurs
                if (is_string($result)) {
                    $_SESSION['flash_message'] = $result; // Message d'erreur spécifique
                } else {
                    $_SESSION['flash_message'] = 'Une erreur est survenue lors de l\'inscription';
                }
                
                header('Location: '.$base_path.'index.php?page=ajouter_park');
                exit();
            }
        
        
            require_once __DIR__.'/vue/ajouter_park.php';
        break;

        // LISTE PARKING
        case 'liste_parkings':
          
            $listparkings = $parking->listparking();
            require_once __DIR__.'/vue/liste_parkings.php';
        break;    

        // MODIFIER PARKING
    case 'modifier_park':
        // Vérification que l'ID existe et est valide
        if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['flash_message'] = "ID de parking invalide";
            header('Location: '.$base_path.'index.php?page=liste_parkings');
            exit();
        }
        
        $id = (int)$_GET['id'];
    
    // Traitement du formulaire de modification
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
        // Nettoyage et validation des données
        $nbplace = filter_input(INPUT_POST, 'nbplace', FILTER_SANITIZE_NUMBER_INT);
        $localisation = filter_input(INPUT_POST, 'localisation', FILTER_SANITIZE_STRING);
        $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
        $nbplace_disponible = filter_input(INPUT_POST, 'nbplace_disponible', FILTER_SANITIZE_NUMBER_INT);
        $tarifhoraire = filter_input(INPUT_POST, 'tarifhoraire', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $statut = filter_input(INPUT_POST, 'statut', FILTER_SANITIZE_STRING) ?? 'disponible';
        
        // Validation des données obligatoires
        if(empty($nbplace) || empty($localisation) || empty($tarifhoraire)) {
            $_SESSION['flash_message'] = "Tous les champs obligatoires doivent être remplis";
            header('Location: '.$base_path.'index.php?page=modifier_park&id='.$id);
            exit();
        }
        
        // Appel de la méthode de modification
        $result = $parking->modifierparkings($id, $nbplace, $localisation, $statut, $numero, $nbplace_disponible, $tarifhoraire);
        
        if($result === true) {
            $_SESSION['flash_message'] = "Parking modifié avec succès";
            header('Location: '.$base_path.'index.php?page=liste_parkings');
            exit();
        } else {
            $_SESSION['flash_message'] = "Erreur lors de la modification du parking";
            header('Location: '.$base_path.'index.php?page=modifier_park&id='.$id);
            exit();
        }
    }
    
    // Récupération des détails du parking pour affichage dans le formulaire
    $detailparkings = $parking->detailpart($id);
    
    // Vérification que le parking existe
    if(!$detailparkings) {
        $_SESSION['flash_message'] = "Parking introuvable";
        header('Location: '.$base_path.'index.php?page=liste_parkings');
        exit();
    }
    
    require_once __DIR__.'/vue/modifier_park.php';
   break;

 // SUSPENDRE PARKINGS 

  case 'suspendre_park':
    if ($page == "suspendre_park") {
        // Vérification de l'ID et des droits ici (important pour la sécurité)
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($id > 0) {
            $parking->suspendrePark($id);
        }
        
        header('Location: '.$base_path.'index.php?page=liste_parkings');
        exit;
    }
    break;

    // GESION DES RESERVATIONS

    case 'reserver':
        $parkingModel = new parkings();
        $parkings = $parkingModel->getAllParkings();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_SESSION['user_id'];
            $id_parking = $_POST['id_parking'];
            $date_debut = $_POST['date_debut'];
            $date_fin = $_POST['date_fin'];
            $nombre_heure = $_POST['nombre_heure'];

            $reservationModel = new ReservationModel();
            $result = $reservationModel->reserverPlace($id_user, $id_parking, $date_debut, $date_fin, $nombre_heure);

            $_SESSION['flash_message'] = $result === true ? "Réservation réussie." : $result;
            header('Location: index.php?page=accueil');
            exit();
        } else {
            include("vue/reserver.php");
        }
        break;

    // liste reservation
        
        case 'listReservation':
            
            $listReservatio = $reservationModel->listReservationAll();
            require_once __DIR__.'/vue/listReservation.php';
            break;

            // lister reservation d'un user   
                case 'listReservationUser':
                    if (isset($_SESSION['user_id'])) {
                        $id = $_SESSION['user_id'];
                         $listReservation = $reservationModel->listReservationUser($id);
                        require_once __DIR__.'/vue/listReservationUser.php';
                    } else {
                        header('Location: '.$base_path.'index.php?page=login');
                        exit();
                    }
                    break;


        // imprimer reservation
        case 'voir_reservation' :

         require_once __DIR__.'/vue/voir_reservation.php';
        break;

    
         // cloturer reservation
        case 'cloturer_reservation':
            if (isset($_GET['id'])) {
        
                $reservationModel = new ReservationModel();
                $reservationModel->cloturerReservation($_GET['id']);
                $_SESSION['flash_message'] = "Réservation clôturée.";
                header('Location: index.php?page=listReservation');
                exit();
            }
            break;

           
            case 'effectuerPay':
                if (!isset($_SESSION['user_id'])) {
                    header('Location: '.$base_path.'index.php?page=login');
                    exit();
                }
            
                // Récupération de l'ID depuis l'URL
                $id_reservation = isset($_GET['id']) ? (int)$_GET['id'] : 0;
                
                if ($id_reservation <= 0) {
                    $_SESSION['flash_message'] = "Réservation invalide";
                    header('Location: index.php?page=accueil');
                    exit();
                }
            
                $reservationModel = new ReservationModel();
                $reservation = $reservationModel->getReservationById($id_reservation, $_SESSION['user_id']);
            
                if (!$reservation) {
                    $_SESSION['flash_message'] = "Réservation non trouvée ou ne vous appartient pas";
                    header('Location: index.php?page=accueil');
                    exit();
                }
            
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valider'])) {
                    $numero_pay = htmlspecialchars($_POST['numero_pay']);
                    $moyen_pay = htmlspecialchars($_POST['moyen_pay']);
                    $montant_total = $reservation['montant_total']; // Qui est le montant de la reservation
                    $datepaiement = htmlspecialchars($_POST['datepaiement']);
                   
                    
                    // Validation des données
                    if (empty($numero_pay) || empty($moyen_pay) || empty($datepaiement)) {
                        $_SESSION['flash_message'] = "Tous les champs sont obligatoires";
                        header("Location: index.php?page=effectuerPay&id=$id_reservation");
                        exit();
                    }
            
                    
                    $result = $paiement->enregistrePaiement($numero_pay, $moyen_pay, $montant_total, $datepaiement, $id_reservation);
                        
                    header('Location: index.php?page=accueil');
                    exit();
                }
            
                // Passage des données a la vue
                $data = $reservation;
                include("vue/effectuerPay.php");
                break;

                // LISTE DES PAYEMENTS USER

                case 'listpaiement':
                    if (isset($_SESSION['user_id'])) {
                        $id = $_SESSION['user_id'];
                         $listpaiement = $paiement->listpaiement($id);
                        require_once __DIR__.'/vue/listpaiement.php';
                    } else {
                        header('Location: '.$base_path.'index.php?page=login');
                        exit();
                    }
                    break;

                    // liste de tout les paiements

                    case 'listpaiementAll':
                        $listpaiementAll = $paiement->listpaiementAll();
                        require_once __DIR__.'/vue/listpaiementAll.php';
                        break;


                
        // Gestion des statistique de la page accueil
                $nombreParkings = $parking->getallPard();
                $parkings = new parkings();
                $nbrTotalDispo=$parkings->getAllParkIndispo();
                $nbrTotalDisponible=$parkings->getAllParkDispo();

                $nombreResrvationActive=$reservationModel->getallReservationActive();
                $totalPaiement=$paiement->getAllTotalpayement();
                $nombreTotalUser=$userModel->getalluser();

    //Page par défaut (redirection vers login)
    default:
        header('Location: '.$base_path.'index.php?page=login');
        exit();


    case'logout':
        
            // Pour la page "logout",
            session_destroy();
            header('Location: '.$base_path.'index.php?page=login'); 
        
    break;
}

?>
