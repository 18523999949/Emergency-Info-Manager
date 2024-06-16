<?php
include '../includes/db.php';

$manage = isset($_GET['manage']) && $_GET['manage'] == 'true';

$sql = "SELECT * FROM vehicles";
$result = $conn->query($sql);

function format_license_plate($plate) {
    return mb_substr($plate, 0, 2) . '·' . mb_substr($plate, 2);
}

function determine_plate_color($plate) {
    $clean_plate = str_replace('·', '', strtoupper($plate));
    error_log("清洗后的车牌: {$clean_plate}");

    // 小型新能源汽车车牌的正则表达式：第一位必须是D或F，第二位可以是字母或数字，后四位必须是数字
    $small_new_energy_pattern = '/^[DF][A-Z0-9][0-9]{4}$/';
    // 大型新能源汽车车牌的正则表达式：前五位必须是数字，第六位必须是D或F
    $large_new_energy_pattern = '/^[0-9]{5}[DF]$/';

    if (preg_match($small_new_energy_pattern, substr($clean_plate, 1)) || 
        preg_match($large_new_energy_pattern, substr($clean_plate, 1))) {
        $color = 'green';
    } else {
        $color = 'blue';
    }

    error_log("车牌颜色确定 {$plate}（清洗：{$clean_plate}）：{$color}");
    return $color;
}

if ($result->num_rows > 0) {
    if ($manage) {
        while ($row = $result->fetch_assoc()) {
            $formatted_plate = format_license_plate($row['license_plate']);
            $plate_class = determine_plate_color($formatted_plate);
            echo "<tr data-id='vehicle-{$row['id']}'>
                    <td>{$row['id']}</td>
                    <td class='license_plate {$plate_class}'>{$formatted_plate}</td>
                    <td class='model'>{$row['model']}</td>
                    <td class='color'>{$row['color']}</td>
                    <td class='driver_name'>{$row['driver_name']}</td>
                    <td class='driver_phone'>{$row['driver_phone']}</td>
                    <td class='actions'>
                        <button onclick='editVehicle({$row['id']})'>修改</button>
                        <button onclick='deleteVehicle({$row['id']})'>删除</button>
                    </td>
                  </tr>";
        }
    } else {
        while ($row = $result->fetch_assoc()) {
            $formatted_plate = format_license_plate($row['license_plate']);
            $plate_class = determine_plate_color($formatted_plate);
            echo "<li data-id='vehicle-{$row['id']}' data-license_plate='{$formatted_plate}' data-model='{$row['model']}' data-color='{$row['color']}' data-driver_name='{$row['driver_name']}' data-driver_phone='{$row['driver_phone']}'>
                    <span class='driver-name'>{$row['driver_name']}</span>
                    <span class='license-plate {$plate_class}'>{$formatted_plate}</span>
                  </li>";
        }
    }
} else {
    if ($manage) {
        echo "<tr><td colspan='7'>没有找到车辆信息</td></tr>";
    } else {
        echo "<li>没有找到车辆信息</li>";
    }
}

$conn->close();
?>
