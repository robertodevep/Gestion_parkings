<?php

class UserModel{

    private $nom;
    private $prenom;
    private $ville;
    private $email;
    private $telephone;
    private $passwords;
    private $roles;
    private $statut;

    public function Connect(){
        $host="localhost";
        $dbname="parkings";
        $user="root";
        $pass="";
    $connect= new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    return $connect;
    }
    


    public function isUser($nom, $passwords) {
        $connect = $this->connect();
    
        // On récupère le mot de passe haché à partir du nom
        $stmt = $connect->prepare("SELECT passwords FROM utilisateurs WHERE nom = :nom");
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
    
        $hashedPassword = $stmt->fetchColumn(); // retourne le passwords hacher stocker dans la BD
    
        if ($hashedPassword && password_verify($passwords, $hashedPassword)) {
            return true;
        } else {
            return false;
        }
    }
    


public function enregistrer_user($nom, $prenom, $ville, $email, $telephone, $passwords, $roles, $statut) {
    try {
        $connect = $this->Connect();
        
        // Vérification email existant
        $stmt = $connect->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();
        // fetchColumn Recupere la premiere colonne du premier resultat (dans se cas count)
        
        if ($count > 0) {
            return "Cet email existe déjà.";
        }  
        
        // password_hash(...) : transforme le mot de passe en une version cryptée (hachée).

        //  PASSWORD_DEFAULT utilise l’algorithme recommandé par PHP (actuellement Bcrypt).
        // Hachage du mot de passe
        $hashedPassword = password_hash($passwords, PASSWORD_DEFAULT);
        
        $requete = $connect->prepare("INSERT INTO utilisateurs VALUES(
            NULL, :nom, :prenom, :ville, :email, :telephone, :passwords, :roles, 'disponible'
        )");
        
        $requete->bindValue(':nom', $nom);
        $requete->bindValue(':prenom', $prenom);
        $requete->bindValue(':ville', $ville);
        $requete->bindValue(':email', $email);
        $requete->bindValue(':telephone', $telephone);
        $requete->bindValue(':passwords', $hashedPassword); // Utilisation du mot de passe hashé
        $requete->bindValue(':roles', $roles);
        
        if ($requete->execute()) {
            return true;
        } else {
            return "Erreur lors de l'enregistrement.";
        }
        
    } catch (\Throwable $th) {
        error_log("Erreur enregistrement: " . $th->getMessage());
        return "Une erreur technique est survenue.";
    }
}

    public function modifierUser($id_user,$nom,$prenom,$ville,$email,$telephone){
        try {
            $connect = $this->connect();
            $requete = $connect->prepare("UPDATE utilisateurs SET nom=:nom, prenom=:prenom, ville=:ville, email=:email, telephone=:telephone WHERE id_user=:id_user");
            $requete->bindValue(':nom', $nom);
            $requete->bindValue(':prenom', $prenom);
            $requete->bindValue(':ville', $ville);
            $requete->bindValue(':email', $email);
            $requete->bindValue(':telephone', $telephone);
            // $requete->bindValue(':passwords', $passwords);
            // $requete->bindValue(':roles', $roles);
            $requete->bindValue(':id_user', $id_user);
            $test = $requete->execute();
            return $test;
        } catch (\Throwable $th) {
            echo "Erreur: " . $th->getMessage();
        }
    }

    public function detailUser($id){
        $connect = $this->connect();
        $requete = $connect->prepare("SELECT * FROM utilisateurs WHERE id_user = :id");
        $requete->bindValue(':id', $id, PDO::PARAM_INT);
        $requete->execute();
        return $requete->fetchAll();
    }

    
public function suspendreUser($id_user){

        
    $connect=$this->connect();

    $test=$connect->query("UPDATE utilisateurs SET statut='indisponible' WHERE id_user=$id_user ");
  

}
    

    public function supprimerUser($id_user){
        $connect=$this->connect();
        $requete=$connect->query("DELETE FROM utilisateurs WHERE id_user=$id_user ");
        $test=$requete->execute();
    }



    public function modifierPassword($email,$passwords){
        $connect=$this->connect();
        $requete=$connect->prepare("UPDATE utilisateur SET passwords='$passwords' WHERE email='$email'");
        $test=$requete->execute();
    }


    public function getRole($username){
        $connect = $this->connect();
        $requete = $connect->prepare("SELECT roles FROM utilisateurs WHERE nom='$nom'");
        // $requete->bindValue(":email", $email);
        $requete->execute(); // Execute the query
        $resultat = $requete->fetchAll();
        return $resultat;
    }

   
  
     // renvoie le role du user
    public function getRolesUser($nom) {
        $connect = $this->connect();
    
        // Utilisation de requête préparée pour la sécurité
        $stmt = $connect->prepare("SELECT roles FROM utilisateurs WHERE nom = :nom");
        $stmt->bindParam(':nom', $nom); 
        $stmt->execute();
    
        $resultats = $stmt->fetchAll(PDO::FETCH_COLUMN); // Récupérer uniquement la colonne 'roles'
    
        if (!empty($resultats)) {
            return $resultats[0];
        } else {
            return null; // Ou une autre valeur par défaut si l'utilisateur n'est pas trouvé
        }
    }

    
    public function isconnect($passwords){
        $connect=$this->connect();
        $stmt=$connect->query("SELECT COUNT(*) FROM utilisateurs WHERE passwords='$passwords'");
        $count = $stmt->fetchColumn();
        if($count > 0){
            echo "true";
       
       }else{

       echo "false";

        }
    }

       
    public function getIduser($nom){
        $role=0;
        $connect = $this->connect();
        $requete = $connect->query("SELECT id_user FROM utilisateurs WHERE nom='$nom'");
        
        $resultat = $requete->fetchAll();
        foreach($resultat as $name){
            $role=$name['id_user'];
         }
        return $role;
    }

    
    
    public function listuser(){
        $connect=$this->connect();
    
        $test=$connect->query("SELECT * FROM utilisateurs WHERE statut = 'disponible'");
        $resultats=$test->fetchAll(PDO::FETCH_ASSOC); // Utiliser FETCH_ASSOC pour obtenir des tableaux associatifs
        return $resultats;
    
    }


  // Liste profil user
    public function listuserParId($id){
        $connect = $this->connect();
    
        $stmt = $connect->prepare("SELECT * FROM utilisateurs WHERE statut = 'disponible' AND id_user = ?");
        $stmt->execute([$id]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    
    
    public function getalluser(){
        $connect=$this->connect();
        $test=$connect->query("SELECT COUNT(*) AS total_user FROM utilisateurs WHERE roles='utilisateur'");
        $resultats=$test->fetch(PDO::FETCH_ASSOC);
        return $resultats;
    }

    

}

?>
