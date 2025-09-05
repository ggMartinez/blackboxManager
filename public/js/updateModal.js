function showUpdateModal(id, name, url, category,relevant){
    $('#updateMonitor input[name="id"]').val(id);
    $('#updateMonitor input[name="name"]').val(name);
    $('#updateMonitor input[name="url"]').val(url);
    $('#updateMonitor input[name="category"]').val(category);
    $('#updateMonitor input[name="relevant"]').prop('checked', relevant);
    $('#updateMonitor').modal('show');
}