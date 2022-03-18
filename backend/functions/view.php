<?php 
require_once 'control.php';

/**
 * Die Funktion zeigt die Liste der Klassen an
 */
function render_courses_table() {
    $courses = get_files('course');
    foreach ($courses as $course) {
        $course = (array) json_decode($course);?>

        Name: <?= $course['course_name'] ?> <a href="pages/delete_course.php?id=<?= $course['course_id'] ?>">Löschen</a><br>
        <?php
    }
}

/**
 * Die Funktion zeigt die Filter für den Blockplan an
 */
function render_plans_filter() { ?>
    <form method="get">
        <select name="course_filter">
            <option></option>
            <?php
            $courses = get_files('course');
            foreach ($courses as $course) {
                $course = (array) json_decode($course); 
                if (isset($_GET['course_filter'])) {
                    $filter = $_GET['course_filter'];
                } else {
                    $filter = null;
                }
                if ($filter == $course['course_name']) {?>
                    <option value="<?= $course['course_name'] ?>" selected><?= $course['course_name'] ?></option>
                <?php } else { ?>
                    <option value="<?= $course['course_name'] ?>"><?= $course['course_name'] ?></option>
                <?php } 
            } ?>
            </select>
        <input value="Suchen" type="submit">
    </form>
    <?php
}

/**
 * Die Funktion zeigt die Ergebnisse der Filter an
 */
function render_plans_filter_results() {
     
    $courses = get_files('course');
    $filter = '';
    if (isset($_GET['course_filter'])) {
        $filter = $_GET['course_filter'];
    }
    $course = get_files('course', $filter);
    $course = (array) json_decode($course[0]);
    $course_id = $course['course_school_year'] . '_Blockplan';
    $course_profession = strtolower($course['course_profession']);
    $course_year = $course['course_year'];
    $course_section = $course['course_section'];

    $current_date =  date("Y") . '-' . date("m") . '-' . date("d");
    $plans = get_files('plan');
    $needle = 'plan_' . strtolower($course_profession) . '_week_' . $course_section;
    echo 'Deine nächsten Blöcke gehen von: ';
    foreach($plans as $plan) {
        $plan = (array) json_decode($plan);
        if ($course_id == $plan['plan_id']) {
            unset($plan['plan_name']);
            unset($plan['plan_id']);
            unset($plan['plan_rows']);
            for($i = 0; $i < count($plan);$i++) {
                if($plan[$i]->$course_profession == $needle ) {
                    if($current_date <= $plan[$i]->time->until){
                        echo '<br>' . $plan[$i]->time->from . ' bis zum ' . $plan[$i]->time->until;
                    }
                }
            }
        }
    }
}

/**
 * Die Funktion zeigt die Tabs für die Blockpläne
 * Die Funktion nimmt insgesamt einen Parameter:
 *  
 * parameter name: mode
 * parameter type: string
 * parameter desc: Mode bestimmt, ob es sich eine Kurzversion oder eine Langversion handelt.
 * parameter options: Nimmt 'short' für neue Daten oder 'extended' für bearbeitende Daten. 
 * 
 */

function render_plans_tabs($mode) {
    $plans = get_files('plan');
    for ($i = 0; $i < count($plans); $i++) { 
        $plan = (array) json_decode($plans[$i]);
        ?>
    
        <div class="sub-tabs-container">
            <label for="sub-tab-<?= $i ?>"><?= $plan['plan_name'] ?></label>
        </div>
    
        <input class="tab-radio" id="sub-tab-<?= $i ?>" name="sub-group" type="radio" checked="checked">
        <div class="sub-tab-content">
            <h1><?= $plan['plan_name'] ?></h1>
            
        <?php 
            if ($mode == 'extended') {
                render_extended_plan($plan);
            } else if ($mode == 'short') {
                render_short_plan($plan);
            }
        ?>
        </div>
    <?php }
}

/**
 * Die Funktion ist eine Hilfsfunktion, die die Langversion für den Blockplan erzeugt
 * Die Funktion nimmt insgesamt einen Parameter:
 *  
 * parameter name: plan
 * parameter type: Array
 * parameter desc: der übergegebene Plan als Array
 * 
 */

