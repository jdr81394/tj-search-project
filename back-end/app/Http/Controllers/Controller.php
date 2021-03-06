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
    }


    // This is for homepage's basic search
    // Jake - Tested
    private function getBasicSearch($request) {
        try {
            $name = $request->name;

            $result = DB::table('items')->select('name')->where('name', 'LIKE','%'.$name.'%')->limit(14)->get();

            return response()->json($result,200);

        } catch(Exception $e) {

        }
    }

    // This update function will be sending the items id number to a user's cart which will be an array 
    // Jake - Tested, but deprecated by Angular front-end.
    public function update(Request $request) {
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
            $remove_from_cart = $request->remove_from_cart;
            $user_id = $request->user_id;

            //Get cart
            $fetch_cart = DB::table('users')->select('cart')->where('id','=',$user_id)->first();
            $cart = json_decode($fetch_cart->cart);

            // Find position of item to be removed in array, and unset it. 
            $key = array_search($remove_from_cart, $cart);
            array_splice($cart, $key, 1);            
           
            $updated_cart = DB::table('users')->select('cart')->where('id', '=', $user_id)->update(['cart' => $cart]);

            return response()->json_encode("The item was successfully removed from your cart.", 200);

        } catch(Exception $e) {

        }
    }

    public function store(Request $request) {
        try {

            $cart = $request->cart;
            $senderName = $request->name;
            $senderEmail = $request->senderEmail;
            $message = $request->message;

            // Jake - must change SMTP username and SMTP password to client's username & password . 
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 2;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                             // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = '';                   // SMTP username
            $mail->Password   = '';                          // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
        
            // //Recipients
            $mail->setFrom("$senderEmail", "$senderName");
            $mail->addAddress('', '');    // Change to whoever TJ wants the target to be
            $mail->addReplyTo("$senderEmail", "$senderName");
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $itemBody = "";
            foreach(json_decode($cart) AS $item) {
            
            $itemBody = $itemBody . "<tr>
              <td>$item->name</td>
              <td>$item->quantity</td>
            </tr>";
            }
            // // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'A new request came in!';
            $mail->Body = "Message:  <br> " . $message . " <br> <table>
                        <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        </tr>
                        $itemBody
                    </table>";
        
            $mail->send();
            return response()->json_encode("The email was successfully sent!", 200);

        } catch(MailException $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        }
    }



}
