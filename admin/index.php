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
</head>
<body>
  <style>
  /* FONT */
  @import url("https://fonts.googleapis.com/css?family=Lato");


  /* Main Tabs */
  label {
    background-color: #00262f;
    color: #ffffff;
    display: inline-block;
    cursor: pointer;
    padding: 8px;
    font-size: 14px;
  }

  label:hover {
    background-color: #02404b;
  }

  label input:checked {
    background-color: red;
  }

  .tab-radio {
    display: none;
  }

  /* Tabs behaviour, hidden if not checked/clicked */
  .sub-tab-content,
  .tab-content {
    display: none;
  }

  .tab-radio:checked + .tab-content,
  .tab-radio:checked + .sub-tab-content {
    display: block;
  }

  /* Sub-tabs */
  .sub-tabs-container label {
    background-color: #cddc39;
    color: #030700;
  }

  .sub-tabs-container label:hover {
    background-color: #AFB42B;
  }

  /* Tabs Content */
  .tab-content {
    padding: 10px;
    background-color: #ffffff;
    border: 1px solid #ddd;
    box-shadow: 2px 10px 6px -3px rgba(0, 0, 0, 0.5);
  }

  /* General */

  body {
    width: 90%;
    margin: 10px auto;
    background-color: #ecf0f1;
    font-family: Lato, sans-serif;
    letter-spacing: 1px;
  }

  *, *:hover {
    transition: all .3s;
  }

  </style>    

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