<!DOCTYPE html>
<html>
  <head>
    <title>Divers-reserveer-systeem</title>
    <link href="3-theme.cs" rel="stylesheet">
    </script>
  </head>
  <body>
    <?php
    // (A) PROCESS RESERVATION
    if (isset($_POST["date"])) {
      require "2-reserve.php";
      if ($_RSV->save(
        $_POST["date"], $_POST["time"], $_POST["name"],
        $_POST["room"], $_POST["tel"], $_POST["notes"])) {
        echo "<div class='ok'>Reservering succesvol opgeslagen! Dankjewel :).</div>";
      } else { echo "<div class='err'>".$_RSV->error."</div>"; }
    }
    ?>

    <!-- (B) RESERVATION FORM -->
    <h1>Reservering</h1>
    <form id="resForm" method="post" target="_self">
      <label for="res_name">Naam</label>
      <input type="text" required name="name" value=""/>

      <label for="res_room">lokaal</label>
      <select id="room" name="room">
      <option value="w001">w001</option>
      <option value="w002">w002</option>
      <option value="w003">w003</option>
      <option value="w004">w004</option>
      <option value="w005">w005</option>
      <option value="w006">w006</option>
      <option value="w007">w007</option>
      <option value="w008">w008</option>
      </select>




      <label for="res_tel">School nummer</label>
      <input type="text" required name="tel" value=""/>

      <label for="res_notes">Notitie (optioneel)</label>
      <input type="text" name="notes" value=""/>

      <?php
      // @TODO - MINIMUM DATE (TODAY)
      // $mindate = date("Y-m-d", strtotime("+2 days"));
      $mindate = date("Y-m-d");
      ?>
      <label>Welke dag wil je reserveren?</label>
      <input type="date" required id="res_date" name="date"
             min="<?=$mindate?>">


      <label for="time">Kies je tijd van de reservering.</label>
      <input type="time" id="time" name="time" min="09:00" max="17:00" required>
      <small>Lokalen kun je reserveren van 09:00 tot 17:00 uur.</small>

      </select>

      <input type="submit" value="Submit"/>
    </form>
  </body>
</html>
