<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PedidoEntregadoCliente extends Notification implements ShouldQueue
{
    use Queueable;

    protected $pedido;

    public function __construct($pedido)
    {
        $this->pedido = $pedido;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Tu pedido ha sido entregado')
                    ->greeting('Hola ' . $notifiable->name . ',')
                    ->line('Tu pedido con ID #' . $this->pedido->id . ' ha sido entregado correctamente.')
                    ->line('¡Gracias por confiar en nosotros!')
                    ->salutation('Saludos, El equipo de Rinconcito');
    }

    public function toDatabase($notifiable)
    {
        return [
            'pedido_id' => $this->pedido->id,
            'mensaje' => 'Tu pedido ha sido entregado correctamente.',
        ];
    }
}
