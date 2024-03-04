<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */


namespace App\Http\Controllers;

use App\Models\Cuota;
use Illuminate\Http\RedirectResponse;
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

/**
 * Controlador que se encarga de realizar las operaciones de pago con Paypal
 * 
 */
class PaypalController extends Controller
{
    /**
     * Api context con nuestras credenciales de paypal, para verficar el pago
     *  
    */ 
    private $apiContext;

    /**
     * Constructor del controlador
     * Obtiene las credenciales del fichero de configuración paypal.
     * Crea un apiContext con esas credenciales
     * 
     * @return void
     */
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
    /**
     * Crea el pago que se va a realizar de la cuota.
     * 
     * @return RedirectResponse|mixed|void
     */
    public function pay(Cuota $cuota){
        // Método de pago
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Cantidad a pagas
        $amount = new Amount();
        $amount->setTotal($cuota->importe);
        // La moneda del pago
        $amount->setCurrency('EUR');

        // Crea una transacción con la cantidad a pagas y una descripción
        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription($cuota->descripcion);

        // Ruta que va a usar de callback
        $callbackUrl = route('paypal.status', $cuota);

        // Establece las rutas de redirección en caso correcto y en caso de cancelar la operación
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        // Crea un pago con el metodo de pago, transacción y ruta de redirección.
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

            // Intenta crear el pago con nuestras credenciales
        try {
            // dd($this->apiContext);
            $payment->create($this->apiContext);
            
            // Si todo a ido bien manda al usuario al approvalLink
            return redirect()->away($payment->getApprovalLink());

        } catch (PayPalConnectionException $ex){
            // En caso de haber un error devuelve el error.
            echo $ex->getData();
        }
    }
    /**
     * Ruta de callback del método anterior
     * Se encarga de obtener el resultado y datos del pago anterior.
     * En caso de que el pago ha sido aprovado también se cambia el estado de la cuota a pagada
     * 
     * @return RedirectResponse
     */
    public function status(Request $request, Cuota $cuota)
    {
        // Obtiene los datos del pago
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        // Si falta algún dato significa que que ha habido algún error.
        if(!$paymentId || !$payerId || !$token){
            $status = "No se pudo proceder con el pago a través de Paypal.";
            return redirect()->route('paypal.result', compact('status'));
        }

        // Obtine el pago
        $payment = Payment::get($paymentId, $this->apiContext);

        // Crea una ejecución para el pago
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        // Ejecuta el pago
        $result = $payment->execute($execution, $this->apiContext);

        // Si el pago ha sido aprovado paga la cuota y redirige al usuario a la vista cuotas
        if($result->getState() === 'approved'){
            $status = 'El pago se ha realizado exitosamente!';

            // Actualizar estado de la cuota.
            $cuota->pagar();

            return redirect()->route('cuotas.show');
        }

        // El pago no ha sido aceptado devolver status negativo.
        $status = 'Error: El pago no se pudo realizar!';
        return redirect()->route('paypal.result', compact('status'));
    }
    /**
     * Muestra el resutlado del pago
     * 
     * @return string|mixed
     */
    public function result($status)
    {
        return $status;
    }

}
