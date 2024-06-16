<?php
include '../includes/db.php';

$manage = isset($_GET['manage']) && $_GET['manage'] == 'true';

$sql = "SELECT * FROM vehicles";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    if ($manage) {
        while($row = $result->fetch_assoc()) {
            echo "<tr data-id='vehicle-{$row['id']}'>
                    <td>{$row['id']}</td>
                    <td class='license_plate'>{$row['license_plate']}</td>
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
        while($row = $result->fetch_assoc()) {
            $license_plate = strtoupper($row['license_plate']); // 将车牌号转换为大写
            $plate_class = (strpos($license_plate, 'D') !== false) ? 'green' : 'blue'; // 判断车牌颜色
            echo "<li data-id='vehicle-{$row['id']}' data-license_plate='{$license_plate}' data-model='{$row['model']}' data-color='{$row['color']}' data-driver_name='{$row['driver_name']}' data-driver_phone='{$row['driver_phone']}'>
                    <span class='driver-name'>{$row['driver_name']}</span>
                    <span class='license-plate {$plate_class}'>{$license_plate}</span>
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
