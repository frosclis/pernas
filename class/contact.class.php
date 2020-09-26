<?php

require_once("utils/swiftmailer/lib/swift_required.php");

class Contact{

    private $contact;

    public function getContact(){
        return $this->contact;
    }

    /**
     * Simple template rendering function
     * @param string $path path of the template file.
     * @return void.
     */
    public function render($path,$vars = '') {
        ob_start();
        include($path);
        return ob_get_clean();
    }

    public function renderData($path,$vars,$datos) {
        ob_start();
        include($path);
        return ob_get_clean();
    }

    /**
     * Templates del Dashboad
     * @return void*/


    public function contactMiddle($data) {
        print $this->renderData(contactMiddle, "", $data);
    }

    public function contactHead($data) {
        print $this->renderData(contactHead, "", $data);
    }

    public function contactMenu($menu_index, $data) {
        print $this->renderData(contactMenu, $menu_index, $data);
    }

    public function sendContactMail($formulario, $opciones) {
        if(!empty($formulario)){
            if(empty($formulario['name']) OR empty($formulario['email']) OR empty($formulario['message']))
                return $resultado ='<div class="alert alert-danger"><strong>Error!</strong> El correo no ha sido enviado, por favor revisa todos los campos.</div>';
            else{
                $secret = $opciones[0]['captcha_secret'];
                //get verify response data
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$formulario['g-recaptcha-response']);
                $responseData = json_decode($verifyResponse);

                if($formulario["agree"] != 1) {
                    return $resultado ='<div class="alert alert-danger"><strong>Error!</strong> No has aceptado las condiciones.</div>';
                } else {
                    if($responseData->success){

                        ## Cargamos la plantilla para el correo electrónico
                        include("utils/mails/form-contacto.php");

                        if(empty($formulario["tel"])) {
                            $formulario["tel"] = "No facilitado";
                        }

                        try {

                            //$transport = Swift_SmtpTransport::newInstance('gator3265.hostgator.com', 25);
                            $transport = Swift_SmtpTransport::newInstance($opciones[0]['server_url'], $opciones[0]['server_port'], 'ssl')->setUsername($opciones[0]['alert_mail'])->setPassword($opciones[0]['alert_mail_pass']);

                            $mailer = Swift_Mailer::newInstance($transport);

                            $message = Swift_Message::newInstance('Contacto')->setFrom(array($opciones[0]['alert_mail'] => 'Alertas Alba Pernas Fotografía'));
                            $message->setTo($opciones[0]['email']);
                            $message->setBody($mensaje_CONTENIDO, 'text/html', 'utf-8');
                            $message->setSubject($mensaje_ASUNTO);
                            $message->setReplyTo($formulario['email']);


                        } catch (Swift_TransportException $e) {
                            echo $e->errorMessage(); //Pretty error messages from PHPMailer
                        } catch (Exception $e) {
                            echo $e->getMessage(); //Boring error messages from anything else!
                        }

                        //send email
                        if (!$mailer->send($message))
                        return $resultado ='<div class="alert alert-danger"><strong>Error!</strong> No hemos podido enviar tu solicitud, por favor ponte en contacto con nosotros por teléfono o inténtalo más tarde.</div>';
                        else{
                            unset($formulario);
                            return $resultado ='<div class="alert alert-success"><strong>Correcto!</strong> Tu mensaje ha sido enviado correctamente, nos pondremos en contacto contigo lo antes posible.</div>';
                        }
                    }else{
                            return $resultado ='<div class="alert alert-danger"><strong>Error!</strong> No has solucionado correctamente el captcha.</div>';
                    }
                }
            }
        }
    }

}

?>