<?php

require_once 'CConexao.php';
require_once 'class.phpmailer.php';

class CEmail {

    public $destinatario;
    public $assunto;
    public $msg;
    public $header;
    public $remetente;
    public $remetente_nome;
    public $mail;

    public function __construct() {

        $this->remetente = 'jurilink@jurilink.com.br';
        $this->remetente_nome = 'Sistema Jurídico Jurilink';

        $this->mail = new PHPMailer();



// Define o método de envio
        $this->mail->Mailer = "smtp";

// Define que a mensagem poderá ter formatação HTML
        $this->mail->IsHTML(true); //
// Define que a codificação do conteúdo da mensagem será utf-8
        $this->mail->CharSet = "utf-8";

// Define que os emails enviadas utilizarão SMTP Seguro tls
        $this->mail->SMTPSecure = "tls";

// Define que o Host que enviará a mensagem é o Gmail
        $this->mail->Host = "smtp.jurilink.com.br";

//Define a porta utilizada pelo Gmail para o envio autenticado
        $this->mail->Port = "587";

// Deine que a mensagem utiliza método de envio autenticado
        $this->mail->SMTPAuth = "true";

// Define o usuário do gmail autenticado responsável pelo envio
        $this->mail->Username = "jurilink@jurilink.com.br";

// Define a senha deste usuário citado acima
        $this->mail->Password = "j6n4x7p7";

// Defina o email e o nome que aparecerá como remetente no cabeçalho
        $this->mail->From = $this->remetente;
        $this->mail->FromName = $this->remetente_nome;

        /*
          Define o email que receberá resposta desta
          mensagem, quando o destinatário responder
         */
        $this->mail->AddReplyTo($this->remetente, $this->remetente_nome);
    }

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

// Define o destinatário que receberá a mensagem
        $this->mail->AddAddress("berzuca@msn.com");

// Assunto da mensagem
        $this->mail->Subject = "Atualização de Ato";

// Toda a estrutura HTML e corpo da mensagem
        $this->mail->Body = $msg;

// Controle de erro ou sucesso no envio
        if (!$this->mail->Send()) {

            echo "Erro de envio: " . $this->mail->ErrorInfo;
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
            Acesse www.jurilink.com.br para visualizar seus processos.";

// Estrutura HTML da mensagem
        $msg = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
        $msg .= "<html>";
        $msg .= "<head></head>";
        $msg .= "<body style=\"background-color:#fff;\" >";
        $msg .= $mensagem;
        $msg .= "</body>";
        $msg .= "</html>";

// Define o destinatário que receberá a mensagem
        $this->mail->AddAddress($destinatario);       

// Assunto da mensagem
        $this->mail->Subject = "Dados para acesso do Sistema Jurilink";

// Toda a estrutura HTML e corpo da mensagem
        $this->mail->Body = $msg;

// Controle de erro ou sucesso no envio
        if (!$this->mail->Send()) {

            return 0;
        } else {

            return 1;
        }
    }

//function

    public function enviarAto($destinatario, $nome_ato, $descricao, $num_processo) {

        $this->assunto = 'Informações Cadastrais Advocacia';

        // conteúdo da mensagem
        $mensagem = "Houve uma atualização de ato no processo $num_processo<br/>
            <strong>Ato Atual: </strong>" . $nome_ato . "<br />
            <strong>Descrição: </strong>" . $descricao . "<br />    
            Acesse www.jurilink.com.br para visualizar seus processos.";

// Estrutura HTML da mensagem
        $msg = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
        $msg .= "<html>";
        $msg .= "<head></head>";
        $msg .= "<body style=\"background-color:#fff;\" >";
        $msg .= $mensagem;
        $msg .= "</body>";
        $msg .= "</html>";

// Define o destinatário que receberá a mensagem
        $this->mail->AddAddress($destinatario);

// Assunto da mensagem
        $this->mail->Subject = "Atualização de Ato";

// Toda a estrutura HTML e corpo da mensagem
        $this->mail->Body = $msg;

// Controle de erro ou sucesso no envio
        if (!$this->mail->Send()) {

            return 0;
        } else {

            return 1;
        }
    }

//function
}

?>
