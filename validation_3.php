<?php
function validate_3() {
    $lines = file('NEWBASE_2.TXT');

    $new_content = "";

    foreach ($lines as $line) {
        $new_content .= str_replace(',', ';', $line);
    }

    file_put_contents('NEWBASE_3.TXT', $new_content);
}
?>