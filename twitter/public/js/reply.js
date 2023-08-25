$(function () {
    $('.edit-btn').click(function (e) {
        e.preventDefault();

        const replyId = $(this).data('reply-id');
        const replyContent = $('#reply-content-' + replyId).text();
        $('#reply-content-' + replyId).css('display', 'none');
        $('.edit-formarea-' + replyId)
            .val(replyContent)
            .css('display', '')
            .focus();
        $('.edit-form-button-' + replyId)
            .css('display', '')
            .val('送信');
    });
});
