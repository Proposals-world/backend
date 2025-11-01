<?php

namespace App\Services;

use App\Models\Fwateer;

class FwateerService
{
    /**
     * Create a new invoice (fwateer record)
     *
     * @param array $data
     * @return \App\Models\Fwateer
     */
    public function create(array $data): Fwateer
    {
        // Auto-generate invoice number like tolba1, tolba2, ...
        $nextNumber = Fwateer::count() + 1;
        $invoiceNumber = 'tolba' . str_pad($nextNumber, 9, '0', STR_PAD_LEFT);

        $data['invoice_number'] = $invoiceNumber;

        return Fwateer::create([
            'company_name'     => $data['company_name'] ?? 'Tolba Platform',
            'company_address'  => $data['company_address'] ?? 'Amman, Jordan',
            'trade_reg_number' => $data['trade_reg_number'] ?? null,
            'sales_tax_number' => $data['sales_tax_number'] ?? null,
            'invoice_date'     => $data['invoice_date'] ?? now()->toDateString(),
            'invoice_number'   => $invoiceNumber,
            'user_id'          => $data['user_id'],
            'amount'           => $data['amount'],
            'payment_method'   => $data['payment_method'], // 'card' or 'click'
        ]);
    }
}
