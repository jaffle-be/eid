(function($, app, window){

    $(document).ready(function()
    {

        var Widget = {
            getSelectedRows: function()
            {
                var rows = [];

                $("table tbody tr td:first-child .selector").each(function(i, item)
                {

                    if($(item).prop('checked') == true)
                    {
                        rows.push($(item).closest('tr'));
                    }
                });

                return rows;
            },
            deleteRows: function(rows)
            {
                var ids = $.map(rows, function(item)
                {
                    return $(item).data('application-id');
                });

                $.ajax({
                    url: '/api/application/delete',
                    type: 'POST',
                    data: {
                        ids: ids
                    },
                    dataType: 'json',
                    success: function(response)
                    {
                        if(response.status === 'oke')
                        {
                            window.location.reload();
                        }
                    }
                });

            }
        };

        $(".page-actions").on('click','a.delete', function(event)
        {
            var rows = Widget.getSelectedRows();

            if(rows.length > 0)
            {
                app.confirmation.open(function()
                {
                    Widget.deleteRows(rows);
                });
            }

            event.preventDefault();
        });
    });



})(window.jQuery, window.app, window);