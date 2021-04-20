jQuery(document).ready(function($) {    
    var page_template = $('#page_template').val();
    show_meta_boxes (page_template);

    $('#page_template').change(function(){
        var page_template = $(this).val();
        show_meta_boxes(page_template);
    });

    $("span.photo_upload_button").on("click", function(add){
        add.preventDefault();
        var imageUploader = wp.media({
            // 'title'     : 'Upload Image',
            // 'button'    : {
            //     'text'  : 'Set the image'
            // },
            'multiple'  : false
        });
        imageUploader.open();
        var button = $(this);
        imageUploader.on("select", function(){
            var image = imageUploader.state().get("selection").first().toJSON();
            var image_link = image.url;
            var thum_link = image.url;
            if (image.height > 150 || image.width > 150) { thum_link = image.sizes.thumbnail.url; }
            //console.log(image);
            //button.siblings('input.photo_url').val(image_link);
            //button..before('<div class="screenshot-photo"><a class="of-uploaded-photo" href="'+ image_link +'" target="_blank"><img class="redux-option-photo" src="'+ thum_link +'"></a></div>');;

            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo').val(image_link);
            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo-id').val(image.id);
            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo-height').val(image.height);
            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo-width').val(image.width);
            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo-thumbnail').val(thum_link);
            button.siblings('div.screenshot-photo').removeClass('hide');
            button.siblings('span.remove-photo').removeClass('hide');
            button.siblings('div.screenshot-photo').find('.of-uploaded-photo').attr("href",image_link);
            button.siblings('div.screenshot-photo').find('img').attr('src', thum_link);
        })
    });
    $("span.remove-photo").on("click", function(del){
        del.preventDefault();
        $(this).addClass('hide');

        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo').val('');
        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo-id').val('');
        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo-height').val('');
        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo-width').val('');
        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo-thumbnail').val('');

        $(this).siblings('div.screenshot-photo').addClass('hide');
        $(this).siblings('div.screenshot-photo').find('.of-uploaded-photo').attr("href",'');
        $(this).siblings('div.screenshot-photo').find('img').attr('src', '');

    });

    function show_meta_boxes(page_template) {
        if(page_template == 'page-template/lightbox-page.php') {
            $('#_clippingpath_gallery_details').show();
        } else {
           $('#_clippingpath_gallery_details').hide(); 
        }
        if(page_template == 'page-template/gallery-page.php') {
            $('#_clippingpath_link_gallery_details').show();
        } else {
           $('#_clippingpath_link_gallery_details').hide();
        }
    }

}); 
