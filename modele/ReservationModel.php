<?php

class ReservationModel{


    public function Connect(){
        $host="localhost";
        $dbname="parkings";
        $user="root";
        $pass="";
    $connect= new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    return $connect;
    }        
                
    public function reserverPlace($id_user, $id_parking, $date_debut, $date_fin, $nombre_heure) {
        $connect = $this->connect();

        // Générer automatiquement le premier numéro de place disponible
        $numero_place = $this->getNextAvailablePlace($id_parking);

        if ($numero_place === null) {
            
            return "Parking plein, aucune place disponible.";
        }

        // Récupérer tarif horaire du parking
        $tarifReq = $connect->prepare("SELECT tarifhoraire FROM parking_vh WHERE id_parking = :id");
        $tarifReq->execute([':id' => $id_parking]);
        $parking = $tarifReq->fetch(PDO::FETCH_ASSOC);

        $montant_total = $nombre_heure * $parking['tarifhoraire'];

        // Insertion réservation
        $req = $connect->prepare("INSERT INTO reservation (date_debut, date_fin, statut, montant_total, numero_place, nombre_heure, id_user, id_parking)
        VALUES (:date_debut, :date_fin, 'active', :montant_total, :numero_place, :nombre_heure, :id_user, :id_parking)");

        $success = $req->execute([
            ':date_debut' => $date_debut,
            ':date_fin' => $date_fin,
            ':montant_total' => $montant_total,
            ':numero_place' => $numero_place,
            ':nombre_heure' => $nombre_heure,
            ':id_user' => $id_user,
            ':id_parking' => $id_parking
        ]);

        if ($success) {
            // Décrémenter nbplace_disponible
            $connect->prepare("UPDATE parking_vh SET nbplace_disponible = nbplace_disponible - 1 WHERE id_parking = :id")
                ->execute([':id' => $id_parking]);
            //return true;

            // CHAMGEMEMNT DU STATUT 
            $checkRemainingStmt = $connect->prepare("SELECT nbplace_disponible FROM parking_vh WHERE id_parking = :id");
            $checkRemainingStmt->execute([':id' => $id_parking]);
            $remaining = $checkRemainingStmt->fetch(PDO::FETCH_ASSOC);

            if ($remaining) {
                if ($remaining['nbplace_disponible'] <= 0) {
                    $connect->prepare("UPDATE parking_vh SET statut = 'indisponible' WHERE id_parking = :id")->execute([':id' => $id_parking]);
                } else {
                    $connect->prepare("UPDATE parking_vh SET statut = 'disponible' WHERE id_parking = :id")->execute([':id' => $id_parking]);
                }
            }

            return true;
            }

            return false;
    }

    public function cloturerReservation($id_reservation) {
        $connect = $this->connect();
        $res = $connect->prepare("SELECT id_parking FROM reservation WHERE id_reservation = :id");
        $res->execute([':id' => $id_reservation]);
        $data = $res->fetch(PDO::FETCH_ASSOC);

        if (!$data) return false;

        // Clôturer la réservation
        $connect->prepare("UPDATE reservation SET statut = 'terminee' WHERE id_reservation = :id")
            ->execute([':id' => $id_reservation]);

        // Incrémenter le nombre de places disponibles
        $connect->prepare("UPDATE parking_vh SET nbplace_disponible = nbplace_disponible + 1 WHERE id_parking = :id")
            ->execute([':id' => $data['id_parking']]);

        $parkingInfo = $connect->prepare("SELECT nbplace, nbplace_disponible FROM parking_vh WHERE id_parking = :id");
        $parkingInfo->execute([':id' => $data['id_parking']]);
        $parking = $parkingInfo->fetch(PDO::FETCH_ASSOC);

        if ($parking['nbplace_disponible'] > 0) {
            $connect->prepare("UPDATE parking_vh SET statut = 'disponible' WHERE id_parking = :id")
                ->execute([':id' => $data['id_parking']]);
        }

        return true;

        
    }

    public function getNextAvailablePlace($id_parking) {
        $connect = $this->connect();

        
        $stmt = $connect->prepare("SELECT nbplace FROM parking_vh WHERE id_parking = :id");
        $stmt->execute([':id' => $id_parking]);
        $parking = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$parking) return null;

        $nbplace = $parking['nbplace'];

        // Récupérer les places actuellement occupées
        $stmt2 = $connect->prepare("SELECT numero_place FROM reservation WHERE id_parking = :id AND statut = 'active'");
        $stmt2->execute([':id' => $id_parking]);
        $occupied = $stmt2->fetchAll(PDO::FETCH_COLUMN);

        for ($i = 1; $i <= $nbplace; $i++) {
            if (!in_array($i, $occupied)) {
                return $i;
            }
        }
        return null; // Aucune place disponible
    }

