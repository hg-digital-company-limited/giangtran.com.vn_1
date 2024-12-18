<?php

namespace App\Livewire\Content;

use App\Models\SourceCodeProduct;
use Livewire\Component;

class ModalPaymentSourceCode extends Component
{
    public $sourceCodeDetail;
    public $balance;
    public function mount(string $id)
    {
        $this->sourceCodeDetail = SourceCodeProduct::find($id);
        $this->balance = auth()->user()->balance;
    }
    public function render()
    {
        return view('livewire.content.modal-payment-source-code');
    }
}
