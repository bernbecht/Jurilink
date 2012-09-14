<?php

require_once 'CConexao.php';
require_once 'class.phpmailer.php';

class CEmail {

    public $destinatario;
    public $assunto;
    public $msg;
    public $header;

    public function testarEnvio() {
        // conteúdo da mensagem
        $mensagem = "Testando o envio de email através de aplicações locais";

// Estrutura HTML da mensagem
        $msg = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
        $msg .= "<html>";
        $msg .= "<head></head>";
        $msg .= "<body style=\"background-color:#fff;\" >";
        $msg .= "<strong>MENSAGEM:</strong><br /><br />";
        $msg .= $mensagem;
        $msg .= "</body>";
        $msg .= "</html>";

// Abaixo começaremos a utilizar o PHPMailer. 

        /*
          Aqui criamos uma nova instância da classe como $mail.
          Todas as características, funções e métodos da classe
          poderão ser acessados através da variável (objeto) $mail.
         */
        $mail = new PHPMailer(); // 
// Define o método de envio
        $mail->Mailer = "smtp";

// Define que a mensagem poderá ter formatação HTML
        $mail->IsHTML(true); //
// Define que a codificação do conteúdo da mensagem será utf-8
        $mail->CharSet = "utf-8";

// Define que os emails enviadas utilizarão SMTP Seguro tls
        $mail->SMTPSecure = "tls";

// Define que o Host que enviará a mensagem é o Gmail
        $mail->Host = "smtp.gmail.com";

//Define a porta utilizada pelo Gmail para o envio autenticado
        $mail->Port = "587";

// Deine que a mensagem utiliza método de envio autenticado
        $mail->SMTPAuth = "true";

// Define o usuário do gmail autenticado responsável pelo envio
        $mail->Username = "bbechtold21";

// Define a senha deste usuário citado acima
        $mail->Password = "msdosftp2104G";

// Defina o email e o nome que aparecerá como remetente no cabeçalho
        $mail->From = "bbechtold21@gmail.com";
        $mail->FromName = "Bernardo Bechtold";

// Define o destinatário que receberá a mensagem
        $mail->AddAddress("bbechtold21@gmail.com");

        /*
          Define o email que receberá resposta desta
          mensagem, quando o destinatário responder
         */
        $mail->AddReplyTo("o-username@gmail.com", $mail->FromName);

// Assunto da mensagem
        $mail->Subject = "Atualização de Ato";

// Toda a estrutura HTML e corpo da mensagem
        $mail->Body = $msg;

// Controle de erro ou sucesso no envio
        if (!$mail->Send()) {

            echo "Erro de envio: " . $mail->ErrorInfo;
        } else {

            echo "Mensagem enviada com sucesso!";
        }
    }

