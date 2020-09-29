<?php

namespace App\Notifications;

use App\Mail\BareMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetNotification extends Notification
{
    use Queueable;

    //プロパティの定義
    public $token;
    public $mail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $token, BareMail $mail)
    {
        //
        $this->token = $token;
        $this->mail = $mail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return $this->mail
            //Mailableクラスのfromメソッドの第一引数には送信元メールアドレス、第二引数にはメール送信者名
            ->from(config('mail.from.address'), config('mail.from.name'))

            //toメソッドには送信先メールアドレスを渡す
            //$notifiableにはパスワード再設定メール送信先となるUserモデルが代入されている。
            ->to($notifiable->email)

            //subjectメソッドには、メールの件名を渡す
            ->subject('[memo]パスワード再設定')

            //resources/views/email/password_reset.blade.phpがテンプレートとして使用される
            ->text('emails.password_reset')

            //テンプレートとなるBladeに渡す変数を、withメソッドに連想配列形式で渡す
            ->with([
                'url' => route('password.reset', [
                    'token' => $this->token,
                    'email' => $notifiable->email
                ]),
                'count' => config(
                    'auth.passwords.' .
                    config('auth.defaults.passwords') .
                    '.expire'
                ),
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
