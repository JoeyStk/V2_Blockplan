<?php 
  require_once '../backend/functions/view.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../frontend/css/styles.css">
</head>
<body>
<!-- In dieser Datei befindet sich das Template im Administrationsbereich.
Hier werden die bestehenden Blocklpläne und Klassen angezeigt, mit der Option für beides weitere anzulegen. -->
  <section>
    <div class="top-tabs-container">
      <label for="main-tab-1">Blockpläne</label>
      <label for="main-tab-2">Klassen</label>
    </div>

    <input class="tab-radio" id="main-tab-1" name="main-group" type="radio" checked="checked"/>
    <div class="tab-content">
      <?php render_plans_tabs('short'); ?>
      <a href="pages/add_plan.php">Neuen Blockplan anlegen</a>
    </div>

    <input class="tab-radio" id="main-tab-2" name="main-group" type="radio"/>
    <div class="tab-content">
      <?php render_courses_table(); ?>
      <!-- %%PATH%% -->
      <a href="pages/add_course.php">Neue Klasse anlegen</a>
    </div>
  </body>
</html>