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

    //do fixniecia nie dziala unsetowanie $_SESSION['flash_notifications']
    //wykrzacza sie przez co flashmessage znika odrazu pewnie cos zjebanego z redirect
    public static function getMessages()
    {
        if(isset($_SESSION['flash_notifications']))
        {
            return $_SESSION['flash_notifications'];
        }
    }
}