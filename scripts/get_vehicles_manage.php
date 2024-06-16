<?php
include '../includes/db.php';

$sql = "SELECT * FROM vehicles";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<li data-id='vehicle-{$row['id']}'>驾驶员: {$row['driver_name']} - 车牌号: {$row['license_plate']}</li>";
    }
} else {
    echo "<li>没有找到车辆信息</li>";
}

$conn->close();
?>
