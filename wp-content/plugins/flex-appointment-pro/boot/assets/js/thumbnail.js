/**
 * Created by Quan on 11/18/2016.
 */
jQuery(document).ready(function ($) {
    var frame, frProduct_image = $("#frProduct_image"), attachment, fr_img_container = $("#fr_img_container"), upload_image_button = $('#upload_image_button'), delete_image_button = $("#delete_image_button");
    upload_image_button.click(function () {
        if (frame) {
            frame.open();
            return;
        } else {
            frame = wp.media({
                title: 'Select or Upload Media Of Your Chosen Persuasion',
                button: {
                    text: 'Use this media'
                },
                multiple: false  // Set to true to allow multiple files to be selected
            });
            frame.open();
        }
        frame.on('select', function () {
            attachment = frame.state().get('selection');
            attachment.map(function (attachment) {
                attachment = attachment.toJSON();
                fr_img_container.append('<li><img src="' + attachment.url + '" alt="" style="max-width:100%;"/></li>');
                var image_id = attachment.id;

                frProduct_image.val( frProduct_image.val() + ", " +  image_id.toString() );

            });
            upload_image_button.addClass('hidden');
            upload_image_button.removeClass('button-secondary');
            delete_image_button.removeClass('hidden');
            delete_image_button.addClass('button-secondary');
        });
    });
    delete_image_button.click(function () {
            frProduct_image.val("");
            fr_img_container.html('');
            upload_image_button.removeClass('hidden');
            upload_image_button.addClass('button-secondary');
            delete_image_button.addClass('hidden');
            delete_image_button.removeClass('button-secondary');
        }
    );
    // $("#fr_img_container").sortable();
    // $("#fr_img_container").disableSelection();
});