function render_extended_plan($plan) { 
    unset($plan['plan_name']);
    unset($plan['plan_id']);
    unset($plan['plan_rows']);
    ?>
    <div id="table-scroll" class="table-scroll">
        <table id="main-table" class="main-table">
            <thead>
                <tr>
                    <th colspan="2" scope="col">Zeitraum</th>
                    <th rowspan="3" scope="col">Jahreswoche</th>
                    <th rowspan="3" scope="col">Schulwoche</th>
                    <th rowspan="3" scope="col">Schultage</th>
                    <th colspan="4" scope="col">Elektro</th>
                    <th rowspan="3" scope="col">Bemerkungen</th>
                    <th colspan="9" scope="col">IT-Berufe</th>
                </tr>
                <tr>
                    <th rowspan="2">Von</th>
                    <th rowspan="2">Bis</th>
                    <th colspan="3">10-12</th>
                    <th>13</th>
                    <th colspan="3">10</th>
                    <th colspan="3">11</th>
                    <th colspan="3">12</th>
                </tr>
                <tr>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th></th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($plan); $i++) {?>
                    <tr>
                        <th><?php if($plan[$i]->time->from != null) {echo $plan[$i]->time->from;} ?></th>
                        <td><?php if($plan[$i]->time->until != null) {echo $plan[$i]->time->until;} ?></td>
                        <td></td>
                        <td><?= $i+1 ?></td>
                        <td><?php if($plan[$i]->days != null) {echo $plan[$i]->days;} ?></td>
                        <td><?php if($plan[$i]->electro == 'plan_electro_week_a') {echo $plan[$i]->days;} ?></td>
                        <td><?php if($plan[$i]->electro == 'plan_electro_week_b') {echo $plan[$i]->days;} ?></td>
                        <td><?php if($plan[$i]->electro == 'plan_electro_week_c') {echo $plan[$i]->days;} ?></td>
                        <td></td>
                        <td><?php if($plan[$i]->comment != null) {echo $plan[$i]->comment;} ?></td>
                        <td><?php if($plan[$i]->it == 'plan_it_week_a') {echo $plan[$i]->days;} ?></td>
                        <td><?php if($plan[$i]->it == 'plan_it_week_b') {echo $plan[$i]->days;} ?></td>
                        <td><?php if($plan[$i]->it == 'plan_it_week_c') {echo $plan[$i]->days;} ?></td>
                        <td><?php if($plan[$i]->it == 'plan_it_week_a') {echo $plan[$i]->days;} ?></td>
                        <td><?php if($plan[$i]->it == 'plan_it_week_b') {echo $plan[$i]->days;} ?></td>
                        <td><?php if($plan[$i]->it == 'plan_it_week_c') {echo $plan[$i]->days;} ?></td>
                        <td><?php if($plan[$i]->it == 'plan_it_week_a') {echo $plan[$i]->days;} ?></td>
                        <td><?php if($plan[$i]->it == 'plan_it_week_b') {echo $plan[$i]->days;} ?></td>
                        <td><?php if($plan[$i]->it == 'plan_it_week_c') {echo $plan[$i]->days;} ?></td>
                    </tr>
                    <?php
                    $plan[$i];
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
}

/**
 * Die Funktion ist eine Hilfsfunktion, die die Kurzversion für den Blockplan erzeugt
 * Die Funktion nimmt insgesamt einen Parameter:
 *  
 * parameter name: plan
 * parameter type: Array
 * parameter desc: der übergegebene Plan als Array
 * 
 */

function render_short_plan($plan) { ?>
    <div>
        <b>Name: </b> <?= $plan['plan_name']?>
        <b>ID: </b> <?= $plan['plan_id'] ?>
        <b>Zeilen: </b><?= $plan['plan_rows'] ?>
        <a href="pages/edit_plan.php?id=<?= $plan['plan_id'] ?>">Bearbeiten</a>
        <a href="pages/delete_plan.php?id=<?= $plan['plan_id']?>">Löschen</a>
    </div>
    <div>
        <table>
            <tr>
                <th>Von</th>
                <th>Bis</th>
                <th>Tage</th>
                <th>IT-Berufe</th>
                <th>Elektro</th>
                <th>Kommentare</th>
                <th>Highlight</th>
            </tr>
                
            <?php
                unset($plan['plan_name']);
                unset($plan['plan_id']);
                unset($plan['plan_rows']);
                foreach ($plan as $row) {
                    $row = (array) $row;
                    $time = (array) $row['time'];
                    ?>
                    <tr>
                        <td><?= $time['from'] ?></td>
                        <td><?= $time['until'] ?></td>
                        <td><?= $row['days'] ?></td>
                        <td><?= $row['it'] ?></td>
                        <td><?= $row['electro'] ?></td>
                        <td><?= $row['comment'] ?></td>
                        <td><?= $row['highlight'] ?></td>
                    </tr>
                <?php } ?>
        </table>
    </div>
<?php
}