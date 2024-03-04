<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */

namespace App\Mail;

use App\Models\Cuota;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendFactura extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * Le pasamos los datos al constructor, como la cuota y el pdf
     */
    public function __construct(public $data,)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('nosecaen@nosecaen.com', 'Nosecaen SL'),
            subject: 'Send Factura',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'cuotas.pdf',
            with: $this->data
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->data['pdf']->output(), 'Factura.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
