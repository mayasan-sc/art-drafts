$(document).ready(()=>{


    $('#post-modal').on('shown.bs.modal', function (event) {
        event.stopPropagation()

        let button = $(event.relatedTarget);
        let user = button.data('user');
        let caption = button.data('caption');
        let image = button.data('image');
        let url = button.data('url');
        let modal = $(this);
        modal.find('#user').eq(0).text(user);
        modal.find('#user').attr('href',url);
        modal.find('.card-body p').eq(0).text(caption);
        modal.find('.card-body #post-edit').attr('href',url);
        modal.find('img').attr('src',image);
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