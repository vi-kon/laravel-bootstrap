@extends('bootstrap::modal/modal')


@section('body')
    {!!app('form')->open(['class' => 'form-horizontal', 'role' => 'form'])!!}
        @yield('form')
    {!!app('form')->close()!!}
@append

@section('append')
    <script type="text/javascript">
        (function ($, undefined) {
            'use strict';

            var modal = $('#modal');

            modal.find('.btn-submit').on('click', function () {
                var self, form;

                self = this;
                form = modal.find('form');

                $(self).button('loading');
                modal.find('.modal-footer').find('.btn:not(.btn-submit)').prop('disabled', true);

                $.post(form.attr('action'), form.serialize())
                        .done(function (data) {
                            modal.find('.modal-content').html(data);
                            modal.trigger('reload.bs.modal');
                        })
                        .fail(function (jqXHR, textStatus, errorThrown) {
                            var name, group;

                            {{-- Validation error --}}
                            if (jqXHR.status === 422 && jqXHR.hasOwnProperty('responseJSON')) {
                                form.children('.error-block').remove();

                                form.find('.form-group')
                                        .removeClass('has-error')
                                        .find('.help-block.error-block').remove();

                                for (name in jqXHR.responseJSON) {
                                    if (jqXHR.responseJSON.hasOwnProperty(name)) {
                                        if (name === 'form') {
                                            $('<div class="error-block"/>')
                                                    .append($('<div class="alert alert-danger"/>')
                                                            .html(jqXHR.responseJSON[name]))
                                                    .prependTo(form);
                                        } else {
                                            group = form.find('.form-group-field-' + name);
                                            group.addClass('has-error');
                                            $('<div class="help-block error-block"/>')
                                                    .html(jqXHR.responseJSON[name])
                                                    .appendTo(group.find('.form-group-field'));
                                        }
                                    }
                                }

                                $(self).button('reset');
                                modal.find('.modal-footer').find('.btn:not(.btn-submit)').prop('disabled', false);

                                modal.trigger('reload.bs.modal');
                            } else {
                                if (jqXHR.status === 500 && jqXHR.hasOwnProperty('responseJSON') && jqXHR.responseJSON.hasOwnProperty('error')) {
                                    modal.find('.modal-header').find('h4').html(jqXHR.responseJSON.error.type);
                                    modal.find('.modal-body').html(
                                            '<span class="text-primary">' + jqXHR.responseJSON.error.message + '</span>' +
                                            '<br/>' +
                                            '<small class="text-muted"><strong>' + jqXHR.responseJSON.error.file + '</strong> at line <strong>' + jqXHR.responseJSON.error.line + '</strong></small>');
                                } else {
                                    if (jqXHR.hasOwnProperty('responseText')) {
                                        console.log(jqXHR.responseText);
                                    }
                                    modal.find('.modal-body').html('<div class="alert alert-danger text-justify">@lang('base.modal.alert.ajax-error.content')</div>');
                                }
                                modal.find('.modal-footer').remove();
                                modal.trigger('reload.bs.modal');
                            }
                        });
            });
        })(jQuery);
    </script>
@append