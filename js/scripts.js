document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('personsList')) {
        loadData('personsList', 'scripts/get_persons.php', 'item');
    }
    if (document.getElementById('vehiclesList')) {
        loadData('vehiclesList', 'scripts/get_vehicles.php', 'vehicle-item');
    }
    if (document.getElementById('personsTable')) {
        loadData('personsTable', 'scripts/get_persons.php?manage=true', 'item');
    }
    if (document.getElementById('vehiclesTable')) {
        loadData('vehiclesTable', 'scripts/get_vehicles.php?manage=true', 'vehicle-item');
    }

    document.addEventListener('click', function(event) {
        if (event.target.matches('.list-container .item, .list-container .vehicle-item')) {
            event.target.classList.toggle('selected');
        }
    });
});

function loadData(elementId, url, itemClass) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var container = document.getElementById(elementId);
            container.innerHTML = xhr.responseText;
            var items = container.querySelectorAll('li');
            items.forEach(function(item) {
                var div = document.createElement('div');
                div.className = itemClass;
                div.innerHTML = item.innerHTML;
                div.setAttribute('data-id', item.getAttribute('data-id'));
                div.setAttribute('data-name', item.getAttribute('data-name'));
                div.setAttribute('data-phone', item.getAttribute('data-phone'));
                div.setAttribute('data-id_number', item.getAttribute('data-id_number'));
                div.setAttribute('data-license_plate', item.getAttribute('data-license_plate'));
                div.setAttribute('data-model', item.getAttribute('data-model'));
                div.setAttribute('data-color', item.getAttribute('data-color'));
                div.setAttribute('data-driver_name', item.getAttribute('data-driver_name'));
                div.setAttribute('data-driver_phone', item.getAttribute('data-driver_phone'));
                container.appendChild(div);
                item.remove();
            });
        }
    };
    xhr.send();
}

function toggleVehicleList() {
    var vehiclesList = document.getElementById('vehiclesList');
    var toggleButton = document.getElementById('toggleVehicleButton');
    if (vehiclesList.classList.contains('hidden')) {
        vehiclesList.classList.remove('hidden');
        toggleButton.textContent = '折叠';
    } else {
        vehiclesList.classList.add('hidden');
        toggleButton.textContent = '展开';
    }
}

function generateAndCopyInfo() {
    var includeGender = document.getElementById('includeGender').checked;
    var includeModel = document.getElementById('includeModel').checked;
    var includeColor = document.getElementById('includeColor').checked;
    var resultDiv = document.getElementById('result');
    var selectedPersons = document.querySelectorAll('#personsList .item.selected');
    var selectedVehicles = document.querySelectorAll('#vehiclesList .vehicle-item.selected');

    var resultText = '';
    var personsText = '';
    var vehiclesText = '';

    if (selectedPersons.length > 0) {
        personsText += '————人员信息————\n';
        personsText += '以下资料共计' + selectedPersons.length + '人\n';
        personsText += '————————————\n\n';
        selectedPersons.forEach(function(person) {
            var idNumber = person.getAttribute('data-id_number');
            var gender = getGenderFromIdNumber(idNumber);
            personsText += '姓名: ' + person.getAttribute('data-name') + '\n';
            personsText += '手机号: ' + person.getAttribute('data-phone') + '\n';
            personsText += '身份证号码: ' + idNumber + '\n';
            if (includeGender) {
                personsText += '性别: ' + gender + '\n';
            }
            personsText += '\n';
        });
    }

    if (selectedVehicles.length > 0) {
        vehiclesText += '————车辆信息————\n';
        vehiclesText += '以下资料共计' + selectedVehicles.length + '辆车\n';
        vehiclesText += '————————————\n\n';
        selectedVehicles.forEach(function(vehicle) {
            vehiclesText += '车牌: ' + vehicle.getAttribute('data-license_plate') + '\n';
            if (includeModel) {
                vehiclesText += '车型: ' + vehicle.getAttribute('data-model') + '\n';
            }
            if (includeColor) {
                vehiclesText += '颜色: ' + vehicle.getAttribute('data-color') + '\n';
            }
            vehiclesText += '驾驶员姓名: ' + vehicle.getAttribute('data-driver_name') + '\n';
            vehiclesText += '驾驶员电话: ' + vehicle.getAttribute('data-driver_phone') + '\n';
            vehiclesText += '\n';
        });
    }

    resultText = personsText + vehiclesText;

    resultDiv.textContent = resultText.trim();
    copyToClipboard(resultText);

    var copySuccess = document.getElementById('copy-success');
    copySuccess.classList.remove('hidden');
    setTimeout(function() {
        copySuccess.classList.add('hidden');
    }, 1000);
}

