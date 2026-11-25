<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <?php
    $serveurs = [
        'api-01' => ['cpu' => 45, 'ram' => 60, 'status' => '1'],
        'api-02' => ['cpu' => 92, 'ram' => 78, 'status' => '1'],
        'db-prod' => ['cpu' => 70, 'ram' => 95, 'status' => '1'],
        'web-01' => ['cpu' => 30, 'ram' => 40, 'status' => '1'],
        'web-02' => ['cpu' => 55, 'ram' => 65, 'status' => '0'],
        'cache-01' => ['cpu' => 88, 'ram' => 92, 'status' => '1'],
    ];

    $onlineCount = 0;
    $scoreTotal = 0;
    $bestName = '';
    $bestScore = null;
    ?>

    <table id="table1" border="1">
        <thead>
            <tr>
                <th>Serveur</th>
                <th>CPU%</th>
                <th>RAM%</th>
                <th>Status</th>
                <th>Score</th>
                <th>Etat</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($serveurs as $nomServeur => $serveur) {
                $cpu = $serveur['cpu'];
                $ram = $serveur['ram'];
                $online = $serveur['status'] === '1';

                $score = 100 - ($cpu + $ram) / 2;
                $estCritique = $cpu > 85 || $ram > 90;

                if ($estCritique) {
                    $etat = 'CRITIQUE';
                } elseif ($score >= 50) {
                    $etat = 'OK';
                } else {
                    $etat = 'ATTENTION';
                }

                if (!$online) {
                    $couleurFond = 'rgb(200,200,200)';
                } elseif ($estCritique) {
                    $couleurFond = 'rgb(255,180,180)';
                } elseif ($score >= 50) {
                    $couleurFond = 'rgb(180,255,180)';
                } else {
                    $couleurFond = 'rgb(255,220,150)';
                }

                if ($online) {
                    $onlineCount++;
                    $statusTexte = 'online';
                } else {
                    $statusTexte = 'offline';
                }

                $scoreTotal += $score;

                if ($bestScore === null || $score > $bestScore) {
                    $bestName = $nomServeur;
                    $bestScore = $score;
                }
            ?>
                <tr class="row" style="background-color: <?php echo $couleurFond; ?>;">
                    <td class="serveur"><?php echo $nomServeur; ?></td>
                    <td class="cpu"><?php echo $cpu; ?></td>
                    <td class="ram"><?php echo $ram; ?></td>
                    <td class="status"><?php echo $statusTexte; ?></td>
                    <td class="score"><?php echo $score; ?></td>
                    <td class="etat"><?php echo $etat; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <?php
    // Moyenne avec count() (slide 65).
    $average = $scoreTotal / count($serveurs);
    ?>
    <h2>Resume</h2>
    <p id="total_online_servers">Serveurs online: <?php echo $onlineCount; ?></p>
    <p id="moy_scores">Score moyen: <?php echo $average; ?></p>
    <p id="best_serv">Meilleur serveur: <?php echo $bestName . ' (' . $bestScore . ')'; ?></p>
</body>
</html>
