
# sf.hwzb.tv

## 项目描述
本项目用于管理人员和车辆信息，包含登录、登出、管理、提交和获取信息的功能。

## 目录结构
```
sf.hwzb.tv/
│
├── .user.ini (PHP配置文件)
├── css/ (样式表)
│   └── styles.css
├── includes/ (数据库配置)
│   └── db.php
├── js/ (JavaScript文件)
│   └── scripts.js
├── scripts/ (功能脚本)
│   ├── delete_person.php (删除人员信息)
│   ├── delete_vehicle.php (删除车辆信息)
│   ├── edit_person.php (编辑人员信息)
│   ├── edit_vehicle.php (编辑车辆信息)
│   ├── get_persons.php (获取人员信息)
│   ├── get_persons_manage.php (获取管理人员信息)
│   ├── get_vehicles.php (获取车辆信息)
│   ├── get_vehicles_manage.php (获取管理车辆信息)
├── submit.php (提交页面主文件)
├── submit_person.php (提交人员信息)
├── submit_vehicle.php (提交车辆信息)
├── index.php (首页)
├── login.php (登录页面)
├── logout.php (登出页面)
├── manage.php (管理页面)
```

## 使用说明
1. **配置数据库**：编辑 `includes/db.php` 文件，填入数据库连接信息。
2. **部署代码**：将代码上传至服务器，确保服务器支持PHP和MySQL。
3. **导入数据库结构**：在MySQL数据库中导入项目所需的数据库结构。
4. **访问项目**：通过浏览器访问 `index.php` 以使用项目功能。

## 删除冗余文件
在项目根目录中，有两个文件 `test` 和 `tets.php` 是冗余文件，可以在部署前删除。

```bash
rm sf.hwzb.tv/test
rm sf.hwzb.tv/tets.php
```

## 贡献指南
欢迎对本项目进行贡献，您可以通过以下步骤提交Pull Request：
1. Fork本项目。
2. 创建新的分支 (`git checkout -b feature/your-feature`)。
3. 提交您的修改 (`git commit -am 'Add new feature'`)。
4. 推送到分支 (`git push origin feature/your-feature`)。
5. 创建Pull Request。

## 许可
本项目采用MIT许可，详情请参考LICENSE文件。
