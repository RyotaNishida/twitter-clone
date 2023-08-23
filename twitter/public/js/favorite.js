$(function() {
    const $favorite = $('.js-like-toggle');
    $favorite.on('click', function() {
        const $this = $(this);
        const favoriteTweetId = $this.data('tweetid');
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `tweets/favorite/${favoriteTweetId}`,
                type: 'POST',
                data: {
                    'tweetId': favoriteTweetId
                }
            })
            .done(function(data) {
                $this.toggleClass('loved');
                $this.next('.favoriteCount').html(data.tweetFavoriteCount);
            })
            .fail(function(data, xhr, err) {
                console.log('エラー', xhr, err);
            });
        return false;
    });
});
