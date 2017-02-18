<script type="text/javascript">

    $(function () {

        // If click on add-button
        $('.add_send').on('click', function () {
            var options = {
                // start add_request method
                url: "/ci3/aleksandr_vashchenko_crud/add_request/",
                success: function (data) {
                    // put info to the div
                    $('.ajax_message').html(data);
                }
            };
            // ajax
            $("#crud_add").ajaxSubmit(options);

            // Fade message
            setTimeout(function () {
                $('span.echo-message').fadeOut('slow');
            }, 10000);
        });
    });

</script>