<?php

namespace App\Http\Controllers\cron;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PaymentHistory;
use App\Repositories\Invoice\InvoiceRepositoryInterface;
use App\Repositories\SmmOrder\SmmOrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Checkpayment extends Controller
{
    protected $invoiceRepository;
    protected $smmOrderRepository;
    public function __construct(InvoiceRepositoryInterface $invoiceRepository, SmmOrderRepositoryInterface $smmOrderRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->smmOrderRepository = $smmOrderRepository;
    }
    public function checkPayment()
    {
        $code = 'HG '.  strtoupper(string: Auth::user()->username);
        $userId = Auth::user()->id;
        // Gọi hàm từ model và truyền user_id
        $result = PaymentHistory::createPaymentHistory($code, $userId);
        return response()->json($result);
    }
    public function checkInvoice($invoice_code)
    {
        $invoice = Invoice::where('invoice_code', $invoice_code)
            ->where('payment_status', 'pending')
            ->first();
        if ($invoice) {
            $userId = $invoice->user_id;
            $this->smmOrderRepository->updatePaymentStatus($invoice->order_code, 'paid');
            $result = $this->invoiceRepository->updateInvoicePayment($invoice_code, $userId);
            return response()->json($result);
        }
        return response()->json(['status' => 'error', 'message' => 'Hóa đơn không tồn tại hoặc đã thanh toán']);
    }
}
