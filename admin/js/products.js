function createProduct() {
    $('#btn-submit').attr('disabled', '');

    $('#btn-submit-text').hide();
    $('#btn-submit-text-saved').hide();
    $('#btn-submit-spinner').show();

    let formData = new FormData();
    formData.append('category-id', $('#category').val());
    formData.append('product-name', $('#product-name').val());
    formData.append('product-description', $('#product-description').val());

    let files = $('#images')[0].files;
    for (let i = 0; i < files.length; i++) {
        formData.append('images[]', files[i]);
    }

    $.ajax(
        {
            method: 'POST',
            url: '../Products/create.php',
            contentType: false,
            processData: false,
            data: formData,
            success: (response) => {
                if (response.status) {
                    $('#btn-submit-text').hide();
                    $('#btn-submit-text-saved').show();
                    $('#btn-submit-spinner').hide();

                    setTimeout(() => window.location.href = '../Products', 1000);
                }
            }
        });

    return false;
}

function editProduct(id) {
    $('#btn-submit').attr('disabled', '');

    $('#btn-submit-text').hide();
    $('#btn-submit-text-saved').hide();
    $('#btn-submit-spinner').show();

    let formData = new FormData();
    formData.append('id', id);
    formData.append('category-id', $('#category').val());
    formData.append('product-name', $('#product-name').val());
    formData.append('product-description', $('#product-description').val());

    let files = $('#images')[0].files;
    for (let i = 0; i < files.length; i++) {
        formData.append('images[]', files[i]);
    }

    $.ajax(
        {
            method: 'POST',
            url: '../Products/edit.php',
            contentType: false,
            processData: false,
            data: formData,
            success: (response) => {
                if (response.status) {
                    $('#btn-submit-text').hide();
                    $('#btn-submit-text-saved').show();
                    $('#btn-submit-spinner').hide();

                    setTimeout(() => window.location.href = '../Products', 1000);
                }
            }
        });

    return false;
}

function showDeleteProductConfirmation(id) {
    $('#btn-yes').attr('data-id', id);
    $('#modal-delete').modal('show');
}

function deleteProduct() {
    let id = $('#btn-yes').attr('data-id');
    if (id == null)
        return;

    window.location.href = '../Products/delete.php?id=' + id;
}

function productImagesSelected() {
    
    let files = $('#images')[0].files;
    let html = '';

    for (let i = 0; i < files.length; i++) {
        let image = URL.createObjectURL(files[i]);
        html += `<img src="${image}" class="img-preview" />`;
    }
    
    $('.custom-file-label').text(`${files.length} files selected.`);
    $('#img-preview-list').html(html);
}

function clearProductImages() {
    $('#images').val('');
    $('.custom-file-label').text(`Select images...`);
    $('#img-preview-list').html('');
}

function deleteProductImage(id) {
    $('#delete-' + id).css('display', 'none');
    $('#delete-spinner-' + id).css('display', 'unset');
    $('#img-preview-' + id).addClass('deleting');

    $.ajax({
        url: '../Products/delete-image.php?id=' + id,
        success: function(response) {
            if (response.status) {
                $('#img-wrap-' + id).remove();
            }
        }   
    });
}