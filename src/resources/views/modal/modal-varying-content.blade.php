@extends('vi-kon.bootstrap::modal.modal')

@section('append')
    @parent
    <script type="text/javascript">
        (function ($, undefined) {
            'use strict';

            var id = '#{{ $id }}';

            $(id).on('show.bs.modal', function (e) {
                var button, data, modal, html;

                button = $(e.relatedTarget);
                data   = button.data();
                modal  = $(this);
                html   = $(data['template']).html();

                $.each(data, function (key, value) {
                    html = html.replace('@{{' + key + '}}', value);
                });

                modal.find('.modal-dialog').find('.modal-content').html(html);
            });
        }(jQuery));
    </script>
@overwrite