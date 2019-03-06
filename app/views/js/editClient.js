const clientsTable = $('#clientsTable');


if (clientsTable.length) {
    $(document).ready(function () {


        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })

        clientsTable.on("click", "td", function () {
            const elementId = $(this).closest('tr').data('id'),
                elementText = $.trim($(this).text()),
                elementField = $(this).data('target'),
                sendButton = $('.send');
            let $textNode = $(this).contents()
                .filter(function () {
                    return this.nodeType == 3
                        && $.trim($(this).text()).length;
                }).eq(0)

            $(this).tooltip('hide');

            $textNode.replaceWith("<div class='form-row'><input class='form-control col-md-9 mr-1' type='text' value='" + elementText + "'/><button name='" + elementField + "' data-row='" + elementId + "' class='btn btn-primary send'>Ok</button></div>");

            sendButton.click(function () {
                const changedValue = $(this).siblings('input').val(),
                    field = $(this).closest('td');
                let $formNode = field.find('.form-row'),
                    data = {},
                    editRequest = $.ajax({
                        url: "/admin/clients/edit/" + elementId,
                        method: "POST",
                        data: elementField + '=' + changedValue
                    });

                editRequest.done(function () {
                    field.addClass('success');
                    console.log(data, 'updated!');
                });
                editRequest.fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });

                $formNode.replaceWith(changedValue);
            })
        });
    })
}