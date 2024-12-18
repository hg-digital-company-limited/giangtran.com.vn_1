<?php

namespace App\Livewire\Page;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Invoice as InvoiceModel;
class Invoice extends Component
{
    public $invoice ;
    public $isPayment = false;
    public function mount($id)
    {
        $this->invoice = InvoiceModel::where('invoice_code', $id)->first();
        $this->isPayment = $this->invoice->payment_status == 'paid';
        if ($this->invoice->user_id != auth()->user()->id) {
            abort(404, 'Không tìm thấy hóa đơn');
        }
    }
    #[Layout('components.layouts.default')]

    public function render()
    {
        return view('livewire.page.invoice');
    }
}
