$(document).ready(function () {
    var dTableUser;

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "get",
        url: "get-data-users",
        dataType: "JSON",
        success: function (response) {
            inputdatauser(response.data)
        }, error: function (xhr, status, error) {
            Swal.fire("Info!", xhr.responseJSON.message, "Danger");
        },
    });

    function inputdatauser(data) {
        dTableUser = $("#tabel-user").DataTable({
            responsive: true,
            destroy: true,
            data: data,
            columns: [
                {
                    data: null,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    },
                },
                {
                    data: "name",
                },
                {
                    data: "username",
                },
                {
                    data: "email",
                },
                {
                    data: "roles",
                },
                {
                    data: "deleted_at",
                    render: function (data, type, row) {
                        var editButton =
                            '<button type="button" class="btn btn-primary" id="btn-edit"  data-toggle="tooltip" data-placement="bottom" title="Ubah User"><i class="fas fa-edit"></i></button>';
                        var actionButton = row.deleted_at
                            ? '<button type="button" class="btn btn-success" id="btn-restore"  data-toggle="tooltip" data-placement="bottom" title="Pulihkan User"><i class="fas fa-trash-restore" aria-hidden="true"></i></button>'
                            : '<button type="button" class="btn btn-danger" id="btn-delete"  data-toggle="tooltip" data-placement="bottom" title="Hapus User"><i class="fas fa-trash"></i></button>';
                        return editButton + " " + actionButton;
                    },
                },
            ],
        });
    }

    $(document).on("click", "#btn-delete", function () {
        var ids = dTableUser.row($(this).parents("tr")).data().id;

        Swal.fire({
            title: 'Are you sure?',
            text: 'You will delete The Account',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    type: "delete",
                    url: "delete-data-user",
                    data: {
                        ids: ids
                    },
                    dataType: "JSON",
                    success: function (response) {
                        Swal.fire({
                            title: "Success",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "OK",
                        }).then((value) => {
                            window.location.href = "home";
                        });
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            title: "Error",
                            text: xhr.responseJSON.message,
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                    },
                });
            }
        });
    });
});