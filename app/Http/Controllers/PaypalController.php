<?php

namespace App\Http\Controllers;

use App\Models\Cuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $paypalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $paypalConfig['client_id'],
                $paypalConfig['secret']
            )
        );

        // $this->apiContext->setConfig($paypalConfig['settings']);
    }

    public function pay(Cuota $cuota){
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($cuota->importe);
        $amount->setCurrency('EUR');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription($cuota->descripcion);

        $callbackUrl = route('paypal.status', $cuota);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            // dd($this->apiContext);
            $payment->create($this->apiContext);
            
            return redirect()->away($payment->getApprovalLink());

        } catch (PayPalConnectionException $ex){
            echo $ex->getData();
        }
    }

    public function status(Request $request, Cuota $cuota)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if(!$paymentId || !$payerId || !$token){
            $status = "No se pudo proceder con el pago a través de Paypal.";
            return redirect()->route('paypal.result', compact('status'));
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        $result = $payment->execute($execution, $this->apiContext);

        if($result->getState() === 'approved'){
            $status = 'El pago se ha realizado exitosamente!';

            // Actualizar estado de la cuota.
            $cuota->pagar();

            return redirect()->route('cuotas.show');
        }

        $status = 'Error: El pago no se pudo realizar!';
        return redirect()->route('paypal.result', compact('status'));
    }

    public function result($status)
    {
        return $status;
    }

}