    // utilisation pour la fermeture 

    public function getAllReservations() {
        $connect = $this->connect();
    
        $req = $connect->prepare("SELECT r.*, u.nom AS nom_user, p.nom AS nom_parking
              FROM reservation r
             JOIN utilisateur u ON r.id_user = u.id_user
            JOIN parking_vh p ON r.id_parking = p.id_parking
            ORDER BY r.date_debut DESC");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }


    // LISTE DE TOUT LES RESERVATIONS

    public function listReservationAll(){

        try {
    
           $connect=$this->connect();
        $test = $connect->prepare("SELECT id_reservation, date_debut, date_fin, reservation.statut, montant_total, utilisateurs.nom AS nom_user, numero_place, nombre_heure, parking_vh.localisation AS localisation_park  
        FROM reservation
        INNER JOIN utilisateurs ON reservation.id_user = utilisateurs.id_user
        INNER JOIN parking_vh ON reservation.id_parking = parking_vh.id_parking 
        ORDER BY CASE 
        WHEN reservation.statut = 'active' THEN 0
        WHEN reservation.statut = 'terminee' THEN 1
         else 2
         END, date_debut ASC ");
        $test->execute(); 
        $resultat = $test->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
        } catch (\Throwable $th) {
              echo "Erreur: " . $th->getMessage();
        }
    
    }
    

    // Liste des reservation d'un utilisateurs

    public function listReservationUser($id){

        try {
    
           $connect=$this->connect();
        $test = $connect->prepare("SELECT id_reservation, date_debut, date_fin, reservation.statut, montant_total, utilisateurs.nom AS nom_user, numero_place, nombre_heure, parking_vh.localisation AS localisation_park
             
        FROM reservation
        INNER JOIN utilisateurs ON reservation.id_user = utilisateurs.id_user
        INNER JOIN parking_vh ON reservation.id_parking = parking_vh.id_parking 
        WHERE reservation.id_user = ?
        ORDER BY CASE 
        WHEN reservation.statut = 'active' THEN 0
        WHEN reservation.statut = 'terminee' THEN 1
         else 2
         END, date_debut ASC ");
        $test->execute([$id]); 
        $resultat = $test->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
        } catch (\Throwable $th) {
              echo "Erreur: " . $th->getMessage();
        }
    
    }

    // liste reservation  par id 
    public function getReservationById($id) {
        try {
            $connect = $this->connect();
            $test = $connect->prepare("SELECT
                r.id_reservation,
                r.date_debut,
                r.date_fin,
                r.statut,
                r.montant_total,
                u.nom AS nom_user,
                r.numero_place,
                r.nombre_heure,
                p.localisation AS localisation_park
            FROM reservation r
            INNER JOIN utilisateurs u ON r.id_user = u.id_user
            INNER JOIN parking_vh p ON r.id_parking = p.id_parking
            WHERE r.id_reservation = ?"); 
            $test->execute([$id]);
            $resultat = $test->fetch(PDO::FETCH_ASSOC); 
            return $resultat;
        } catch (\PDOException $e) {
            echo "Erreur de base de données: " . $e->getMessage();
            return false;
        } catch (\Throwable $th) {
            echo "Erreur inattendue: " . $th->getMessage();
            return false;
        }
    }

    
    public function getallReservationActive(){
        $connect=$this->connect();
        $test=$connect->query("SELECT COUNT(*) AS total_reservActif FROM reservation WHERE statut = 'active'");
        $resultats=$test->fetch(PDO::FETCH_ASSOC);
        return $resultats;
    }

    public function getallReservationTerminer(){
        $connect=$this->connect();
        $test=$connect->query("SELECT COUNT(*) AS total_reservTerminer FROM reservation WHERE statut = 'terminee'");
        $resultats=$test->fetch(PDO::FETCH_ASSOC);
        return $resultats;
    }
    
}
