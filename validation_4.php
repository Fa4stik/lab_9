<?php
function punct_a($lines) {
    $male_count = 0;
    $female_count = 0;
    $male_height_total = 0;
    $female_height_total = 0;
    $male_weight_total = 0;
    $female_weight_total = 0;
    $male_age_total = 0;
    $female_age_total = 0;

    foreach ($lines as $line) {
        $fields = explode(';', $line);
        if (!isset($fields[4]) || !isset($fields[12]) || !isset($fields[13]) || !isset($fields[9])) continue;
        
        
        $gender = $fields[4];
        $birth_date = explode('/', $fields[9]);
        if (!isset($birth_date[2])) continue;
        $age = date('Y') - $birth_date[2];

        if ($gender == "male") {
            $male_count++;
            $male_height_total += $fields[13];
            $male_weight_total += $fields[12];
            $male_age_total += $age;
        } elseif ($gender == "female") {
            $female_count++;
            $female_height_total += $fields[13];
            $female_weight_total += $fields[12];
            $female_age_total += $age;
        }
    }

    $male_avg_height = round($male_height_total / $male_count);
    $male_avg_weight = round($male_weight_total / $male_count);
    $male_avg_age = round($male_age_total / $male_count);

    $female_avg_height = round($female_height_total / $female_count);
    $female_avg_weight = round($female_weight_total / $female_count);
    $female_avg_age = round($female_age_total / $female_count);

    // “ниже среднего”, “средний”, “выше среднего” 
    // male
    $male_below_height_count = 0;
    $male_avg_height_count = 0;
    $male_above_height_count = 0;

    $male_below_weight_count = 0;
    $male_avg_weight_count = 0;
    $male_above_weight_count = 0;

    $male_below_age_count = 0;
    $male_avg_age_count = 0;
    $male_above_age_count = 0;

    // female
    $female_below_height_count = 0;
    $female_avg_height_count = 0;
    $female_above_height_count = 0;

    $female_below_weight_count = 0;
    $female_avg_weight_count = 0;
    $female_above_weight_count = 0;

    $female_below_age_count = 0;
    $female_avg_age_count = 0;
    $female_above_age_count = 0;

    foreach ($lines as $line) {
        $fields = explode(';', $line);

        if (!isset($fields[4]) || !isset($fields[12]) || !isset($fields[13]) || !isset($fields[9])) continue;

        $gender = $fields[4];
        $height = $fields[13];
        $weight = $fields[12];
        $birth_date = explode('/', $fields[9]);
        if (!isset($birth_date[2])) continue;
        $age = date('Y') - $birth_date[2];

        if ($gender == "male") {
            if ($height < $male_avg_height) $male_below_height_count++;
            elseif ($height == $male_avg_height) $male_avg_height_count++;
            else $male_above_height_count++;
            
            if ($weight < $male_avg_weight) $male_below_weight_count++;
            elseif ($weight == $male_avg_weight) $male_avg_weight_count++;
            else $male_above_weight_count++;

            if ($age < $male_avg_age) $male_below_age_count++;
            elseif ($age == $male_avg_age) $male_avg_age_count++;
            else $male_above_age_count++;
            
        } elseif ($gender == "female") {
            if ($height < $female_avg_height) $female_below_height_count++;
            elseif ($height == $female_avg_height) $female_avg_height_count++;
            else $female_above_height_count++;
            
            if ($weight < $female_avg_weight) $female_below_weight_count++;
            elseif ($weight == $female_avg_weight) $female_avg_weight_count++;
            else $female_above_weight_count++;

            if ($age < $female_avg_age) $female_below_age_count++;
            elseif ($age == $female_avg_age) $female_avg_age_count++;
            else $female_above_age_count++;
        }
    }

    echo "Количество мужчин и женщин: " . ($male_count + $female_count) . "</br>";
    echo "Количество мужчин: " . ($male_count) . "</br>";
    echo "Количество женщин: " . ($female_count) . "</br>";

    echo "Количество общий выше среднего рост: " . ($female_above_height_count + $male_above_height_count) . "</br>";
    echo "Количество общий средний рост: " . ($female_avg_height_count + $male_avg_height_count) . "</br>";
    echo "Количество общий ниже среднего рост: " . ($female_below_height_count + $male_below_height_count) . "</br>";

    echo "Количество общий выше среднего вес: " . ($female_above_weight_count + $male_above_weight_count) . "</br>";
    echo "Количество общий средний вес: " . ($female_avg_weight_count + $male_avg_weight_count) . "</br>";
    echo "Количество общий ниже среднего вес: " . ($female_below_weight_count + $male_below_weight_count) . "</br>";

    echo "Количество общий выше среднего возраст: " . ($female_above_age_count + $male_above_age_count) . "</br>";
    echo "Количество общий средний возраст: " . ($female_avg_age_count + $male_avg_age_count) . "</br>";
    echo "Количество общий ниже среднего возраст: " . ($female_below_age_count + $male_below_age_count) . "</br>";

    echo "Общий средний рост: " . (($male_avg_height + $female_avg_height) / 2) . "</br>";
    echo "Общий средний вес: " . (($male_avg_weight + $female_avg_weight) / 2) . "</br>";
    echo "Общий средний возраст: " . (($male_avg_age + $female_avg_age) / 2) . "</br>";

    echo "Количество мужчины выше среднего рост: " . $male_above_height_count . "</br>";
    echo "Количество мужчины средний рост: " . $male_avg_height_count . "</br>";
    echo "Количество мужчины ниже среднего рост: " . $male_below_height_count . "</br>";

    echo "Количество мужчины выше среднего вес: " . $male_above_weight_count . "</br>";
    echo "Количество мужчины средний вес: " . $male_avg_weight_count . "</br>";
    echo "Количество мужчины ниже среднего вес: " . $male_below_weight_count . "</br>";

    echo "Количество мужчины выше среднего возраст: " . $male_above_age_count . "</br>";
    echo "Количество мужчины средний возраст: " . $male_avg_age_count . "</br>";
    echo "Количество мужчины ниже среднего возраст: " . $male_below_age_count . "</br>";

    echo "Мужчины средний рост: " . $male_avg_height . "</br>";
    echo "Мужчины средний вес: " . $male_avg_weight . "</br>";
    echo "Мужчины средний возраст: " . $male_avg_age . "</br>";

    echo "Количество женщины выше среднего рост: " . $female_above_height_count . "</br>";
    echo "Количество женщины средний рост: " . $female_avg_height_count . "</br>";
    echo "Количество женщины ниже среднего рост: " . $female_below_height_count . "</br>";

    echo "Количество женщины выше среднего вес: " . $female_above_weight_count . "</br>";
    echo "Количество женщины средний вес: " . $female_avg_weight_count . "</br>";
    echo "Количество женщины ниже среднего вес: " . $female_below_weight_count . "</br>";

    echo "Количество женщины выше среднего возраст: " . $female_above_age_count . "</br>";
    echo "Количество женщины средний возраст: " . $female_avg_age_count . "</br>";
    echo "Количество женщины ниже среднего возраст: " . $female_below_age_count . "</br>";

    echo "Женщины средний рост: " . $female_avg_height . "</br>";
    echo "Женщины средний вес: " . $female_avg_weight . "</br>";
    echo "Женщины средний возраст: " . $female_avg_age . "</br>";
}

