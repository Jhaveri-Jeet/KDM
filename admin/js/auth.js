function login() {
    $('#btn-submit').attr('disabled', '');
    $('#btn-submit-text').hide();
    $('#btn-submit-text-saved').hide();
    $('#btn-submit-spinner').show();

    $.ajax({
        method: 'POST',
        url: 'login.php',
        data: {
            username: $('#username').val(),
            password: $('#password').val()
        },
        success: (response) => {
            if (response.status) {
                $('#btn-submit-text').hide();
                $('#btn-submit-text-saved').show();
                $('#btn-submit-spinner').hide();

                setTimeout(() => window.location.href = './', 1000);
            }
            else {
                $('#btn-submit-text').show();
                $('#btn-submit-text-saved').hide();
                $('#btn-submit-spinner').hide();

                $('#btn-submit').removeAttr('disabled');

                let error = createErrorMessage(response.message);
                $('#message').html(error);
            }
        }
    });

    return false;
}

function changePassword() {
    let oldPassword = $('#old-password').val();
    let newPassword = $('#new-password').val();
    let confirmPassword = $('#confirm-password').val();

    if (newPassword != confirmPassword) {
        $('#message').html(createErrorMessage('New passwords do not match!'));
        return false;
    }

    $('#btn-submit').attr('disabled', '');
    $('#btn-submit-text').hide();
    $('#btn-submit-text-saved').hide();
    $('#btn-submit-spinner').show();

    $.ajax({
        method: 'POST',
        url: 'change-password.php',
        data: {
            oldPassword: oldPassword,
            newPassword: newPassword
        },
        success: (response) => {
            if (response.status) {
                $('#btn-submit-text').hide();
                $('#btn-submit-text-saved').show();
                $('#btn-submit-spinner').hide();

                $('#btn-submit-text').show();
                $('#btn-submit-text-saved').hide();
                $('#btn-submit-spinner').hide();

                $('#btn-submit').removeAttr('disabled');

                let message = createSuccessMessage(response.message);
                $('#message').html(message);
            } else {
                $('#btn-submit-text').show();
                $('#btn-submit-text-saved').hide();
                $('#btn-submit-spinner').hide();

                $('#btn-submit').removeAttr('disabled');

                let error = createErrorMessage(response.message);
                $('#message').html(error);
            }
        }
    });

    return false;
}

function createErrorMessage(message) {
    let errorMessage = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' + message + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    return errorMessage;
}

function createSuccessMessage(message) {
    let successMessage = '<div class="alert alert-success alert-dismissible fade show" role="alert">' + message + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    return successMessage;
}