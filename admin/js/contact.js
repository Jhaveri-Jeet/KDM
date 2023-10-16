// function createInquiry() {
//     $('#btn-submit').attr('disabled', '');

//     $('#btn-submit-text').hide();
//     $('#btn-submit-text-saved').hide();
//     $('#btn-submit-spinner').show();

//     let formData = new FormData();

//     formData.append('PersonName', $('#PersonName').val());
//     formData.append('PersonEmail', $('#PersonEmail').val());
//     formData.append('Subjects', $('#Subjects').val());
//     formData.append('message', $('#message').val());
//     $.ajax({
//         method: 'POST',
//         url: 'contact.php',
//         contentType: false,
//         processData: false,
//         data: formData,
//         success: (response) => {
//             if (response.status) {
//                 $('#btn-submit-text').hide();
//                 $('#btn-submit-text-saved').show();
//                 $('#btn-submit-spinner').hide();

//                 setTimeout(() => Window.location.href = '../admin/contact.php', 1000);
//             }
//         }
//     });

//     return false;
// }
function showDeleteInquiryConfirmation(id) {
    $('#btn-yes').attr('data-id', id);
    $('#modal-delete').modal('show');
}

function deleteInquiry() {
    let id = $('#btn-yes').attr('data-id');
    if (id == null)
        return;

    window.location.href = '../inquiries/delete.php?id=' + id;
}