const $table = $('#clientsTable'),
    button = $('.remove'),
    modal = $('#removeClientModal'),
    form = $('#removeClientForm');

if ($table.length) {
    button.click(function () {
        const name = $(this).closest('tr').data('name'),
            id = $(this).closest('tr').data('id');
        modal.find('s').text(name);
        form.attr('action', '/admin/clients/delete/' + id);
        form.find('#clientToRemove').val(id);
        modal.modal('show');
    })
}