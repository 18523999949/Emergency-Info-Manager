<?php
include '../includes/db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$id_number = $_POST['id_number'];

$sql = "UPDATE persons SET name = ?, phone = ?, id_number = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssi', $name, $phone, $id_number, $id);

if ($stmt->execute()) {
    echo '人员信息更新成功';
} else {
    echo '人员信息更新失败';
}

$stmt->close();
$conn->close();
?>
