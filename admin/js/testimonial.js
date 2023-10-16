function createTestimonial() {
    $('#btn-submit').attr('disabled', '');

    $('#btn-submit-text').hide();
    $('#btn-submit-text-saved').hide();
    $('#btn-submit-spinner').show();

    let formData = new FormData();
    formData.append('name', $('#testimonial-name').val());
    formData.append('description', $('#testimonial-description').val());
    formData.append('image', $('#testimonial-image')[0].files[0]);

    $.ajax({
        method: 'POST',
        url: '../testimonial/create.php',
        contentType: false,
        processData: false,
        data: formData,
        success: (response) => {
            if (response.status) {
                $('#btn-submit-text').hide();
                $('#btn-submit-text-saved').show();
                $('#btn-submit-spinner').hide();

                setTimeout(() => window.location.href = '../testimonial', 1000);
            }
        }
    });

    return false;
}

function editTestimonial(id) {
    $('#btn-submit').attr('disabled', '');

    $('#btn-submit-text').hide();
    $('#btn-submit-text-saved').hide();
    $('#btn-submit-spinner').show();

    let formData = new FormData();
    formData.append('id', id);
    formData.append('name', $('#testimonial-name').val());
    formData.append('description', $('#testimonial-description').val());

    if ($('#testimonial-image')[0].files.length > 0)
        formData.append('image', $('#testimonial-image')[0].files[0]);

    $.ajax({
        method: 'POST',
        url: '../testimonial/edit.php',
        contentType: false,
        processData: false,
        data: formData,
        success: (response) => {
            if (response.status) {
                $('#btn-submit-text').hide();
                $('#btn-submit-text-saved').show();
                $('#btn-submit-spinner').hide();

                setTimeout(() => window.location.href = '../testimonial', 1000);
            }
        }
    });

    return false;
}

function showDeleteTestimonialConfirmation(id) {
    $('#btn-yes').attr('data-id', id);
    $('#modal-delete').modal('show');
}

function deleteProduct() {
    let id = $('#btn-yes').attr('data-id');
    if (id == null)
        return;

    window.location.href = '../testimonial/delete.php?id=' + id;
}

function testimonialImageSelected() {

    let files = $('#testimonial-image')[0].files;
    let html = '';

    for (let i = 0; i < files.length; i++) {
        let image = URL.createObjectURL(files[i]);
        html += `<img src="${image}" class="img-product" />`;
    }

    $('.custom-file-label').text(`${files.length} files selected.`);
    $('#img-preview-list').html(html);
}

function clearTestimonialImage(defaultImage = '') {
    $('#testimonial-image').val('');
    $('.custom-file-label').text(`Select images...`);
    $('#img-preview-list').html(`<img src="${defaultImage}" class="img-preview" />`);
}