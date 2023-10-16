$(function () {
    $('#summernote').summernote({
        minHeight: 300,
        tabDisable: true,
        toolbar: [
            ['style', ['style']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['para', ['ul', 'ol', 'paragraph', 'height']],
            ['fontstyle', ['fontname', 'fontsize', 'fontsizeunit']],
            ['fontstyle', ['color', 'forecolor', 'backcolor']],
            ['insert', ['picture', 'link', 'video', 'table', 'hr']],
            ['misc', ['fullscreen', 'undo', 'redo', 'help']]
        ],
        fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36', '48', '64', '82', '150']
    });

    $('#summernote').summernote('fontName', 'Calibri');
    $('#summernote').summernote('fontSize', '18');

    $('#blog-post-title').focus();
    window.scrollTo(0, 0);
});

async function showPreview() {
    $.ajax({
        method: 'POST',
        url: '../blog/preview.php',
        data: {
            blogPostTitle: $('#blog-post-title').val(),
            blogPostMarkup: $('#summernote').summernote('code'),
            blogPostThumbnail: await readFileAsDataURL($('#blog-post-thumbnail')[0].files[0] ?? null)
        },
        success: () => window.open('../blog/preview.php', '_blank')
    });
}

function createBlogPost() {
    $('#btn-preview').attr('disabled', '');
    $('#btn-submit').attr('disabled', '');

    $('#btn-submit-text').hide();
    $('#btn-submit-text-saved').hide();
    $('#btn-submit-spinner').show();

    let thumbnailFile = $('#blog-post-thumbnail')[0].files[0] ?? null;

    let formData = new FormData();
    formData.append("blogPostTitle", $('#blog-post-title').val());
    formData.append("blogPostMarkup", $('#summernote').summernote('code'));

    if (thumbnailFile != null)
        formData.append("blogPostThumbnail", thumbnailFile);

    $.ajax({
        method: 'POST',
        url: '../blog/create.php',
        contentType: false,
        processData: false,
        data: formData,
        success: (response) => {
            if (response.status) {
                $('#btn-submit-text').hide();
                $('#btn-submit-text-saved').show();
                $('#btn-submit-spinner').hide();

                setTimeout(() => window.location.href = '../blog', 1000);
            }
        }
    });

    return false;
}

function updateBlogPost(id) {
    $('#btn-preview').attr('disabled', '');
    $('#btn-submit').attr('disabled', '');

    $('#btn-submit-text').hide();
    $('#btn-submit-text-saved').hide();
    $('#btn-submit-spinner').show();

    let thumbnailFile = $('#blog-post-thumbnail')[0].files[0] ?? null;

    let formData = new FormData();
    formData.append("id", id);
    formData.append("blogPostTitle", $('#blog-post-title').val());
    formData.append("blogPostMarkup", $('#summernote').summernote('code'));
    formData.append("removeThumbnail", $('#remove-thumbnail').val());

    if (thumbnailFile != null)
        formData.append("blogPostThumbnail", thumbnailFile);

    $.ajax({
        method: 'POST',
        url: '../blog/edit.php',
        contentType: false,
        processData: false,
        data: formData,
        success: (response) => {

            if (response.status) {
                $('#btn-submit-text').hide();
                $('#btn-submit-text-saved').show();
                $('#btn-submit-spinner').hide();

                setTimeout(() => window.location.href = '../blog', 1000);
            }
        }
    });

    return false;
}

function showDeleteBlogPostConfirmation(id) {
    $('#btn-yes').attr('data-id', id);
    $('#modal-delete').modal('show');
}

function deleteBlogPost() {
    let id = $('#btn-yes').attr('data-id');
    if (id == null)
        return;

    window.location.href = '../blog/delete.php?id=' + id;
}

async function previewThumbnail() {
    let thumbnailFile = $('#blog-post-thumbnail')[0].files[0] ?? null;
    if (thumbnailFile == null)
        return;

    let image = await readFileAsDataURL(thumbnailFile);
    $('#img-thumbnail').attr('src', image);
}

function clearThumbnail(original) {
    $('#blog-post-thumbnail').val('');
    $('#img-thumbnail').attr('src', original);
}

function removeThumbnailToggled(box, original) {
    if (box.checked) {
        $('#remove-thumbnail').val('Yes');

        $('#blog-post-thumbnail').val('');
        $('#blog-post-thumbnail-group').hide();

        $('#img-thumbnail').hide();
        $('#img-thumbnail').attr('src', original);
    }
    else {
        $('#remove-thumbnail').val('No');
        $('#blog-post-thumbnail-group').show();
        $('#img-thumbnail').show();
    }
}

function readFileAsDataURL(file) {
    return new Promise((resolve, reject) => {
        let fileredr = new FileReader();
        fileredr.onload = () => resolve(fileredr.result);
        fileredr.onerror = () => reject(fileredr);
        fileredr.readAsDataURL(file);
    });
}