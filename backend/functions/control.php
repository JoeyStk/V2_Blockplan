<?php

/**
 * Die Funktion nimmt ein Array entgegen und wandelt es in ein JSON um.
 * Die Funktion nimmt insgesamt drei Parameter:
 * 
 * parameter name: type
 * parameter type: string
 * parameter desc: Type bestimmt, ob es sich hier um ein Array für die Schulklassen oder für die Blockpläne handelt. 
 * parameter options: Nimmt 'course' für Schulklassen oder 'plan' für Blockpläne
 * 
 * parameter name: mode
 * parameter type: string
 * parameter desc: Mode bestimmt, ob es sich um ein neues oder ein bereits bestehendes Array handelt.
 * parameter options: Nimmt 'n' für neue Daten oder 'o' für bearbeitende Daten.
 * 
 * parameter name: data
 * parameter type: array
 * parameter desc: Data sind die im Formular gesammelten Informationen, die in save in ein JSON umgewandelt werden soll.
 * parameter options: Nimmt 'course' für Schulklassen oder 'plan' für Blockpläne
 */
function save_file($type, $mode, $data){
    // %%PATH%%
    $path = '../jsons/' . $type . 's/';
    $id = $type . '_id';
    $json_content = json_encode($data);
    if ($mode == 'n') {
        $filepath = $path . $data[$id] . '.json';
        file_put_contents($filepath, $json_content);
    } else if ($mode == 'o') {
        $filepath = $path . $data[$id] . '.json';
        unlink($filepath);
        file_put_contents($filepath, $json_content);
    }
}

/**
 * Die Funktion liest die Dateien aus einem angegebenen Verzeichnis aus.
 * Die Funktion nimmt insgesamt zwei Parameter:
 * 
 * parameter name: type
 * parameter type: string
 * parameter desc: Type bestimmt, ob es sich hier um ein Array für die Schulklassen oder für die Blockpläne handelt. 
 * parameter options: Nimmt 'course' für Schulklassen oder 'plan' für Blockpläne
 * 
 * parameter name: filename
 * parameter type: string
 * parameter desc: Dies ist ein optionaler Parameter. Mit ihm kann eine bestimmte Datei ausgelesen werden.
 * 
 */

function get_files($type, $filename = null){
    //%%PATH%%
    $path = __DIR__ . '/../jsons/' . $type . 's/';
    $contents = []; 
    if ($filename != null) {
        $content = file_get_contents($path . $filename . '.json');
        array_push($contents, $content);
    } else {
        $files = scandir($path);
        foreach ($files as $file) {
            if(strlen($file) > 2) {
                $content = file_get_contents($path . $file);
                array_push($contents, $content);
            }
        }
    }
    return $contents;
}

/**
 * Die Funktion löscht angelegte Dateien.
 * Die Funktion nimmt insgesamt zwei Parameter:
 * 
 * parameter name: type
 * parameter type: string
 * parameter desc: Type bestimmt, ob es sich hier um ein Array für die Schulklassen oder für die Blockpläne handelt.
 * parameter options: Nimmt 'course' für Schulklassen oder 'plan' für Blockpläne
 * 
 * parameter name: file
 * parameter type: string
 * parameter desc: Hier wird der Pfad zur zu löschenden Datei angegeben
 * 
 */

function delete_file($type, $file) {
    $path = __DIR__ . '/../jsons/' . $type . 's/';
    $filepath = $path . $file .'.json';
    unlink($filepath);
}