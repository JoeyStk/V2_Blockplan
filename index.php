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
</head>
    <body>
        <style>
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
        Der gesamte Blockplan
            <?php
            render_plan();
            ?>
        </div>

    </body>
</html>