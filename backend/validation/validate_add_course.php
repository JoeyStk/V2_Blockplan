<?php 
require_once '../functions.php';

/** 
 * Diese Funktion / Seite validiert neue Kurse
 */

$data = array(
    'course_id' => $_POST['course_name'],
    'course_name' => $_POST['course_name'],
    'course_profession' => $_POST['course_profession'],
    'course_year' => $_POST['course_year'],
    'course_school_year' => $_POST['course_school_year'],
    'course_section' => $_POST['course_section'],
);

save_file('course', 'n', $data);
// %%PATH%%
header('Location: https://localhost/Blockplan_Formular_Test/admin/');