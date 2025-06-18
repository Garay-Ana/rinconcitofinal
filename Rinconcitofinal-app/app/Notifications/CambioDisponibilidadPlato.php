<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class CambioDisponibilidadPlato extends Notification implements ShouldQueue
{
    use Queueable;

    protected $plato;
    protected $disponible;

    public function __construct($plato, $disponible)
    {
        $this->plato = $plato;
        $this->disponible = $disponible;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $status = $this->disponible ? 'disponible' : 'no disponible';

        return (new MailMessage)
                    ->subject('Cambio en la disponibilidad del platillo')
                    ->greeting('Hola ' . $notifiable->name . ',')
                    ->line("El platillo '{$this->plato->nombre}' ahora está {$status}.")
                    ->line('Por favor, toma las acciones necesarias.')
                    ->salutation('Saludos, El equipo de Rinconcito');
    }

    public function toDatabase($notifiable)
    {
        $status = $this->disponible ? 'disponible' : 'no disponible';

        return [
            'plato_id' => $this->plato->id,
            'mensaje' => "El platillo '{$this->plato->nombre}' ahora está {$status}.",
        ];
    }
}
