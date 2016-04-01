<?php

namespace Models\Core;

class Mail {

  public static function message($name, $lastname, $email, $subject, $message) {

		$mail = "Client <b>" . $name . "</b> <b>" . $lastname . "</b> has email <b>" . $email . "</b> sended next message: <b>" . $message . "</b> (with subject <b>" . $subject . "</b>)";

		return $mail;
    }
}