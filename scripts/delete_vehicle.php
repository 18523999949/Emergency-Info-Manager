<?php
include '../includes/db.php';

$id = $_POST['id'];

$sql = "DELETE FROM vehicles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    echo '车辆信息删除成功';
} else {
    echo '车辆信息删除失败';
}

$stmt->close();
$conn->close();
?>
