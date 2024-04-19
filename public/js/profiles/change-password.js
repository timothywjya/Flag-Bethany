$(document).ready(function () {
    $("#change-password").click(function (event) {
        var current = $("#current_password").val();
        var password = $("#password").val();
        var confirm = $("#password_confirmation").val();

        var lowercaseRegex = /[a-z]/;
        var uppercaseRegex = /[A-Z]/;
        var numberRegex = /[0-9]/;
        var symbolRegex = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/;

        if (password.length < 8) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Password harus memiliki panjang minimal 8 karakter.",
            });
            return false;
        }

        if (!lowercaseRegex.test(password)) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Password harus mengandung setidaknya satu huruf kecil.",
            });
            return false;
        }

        if (!numberRegex.test(password)) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Password harus mengandung setidaknya satu huruf besar.",
            });
            return false;
        }

        if (!uppercaseRegex.test(password)) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Password harus mengandung setidaknya satu huruf besar.",
            });
            return false;
        }

        if (!symbolRegex.test(password)) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Password harus mengandung setidaknya satu simbol.",
            });
            return false;
        }

        if (confirm != password) {
            Swal.fire({
                title: "Check Again!",
                text: "Konfirmasi Kata Sandi Anda Salah",
                icon: "error",
                confirmButtonText: "OK",
            })
            return false;
        }

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "change-password",
            data: {
                current_password: current,
                password: password
            },
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
    });
});