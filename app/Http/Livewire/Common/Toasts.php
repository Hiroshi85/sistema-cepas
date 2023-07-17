<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class Toasts extends Component
{
    public $toasts = [];


    protected $listeners = ['toast' => 'createToast', 'dismissToast'];

    public function createToast($message, $type = 'info')
    {
        $toast = [
            'id' => uniqid(),
            'message' => $message,
            'type' => $type,
        ];


        $this->toasts[] = $toast;

    }

    public function mount()
    {
        $flashData = session()->get('toast');

        if ($flashData) {
            $this->createToast($flashData['message'], $flashData['type']);
        }
    }
    public function dismissToast($toastId)
    {
        $this->toasts = array_filter($this->toasts, function ($toast) use ($toastId) {
            return $toast['id'] !== $toastId;
        });
    }

    public function render()
    {
        return view('livewire.common.toasts');
    }
}
