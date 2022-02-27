<?php
require_once '../../backend/functions/control.php';

$id = $_GET['id'];
$plans = get_files('plan', $id);
foreach($plans as $plan) {
    $plan = (array) json_decode($plan);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blockplan - Bearbeiten</title>
    <link href="../../frontend/css/styles.css" rel="stylesheet">
</head>
<body>
<a href="../">Zurück</a>
<form method="post" action="../../backend/validation/validate_edit_plan.php?rows=<?= $rows ?>">
    <label for="plan_name">Name des Blockplans</label>
    <input required value="<?= $plan['plan_name'] ?>" id="plan_name" name="plan_name">
    <?php
    if (isset($_GET['rows'])) {
        $limit = $_GET['rows'];
    } else {
        $limit = intval($plan['plan_rows']); 
    }
    
    for ($row = 1; $row <= $limit; $row++) {
        $plan = (array) $plan[$row - 1];
        $time = (array) $plan['time'];
        ?>
            <div id="<?= $row ?>" class="card">
                <div>
                    Zeile: <?= $row ?><br>
                    <input id="plan_from_<?= $row ?>" value="<?php if(isset($time['from'])) { ?><?= $time['from'] ?><?php }?>" name="plan_from_<?= $row ?>" onchange='saveValue(this);' type="date">
                    <input id="plan_until_<?= $row ?>" value="<?php if(isset($time['until'])) { ?><?= $time['until'] ?><?php }?>" name="plan_until_<?= $row ?>" onchange='saveValue(this);' type="date">
                    <input id="plan_days_<?= $row ?>" value="<?= $plan['days'] ?>" name="plan_days_<?= $row ?>" value="5" min="1" max="5" onchange='saveValue(this);' type="number">
                    <?php if($plan['highlight']) {?>
                        <input type="checkbox" checked name="plan_highlight_<?= $row ?>" id="plan_highlight_<?= $row ?>" >Zeile farblich hervorgeheben</div>
                        <?php
                    } else { ?>
                    <input type="checkbox" name="plan_highlight_<?= $row ?>" id="plan_highlight_<?= $row ?>" >Zeile farblich hervorgeheben</div>
                    <?php }?>
                <div>IT-Berufe<br>
                    <input type="radio" <?php if($plan['it'] == 'plan_it_week_a'){ ?> selected="selected" <?php } ?> name="plan_it_week_<?= $row ?>" onchange='saveChecked(this);' id="plan_it_week_a_<?= $row ?>" value="plan_it_week_a">A-Block
                    <input type="radio" <?php if($plan['it'] == 'plan_it_week_b'){ ?> selected="selected" <?php } ?> name="plan_it_week_<?= $row ?>" onchange='saveChecked(this);' id="plan_it_week_b_<?= $row ?>" value="plan_it_week_b">B-Block
                    <input type="radio" <?php if($plan['it'] == 'plan_it_week_c'){ ?> selected="selected" <?php } ?> name="plan_it_week_<?= $row ?>" onchange='saveChecked(this);' id="plan_it_week_c_<?= $row ?>" value="plan_it_week_c">C-Block
                    <br>
                    <input type="radio" <?php if($plan['it'] == 'plan_it_week_exception'){ ?> selected="selected" <?php } ?> name="plan_it_week_<?= $row ?>" onchange='saveChecked(this);' id="plan_it_week_exception_<?= $row ?>" value="plan_it_week_exception">Nur zwölfte Klassen
                    <input type="radio" <?php if($plan['it'] == 'plan_it_week_none'){ ?> selected="selected" <?php } ?> name="plan_it_week_<?= $row ?>" onchange='saveChecked(this);' id="plan_it_week_none_<?= $row ?>" value="plan_it_week_none">Keine
                </div>
                <div>Elektro-Berufe<br>
                    <input type="radio" <?php if($plan['electro'] == 'plan_electro_week_a'){ ?> selected="selected" <?php } ?> onchange='saveChecked(this);' name="plan_electro_week_<?= $row ?>" id="plan_electro_week_a_<?= $row ?>" value="plan_electro_week_a">A-Block
                    <input type="radio" <?php if($plan['electro'] == 'plan_electro_week_b'){ ?> selected="selected" <?php } ?> onchange='saveChecked(this);' name="plan_electro_week_<?= $row ?>" id="plan_electro_week_b_<?= $row ?>" value="plan_electro_week_b">B-Block
                    <input type="radio" <?php if($plan['electro'] == 'plan_electro_week_c'){ ?> selected="selected" <?php } ?> onchange='saveChecked(this);' name="plan_electro_week_<?= $row ?>" id="plan_electro_week_c_<?= $row ?>" value="plan_electro_week_c">C-Block
                    <br>
                    <input type="radio" <?php if($plan['electro'] == 'plan_electro_week_exception'){ ?> selected="selected" <?php } ?> onchange='saveChecked(this);' name="plan_electro_week_<?= $row ?>" id="plan_electro_week_exception_<?= $row ?>" value="plan_electro_week_exception"> 13. Klassen
                    <input type="radio" <?php if($plan['electro'] == 'plan_electro_week_none'){ ?> selected="selected" <?php } ?> onchange='saveChecked(this);' name="plan_electro_week_<?= $row ?>" id="plan_electro_week_none_<?= $row ?>" value="plan_electro_week_none">Keine
                </div>
                <div>
                    Bemerkungen
                    <br>
                    <input value="<?= $plan['comment'] ?>" onchange='saveValue(this);' id="plan_comment_<?= $row ?>" name="plan_comment_<?= $row ?>">
                </div>
            </div>
        <?php

    }
    ?>

    <a href="<?= '?id=' . $id . '&rows=' . $limit+1; ?>">Zeile hinzufügen</a>
    <a href="<?= '?id=' . $id . '&rows=' . $limit-1; ?>">Zeile löschen</a>

    <input type="submit" value="Speichern">
</form>

<?php
}
?>