function getGenderFromIdNumber(idNumber) {
    if (idNumber.length === 18) {
        var genderNumber = parseInt(idNumber.charAt(16));
        return (genderNumber % 2 === 0) ? '女' : '男';
    } else if (idNumber.length === 15) {
        var genderNumber = parseInt(idNumber.charAt(14));
        return (genderNumber % 2 === 0) ? '女' : '男';
    } else {
        return '未知';
    }
}

function copyToClipboard(text) {
    var textarea = document.createElement('textarea');
    textarea.value = text;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);
}

function deletePerson(id) {
    if (confirm('确定要删除这个人员吗？')) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'scripts/delete_person.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                loadData('personsTable', 'scripts/get_persons.php?manage=true', 'item');
            }
        };
        xhr.send('id=' + id);
    }
}

function deleteVehicle(id) {
    if (confirm('确定要删除这个车辆吗？')) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'scripts/delete_vehicle.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                loadData('vehiclesTable', 'scripts/get_vehicles.php?manage=true', 'vehicle-item');
            }
        };
        xhr.send('id=' + id);
    }
}

function editPerson(id) {
    var row = document.querySelector(`tr[data-id="person-${id}"]`);
    var name = row.querySelector('.name').textContent;
    var phone = row.querySelector('.phone').textContent;
    var idNumber = row.querySelector('.id_number').textContent;

    row.querySelector('.name').innerHTML = `<input type="text" value="${name}" class="edit-name">`;
    row.querySelector('.phone').innerHTML = `<input type="text" value="${phone}" class="edit-phone">`;
    row.querySelector('.id_number').innerHTML = `<input type="text" value="${idNumber}" class="edit-id_number">`;

    row.querySelector('.actions').innerHTML = `<button onclick="savePerson(${id})">保存</button>`;
}

function savePerson(id) {
    var row = document.querySelector(`tr[data-id="person-${id}"]`);
    var name = row.querySelector('.edit-name').value;
    var phone = row.querySelector('.edit-phone').value;
    var idNumber = row.querySelector('.edit-id_number').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'scripts/edit_person.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            loadData('personsTable', 'scripts/get_persons.php?manage=true', 'item');
        }
    };
    xhr.send(`id=${id}&name=${name}&phone=${phone}&id_number=${idNumber}`);
}

function editVehicle(id) {
    var row = document.querySelector(`tr[data-id="vehicle-${id}"]`);
    var licensePlate = row.querySelector('.license_plate').textContent;
    var model = row.querySelector('.model').textContent;
    var color = row.querySelector('.color').textContent;
    var driverName = row.querySelector('.driver_name').textContent;
    var driverPhone = row.querySelector('.driver_phone').textContent;

    row.querySelector('.license_plate').innerHTML = `<input type="text" value="${licensePlate}" class="edit-license_plate">`;
    row.querySelector('.model').innerHTML = `<input type="text" value="${model}" class="edit-model">`;
    row.querySelector('.color').innerHTML = `<input type="text" value="${color}" class="edit-color">`;
    row.querySelector('.driver_name').innerHTML = `<input type="text" value="${driverName}" class="edit-driver_name">`;
    row.querySelector('.driver_phone').innerHTML = `<input type="text" value="${driverPhone}" class="edit-driver_phone">`;

    row.querySelector('.actions').innerHTML = `<button onclick="saveVehicle(${id})">保存</button>`;
}

function saveVehicle(id) {
    var row = document.querySelector(`tr[data-id="vehicle-${id}"]`);
    var licensePlate = row.querySelector('.edit-license_plate').value;
    var model = row.querySelector('.edit-model').value;
    var color = row.querySelector('.edit-color').value;
    var driverName = row.querySelector('.edit-driver_name').value;
    var driverPhone = row.querySelector('.edit-driver_phone').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'scripts/edit_vehicle.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            loadData('vehiclesTable', 'scripts/get_vehicles.php?manage=true', 'vehicle-item');
        }
    };
    xhr.send(`id=${id}&license_plate=${licensePlate}&model=${model}&color=${color}&driver_name=${driverName}&driver_phone=${driverPhone}`);
}
