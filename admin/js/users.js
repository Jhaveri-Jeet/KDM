function createUser() {
    $('#btn-submit').attr('disabled', '');

    $('#btn-submit-text').hide();
    $('#btn-submit-text-saved').hide();
    $('#btn-submit-spinner').show();

    $.ajax(
        {
            method: 'POST',
            url: '../Users/create.php',
            data: { 
                userName: $('#user-name').val(), 
                userPassword: $('#user-password').val(),
            },
            success: (response) => {
                if (response.status) {
                    $('#btn-submit-text').hide();
                    $('#btn-submit-text-saved').show();
                    $('#btn-submit-spinner').hide();

                    setTimeout(() => window.location.href = '../Users', 1000);
                }
            }
        });

    return false;
}

function editUser(id) {
    $('#btn-submit').attr('disabled', '');

    $('#btn-submit-text').hide();
    $('#btn-submit-text-saved').hide();
    $('#btn-submit-spinner').show();

    $.ajax(
        {
            method: 'POST',
            url: '../Users/edit.php',
            data: { 
                id: id, 
                userName: $('#user-name').val(), 
                userPassword: $('#user-password').val(),
            },
            success: (response) => {

                if (response.status) {
                    $('#btn-submit-text').hide();
                    $('#btn-submit-text-saved').show();
                    $('#btn-submit-spinner').hide();

                    setTimeout(() => window.location.href = '../Users', 1000);
                }
            }
        });

    return false;
}

function showDeleteUserConfirmation(id) {
    $('#btn-yes').attr('data-id', id);
    $('#modal-delete').modal('show');
}

function deleteUser() {
    let id = $('#btn-yes').attr('data-id');
    if (id == null)
        return;

    window.location.href = '../Users/delete.php?id=' + id;
}