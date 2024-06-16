<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['redirect_url'] = 'index.php';
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>选择人员和车辆信息</title>
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
    
    <h1>选择人员和车辆信息</h1>

    <h2>人员信息</h2>
    <div id="personsList" class="list-container">
        <!-- 数据将通过JavaScript动态加载 -->
    </div>

    <h2>
        <span>车辆信息</span>
        <button onclick="toggleVehicleList()" id="toggleVehicleButton">展开</button>
    </h2>
    <div id="vehiclesList" class="list-container hidden">
        <!-- 数据将通过JavaScript动态加载 -->
    </div>

    <label><input type="checkbox" id="includeGender"> 显示性别</label>
    <label><input type="checkbox" id="includeModel"> 显示车型</label>
    <label><input type="checkbox" id="includeColor"> 显示颜色</label>
    <br><br>
    <button onclick="generateAndCopyInfo()">生成并复制</button>
    <div id="result" class="result"></div>
    <div id="copy-success" class="copy-success hidden">复制成功</div>

    <script src="js/scripts.js"></script>
</body>
</html>
