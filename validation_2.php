<?php
function format_record_number($number) {
    return str_pad($number, 6, '0', STR_PAD_LEFT);
}

function format_phone_number($phone) {
    // Удаление всех символов, кроме цифр
    $phone = preg_replace('/[^0-9]/', '', $phone);

    $length = strlen($phone);
    if ($length == 8) {
        return preg_replace('/^(\d)(\d{3})(\d{4})$/', '$1-$2-$3', $phone);
    } elseif ($length == 9) {
        return preg_replace('/^(\d{2})(\d{3})(\d{4})$/', '$1-$2-$3', $phone);
    } elseif ($length == 10) {
        return preg_replace('/^(\d{3})(\d{3})(\d{4})$/', '$1-$2-$3', $phone);
    } else {
        return $phone; // Если номер не соответствует ни одному из форматов, вернуть исходный номер
    }
}

function format_weight($weight) {
    return round((float)$weight);
}

function validate_2() {
    $lines = file('NEWBASE_1.TXT');

    $new_content = "";

    // Применение функций валидации
    foreach ($lines as $line) {
        $fields = explode(',', $line);

        if (count($fields) < 17) continue;
        // Проверка на существование ключей массива перед использованием
        if (isset($fields[0])) {
            $fields[0] = format_record_number($fields[0]);
        }

        if (isset($fields[8])) {
            $fields[8] = format_phone_number($fields[8]);
        }

        if (isset($fields[12])) {
            $fields[12] = format_weight($fields[12]);
        }

        $new_content .= implode(',', $fields);
    }

    file_put_contents('NEWBASE_2.TXT', $new_content);
}
?>