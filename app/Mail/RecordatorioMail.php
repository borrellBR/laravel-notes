// app/Mail/RecordatorioMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Note;

class RecordatorioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $note;

    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    public function build()
    {
        return $this->markdown('emails.reminder')
                    ->subject('Recordatorio de tu nota');
    }
}
