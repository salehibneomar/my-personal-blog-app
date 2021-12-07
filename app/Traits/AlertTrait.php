<?php

namespace App\Traits;

trait AlertTrait{
    protected function successful($message){
        return [
            'alertType'=> 'success',
            'alertMsg' => $message,
        ];
    }

    protected function failed($message){
        return [
            'alertType'=> 'error',
            'alertMsg' => $message,
        ];
    }
}