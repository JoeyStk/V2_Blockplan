<?php 
require_once 'control.php';

function render_courses_table() {
    $courses = get_files('course');
    foreach ($courses as $course) {
        $course = (array) json_decode($course);?>

        Name: <?= $course['course_name'] ?> <a href="pages/delete_course.php?id=<?= $course['course_id'] ?>">Löschen</a><br>
        <?php
    }
}

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

function render_plans_tabs() {
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
            </div>

    <?php }
}

function render_plan() {
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
            </div>

    <?php }
}