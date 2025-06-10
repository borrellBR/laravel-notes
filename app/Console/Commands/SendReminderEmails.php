<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\ReminderMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Note;

class SendReminderEmails extends Command
{
    protected $signature = 'reminders:send';

    protected $description = 'Enviar correos de recordatorio cuando sea la fecha indicada';

    public function handle()
    {
        $today =now()->toDateString();
        $notes = Note::whereDate('reminder', $today)->get();

        foreach ($notes as $note) {
            Mail::to($note->user->email)->send(new ReminderMail($note));
            $this->info("Correo de recordatorio enviado para la nota: {$note->header}");
        }

        $this->info('Recordatorios enviados:' . $notes->count());

        if ($notes->isEmpty()) {
            $this->info('No hay notas con recordatorios para hoy.');
        }
        return Command::SUCCESS;
    }
}
