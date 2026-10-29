<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docket #{{ $order->order_number }} - Siya's Kitchen</title>
    <style>
        @page {
            size: 80mm auto;
            margin: 0;
        }

        body {
            font-family: 'Courier New', Courier, monospace, sans-serif;
            font-size: 13px;
            line-height: 1.35;
            color: #000;
            background: #fff;
            width: 76mm;
            margin: 2mm auto;
            padding: 2mm;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        
        .divider {
            border-top: 1px dashed #000;
            margin: 6px 0;
        }

        .header-box {
            border: 2px solid #000;
            padding: 6px;
            margin: 6px 0;
            text-align: center;
        }

        .table-title {
            font-size: 22px;
            font-weight: 900;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 6px 0;
        }

        th, td {
            padding: 3px 0;
            vertical-align: top;
        }

        .no-print {
            margin-bottom: 15px;
            text-align: center;
        }

        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="window.print()" style="padding: 6px 12px; font-weight: bold; cursor: pointer; background: #000; color: #fff; border: none; border-radius: 4px;">
            🖨️ Print Docket Now
        </button>
        <button onclick="window.close()" style="padding: 6px 12px; cursor: pointer; border: 1px solid #999; border-radius: 4px;">
            Close Window
        </button>
    </div>

    <div class="text-center">
        <div class="bold" style="font-size: 18px;">SIYA'S KITCHEN</div>
        <div>London, United Kingdom</div>
        <div>Kitchen & Bar Docket</div>
    </div>

    <div class="header-box">
        @if($order->order_type === 'dine_in')
            <div class="table-title">TABLE #{{ $order->table_number ?? '1' }}</div>
            <div class="bold">*** DINE-IN SERVICE ***</div>
        @else
            <div class="table-title">TAKEAWAY</div>
            <div class="bold">*** COUNTER PICKUP ***</div>
        @endif
    </div>

    <div>
        <div><strong>Order Ref:</strong> {{ $order->order_number }}</div>
        <div><strong>Date/Time:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</div>
        <div><strong>Guest:</strong> {{ $order->customer_name ?: 'Walk-in' }}</div>
        @if($order->customer_phone)
            <div><strong>Phone:</strong> {{ $order->customer_phone }}</div>
        @endif
        <div><strong>Payment:</strong> PAID (Teya Hosted Checkout)</div>
    </div>

    <div class="divider"></div>

    <table>
        <thead>
            <tr>
                <th style="width: 15%; text-align: left;">QTY</th>
                <th style="width: 60%; text-align: left;">ITEM</th>
                <th style="width: 25%; text-align: right;">AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td class="bold" style="font-size: 15px;">{{ $item->quantity }}x</td>
                    <td>
                        <div class="bold" style="font-size: 14px;">{{ $item->item_name }}</div>
                        @if($item->variation_name)
                            <div style="font-size: 11px;">* {{ $item->variation_name }}</div>
                        @endif
                        @if(!empty($item->addons_json))
                            @foreach($item->addons_json as $addon)
                                <div style="font-size: 11px;">+ {{ $addon['name'] }}</div>
                            @endforeach
                        @endif
                        @if($item->special_instructions)
                            <div class="bold" style="font-size: 11px; margin-top: 2px;">
                                NOTE: {{ $item->special_instructions }}
                            </div>
                        @endif
                    </td>
                    <td class="text-right bold">
                        {{ $item->formatted_line_total }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="divider"></div>

    <table>
        <tr>
            <td>Subtotal:</td>
            <td class="text-right">{{ $order->formatted_subtotal }}</td>
        </tr>
        <tr>
            <td>VAT (Included):</td>
            <td class="text-right">£{{ number_format($order->vat_pence / 100, 2) }}</td>
        </tr>
        <tr class="bold" style="font-size: 15px;">
            <td>TOTAL PAID:</td>
            <td class="text-right">{{ $order->formatted_total }}</td>
        </tr>
    </table>

    @if($order->special_instructions)
        <div class="divider"></div>
        <div class="bold">SPECIAL INSTRUCTIONS:</div>
        <div>{{ $order->special_instructions }}</div>
    @endif

    <div class="divider"></div>
    <div class="text-center" style="font-size: 11px; margin-top: 6px;">
        Thank you for choosing Siya's Kitchen!<br>
        www.siyaskitchen.co.uk
    </div>

    <script>
        // Auto trigger print when page opens
        window.addEventListener('load', () => {
            // Uncomment if auto-print desired
            // window.print();
        });
    </script>
</body>
</html>
