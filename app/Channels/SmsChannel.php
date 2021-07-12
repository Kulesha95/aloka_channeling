<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class SmsChannel
{

	private $userId, $password;

	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->userId = env('TETIT_USER_ID');
		$this->password = env('TETIT_PASSWORD');
	}

	/**
	 * Send the given notification.
	 *
	 * @param  mixed  $notifiable
	 * @param  \Illuminate\Notifications\Notification  $notification
	 * @return void
	 */
	public function send($notifiable, Notification $notification)
	{
		$message = $notification->toSms($notifiable);

		$status = Http::get('https://www.textit.biz/sendmsg', [
			'id' => $this->userId,
			'pw' => $this->password,
			'to' => $notifiable->mobile,
			'text' => $message,
		]);
	}
}