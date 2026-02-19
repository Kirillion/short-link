const $form = $('#short-link-create-form');
$form.on('beforeSubmit', function (e) {
    let data = $form.serialize();

    $.ajax({
        url: $form.attr('action'),
        type: 'POST',
        data: data,
        success: function (response) {

        },
        error: function (response) {

        },
    });

    return false;
});