const $form = $('#short-link-create-form');
const $copyBtn = $('#copy-short-link');
const $shortUrlP = $('#short-url');
const $qrWrapper = $('#qr-wrapper');
const $accordionShortLink = $('#accordion-short-link')
const $helpBlock =  $('.help-block');

const collapseShortLink = new bootstrap.Collapse($('#collapse-short-link'), {toggle: false})
let processingRequestFlag = false;

$helpBlock.addClass('fs-5');
$helpBlock.addClass('text-center');

$form.on('beforeSubmit', function (e) {
    if (processingRequestFlag) {
        return false;
    }

    let data = $form.serialize();

    processingRequest();

    $.ajax({
        url: $form.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function (response) {
            $shortUrlP.html(response.data.short_url);
            $copyBtn.prop('disabled', false);

            updateQrCode(response.data.short_url);
            $accordionShortLink.removeClass('d-none');

            collapseShortLink.show();

            endProcessingRequest();
        },
        error: function (xhr) {
            $helpBlock.html(xhr.responseJSON.error)
            endProcessingRequest();
        },
    });

    return false;
});

$copyBtn.on('click', function () {
    try {
        // Работает только с HTTPS или на localhost
        navigator.clipboard.writeText($shortUrlP.text());
    } catch (e) {
        // Устаревший метод, но пока поддерживается
        let range = document.createRange();
        range.selectNodeContents($shortUrlP[0]);

        let selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(range);

        document.execCommand('copy');
    }

});

function processingRequest() {
    processingRequestFlag = true;

    $form.find('[name="CreateForm[url]"]').prop('disabled', true);
    $form.find('[type="submit"]').prop('disabled', true);

    collapseShortLink.hide();
    $accordionShortLink.addClass('d-none');

    $shortUrlP.html('');
    $qrWrapper.html('');
    $copyBtn.prop('disabled', true);
}

function endProcessingRequest() {
    processingRequestFlag = false;

    $form.find('[name="CreateForm[url]"]').prop('disabled', false);
    $form.find('[type="submit"]').prop('disabled', false);
}

function updateQrCode(url) {
    let qrcode = new QRCode($qrWrapper[0], {
        text: url,
        width: 200,
        height: 200,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction level
    });
}