function punct_b($lines) {
    $holidays = [
        '01.01' => [],
        '07.01' => [],
        '14.02' => [],
        '23.02' => [],
        '08.03' => [],
        '01.05' => [],
        '31.12' => []
    ];

    foreach ($lines as $line) {
        $fields = explode(';', $line);
        if (!isset($fields[9])) continue;
        $birth_parts = explode('/', $fields[9]);
        
        // Проверка корректности формата даты
        if (count($birth_parts) < 3) {
            continue;
        }

        $month = str_pad($birth_parts[0], 2, "0", STR_PAD_LEFT); // Месяц
        $day = str_pad($birth_parts[1], 2, "0", STR_PAD_LEFT);   // День
        $short_birth_date = "$day.$month";

        if (isset($holidays[$short_birth_date])) {
            $holidays[$short_birth_date][] = $fields[1]; // Добавляем имя человека к соответствующей дате
        }
    }

    // Вывод результатов
    foreach ($holidays as $date => $names) {
        if (count($names) > 0) {
            echo "День рождения $date: " . implode(', ', $names) . "<br/>";
        }
    }
}

function validate_4() {
    $lines = file('NEWBASE_3.TXT');

    echo "a)</br>";
    punct_a($lines);
    echo "</br>b)</br>";
    punct_b($lines);
}
?>