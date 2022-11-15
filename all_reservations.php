<?php include './core/db/db_con.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserveringen</title>
</head>
<body>
   <h1>Reserveringen</h1>
    <table>
        <tr>
            <th>Naam</th>
            <th>Lokaal</th>
            <th>School nummer</th>
            <th>Notitie</th>
            <th>Datum</th>
            <th>Tijd</th>
        </tr>
        <?php
            $sql = "SELECT * FROM reservations";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $reservations = $stmt->fetchAll();
            foreach($reservations as $reservation) {
                echo "<tr>";
                echo "<td>".$reservation['res_name']."</td>";
                echo "<td>".$reservation['res_room']."</td>";
                echo "<td>".$reservation['res_tel']."</td>";
                echo "<td>".$reservation['res_notes']."</td>";
                echo "<td>".$reservation['res_date']."</td>";
                echo "<td>".$reservation['res_time']."</td>";
                echo "</tr>";
            }
    ?>
</body>
</html>