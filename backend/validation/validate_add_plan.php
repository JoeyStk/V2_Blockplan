<?php
require '../functions/control.php';

$rows = $_GET['rows'];
$id = explode('/', explode(' ',$_POST['plan_name'])[1])[0] . '_Blockplan';
$data = array(
    'plan_name' => $_POST['plan_name'],
    'plan_id' => $id,
    'plan_rows' => $rows,
);

for ($row = 1; $row <= $rows; $row++) {
    $from = $_POST['plan_from_' . $row];
    $until = $_POST['plan_until_' . $row];
    
    $single_row = array(
        'days' => $_POST['plan_days_' . $row],
        'it' => $_POST['plan_it_week_' . $row],
        'electro' => $_POST['plan_electro_week_' . $row],
        'comment' => $_POST['plan_comment_' . $row],
        'highlight' => isset($_POST['plan_highlight_' . $row]),
        'time' => array(
            'from' => $from,
            'until' => $until,
        ),
    );
    array_push($data, $single_row);
}

save_file('plan', 'n', $data);
header('Location: https://localhost/Blockplan_Formular_Test/admin/');
