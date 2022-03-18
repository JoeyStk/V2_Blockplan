<?php
//$dir = __DIR__ . '\index.php';
$dir = 'localhost/Blockplan_Formular_Test/admin/index.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blockplan - Neuen Blockplan anlegen</title>
    <link href="../../frontend/css/styles.css" rel="stylesheet">
</head>
<body>

<style>
[data-tip] {
  position:relative;

}
[data-tip]:before {
  content:'';
  /* hides the tooltip when not hovered */
  display:none;
  content:'';
  display:none;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid #1a1a1a;
  position:absolute;
  top:30px;
  left:35px;
  z-index:8;
  font-size:0;
  line-height:0;
  width:0;
  height:0;
  position:absolute;
  top:30px;
  left:35px;
  z-index:8;
  font-size:0;
  line-height:0;
  width:0;
  height:0;
}
[data-tip]:after {
  display:none;
  content:attr(data-tip);
  position:absolute;
  top:35px;
  left:0px;
  padding:5px 8px;
  background:#1a1a1a;
  color:#fff;
  z-index:9;
  font-size: 0.75em;
  height:18px;
  line-height:18px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  white-space:nowrap;
  word-wrap:normal;
}
[data-tip]:hover:before,
[data-tip]:hover:after {
  display:block;
}
</style>

<?php 
if (isset($_GET['rows'])) {
    $rows = $_GET['rows'];
} else {
    $rows = 1;
}

$current_url = $dir . '?rows=' . $rows;

/* View */
?>
<!-- Das ist das Template zum Erstellen eines Blockplans. -->
<a href="/Blockplan_Formular_Test/admin">Zurück zum Frontend</a>
<form method="post" action="../../backend/validation/validate_add_plan.php?rows=<?= $rows ?>">
    <label for="plan_name">Name des Blockplans</label>
    <div data-tip="Bitte den Titel so einpflegen: Blockplan 2022/2023">
        <input required id="plan_name" name="plan_name">
    </div>
    <?php
    for ($row = 1; $row <= $rows; $row++) {
        ?>
            <div id="<?= $row ?>" class="card">
                <div>
                    Zeile: <?= $row ?><br>
                    <input id="plan_from_<?= $row ?>" name="plan_from_<?= $row ?>" onchange='saveValue(this);' type="date">
                    <input id="plan_until_<?= $row ?>" name="plan_until_<?= $row ?>" onchange='saveValue(this);' type="date">
                    <input id="plan_days_<?= $row ?>" name="plan_days_<?= $row ?>" value="5" min="1" max="5" onchange='saveValue(this);' type="number">
                    <input type="checkbox" name="plan_highlight_<?= $row ?>" id="plan_highlight_<?= $row ?>" >Zeile farblich hervorgeheben</div>
                <div>IT-Berufe<br>
                    <input type="radio" name="plan_it_week_<?= $row ?>" onchange='saveChecked(this);' id="plan_it_week_a_<?= $row ?>" value="plan_it_week_a">A-Block
                    <input type="radio" name="plan_it_week_<?= $row ?>" onchange='saveChecked(this);' id="plan_it_week_b_<?= $row ?>" value="plan_it_week_b">B-Block
                    <input type="radio" name="plan_it_week_<?= $row ?>" onchange='saveChecked(this);' id="plan_it_week_c_<?= $row ?>" value="plan_it_week_c">C-Block
                    <br>
                    <input type="radio" name="plan_it_week_<?= $row ?>" onchange='saveChecked(this);' id="plan_it_week_exception_<?= $row ?>" value="plan_it_week_exception">Nur zwölfte Klassen
                    <input type="radio" name="plan_it_week_<?= $row ?>" onchange='saveChecked(this);' id="plan_it_week_none_<?= $row ?>" value="plan_it_week_none">Keine
                </div>
                <div>Elektro-Berufe<br>
                    <input type="radio" onchange='saveChecked(this);' name="plan_electro_week_<?= $row ?>" id="plan_electro_week_a_<?= $row ?>" value="plan_electro_week_a">A-Block
                    <input type="radio" onchange='saveChecked(this);' name="plan_electro_week_<?= $row ?>" id="plan_electro_week_b_<?= $row ?>" value="plan_electro_week_b">B-Block
                    <input type="radio" onchange='saveChecked(this);' name="plan_electro_week_<?= $row ?>" id="plan_electro_week_c_<?= $row ?>" value="plan_electro_week_c">C-Block
                    <br>
                    <input type="radio" onchange='saveChecked(this);' name="plan_electro_week_<?= $row ?>" id="plan_electro_week_exception_<?= $row ?>" value="plan_electro_week_exception"> 13. Klassen
                    <input type="radio" onchange='saveChecked(this);' name="plan_electro_week_<?= $row ?>" id="plan_electro_week_none_<?= $row ?>" value="plan_electro_week_none">Keine
                </div>
                <div>
                    Bemerkungen
                    <br>
                    <input onchange='saveValue(this);' id="plan_comment_<?= $row ?>" name="plan_comment_<?= $row ?>">
                </div>
            </div>
        <?php

    }
    ?>

    <a href="<?= '?rows=' . $rows+1; ?>">Zeile hinzufügen</a>
    <a href="<?= '?rows=' . $rows-1; ?>">Zeile löschen</a>

    <input type="submit" value="Speichern">
</form>
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
