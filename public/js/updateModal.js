function showUpdateModal(id, name, url, category){
    $('#updateMonitor input[name="id"]').val(id);
    $('#updateMonitor input[name="name"]').val(name);
    $('#updateMonitor input[name="url"]').val(url);
    $('#updateMonitor input[name="category"]').val(category);
    $('#updateMonitor').modal('show');
}