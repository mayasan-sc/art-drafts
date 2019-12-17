$(document).ready(()=>{


    $('#post-modal').on('shown.bs.modal', function (event) {
        event.stopPropagation()

        let button = $(event.relatedTarget);
        let user = button.data('user');
        let user_icon = button.data('user_icon');
        let caption = button.data('caption');
        let image = button.data('image');
        let url = button.data('url');
        let modal = $(this);
        modal.find('#user').eq(0).text(user);
        modal.find('#user').attr('href',url);
        if(user_icon !== "data:image/png;base64,"){
            modal.find('#user_icon').attr('src',user_icon);
        } else {
            modal.find('#user_icon').addClass('d-none');
            modal.find('#user_icon_sub').removeClass('d-none');
        }
        modal.find('.card-body p').eq(0).text(caption);
        modal.find('.card-body #post-edit').attr('href',url);
        modal.find('#post_image').attr('src',image);
    });

    /*
    $('#post-modal').on('hidden.bs.modal', function () {
        modal.find('.card-body #user').text('');
        modal.find('.card-body p').text('');
        modal.find('form').attr('action','');
        modal.find('img').attr('src','');
    })
    */
    
});