<?php
require_once 'backend/functions/view.php';
$dir = __DIR__;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="frontend/css/styles.css">
</head>
    <body>
        <a href="admin/index.php">Zum Adminbereich</a>

        <div class="top-tabs-container">
            <label for="main-tab-filter">Filter</label>
            <label for="main-tab-plan">Blockpläne</label>
        </div>

  <!-- Tab Container || für Blockpläne -->
        <input class="tab-radio" id="main-tab-filter" name="main-group" type="radio" checked="checked"/>
        <div class="tab-content">
            <?php
            render_plans_filter();
            render_plans_filter_results();
            ?>  
        </div>

  <!-- Tab Container || für Klassen -->
        <input class="tab-radio" id="main-tab-plan" name="main-group" type="radio"/>
        <div class="tab-content">
            <?php render_plans_tabs('extended', 'user'); ?>
        </div>

    </body>
</html>