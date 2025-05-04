<?php

  class Paiement {
    private $montant_total;
    private $numero_pay;
    private $moyen_pay;
    private $statut;
    private $datepaiment;
    private $id_reservation;

     public function connect(){
        $host = 'localhost';
        $dbname = 'parkings';
        $user = 'root';
        $pass = '';

        $connect = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connect;
     }

   



  public function enregistrePaiement($numero_pay, $moyen_pay, $montant_total, $datepaiement, $id_reservation) {
    try {
        $connect = $this->connect();
        $requete = $connect->prepare("INSERT INTO paiement (numero_pay, moyen_pay, montantpaiement, statut, datepaiement, id_reservation) 
                                     VALUES(:numero_pay, :moyen_pay, :montantpaiement, 'payer', :datepaiement, :id_reservation)");

        $requete->bindValue(':numero_pay', $numero_pay, PDO::PARAM_STR);
        $requete->bindValue(':moyen_pay', $moyen_pay, PDO::PARAM_STR);
        $requete->bindValue(':montantpaiement', $montant_total, PDO::PARAM_STR);
        $requete->bindValue(':datepaiement', $datepaiement, PDO::PARAM_STR);
        $requete->bindValue(':id_reservation', $id_reservation, PDO::PARAM_INT);

        $result = $requete->execute();
        
        if (!$result) {
            error_log("Erreur PDO: " . implode(" ", $requete->errorInfo()));
        }
        
        return $result;
    } catch (PDOException $e) {
        error_log('Erreur Paiement: '. $e->getMessage());
        return false;
    }
}

    // public function listpaiement($id) {
    //   $connect = $this->connect();
    //   $requete = $connect->prepare("SELECT paiement.montantpaiement AS montant_paiements, paiement.statut, paiement.datepaiement, reservation.localisation AS localisation_park
    //         FROM paiement
    //         INNER JOIN reservation ON paiement.id_reservation = reservation.id_reservation
    //         WHERE paiement.statut = 'payer' AND paiement.id_paiement = :id_paiement");
    //   $requete->bindParam(':id_paiement', $id, PDO::PARAM_INT); // Liez l'ID de paiement en tant qu'entier
    //   $requete->execute();
    //   $result = $requete->fetchAll(PDO::FETCH_ASSOC);
    //   return $result;
    // }

  //   public function listpaiement($id) {
  //     try {
  //         $connect = $this->connect();
  
  //         $requete = $connect->prepare("
  //             SELECT 
  //                 paiement.numero_pay,
  //                 paiement.moyen_pay,
  //                 paiement.montantpaiement,
  //                 paiement.statut,
  //                 paiement.datepaiement,
  //                 parking_vh.localisation AS localisation_park
  //             FROM paiement
  //             INNER JOIN reservation ON paiement.id_reservation = reservation.id_reservation
  //             INNER JOIN parking_vh ON reservation.id_parking = parking_vh.id_parking
  //             WHERE paiement.statut = 'payer' AND paiement.id_paiement = :id_paiement
  //         ");
  
  //         $requete->bindParam(':id_paiement', $id, PDO::PARAM_INT);
  //         $requete->execute();
  //         $result = $requete->fetchAll(PDO::FETCH_ASSOC);
  //         return $result;
  //     } catch (PDOException $e) {
  //         echo "Erreur lors de la récupération des paiements : " . $e->getMessage();
  //         return [];
  //     }
  // }
  
  public function listpaiement($id_user) {
    try {
        $connect = $this->connect();

        $requete = $connect->prepare("
            SELECT
                paiement.numero_pay,
                paiement.moyen_pay,
                paiement.montantpaiement,
                paiement.statut,
                paiement.datepaiement,
                parking_vh.localisation AS localisation_park
            FROM paiement
            INNER JOIN reservation ON paiement.id_reservation = reservation.id_reservation
            INNER JOIN parking_vh ON reservation.id_parking = parking_vh.id_parking
            WHERE paiement.statut = 'payer' AND reservation.id_user = :id_user
        ");

        $requete->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des paiements : " . $e->getMessage();
        return [];
    }
 }

 public function listpaiementAll() {
  try {
      $connect = $this->connect();

      $requete = $connect->prepare("
          SELECT
              paiement.numero_pay,
              paiement.moyen_pay,
              paiement.montantpaiement,
              paiement.statut,
              paiement.datepaiement,
              parking_vh.localisation AS localisation_park
          FROM paiement
          INNER JOIN reservation ON paiement.id_reservation = reservation.id_reservation
          INNER JOIN parking_vh ON reservation.id_parking = parking_vh.id_parking
          WHERE paiement.statut = 'payer'
      ");

      $requete->execute();
      $result = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $result;
  } catch (PDOException $e) {
      echo "Erreur lors de la récupération de tous les paiements : " . $e->getMessage();
      return [];
  }
}

    public function getAllTotalpayement(){
      $connect=$this->connect();
      $test=$connect->query("SELECT SUM(montantpaiement) AS total_paiement FROM paiement");
      $resultats=$test->fetch(PDO::FETCH_ASSOC);
      return $resultats;
  }

  public function getAllNbrPayement(){
    $connect=$this->connect();
    $test=$connect->query("SELECT COUNT(*) AS nbr_paiement FROM paiement WHERE statut='payer'");
    $resultats=$test->fetch(PDO::FETCH_ASSOC);
    return $resultats;
}

  }
?>