function addModal(id, route, title = 'Add', form_id, table_id, table_type = false) {
    $('#' + id).on('click', function () {
        $.ajax({
            url: route,
            method: 'get',
            success: function (data) {
                $('#modal-body').html(data);
                $('#modal-title').text(title);
                $('#modal').modal('show');

                $('#' + form_id).submit(function (e) {
                    $(".span_error").each(function () {
                        $(this).remove()
                    });
                    $('#error').remove()
                    e.preventDefault();
                    $("#btn-submit").prop("disabled", false)
                    var form = $(this);
                    var url = form.attr('action');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: new FormData(this),
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            if (data.status === 422) {
                                $("#btn-submit").prop("disabled", false)
                                $.each(data.errors, function (index, value) {
                                    var error = '<span class="text-danger span_error"> ' + value + '</span>'
                                    if (index.split('.').length > 1) {
                                        $('#error').last().append(error)
                                    } else {
                                        $('[name="' + index + '"]').parent().last().append(error)
                                    }
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops,there were an errors...',
                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                if (table_type)
                                    table_id.ajax.reload();
                                else
                                    window.LaravelDataTables[table_id].ajax.reload();
                                $('#modal').modal('hide');
                                $('#modal-body').empty()
                            }
                        }
                    });

                });
            }
        });
    });
}

function editModal(editClass, route, title = 'Edit', form_id, table_id) {
    $(document).on('click', '.' + editClass, function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '/' + route + '/' + id + '/edit',
            method: 'get',
            success: function (data) {
                $('#modal-body').html(data);
                $('#modal-title').text(title);
                $('#modal').modal('show');

                $('#' + form_id).submit(function (e) {
                    $(".span_error").each(function () {
                        $(this).remove()
                    });
                    e.preventDefault();
                    $("#btn-submit").prop("disabled", false)
                    var form = $(this);
                    var url = form.attr('action');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: new FormData(this),
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            if (data.status === 422) {
                                $("#btn-submit").prop("disabled", false)
                                $.each(data.errors, function (index, value) {
                                    console.log(index)
                                    var error = '<span class="text-danger span_error"> ' + value + '</span>'
                                    $('[name="' + index + '"]').parent().last().append(error)
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops,there were an errors...',
                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                window.LaravelDataTables[table_id].ajax.reload();
                                $('#modal').modal('hide');
                                $('#modal-body').empty()
                            }
                        }
                    });

                });
            }
        });
    });
}

function remove(removeClass, url, table_id, csrf_token, table_type = false) {
    $(document).on('click', '.' + removeClass, function () {
        var id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    url: '/' + url + '/' + id,
                    method: 'delete',
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Your item has been removed',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        if (table_type)
                            table_id.ajax.reload();
                        else
                            window.LaravelDataTables[table_id].ajax.reload();
                    }
                });
            }
        });

    });
}

$('#btn_model_close').on('click', function () {
    $('#modal-body').empty()
});