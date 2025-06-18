<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PedidoEntregadoChef extends Notification implements ShouldQueue
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
                    ->subject('Pedido entregado al cliente')
                    ->greeting('Hola ' . $notifiable->name . ',')
                    ->line('El pedido con ID #' . $this->pedido->id . ' ha sido entregado al cliente.')
                    ->salutation('Saludos, El equipo de Rinconcito');
    }

    public function toDatabase($notifiable)
    {
        return [
            'pedido_id' => $this->pedido->id,
            'mensaje' => 'El pedido ha sido entregado al cliente.',
        ];
    }
}
