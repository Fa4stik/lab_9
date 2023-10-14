<?php

function validate_email($email) {
    $error_count = 0;

    if (!$email) return [$email, $error_count]; // Если email пуст

    // Проверка на наличие только одного символа @ и одной точки в имени домена
    if (substr_count($email, '@') != 1 || substr_count(explode('@', $email)[1], '.') != 1) {
        $error_count++;
    }

    // Удаление недопустимых символов
    $email = preg_replace('/[^a-zA-Z0-9@.]/', '', $email);

    return [$email, $error_count];
}

function validate_gender($gender) {
    $error_count = 0;

    if (!$gender) return [$gender, $error_count]; // Если пол пуст

    if (preg_match('/[^\x20-\x7E]/', $gender)) return [$gender, $error_count];

    if ($gender != "male" && $gender != "female") {
        $error_count++;
        $gender = "";
    }

    return [$gender, $error_count];
}

function validate_1() {
    $lines = file('OLDBASE.TXT');

    $email_errors = 0;
    $gender_errors = 0;

    $new_content = "";

    // Применение функций валидации
    foreach ($lines as $line) {
        $fields = explode(',', $line);
        if (count($fields) < 17) continue;

        // Проверка на существование ключей массива перед использованием
        if (isset($fields[7])) {
            list($fields[7], $email_error) = validate_email($fields[7]);
            $email_errors += $email_error;
        }

        if (isset($fields[4])) {
            list($fields[4], $gender_error) = validate_gender($fields[4]);
            $gender_errors += $gender_error;
        }

        $new_content .= implode(',', $fields);
    }

    file_put_contents('NEWBASE_1.TXT', $new_content);

    echo "Количество ошибок в электронной почте: $email_errors</br>";
    echo "Количество ошибок в поле пола: $gender_errors</br>";
}

?>