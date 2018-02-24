        $(document).ready(function () {
            $('#filter-btn').click(function ()
            {
                 alert('dfghjk');
               // if (userinput_is_valid()) {
                //     submit_form();
                // }
            });

        });

        function submit_form() {
            $.ajax({
                url: '/Score/Analysis', // the URL for the request
                data: $('#myform').serialize(),// the data to send // (will be converted to a query string)
                type: 'POST',// whether this is a POST or GET request
                cache: false,
                dataType: 'HTML',//'JSON',// the type of data we expect back

                success: function (data) {
                    $('#feedback').html(data);
                    //$.unblockUI();
                },

                error: function (xhr, status)// code to run if the request fails;
                {
                    alert('Sorry, there was a problem!');
                },

                complete: function (xhr, status) // code to run regardless of success or failure
                {
                    //alert('The request is complete!');
                }
            });
        }