<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

use DB;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\MailException;

// Load Composer's autoloader
// require '/../../vendor/autoload.php';

// require '../../vendor/autoload.php';



class Controller extends BaseController
{
    // Jake - Tested
    public function index(Request $request) {
        if ($request->has('action')) {
            switch($request->action) {
                case 'basicSearch':
                    return $this->getBasicSearch($request);
                    break;
            }
        }

        // return $request;

            // $result = DB::table('items')->select('*')->where('name', 'LIKE','%'.'item'.'%')->limit(3)->get();

            // return response()->json($result,200);
    }


    // This is for homepage's basic search
    // Jake - Tested
    private function getBasicSearch($request) {
        try {


            $name = $request->name;

            $result = DB::table('items')->select('name')->where('name', 'LIKE','%'.$name.'%')->limit(15)->get();

            return response()->json($result,200);

        } catch(Exception $e) {

        }
    }



    // This update function will be sending the items id number to a user's cart which will be an array 
    // Jake - Tested
    public function update(Request $request) {
        // if ($request->has('action')) {
        //     switch ($request->action) {
        //         case 'addToCart':
        //             return $this->addToCart($request);
        //         break;
        //         case 'removeFromCart':
        //             return $this->removeFromCart($request);
        //         break;
        //     }
        // }
        if ($request->has('action')) {
            switch($request->action) {
                case 'addToCart':
                    return $this->addToCart($request);
                break;
                case 'removeFromCart':
                    return $this->removeFromCart($request);
                break;
            }
        }
    }

    private function addToCart($request) {
        try {

            // Item that was selected to be added
            $add_to_cart = $request->add_to_cart;
            $user_id = $request->user_id;
            // append item's id # to users' cart
            $fetch_cart= DB::table('users')->select('cart')->where('id', '=', $user_id)->first();
            $cart = json_decode($fetch_cart->cart);

            // Ensure that the add_to_cart is an integer. If string, cast to integer.
            if (gettype($add_to_cart) == 'string') {
                $add_to_cart = (int)$add_to_cart;
                
            }
            // Push the number of the item into the cart.
            array_push($cart, $add_to_cart);

            // Update the cart.
            $updated_cart = DB::table('users')->select('cart')->where('id', '=', $user_id)->update(['cart' => $cart]);

            return response()->json_encode($updated_cart, 200);

        } catch(Exception $e) {

        }
    }

    private function removeFromCart($request) {
        try{
            // return 'in remove cart';
            $remove_from_cart = $request->remove_from_cart;
            $user_id = $request->user_id;

            //Get cart
            $fetch_cart = DB::table('users')->select('cart')->where('id','=',$user_id)->first();
            $cart = json_decode($fetch_cart->cart);
            // $key = array_search($remove_from_cart, $cart_to_alter);

            // $new_cart = unset($cart_to_alter[$key]);

            // Find position of item to be removed in array, and unset it. 
            // return json_encode($cart);

            $key = array_search($remove_from_cart, $cart);
            array_splice($cart, $key, 1);            
           
            $updated_cart = DB::table('users')->select('cart')->where('id', '=', $user_id)->update(['cart' => $cart]);

            return response()->json_encode("The item was successfully removed from your cart.", 200);

        } catch(Exception $e) {

        }
    }

    public function store(Request $request) {
        try {

            $mail = new PHPMailer(true);

            $mail->SMTPDebug = 2;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                             // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'jdr81394@gmail.com';                   // SMTP username
            $mail->Password   = 'Bbknights1!';                          // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom('jdr81394@gmail.com', 'Mailer');
            $mail->addAddress('jdr81394@gmail.com', 'Joe User');     // Add a recipient
            $mail->addAddress('jdr81394@gmail.com');               // Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('jdr81394@gmail.com');
            $mail->addBCC('bcc@example.com');
          $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';














            // // Instantiation and passing `true` enables exceptions
            // $mail = new PHPMailer(true);
            // // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            // $mail->SMTPDebug = 2;

            // $mail->isSMTP();                                            // Send using SMTP
            // $mail->Host       = '0.0.0.0:9000';                 // Set the SMTP server to send through
            // $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            // $mail->Username   = 'jake@surge.com';                       // SMTP username
            // $mail->Password   = 'secret';                               // SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            // $mail->Port       = 587;                                    // TCP port to connect to
            // $mail->SMTPOptions = array(
            //     'ssl' => array(
            //         'verify_peer' => false,
            //         'verify_peer_name' => false,
            //         'allow_self_signed' => true
            //     )
            // );

            // //Recipients
            // $mail->setFrom('from@example.com', 'Mailer');
            // $mail->addAddress('jdr81394@gmail.com', 'Joe User');     // Add a recipient
            // $mail->addAddress('jdr81394@gmail.com');               // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // // Attachments
            // // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // // Content
            // $mail->isHTML(true);                                  // Set email format to HTML
            // $mail->Subject = 'Here is the subject';
            // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            // $mail->send();
            // echo 'Message has been sent';

        } catch(MailException $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        }
    }



}
