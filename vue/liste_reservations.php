<h2>Mes réservations</h2>

<?php if (!empty($reservations)) : ?>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Parking</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Durée (h)</th>
                <th>Montant</th>
                <th>Numéro place</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $res) : ?>
                <tr>
                    <td><?= htmlspecialchars($res['nom_parking']) ?></td>
                    <td><?= htmlspecialchars($res['date_debut']) ?></td>
                    <td><?= htmlspecialchars($res['date_fin']) ?></td>
                    <td><?= htmlspecialchars($res['nombre_heure']) ?></td>
                    <td><?= htmlspecialchars($res['montant_total']) ?> FCFA</td>
                    <td><?= htmlspecialchars($res['numero_place']) ?></td>
                    <td><?= htmlspecialchars($res['statut']) ?></td>
                    <td>
                        <?php if ($res['statut'] === 'active') : ?>
                            <a href="index.php?page=cloturer_reservation&id=<?= $res['id_reservation'] ?>"
                               onclick="return confirm('Clôturer cette réservation ?');">
                                Fermer
                            </a>
                        <?php else : ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>Vous n'avez pas encore de réservation.</p>
<?php endif; ?>
