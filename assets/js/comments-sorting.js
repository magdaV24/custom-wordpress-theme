$(document).ready(function(){

    const commentsSorting = $("input[type=radio][name=comments-sort]");

    commentsSorting.change(function(e){
        e.preventDefault();
        const sortingBy = $(this).val();
        $.ajax({
            type: 'GET',
            url: themeData.ajax_url,
            data: {
                action: 'comments_sorting',
                sorting_method: sortingBy,
                post_id: themeData.post_id
            },
            success: function(response) {
                if (response) {
                    $('.comments-list').html(response);
                } else {
                    console.error('An unexpected error har  ocurred. Please try again later.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    })
})