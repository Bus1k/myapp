<?php

namespace Core;

/*
 * Flash notification messages:
 * messages for one-time display using the session for storage between requests.
 */
class FlashMessage
{
    const SUCCESS = 'success';
    const INFO    = 'info';
    const WARNING = 'warning';

    public static function addMessage($message, $type = 'success')
    {
        if(!isset($_SESSION['flash_notifications']))
        {
            $_SESSION['flash_notifications'] = [];
        }

        //Append the message to array
        $_SESSION['flash_notifications'][] = [
            'body' => $message,
            'type' => $type
        ];
    }

    public static function getMessages()
    {
        if(isset($_SESSION['flash_notifications']))
        {
            $msg = $_SESSION['flash_notifications'];

            if(!empty($_SESSION['flash_notifications']))
            {
                unset($_SESSION['flash_notifications']);
            }

            return $msg;
        }
    }
}