<?php
include '../includes/db.php';

$sql = "SELECT * FROM persons";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<li data-id='person-{$row['id']}'>{$row['name']}</li>";
    }
} else {
    echo "<li>没有找到人员信息</li>";
}

$conn->close();
?>
