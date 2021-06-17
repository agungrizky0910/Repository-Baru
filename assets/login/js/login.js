var $ = jQuery.noConflict();

$(function() {
    var loginPage = $("#login-page");

    loginPage.find("form").submit(function(e) {
        // Preventing form submissions. If you implement
        // a backend, you might want to remove this code
        e.preventDefault();
        $.ajax({
            url: rootWebService + "login",
            type: "POST",
            cache: false,
            async: false,
            data: $("#login-form").serialize(),
            success: function(response) {
                var msg = response.msg;

                if (msg === "OK") {
                    window.location = page;
                } else if (msg === "BAN") {
                    Notiflix.Report.Failure(
                        "Akun Dinonaktifkan !",
                        "Akun anda telah dinonaktifkan oleh karena melakukan pelanggaran, silahkan hubungi kami untuk mengaktifkannya kembali <br><br>- Administrator",
                        "Tutup"
                    );
                } else if (msg === "OFF") {
                    Notiflix.Report.Warning(
                        "Akun Belum Aktif !",
                        "Anda belum melakukan <b>AKTIVASI EMAIL</b>. Segera untuk melakukan aktivasi untuk mengkatifkan akun anda <br><br>- Administrator",
                        "Tutup"
                    );
                } else if (msg === "PASS_SALAH") {
                    Notiflix.Notify.Failure("Password Salah !");
                } else if (msg === "USERNAME_SALAH") {
                    Notiflix.Notify.Failure("Username tidak dikenal !");
                } else if (msg === "KOSONG") {
                    Notiflix.Notify.Warning("Data tidak boleh kosong !");
                } else if (msg === "SHORT_NAME") {
                    Notiflix.Notify.Warning(
                        "Nama minimal 3 huruf dan maksimal 30 huruf !"
                    );
                } else if (msg === "INVALID_NAME") {
                    Notiflix.Notify.Warning(
                        "Nama tidak boleh menggunakan karakter ilegal !"
                    );
                } else if (msg === "INVALID_NIM") {
                    Notiflix.Notify.Warning("NIM tidak benar !");
                } else if (msg === "NO_UNIQ_NIM") {
                    Notiflix.Notify.Failure("NIM sudah digunakan !");
                } else if (msg === "INVALID_EMAIL") {
                    Notiflix.Notify.Warning("Email tidak benar !");
                } else if (msg === "NO_UNIQ_EMAIL") {
                    Notiflix.Notify.Failure("Email sudah digunakan !");
                } else if (msg === "SHORT_USERNAME") {
                    Notiflix.Notify.Warning("Username minimal 5 huruf !");
                } else if (msg === "INVALID_USERNAME") {
                    Notiflix.Notify.Warning(
                        "Username tidak boleh menggunakan karakter ilegal !"
                    );
                } else if (msg === "NO_UNIQ_USERNAME") {
                    Notiflix.Notify.Failure("Username sudah digunakan !");
                } else if (msg === "SHORT_PASS") {
                    Notiflix.Notify.Warning(
                        "Password minimal 6 huruf dan maksimal 30 huruf !"
                    );
                } else if (msg === "FAIL_SEND_EMAIL") {
                    Notiflix.Report.Warning(
                        "Terjadi Kesalahan !",
                        "Terjadi kesalahan, coba beberapa saat lagi <br><br> - System",
                        "Tutup"
                    );
                } else if (msg === "SUCCESS_REG") {
                    Notiflix.Report.Success(
                        "Registrasi Berhasil",
                        '"Pendaftaran akun telah berhasil, segera lakukan aktivasi melalu kode yang sudah kami kirim ke email anda." <br><br>- System',
                        "Tutup"
                    );
                    $("form :input").val("");
                } else if (msg === "FAIL_REG") {
                    Notiflix.Report.Warning(
                        "Gagal Mendaftar Akun!",
                        "Terjadi kesalahan, coba beberapa saat lagi <br><br> - System",
                        "Tutup"
                    );
                } else if (msg === "NO_FOUND_EMAIL") {
                    Notiflix.Notify.Failure("Email tidak dikenal !");
                } else if (msg === "SUCCESS_LOST") {
                    Notiflix.Report.Info(
                        "Reset Password",
                        '"Link reset password telah dikirim melalui email. Segera lakukan perubahan password sebelum kode kadaluarsa" <br><br>- System',
                        "Tutup"
                    );
                    $("form :input").val("");
                }
            }, //success
            error: function(xhr, ajaxOption, thrownError) {
                Notiflix.Report.Failure(
                    "Terjadi Kesalahan !",
                    "Server tidak merespon permintaan !! - System<br>",
                    "Tutup"
                );
            }, //error
        }); //ajax
    });
});