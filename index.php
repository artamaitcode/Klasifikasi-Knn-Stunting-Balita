<?php
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLASIFIKASI KNN</title>

    <link href="assets/img/bg.jpg" rel="icon">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        min-height: 100vh;
        margin: 0;
        font-family: "Segoe UI", Arial, sans-serif;
        background: #0f172a;
        overflow-x: hidden;
    }

    body:before {
        content: "";
        position: fixed;
        inset: 0;
        background:
            linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(30, 64, 175, 0.82)),
            url("assets/img/bg.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        z-index: -2;
    }

    body:after {
        content: "";
        position: fixed;
        width: 520px;
        height: 520px;
        right: -180px;
        top: -160px;
        border-radius: 50%;
        background: rgba(59, 130, 246, 0.25);
        filter: blur(2px);
        z-index: -1;
    }

    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 35px 18px;
    }

    .login-container {
        width: 100%;
        max-width: 1120px;
        display: grid;
        grid-template-columns: 1.15fr 0.85fr;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 30px 70px rgba(0, 0, 0, 0.35);
        backdrop-filter: blur(18px);
    }

    .login-left {
        position: relative;
        padding: 55px;
        color: #ffffff;
        overflow: hidden;
    }

    .login-left:before {
        content: "";
        position: absolute;
        width: 340px;
        height: 340px;
        left: -140px;
        bottom: -140px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
    }

    .login-brand {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 38px;
    }

    .login-brand-icon {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        background: #ffffff;
        color: #1d4ed8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        font-weight: 900;
        box-shadow: 0 15px 35px rgba(255, 255, 255, 0.18);
    }

    .login-brand-text strong {
        display: block;
        font-size: 18px;
        letter-spacing: 0.4px;
    }

    .login-brand-text span {
        display: block;
        font-size: 13px;
        color: #bfdbfe;
        margin-top: 2px;
    }

    .login-title {
        position: relative;
        z-index: 2;
        font-size: 40px;
        line-height: 1.25;
        font-weight: 900;
        margin: 0 0 18px 0;
        color: #ffffff;
    }

    .login-subtitle {
        position: relative;
        z-index: 2;
        font-size: 16px;
        line-height: 1.8;
        color: #dbeafe;
        max-width: 620px;
        margin-bottom: 25px;
    }

    .login-study {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.22);
        padding: 12px 16px;
        border-radius: 999px;
        color: #ffffff;
        font-weight: 700;
        margin-bottom: 35px;
    }

    .login-features {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-top: 35px;
    }

    .login-feature-card {
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 18px;
        padding: 18px;
    }

    .login-feature-card i {
        font-size: 25px;
        color: #bfdbfe;
    }

    .login-feature-card strong {
        display: block;
        font-size: 14px;
        margin-top: 10px;
        color: #ffffff;
    }

    .login-feature-card span {
        display: block;
        font-size: 12px;
        color: #dbeafe;
        margin-top: 4px;
    }

    .login-right {
        background: #ffffff;
        padding: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        width: 100%;
        max-width: 390px;
    }

    .login-card-header {
        margin-bottom: 28px;
    }

    .login-card-header span {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
        font-size: 13px;
        margin-bottom: 16px;
    }

    .login-card-header h3 {
        margin: 0;
        font-size: 30px;
        font-weight: 900;
        color: #111827;
    }

    .login-card-header p {
        margin: 8px 0 0 0;
        color: #64748b;
        line-height: 1.6;
        font-weight: 600;
    }

    .login-alert {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        border-radius: 14px;
        padding: 13px 15px;
        font-weight: 700;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .form-group-modern {
        margin-bottom: 16px;
    }

    .form-group-modern label {
        display: block;
        color: #111827;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .input-modern {
        position: relative;
    }

    .input-modern i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        font-size: 18px;
    }

    .input-modern input {
        width: 100%;
        height: 50px;
        border-radius: 15px;
        border: 1px solid #d1d5db;
        background: #f8fafc;
        padding: 0 15px 0 45px;
        font-size: 14px;
        color: #111827;
        outline: none;
        transition: 0.2s ease;
    }

    .input-modern input:focus {
        border-color: #2563eb;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
    }

    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        color: #64748b;
        font-size: 18px;
        cursor: pointer;
        padding: 5px;
    }

    .password-input input {
        padding-right: 48px;
    }

    .login-button {
        width: 100%;
        height: 50px;
        border: none;
        border-radius: 15px;
        background: linear-gradient(135deg, #2563eb, #1e40af);
        color: #ffffff;
        font-weight: 900;
        letter-spacing: 0.3px;
        margin-top: 8px;
        box-shadow: 0 14px 26px rgba(37, 99, 235, 0.28);
        transition: 0.2s ease;
    }

    .login-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 32px rgba(37, 99, 235, 0.35);
    }

    .login-footer-note {
        margin-top: 20px;
        padding: 14px;
        border-radius: 16px;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
        font-weight: 600;
    }

    .login-footer-note i {
        color: #2563eb;
        margin-right: 6px;
    }

    @media (max-width: 992px) {
        .login-container {
            grid-template-columns: 1fr;
            max-width: 680px;
        }

        .login-left {
            padding: 38px;
        }

        .login-title {
            font-size: 30px;
        }

        .login-features {
            grid-template-columns: 1fr;
        }

        .login-right {
            padding: 35px;
        }
    }

    @media (max-width: 576px) {
        .login-wrapper {
            padding: 18px;
        }

        .login-container {
            border-radius: 22px;
        }

        .login-left {
            padding: 28px;
        }

        .login-title {
            font-size: 24px;
        }

        .login-subtitle {
            font-size: 14px;
        }

        .login-study {
            border-radius: 16px;
            align-items: flex-start;
        }

        .login-right {
            padding: 26px;
        }

        .login-card-header h3 {
            font-size: 25px;
        }
    }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <div class="login-container">

            <div class="login-left">
                <div class="login-brand">
                    <div class="login-brand-icon">
                        <i class="bi bi-heart-pulse-fill"></i>
                    </div>

                    <div class="login-brand-text">
                        <strong>KNN Stunting</strong>
                        <span>Sistem Klasifikasi</span>
                    </div>
                </div>

                <h1 class="login-title">
                    Implementasi Metode K-Nearest Neighbor Untuk Prediksi Stunting Balita
                </h1>

                <p class="login-subtitle">
                    Sistem ini membantu proses prediksi stunting balita berdasarkan data kesehatan dan lingkungan dengan
                    pendekatan klasifikasi KNN.
                </p>

                <div class="login-study">
                    <i class="bi bi-hospital"></i>
                    <span>Studi Kasus: Puskesmas Ngimbang</span>
                </div>

                <div class="login-features">
                    <div class="login-feature-card">
                        <i class="bi bi-database-fill"></i>
                        <strong>Data Training</strong>
                        <span>Data acuan klasifikasi</span>
                    </div>

                    <div class="login-feature-card">
                        <i class="bi bi-check2-circle"></i>
                        <strong>Data Testing</strong>
                        <span>Data yang diuji</span>
                    </div>

                    <div class="login-feature-card">
                        <i class="bi bi-pie-chart-fill"></i>
                        <strong>Hasil Analisa</strong>
                        <span>Keputusan akhir</span>
                    </div>
                </div>
            </div>

            <div class="login-right">
                <div class="login-card">

                    <div class="login-card-header">
                        <span>
                            <i class="bi bi-shield-lock-fill"></i>
                            Login Administrator
                        </span>

                        <h3>Masuk Sistem</h3>
                        <p>Gunakan username dan password yang sudah terdaftar untuk mengakses dashboard.</p>
                    </div>

                    <?php 
                    if(isset($_GET['pesan'])){
                        if($_GET['pesan'] == "gagal"){
                    ?>

                    <div class="login-alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <span>Login gagal. Username atau password salah.</span>
                    </div>

                    <?php 
                        }
                    }
                    ?>

                    <form action="login_proses.php" method="post">

                        <div class="form-group-modern">
                            <label>Username</label>

                            <div class="input-modern">
                                <i class="bi bi-person-fill"></i>
                                <input type="text" name="username" id="username" placeholder="Masukkan username"
                                    autocomplete="off" required>
                            </div>
                        </div>

                        <div class="form-group-modern">
                            <label>Password</label>

                            <div class="input-modern password-input">
                                <i class="bi bi-lock-fill"></i>
                                <input type="password" name="password" id="password" placeholder="Masukkan password"
                                    required>

                                <button type="button" class="password-toggle" onclick="togglePassword()">
                                    <i class="bi bi-eye-fill" id="passwordIcon"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" name="submit" class="login-button">
                            Login
                        </button>

                    </form>

                    <div class="login-footer-note">
                        <i class="bi bi-info-circle-fill"></i>
                        Pastikan data login benar sebelum masuk ke sistem klasifikasi.
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
    function togglePassword() {
        var password = document.getElementById("password");
        var icon = document.getElementById("passwordIcon");

        if (password.type === "password") {
            password.type = "text";
            icon.className = "bi bi-eye-slash-fill";
        } else {
            password.type = "password";
            icon.className = "bi bi-eye-fill";
        }
    }
    </script>

</body>

</html>