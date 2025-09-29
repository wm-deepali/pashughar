<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $invoice_number ?? '#INV-1001' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            padding: 20px;
        }

        .order-invoice {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-header,
        .invoice-info,
        .invoice-items,
        .invoice-totals {
            margin-bottom: 20px;
        }

        .invoice-header h2 {
            font-weight: 700;
            margin: 0;
        }

        .invoice-header small {
            font-weight: 600;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        table th,
        table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        table th {
            background: #f1f1f1;
        }

        .totals-table {
            width: 100%;
            font-size: 14px;
        }

        .totals-table th,
        .totals-table td {
            padding: 8px;
        }

        .totals-table th {
            text-align: left;
        }

        .totals-table td {
            text-align: right;
        }

        .totals-table tr.total-row th,
        .totals-table tr.total-row td {
            border-top: 2px solid #6B3DF4;
            border-bottom: 2px solid #6B3DF4;
            font-size: 18px;
            color: #6B3DF4;
            font-weight: bold;
        }

        .btn-download {
            display: inline-block;
            background: #6B3DF4;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 600;
        }

        .btn-download:hover {
            background: #5a32c4;
        }
    </style>
</head>

<body>

    <div class="order-invoice">

        {{-- Company Logo --}}
        @if($invoiceSetting && $invoiceSetting->invoice_logo)
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="{{ asset('storage/' . $invoiceSetting->invoice_logo) }}" alt="Company Logo"
                    style="max-height: 100px;">
            </div>
        @endif

        {{-- Header --}}
        <div class="invoice-header d-flex justify-content-between align-items-start">
            <div>
                <h2>INVOICE</h2>
                <small>{{ $invoice_number ?? '#INV-1001' }}</small>
            </div>
        </div>

        {{-- Info Section --}}
        <table style="width: 100%; margin-top: 20px; font-size: 14px; border-collapse: collapse;">
            <tr>
                <!-- Info -->
                <td style="vertical-align: top; width: 33%; padding-right: 10px; border: none;">
                    <strong>Info</strong>
                    <hr style="border:1px solid #dee2e6;">
                    <p><strong>Invoice Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}
                    </p>
                    <p><strong>Order Id:</strong> {{ $order->order_number }}</p>
                    <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status ?? '-') }}</p>
                    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method ?? '-') }}</p>
                    <p><strong>Payment Date:</strong>
                        {{ \Carbon\Carbon::parse($order->payment_date ?? now())->format('d M, Y') }}</p>
                </td>

                <!-- Billed To -->
                <td style="vertical-align: top; width: 33%; padding: 10px; border: none;">
                    <strong>Billed to</strong>
                    <hr style="border:1px solid #dee2e6;">
                    <p style="margin-bottom:6px; font-weight:600;">{{ $order->customers->full_name ?? '' }} </p>
                    <p style="margin-bottom:6px;">{{ $order->customers->full_address ?? '' }}</p>
                    <p style="margin-bottom:4px;">{{ $order->customers->mobile ?? '' }}</p>
                    <p style="margin-bottom:6px; color:blue;">{{ $order->customcustomerser->email ?? '' }}</p>
                </td>

                <!-- From -->
                <td style="vertical-align: top; width: 33%; padding-left: 10px; border: none;">
                    <strong>From</strong>
                    <hr style="border:1px solid #dee2e6;">
                    @if($invoiceSetting)
                        <p style="margin-bottom:6px; font-weight:600;">
                            {{ $invoiceSetting->company_name ?? 'Company Name' }}
                        </p>
                        <p style="margin-bottom:6px;">
                            {{ $invoiceSetting->registered_address ?? '' }}
                        </p>
                        <p style="margin-bottom:4px;">
                            {{ $invoiceSetting->invoice_mobile ?? '+91-0000000000' }}
                        </p>
                        <p style="color:blue;">
                            {{ $invoiceSetting->invoice_email ?? 'admin@example.com' }}
                        </p>
                    @else
                        <p style="margin-bottom:6px; font-weight:600;">Pashughar</p>
                        <p style="margin-bottom:6px;">Kalindikunj, Near Okhla Bird Sanctuary, Delhi, India</p>
                        <p style="margin-bottom:4px;">+91-8755718642</p>
                        <p style="color:blue;">admin@pashughar.com</p>
                    @endif
                </td>
            </tr>
        </table>



        {{-- Item Table --}}
        <h5 style="margin-top: 20px;">Item Summary</h5>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Rate (<i class="fa-solid fa-indian-rupee-sign"></i>)</th>
                    <th>Total (<i class="fa-solid fa-indian-rupee-sign"></i>)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->subscriptions->name }}</td>
                    <td>1</td>
                    <td>{{ number_format($order->mrp, 2) }}</td>decimals:
                    <td>{{ number_format($order->mrp, 2) }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Totals --}}
        <div style="margin-top: 20px; display: flex; justify-content:flex-end;">
            <div style="width: 40%;">
                @php
                    $subscriptionCost = $order->mrp ?? 0;
                    $subTotal = $order->offered_price;
                    $discount = $subscriptionCost - $subTotal; // make sure this exists
                    $gstAmount = $order->gst_amount ?? 0;
                    $total = $subTotal + $gstAmount;
                @endphp
                <table class="totals-table">
                    <tr>
                        <th>Subscription Cost:</th>
                        <td><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($subscriptionCost, 2) }}</td>
                    </tr>
                    @if($discount > 0)
                        <tr>
                            <th>Discount:</th>
                            <td><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($discount, 2) }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Sub Total:</th>
                        <td><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($subTotal, 2) }}</td>
                    </tr>
                    @if($order->gst_amount > 0)
                        <tr>
                            <th>{{ $order->gst_type ?? 'GST' }}:</th>
                            <td><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($gstAmount, 2) }}</td>
                        </tr>
                    @endif
                    <tr class="total-row">
                        <th>Total:</th>
                        <td><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($total, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>


    </div>

</body>

</html>