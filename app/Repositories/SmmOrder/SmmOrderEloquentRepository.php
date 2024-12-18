<?php
namespace App\Repositories\SmmOrder;

use App\Models\SmmOrder;
use App\Models\User;
use App\Repositories\EloquentRepository;
use App\Repositories\Invoice\InvoiceRepositoryInterface;
use App\Repositories\SmmOrder\SmmOrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;
class SmmOrderEloquentRepository extends EloquentRepository implements SmmOrderRepositoryInterface
{
    /**
     * get model
     * @return string
     */

    protected $invoiceRepository;

    public function getModel()
    {
        return SmmOrder::class;
    }

    public function createOrder($data)
    {
        $user = User::find($data['user_id']);

        // Kiểm tra số dư của người dùng chỉ nếu payment_method khác bank_transfer
        if ($data['payment_method'] !== 'bank_transfer') {
            if ($user->balance < $data['total_price']) {
                return [
                    'status' => 'error',
                    'message' => 'Số dư không đủ để thực hiện giao dịch.',
                ];
            }

            // Trừ tiền từ tài khoản của người dùng
            $user->balance -= $data['total_price'];
            $user->save();
        }

        // Tạo order_code ngẫu nhiên 6 chữ số không trùng lặp
        do {
            $orderCode = random_int(100000, 999999);
        } while ($this->_model::where('order_code', $orderCode)->exists());

        // Thiết lập payment_status
        $paymentStatus = ($data['payment_method'] === 'bank_transfer') ? 'pending' : 'paid';
        // Tạo đơn hàng mới
        $order = $this->_model::create([
            'user_id' => $data['user_id'],
            'smm_service_id' => $data['smm_service_id'],
            'quantity' => $data['quantity'],
            'total_price' => $data['total_price'],
            'status' => $data['status'],
            'unit_price' => $data['unit_price'],
            'start_count' => $data['start_count'],
            'link' => $data['link'],
            'remains' => $data['remains'],
            'payment_method' => $data['payment_method'],
            'order_code' => $orderCode,
            'payment_status' => $paymentStatus,
        ]);

        if ($order && $order->payment_method == 'bank_transfer') {
            $data = [
                'invoice_code' => $order->order_code,
                'invoice_type' => 'Đăng Ký Dịch Vụ',
                'service' => $order->service->name,
                'amount' => $order->total_price,
                'invoice_date' => now(),
                'user_id' => $order->user_id,
                'payment_due_date' => now()->addMinutes(3),
                'payment_status' => 'pending',
            ];
            $this->invoiceRepository = app(InvoiceRepositoryInterface::class);

            $invoice = $this->invoiceRepository->createInvoice($data);

            return ['status' => $invoice['status'], 'message' => $invoice['message'], 'payment_status' => $paymentStatus, 'order' => $order, 'order_code' => $order->order_code];
        } else {
            return ['status' => 'success', 'message' => 'Đơn hàng đã được tạo thành công'];
        }
    }

    public function getOrdersByCurrentUser()
    {
        // Lấy người dùng đang đăng nhập
        $user = Auth::user();

        // Kiểm tra xem người dùng có tồn tại không
        if ($user) {
            // Truy vấn và trả về tất cả đơn hàng của người dùng
            return $this->_model::where('user_id', $user->id)->get();
        }

        return []; // Trả về mảng rỗng nếu không có người dùng đăng nhập
    }
    public function updatePaymentStatus($orderCode, $status)
    {
        return $this->_model::where('order_code', $orderCode)->update(['payment_status' => $status]);
    }
}
