<?php
// Извлечение уникальных регионов из файла
function get_regions() {
    $lines = file('NEWBASE_3.TXT');
    $regions = [];

    foreach ($lines as $line) {
        $fields = explode(';', $line);

        if (isset($fields[6]) && !in_array($fields[6], $regions) && !preg_match('/[^\x20-\x7E]/', $fields[6])) {
            $regions[] = $fields[6];
        }
    }

    return $regions;
}

$regions = get_regions();
?>

<form method="GET">
    <select name="region">
        <?php foreach ($regions as $region): ?>
            <option value="<?php echo $region; ?>"><?php echo $region; ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Получить</button>
</form>

<?php
function calculate_age($birthdate) {
    $birth_parts = explode('/', $birthdate);
    if (count($birth_parts) < 3) {
        return 0;
    }
    $birth_date = new DateTime($birth_parts[2] . '-' . $birth_parts[0] . '-' . $birth_parts[1]);
    $current_date = new DateTime();
    return $birth_date->diff($current_date)->y;
}

function validate_5() {
    if (!isset($_GET['region'])) {
        return;
    }

    $region = $_GET['region'];
    $lines = file('NEWBASE_3.TXT');
    $residents = [];

    foreach ($lines as $line) {
        $fields = explode(';', $line);

        if (!isset($fields[6])) continue;

        if ($fields[6] == $region) {
            $residents[] = $fields;
        }
    }

    // Сортировка по фамилии в алфавитном порядке
    usort($residents, function($a, $b) {
        return strcmp($a[3], $b[3]);
    });

    foreach ($residents as $resident) {
        $color = ($resident[4] == "male") ? "blue" : "pink";
        $age = calculate_age($resident[9]);
        $address = $resident[13] . ' ' . $resident[14];
        echo "<p style='color:$color'>$resident[1] $resident[2] $resident[3] (Возраст: $age) - $address | id: $resident[0]</p>";
    }
}
?>