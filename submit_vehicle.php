<?php
include 'includes/db.php';

$license_plate = $_POST['license_plate'];
$model = $_POST['model'];
$color = $_POST['color'];
$driver_name = $_POST['driver_name'];
$driver_phone = $_POST['driver_phone'];

$sql = "INSERT INTO vehicles (license_plate, model, color, driver_name, driver_phone) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('准备语句失败: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param('sssss', $license_plate, $model, $color, $driver_name, $driver_phone);

if ($stmt->execute()) {
    echo '车辆信息提交成功';
} else {
    echo '车辆信息提交失败: ' . (strpos($stmt->error, 'Duplicate entry') !== false ? '重复的车牌号' : htmlspecialchars($stmt->error));
}

$stmt->close();
$conn->close();
?>
