<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ToasterComponent extends Component
{

    public $status = "info";
    public $title = "";
    public $message = "";

    protected $listeners = [
        "toaster_message" => "update"
    ];

    public function render()
    {
        return view('livewire.toaster-component');
    }

    public function update($toaster_message) {
        $this->status = $toaster_message["status"];
        $this->title = $toaster_message["title"];
        $this->message = $toaster_message["message"];
    }
}
