<?php
include '../includes/db.php';

$manage = isset($_GET['manage']) && $_GET['manage'] == 'true';

$sql = "SELECT * FROM persons";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    if ($manage) {
        while($row = $result->fetch_assoc()) {
            echo "<tr data-id='person-{$row['id']}'>
                    <td>{$row['id']}</td>
                    <td class='name'>{$row['name']}</td>
                    <td class='phone'>{$row['phone']}</td>
                    <td class='id_number'>{$row['id_number']}</td>
                    <td class='actions'>
                        <button onclick='editPerson({$row['id']})'>修改</button>
                        <button onclick='deletePerson({$row['id']})'>删除</button>
                    </td>
                  </tr>";
        }
    } else {
        while($row = $result->fetch_assoc()) {
            echo "<li data-id='person-{$row['id']}' data-name='{$row['name']}' data-phone='{$row['phone']}' data-id_number='{$row['id_number']}'>
                    {$row['name']}
                  </li>";
        }
    }
} else {
    if ($manage) {
        echo "<tr><td colspan='5'>没有找到人员信息</td></tr>";
    } else {
        echo "<li>没有找到人员信息</li>";
    }
}

$conn->close();
?>
