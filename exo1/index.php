<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <?php
    // Tableau associative (slide 64).
    $etudiantsNote = [
        'JOHN' => 9,
        'BOB' => 15.5,
        'RAYANE' => 7,
        'ROSIE' => 13,
    ];

    // Fonction (slide 71), comparaison (slide 66).
    function estAdmissible($note)
    {
        return $note >= 10;
    }
    ?>

    <table id="table1" border="1">
        <thead>
            <tr>
                <th>Cle</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Boucle foreach (slide 69).
            foreach ($etudiantsNote as $etudiant => $note) {
                // Condition (slide 67).
                if (estAdmissible($note)) {
                    $couleurFond = 'rgb(136,248,136)';
                } else {
                    $couleurFond = 'rgb(251,173,173)';
                }
            ?>
                <tr class="row" style="background-color: <?php echo $couleurFond; ?>;">
                    <td class="etud"><?php echo $etudiant; ?></td>
                    <td class="note"><?php echo $note; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
