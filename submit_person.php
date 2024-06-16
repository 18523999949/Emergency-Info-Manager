<?php
include 'includes/db.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$id_number = $_POST['id_number'];

$sql = "INSERT INTO persons (name, phone, id_number) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('准备语句失败: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param('sss', $name, $phone, $id_number);

if ($stmt->execute()) {
    echo '人员信息提交成功';
} else {
    echo '人员信息提交失败: ' . htmlspecialchars($stmt->error);
}

$stmt->close();
$conn->close();
?>
