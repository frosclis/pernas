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

    public function sendContactMail($formulario) {
        if(!empty($formulario)){
            if(empty($formulario['name']) OR empty($formulario['email']) OR empty($formulario['message']))
                return $resultado ='<div class="alert alert-danger"><strong>Error!</strong> El correo no ha sido enviado, por favor revisa todos los campos.</div>';
            else{
                $secret = '6LeqeGAUAAAAAMTdxMuagmD3ERIBtVxadjf5u1Oc';
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
                            $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')->setUsername('alertasapf@gmail.com')->setPassword('movidas222');

                            $mailer = Swift_Mailer::newInstance($transport);

                            $message = Swift_Message::newInstance('Contacto')->setFrom(array('alertasapf@gmail.com' => 'Alertas Alba Pernas Fotografía'));
                            $message->setTo('frosclis@gmail.com');
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
                        return $resultado ='<div class="alert alert-danger"><strong>Error!</strong> No hemos recibido tu email, por favor ponte en contacto con nosotros por teléfono o inténtalo más tarde.</div>';
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