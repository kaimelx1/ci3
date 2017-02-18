<script type="text/javascript">

    $(function () {

        // If click on add button
        $('.edit_send').on('click', function () {
            // confirmation
            if (confirm('Do you really want to edit information?')) {
                var options = {
                    // start edit_request method
                    url: "/ci3/aleksandr_vashchenko_crud/edit_request/<?=intval($row['id'])?>",
                    success: function (data) {
                        // put info to the div
                        $('.ajax_message').html(data);
                    }
                };
                // ajax
                $("#crud_edit").ajaxSubmit(options);
            }

            // Fade message
            setTimeout(function () {
                $('span.echo-message').fadeOut('slow');
            }, 10000);
        });
    });

</script>