<?php

namespace App\Livewire\Content;

use App\Models\SourceCodeProduct;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ModalPaymentSourceCode extends Component
{
    use LivewireAlert;
    public $sourceCodeDetail;
    public $balance;
    public $errors = [];
    public $paymentMethod;
    public function mount(string $id)
    {
        $this->sourceCodeDetail = SourceCodeProduct::find($id);
        $this->balance = auth()->user()->balance;
    }
    public function payment()
    {
        $userBalance = auth()->user()->balance; // Assuming 'bala
        // Reset errors before processing
        $this->errors = [];

        // Check if the user is authenticated
        if (!auth()->user()) {
            $this->errors['auth'] = 'Vui lòng đăng nhập để tạo đơn hàng';
        }
        if ($this->paymentMethod == 'balance' && $userBalance < $this->sourceCodeDetail->price) {
            $this->errors['paymentMethod'] = 'Số dư không đủ.';
        }

        // Validate required fields
        if (is_null($this->paymentMethod)) {
            $this->errors['paymentMethod'] = 'Vui lòng chọn phương thức thanh toán.';
        }

        // If there are errors, alert the user and return
        if (!empty($this->errors)) {
            foreach ($this->errors as $error) {
                $this->alert('error', $error);
                sleep(2);
                return redirect('/source-code/list/ ' . $this->sourceCodeDetail->id);
            }

            return;
        }

    }
    public function render()
    {
        return view('livewire.content.modal-payment-source-code');
    }
}
