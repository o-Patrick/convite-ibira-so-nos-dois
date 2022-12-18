<?php
  require_once('PHPMailer/src/PHPMailer.php');
	require_once('PHPMailer/src/SMTP.php');
	require_once('PHPMailer/src/Exception.php');

  use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

  if(isset($_POST["btnSubmit"])) {
    if (isset($_POST["nome"])) $nome = $_POST["nome"];
    if (isset($_POST["email"])) $email = $_POST["email"];
    if (isset($_POST["mensagem"])) $mensagemDela = $_POST["mensagem"];

    $mail = new PHPMailer(true);

    // e-mail
		try {
			// para depuração
			// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "tls";
			$mail->Port = 587;
			$mail->SMTPOptions = array(
				'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
				)
			);
			$mail->Username = 'convite.para.bianca@gmail.com';
			$mail->Password = 'akiv qmyn pvxf bbrj';

			$mail->setFrom('convite.para.bianca@gmail.com');
			$mail->addAddress($email);
			$mail->addBCC('convite.para.bianca@gmail.com');

			$mail->isHTML(true);
      $mail->CharSet = 'UTF-8';
			$mail->Subject = "$nome, sua presença foi confirmada!";
			$mail->Body = "Olá, $nome! \n Sua confirmação foi registrada com sucesso! Confira sua mensagem: <hr> $mensagemDela <hr>";

			if($mail->send()) {
        echo "<script> console.log('E-mail de confirmação enviado com sucesso!') </script>";
      } else {
				echo "<script> alert('ERRO: resposta não enviada!') </script>";
			} // if mail send
		} catch (Exception $e) {
			echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
		} // try contrução e-mail

		// confirmação
		echo "<script>alert('Presença confirmada com sucesso! Verifique sua caixa de entrada ou de spam do e-mail para visualizar o comprovante')</script>";
    echo "<meta http-equiv='refresh' content='0; index.html'>";
  } // if isset btnSubmit
?>
