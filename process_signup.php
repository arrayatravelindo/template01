<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $destination = $_POST['destination'];

    $mail = new PHPMailer(true);

    try {
        // Pengaturan Server
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // Aktifkan untuk debug
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Ganti dengan server SMTP Anda
        $mail->SMTPAuth   = true;
        $mail->Username   = 'arrayatrans.pare@gmail.com'; // Ganti dengan email pengirim
        $mail->Password   = 'Pare14012025'; // Ganti dengan password email pengirim
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587; // Ganti dengan port yang sesuai

        // Penerima
        $mail->setFrom('arrayatrans.pare@gmail.com', 'Honeymoon Mega Offer');
        $mail->addAddress($email, $name);

        // Konten
        $mail->isHTML(true);
        $mail->Subject = 'Konfirmasi Pendaftaran Honeymoon Mega Offer';
        $mail->Body    = "Halo $name,<br><br>Terima kasih telah mendaftar untuk Honeymoon Mega Offer kami!<br><br>Anda telah memilih tujuan: $destination.<br><br>Kami akan segera menghubungi Anda dengan detail penawaran 30% OFF.<br><br>Salam,<br>Tim Arraya Travelindo";

        $mail->send();
        echo 'Pendaftaran berhasil! Email konfirmasi telah dikirim.';
    } catch (Exception $e) {
        echo "Gagal mengirim email: {$mail->ErrorInfo}";
    }
}
?>