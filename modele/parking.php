
<?php

class parkings{

    private $nbplace;
    private $localisation;
    private $statut;
    private $numero;
    private $nbplace_disponible;
    private $tarifhoraire;

    public function connect(){
        $host="localhost";
        $dbname="parkings";
        $user="root";
        $pass="";

        $connect = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
        $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $connect;
    }
        
    
    
    public function enregistrer_parking($nbplace,$localisation,$statut,$numero,$nbplace_disponible,$tarifhoraire){
        $connect=$this->Connect();
        $requete=$connect->prepare("INSERT INTO parking_vh VALUES (NULL,:nbplace,:localisation,'disponible',:numero,:nbplace_disponible,:tarifhoraire)");
        $requete->bindValue(':nbplace',$nbplace);
        $requete->bindValue(':localisation',$localisation);
        //$requete->bindValue(':statut','disponible'); nbplace_disponible
        $requete->bindValue(':numero',$numero);
        $requete->bindValue(':nbplace_disponible',$nbplace_disponible);
        $requete->bindValue(':tarifhoraire',$tarifhoraire);
        $requete->execute();
        //$test=$connect->lastInsertId();
        return $requete;

    }
    // pour la reservation
    public function getAllParkings() {
        $connect = $this->connect();
        $stmt = $connect->prepare("SELECT * FROM parking_vh WHERE statut = 'disponible'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

public function modifierparkings($id_parking, $nbplace, $localisation, $statut, $numero, $nbplace_disponible, $tarifhoraire) {
    try {
        $connect = $this->connect();
        $requete = $connect->prepare("UPDATE parking_vh SET nbplace=:nbplace, localisation=:localisation, statut=:statut, numero=:numero, nbplace_disponible=:nbplace_disponible, tarifhoraire=:tarifhoraire WHERE id_parking=:id_parking");
        
        $requete->bindValue(':nbplace', $nbplace, PDO::PARAM_INT);
        $requete->bindValue(':localisation', $localisation, PDO::PARAM_STR);
        $requete->bindValue(':statut', $statut, PDO::PARAM_STR);
        $requete->bindValue(':numero', $numero, PDO::PARAM_STR);
        $requete->bindValue(':nbplace_disponible', $nbplace_disponible, PDO::PARAM_INT);
        $requete->bindValue(':tarifhoraire', $tarifhoraire, PDO::PARAM_STR);
        $requete->bindValue(':id_parking', $id_parking, PDO::PARAM_INT);
        
        $test = $requete->execute();
        return $test;
    } catch (\Throwable $th) {
        // Mieux vaut logger l'erreur que de l'afficher directement
        error_log("Erreur modification parking: " . $th->getMessage());
        return false;
    }
}

public function suspendrePark($id_parking){

        
    $connect=$this->connect();

    $test=$connect->query("UPDATE parking_vh SET statut='indisponible' WHERE id_parking=$id_parking ");
  

}
    
    

    public function detailpart($id){
        $connect = $this->connect();
        $requete = $connect->prepare("SELECT * FROM parking_vh WHERE id_parking = :id");
        $requete->bindValue(':id', $id, PDO::PARAM_INT);
        $requete->execute();
        return $requete->fetchAll();
    }
    

    public function supprimerparking($id_parking){
        $connect=$this->connect();
        $requete=$connect->query("DELETE FROM parking_vh WHERE id_parking=$id_parking ");
        $test=$requete->execute();
    }



    

    public function listparking(){
        $connect=$this->connect();

        $test=$connect->query("SELECT * FROM parking_vh");
        $resultats=$test->fetchAll(PDO::FETCH_ASSOC);
        return $resultats;
    
    }

    // liste parking dispo
    public function listparkingdispo(){
        $connect=$this->connect();

        $test=$connect->query("SELECT * FROM parking_vh WHERE statut = 'disponible'");
        $resultats=$test->fetchAll(PDO::FETCH_ASSOC);
        return $resultats;
    
    }

    // compte le nombre de parking
    public function getallPard(){
        $connect=$this->connect();
        $test=$connect->query("SELECT COUNT(*) AS total_parkings FROM parking_vh");
        $resultats=$test->fetch(PDO::FETCH_ASSOC);
        return $resultats;
    }

    public function getAllParkIndispo(){
        $connect=$this->connect();
        $test=$connect->query("SELECT COUNT(*) AS total_parkindispo FROM parking_vh WHERE statut='indisponible'");
        $resultats=$test->fetch(PDO::FETCH_ASSOC);
        return $resultats;
    }

    public function getAllParkDispo(){
        $connect=$this->connect();
        $test=$connect->query("SELECT COUNT(*) AS total_parkdispo FROM parking_vh WHERE statut='disponible'");
        $resultats=$test->fetch(PDO::FETCH_ASSOC);
        return $resultats;
    }

}

?>