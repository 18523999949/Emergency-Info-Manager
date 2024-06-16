<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['redirect_url'] = 'manage.php';
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理人员和车辆信息</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">首页</a></li>
            <li><a href="submit.php">提交信息</a></li>
            <li><a href="manage.php">管理信息</a></li>
            <li><a href="logout.php">登出</a></li>
        </ul>
    </nav>
    
    <h1>管理人员和车辆信息</h1>

    <h2>人员信息</h2>
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>电话</th>
                <th>身份证号码</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody id="personsTable">
            <!-- 数据将通过JavaScript动态加载 -->
        </tbody>
    </table>

    <h2>车辆信息</h2>
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>车牌号</th>
                <th>车型</th>
                <th>颜色</th>
                <th>驾驶员姓名</th>
                <th>驾驶员电话</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody id="vehiclesTable">
            <!-- 数据将通过JavaScript动态加载 -->
        </tbody>
    </table>

    <script src="js/scripts.js"></script>
</body>
</html>
