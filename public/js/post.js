function refresh(element) {
    $(element).load(document.URL+' '+element)
}


$(document).ready(function() {

        // Delete post button
    $(document).on('click','.btn-del',function () {
        var id = $(this).data('postid');

        $.ajax({
            url: '/blog/del/'+id,
            success: function () {
                console.log('success, deleted post id = '+id);
                refresh('.posts');
            }
        });
        // Edit post button
            }).on('click','.btn-edit',function () {
                var id = $(this).data('postid');
                $("#save"+id).removeClass('hidden');
                $("#cancel"+id).removeClass('hidden');
                $("#post"+id).addClass('hidden');
                $("#form-edit"+id).removeClass('hidden');
                // Edit post cancel button
            }).on('click','.btn-cancel',function () {
                var id = $(this).data('postid');
                $("#save"+id).addClass('hidden');
                $("#cancel"+id).addClass('hidden');
                $("#post"+id).removeClass('hidden');
                $("#form-edit"+id).addClass('hidden');
                // Edit post save button
            }).on('click','.btn-save', function () {
                var id = $(this).data('postid');
                var title = $("#postTitle"+id).val();
                var body = $("#postBody"+id).val();
                $.ajax({
                    url: '/blog/edit/'+id,
                    data: {'title' : title, 'body' : body},
                    success: function () {
                        console.log('success, edited post id = '+id);
                        refresh('.posts');
                    }
                });
            });

});