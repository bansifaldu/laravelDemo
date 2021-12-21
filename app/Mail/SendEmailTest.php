<?php
  
namespace App\Mail;
  
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
  
class SendEmailTest extends Mailable
{
    use Queueable, SerializesModels;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
  
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user_detail=$this->user;
        $user = array(
          'name'     => $user_detail->name
        );
        return $this->subject('Mail from Laravel Job Scheduler')
            ->view('emails.test')
            ->with(['user' => $user]);
     }
}