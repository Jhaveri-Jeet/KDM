function showDeleteUpdatedPriceConfirmation(id) {
    $('#btn-yes').attr('data-id', id);
    $('#modal-delete').modal('show');
}

function deleteUpdatedPrice() {
    let id = $('#btn-yes').attr('data-id');
    if (id == null)
        return;

    window.location.href = '../updatedprice/delete.php?id=' + id;
}
