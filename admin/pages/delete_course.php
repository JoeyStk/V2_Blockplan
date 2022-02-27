<?php 
require_once '../../backend/functions/control.php';

$id = $_GET['id'];
delete_file('course', $id);
// %%PATH%%
header('Location: https://localhost/Blockplan_Formular_Test/admin/');

?>