function showUpdateModal(id, name, url, category,relevant,username,password){
    $('#updateMonitor input[name="id"]').val(id);
    $('#updateMonitor input[name="name"]').val(name);
    $('#updateMonitor input[name="url"]').val(url);
    $('#updateMonitor input[name="category"]').val(category);
    $('#updateMonitor input[name="relevant"]').prop('checked', relevant);

    console.log("Username: " + username);
    console.log("Password: " + password);
    console.log("Relevant: " + relevant);
    // if username is not null, set the checkbox authUpdateCheckBox to checked and show the div with id "auth-update"
    if(username != null || username != null){
        $('#authUpdateCheckBox').prop('checked', true);
        $('#auth-update').show();
    }
    else {
        $('#authUpdateCheckBox').prop('checked', false);
        $('#auth-update').hide();
    }


    
    $('#updateMonitor input[name="username"]').val(username);
    $('#updateMonitor input[name="password"]').val(password);
    $('#updateMonitor').modal('show');
}