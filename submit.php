<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>提交信息</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js"></script>
    <style>
        .tab {
            display: none;
        }

        .tab.active {
            display: block;
        }

        .tab-buttons {
            margin-bottom: 10px;
        }

        .tab-buttons button {
            padding: 10px 20px;
            margin-right: 5px;
            cursor: pointer;
        }

        .tab-buttons button.active {
            background-color: #007BFF;
            color: white;
            border: none;
        }
    </style>
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
    
    <h1>提交信息</h1>

    <div class="tab-buttons">
        <button id="personTabButton" class="active" onclick="showTab('person')">提交人员信息</button>
        <button id="vehicleTabButton" onclick="showTab('vehicle')">提交车辆信息</button>
    </div>

    <div id="personTab" class="tab active">
        <h2>提交人员信息</h2>
        <form action="submit_person.php" method="POST" onsubmit="return validatePersonForm()">
            <label for="name">姓名:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="phone">电话:</label>
            <input type="text" id="phone" name="phone" required><br><br>
            <label for="id_number">身份证号码:</label>
            <input type="text" id="id_number" name="id_number" required><br><br>
            <input type="submit" value="提交">
        </form>
    </div>

    <div id="vehicleTab" class="tab">
        <h2>提交车辆信息</h2>
        <form action="submit_vehicle.php" method="POST" onsubmit="return validateVehicleForm()">
            <label for="license_plate">车牌号:</label>
            <input type="text" id="license_plate" name="license_plate" required><br><br>
            <label for="model">车型:</label>
            <input type="text" id="model" name="model" required><br><br>
            <label for="color">颜色:</label>
            <input type="text" id="color" name="color" required><br><br>
            <label for="driver_name">驾驶员姓名:</label>
            <input type="text" id="driver_name" name="driver_name" required><br><br>
            <label for="driver_phone">驾驶员电话:</label>
            <input type="text" id="driver_phone" name="driver_phone" required><br><br>
            <input type="submit" value="提交">
        </form>
    </div>

    <script>
        function showTab(tabName) {
            var personTab = document.getElementById('personTab');
            var vehicleTab = document.getElementById('vehicleTab');
            var personTabButton = document.getElementById('personTabButton');
            var vehicleTabButton = document.getElementById('vehicleTabButton');

            if (tabName === 'person') {
                personTab.classList.add('active');
                vehicleTab.classList.remove('active');
                personTabButton.classList.add('active');
                vehicleTabButton.classList.remove('active');
            } else {
                personTab.classList.remove('active');
                vehicleTab.classList.add('active');
                personTabButton.classList.remove('active');
                vehicleTabButton.classList.add('active');
            }
        }

        function validatePersonForm() {
            // 添加必要的表单验证逻辑
            return true;
        }

        function validateVehicleForm() {
            // 添加必要的表单验证逻辑
            return true;
        }
    </script>
</body>
</html>
