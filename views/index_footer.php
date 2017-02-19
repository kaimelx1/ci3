<script type="text/javascript">

    $(function () {

        // Every moment when you come to the main page
        table_refresh();

        // When type in search input
        $('.search-box').on('input', function () {
            // set page = 1
            $('.table_page').val(1);
            table_refresh();
        });

        // If click on refresh-button
        $('.table_refresh').on('click', function () {
            table_refresh();
        });

        // If change selects
        $('#alek-page-select').change(function () {
            // set page = 1
            $('.table_page').val(1);
            table_refresh();
        });

        // If click on left-button
        $('.page_left').on('click', function () {
            var page = $('.table_page').val();
            if (page > 1) {
                page--;
                $('.table_page').val(page);
                table_refresh();
            }
        });

        // If click on right-button
        $('.page_right').on('click', function () {
            var page = $('.table_page').val();
            var per_page = $('#alek-page-select').val();
            if (page < (<?=$count?>/ per_page))
            {
                page++;
                $('.table_page').val(page);
                table_refresh();
            }
        });

        // If click on delete-button
        $('.del_btn').on('click', function () {

            // confirm window validation
            var count = $('#table_form').find('input[type=checkbox]:checked').length;

            if (count) {
                // confirmation
                if (confirm('Do you really want to delete user(-s)?')) {
                    var options = {
                        // start method
                        url: "/ci3/aleksandr_vashchenko_crud/del_request/",
                        success: function (data) {
                            // delete
                            //$('.del_checkbox:checked').parent().parent().remove();
                            table_refresh();
                        }
                    };
                    // ajax
                    $("#table_form").ajaxSubmit(options);
                }
            }

        });
    });


    //data for table view
    function table_refresh() {
        // put text until data will be downloaded
        $('#crud_table').html('loading...');
        var options = {
            // start method
            url: "/ci3/aleksandr_vashchenko_crud/table/",
            success: function (data) {
                // put data in table
                $('#crud_table').html(data);
            }
        };
        // ajax
        $("#crud_form").ajaxSubmit(options);
    }

</script>