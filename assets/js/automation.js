// Копирует выбранный текст на странице в буфер обмена
function copySelectedToClipboard() {
    const promise = navigator.clipboard.writeText(window.getSelection().toString().trim());

    promise.then(() => {
        $.notify('Copied to clipboard', {autoHideDelay: 2000, position: 'top center', className: 'info'});
    });
}

function notifySuccess(m) {
    $.notify(m, {autoHideDelay: 2000, position: 'top center', className: 'success'});
}
