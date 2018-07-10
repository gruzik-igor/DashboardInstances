let is_loading = false;

$(function () {
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() == $(document).height()) {
            if (is_loading == false) {
                is_loading = true;
                var infiniteScrollBody = $('#infiniteScrollBody');

                var currentLimit = infiniteScrollBody.attr('data-current-limit');

                //ajaxSpinnerShow($('#loader'));

                var url = infiniteScrollBody.attr('data-url');
                var method = infiniteScrollBody.attr('data-method');
                $.ajax({
                    url: url + '?_limit=' + (currentLimit + 1),
                    type: method,
                    success: function (data, status, reqeust) {
                        infiniteScrollBody.attr('data-current-limit', (currentLimit + 1));

                        infiniteScrollBody.append(data);


                        is_loading = false;
                    }
                });
            }
        }
    });
});