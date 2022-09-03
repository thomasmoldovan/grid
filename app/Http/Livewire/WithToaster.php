<?php

namespace App\Http\Livewire;

trait WithToaster
{
    public function alert($status = "info", $title = "Test", $message = "Message")
    {
        $toaster_message = [
            "status" => $status,
            "title" => $title,
            "message" => $message
        ];
        $this->emit("toaster_message", $toaster_message);
    }

}
