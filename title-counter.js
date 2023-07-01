jQuery(document).ready(function ($) {
    var maxTitleLength = 55;
    var titleInput = $('#title');
    var titleCounter = $('<span>', { class: 'title-counter' }).insertAfter(titleInput);

    function updateTitleCounter() {
        var titleLength = titleInput.val().length;
        var remainingChars = maxTitleLength - titleLength;
        titleCounter.text(remainingChars);

        if (remainingChars >= 20) {
            titleCounter.removeClass('almost-done').removeClass('ended').addClass('ok');
        } else if (remainingChars > 0 && remainingChars < 20) {
            titleCounter.removeClass('ok').removeClass('ended').addClass('almost-done');
        } else {
            titleCounter.removeClass('ok').removeClass('almost-done').addClass('ended');
        }
    }

    titleInput.on('input', updateTitleCounter);
    titleInput.on('keypress', function (e) {
        if (titleInput.val().length >= maxTitleLength) {
            e.preventDefault();
        }
    });

    updateTitleCounter();
});