    public function enviarSenha($destinatario, $user, $senha) {

        $this->assunto = 'Informações Cadastrais Advocacia';

        // conteúdo da mensagem
        $mensagem = "Informações para acompanhamento de processos com a advocacia:<br/>
            <strong>login: </strong>" . $user . "<br />
            <strong>senha: </strong>" . $senha . "<br />    
            Acesso www.jurilink.com.br para visualizar seus processos.";

// Estrutura HTML da mensagem
        $msg = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
        $msg .= "<html>";
        $msg .= "<head></head>";
        $msg .= "<body style=\"background-color:#fff;\" >";
        $msg .= $mensagem;
        $msg .= "</body>";
        $msg .= "</html>";

// Abaixo começaremos a utilizar o PHPMailer. 

        /*
          Aqui criamos uma nova instância da classe como $mail.
          Todas as características, funções e métodos da classe
          poderão ser acessados através da variável (objeto) $mail.
         */
        $mail = new PHPMailer(); // 
// Define o método de envio
        $mail->Mailer = "smtp";

// Define que a mensagem poderá ter formatação HTML
        $mail->IsHTML(true); //
// Define que a codificação do conteúdo da mensagem será utf-8
        $mail->CharSet = "utf-8";

// Define que os emails enviadas utilizarão SMTP Seguro tls
        $mail->SMTPSecure = "tls";

// Define que o Host que enviará a mensagem é o Gmail
        $mail->Host = "smtp.gmail.com";

//Define a porta utilizada pelo Gmail para o envio autenticado
        $mail->Port = "587";

// Deine que a mensagem utiliza método de envio autenticado
        $mail->SMTPAuth = "true";

// Define o usuário do gmail autenticado responsável pelo envio
        $mail->Username = "bbechtold21";

// Define a senha deste usuário citado acima
        $mail->Password = "msdosftp2104G";

// Defina o email e o nome que aparecerá como remetente no cabeçalho
        $mail->From = "bbechtold21@gmail.com";
        $mail->FromName = "Bernardo Bechtold";

// Define o destinatário que receberá a mensagem
        $mail->AddAddress($destinatario);

        /*
          Define o email que receberá resposta desta
          mensagem, quando o destinatário responder
         */
        $mail->AddReplyTo("bbechtold21@gmail.com", $mail->FromName);

// Assunto da mensagem
        $mail->Subject = "Atualização de Ato";

// Toda a estrutura HTML e corpo da mensagem
        $mail->Body = $msg;

// Controle de erro ou sucesso no envio
        if (!$mail->Send()) {

            return 0;
        } else {

            return 1;
        }
    }//function
    
    public function enviarAto($destinatario, $nome_ato, $descricao, $num_processo) {

        $this->assunto = 'Informações Cadastrais Advocacia';

        // conteúdo da mensagem
        $mensagem = "Houve uma atualização de ato no processo $num_processo<br/>
            <strong>Ato Atual: </strong>" . $nome_ato . "<br />
            <strong>Descrição: </strong>" . $descricao . "<br />    
            Acesso www.jurilink.com.br para visualizar seus processos.";

// Estrutura HTML da mensagem
        $msg = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
        $msg .= "<html>";
        $msg .= "<head></head>";
        $msg .= "<body style=\"background-color:#fff;\" >";
        $msg .= $mensagem;
        $msg .= "</body>";
        $msg .= "</html>";

// Abaixo começaremos a utilizar o PHPMailer. 

        /*
          Aqui criamos uma nova instância da classe como $mail.
          Todas as características, funções e métodos da classe
          poderão ser acessados através da variável (objeto) $mail.
         */
        $mail = new PHPMailer(); // 
// Define o método de envio
        $mail->Mailer = "smtp";

// Define que a mensagem poderá ter formatação HTML
        $mail->IsHTML(true); //
// Define que a codificação do conteúdo da mensagem será utf-8
        $mail->CharSet = "utf-8";

// Define que os emails enviadas utilizarão SMTP Seguro tls
        $mail->SMTPSecure = "tls";

// Define que o Host que enviará a mensagem é o Gmail
        $mail->Host = "smtp.gmail.com";

//Define a porta utilizada pelo Gmail para o envio autenticado
        $mail->Port = "587";

// Deine que a mensagem utiliza método de envio autenticado
        $mail->SMTPAuth = "true";

// Define o usuário do gmail autenticado responsável pelo envio
        $mail->Username = "bbechtold21";

// Define a senha deste usuário citado acima
        $mail->Password = "msdosftp2104G";

// Defina o email e o nome que aparecerá como remetente no cabeçalho
        $mail->From = "bbechtold21@gmail.com";
        $mail->FromName = "Bernardo Bechtold";

// Define o destinatário que receberá a mensagem
        $mail->AddAddress($destinatario);

        /*
          Define o email que receberá resposta desta
          mensagem, quando o destinatário responder
         */
        $mail->AddReplyTo("bbechtold21@gmail.com", $mail->FromName);

// Assunto da mensagem
        $mail->Subject = "Atualização de Ato";

// Toda a estrutura HTML e corpo da mensagem
        $mail->Body = $msg;

// Controle de erro ou sucesso no envio
        if (!$mail->Send()) {

            return 0;
        } else {

            return 1;
        }
    }//function
    
    
    
}
?>