<script>
    // localStorage.clear();
    let url = window.location.search.substr(1);
    let rows = url.split("=")[1];
    for (let i = 1; i <= rows; i++) {
        document.getElementById("plan_from_"+i).value = getSavedValue("plan_from_"+i);
        document.getElementById("plan_until_"+i).value = getSavedValue("plan_until_"+i);
        document.getElementById("plan_days_"+i).value = getSavedValue("plan_days_"+i);
        document.getElementById("plan_comment_"+i).value = getSavedValue("plan_comment_"+i);
        
        document.getElementById("plan_it_week_a_"+i).checked = getSavedValue("plan_it_week_a_"+i);
        document.getElementById("plan_it_week_b_"+i).checked = getSavedValue("plan_it_week_b_"+i);
        document.getElementById("plan_it_week_c_"+i).checked = getSavedValue("plan_it_week_c_"+i);
        document.getElementById("plan_it_week_exception_"+i).checked = getSavedValue("plan_it_week_exception_"+i);
        
        document.getElementById("plan_electro_week_a_"+i).checked = getSavedValue("plan_electro_week_a_"+i);
        document.getElementById("plan_electro_week_b_"+i).checked = getSavedValue("plan_electro_week_b_"+i);
        document.getElementById("plan_electro_week_c_"+i).checked = getSavedValue("plan_electro_week_c_"+i);
        document.getElementById("plan_electro_week_exception_"+i).checked = getSavedValue("plan_electro_week_exception_"+i);

    }

    //Save the value function - save it to localStorage as (ID, VALUE)
    function saveValue(e){
        var id = e.id;  // get the sender's id to save it . 
        var val = e.value; // get the value. 
        localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override . 
    }

    function saveChecked(e) {
        var name = e.name;
        var radios = document.getElementsByName(name); // list of radio buttons
        
        for(var i=0;i<radios.length;i++){
            localStorage.removeItem(radios[i].id);
        }

        var id = e.id;
        localStorage.setItem(id, true);

    }

    //get the saved value function - return the value of "v" from localStorage. 
    function getSavedValue  (v){
        if (!localStorage.getItem(v)) {
            return "";// You can change this to your defualt value. 
        }
        return localStorage.getItem(v);
    }

</script>

</body>
</html>