<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الأسعار</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "DejaVu Sans", "Arial Unicode MS", "Tahoma", sans-serif;
        }

        body {
            direction: rtl;
            text-align: right;
            background-color: #f9fafb;
            padding: 20px;
            font-size: 14px;
            line-height: 1.6;
            color: #374151;
            font-weight: 400;
        }

        .invoice-container {
            background: white;
            max-width: 1000px;
            margin: 0 auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 40px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            position: relative;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .header-title {
            font-size: 42px;
            font-weight: bold;
            color: #14532d;
            margin: 0;
        }

        .title {
            font-size: 12pt;
            font-weight: bold;
            color: #14532d;
        }

        .invoice-info {
            margin: 5px 0;
            line-height: 1.4;
        }

        .value {
            font-size: 12pt;
            font-weight: bold;
            color: #000000;
            margin-right: 5px;
        }

        .logo-section {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .taklifa-logo {
            width: 0px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 60pt
        }

        .scan-logo {
            text-align: center;
            margin: 10px 0;
        }

        .scan-logo img {
            height: 150px;
            width: auto;
        }

        .validity-banner {
            background-color: #14532d;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 10px;
        }


        /* Quote Details */
        .quote-details {
            padding: 25px 40px;
            background: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 150px;
        }

        .detail-label {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .detail-value {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
        }

        .validity-banner {
            background: #059669;
            color: white;
            padding: 15px 28px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 15px;
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(5, 150, 105, 0.2);
        }

        .background-table {
            background: #f1f5f9;
        }

        /* Company Section */
        .company-section {
            padding: 20px 40px;

            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 0;
            margin: 0;
        }

        .table-style {
            border-collapse: collapse;
            font-size: 11pt;
        }

        .th-style {
            border: 1px solid #ddd;
            word-wrap: break-word;
            padding: 6px;
            text-align: center;
            height: 40px;
        }

        .td-style {
            border: 1px solid #ddd;
            text-align: right;
            word-wrap: break-word;
            padding: 6px;
            text-align: center;
        }

        .color:nth-child(even) {
            background-color: #EFF7F3;
        }

        .table-style {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .company-info {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
        }

        .company-avatar {
            width: 50px;
            height: 50px;
            background: #d1d5db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
            color: #6b7280;
            flex-shrink: 0;
        }

        .company-details {
            flex: 1;
        }

        .company-name {
            font-size: 26px;
            font-weight: bold;
            color: #14532d;
            margin: 0 0 4px 0;
        }

        .company-address {
            font-weight: bold;
            color: #1f2937;
            font-size: 16px;
            margin: 0;
            line-height: 1.4;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-whatsapp {
            background: #25d366;
            color: white;
        }

        .btn-info {
            background: #374151;
            color: white;
        }

        /* Products Table */
        .products-section {
            padding: 0 40px 40px;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table-header {
            background: #059669;
            color: white;
        }

        .table-header th {
            padding: 18px 15px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            border: none;
        }

        .products-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }

        .products-table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        .products-table tbody tr:nth-child(odd) {
            background: #ffffff;
        }

        .products-table tbody td {
            padding: 20px 15px;
            text-align: center;
            font-size: 13px;
            vertical-align: middle;
            border: none;
        }

        .product-image {
            width: 50px;
            height: 50px;
            background: #f3f4f6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 20px;
        }

        .product-name {
            font-weight: bold;
            font-size: 14px;
            color: #111827;
            margin-bottom: 4px;
            text-align: right;
        }

        .product-description {
            font-size: 11px;
            color: #6b7280;
            line-height: 1.4;
            text-align: right;
        }

        .price-cell {
            font-weight: bold;
            color: #111827;
        }

        .total-cell {
            font-weight: bold;
            font-size: 15px;
            color: #111827;
        }

        /* Total Section */
        .total-section {
            background: #059669;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            font-size: 18px;
        }

        .total-label {
            font-size: 20px;
        }

        .total-amount {
            font-size: 24px;
            font-weight: bold;
        }

        .currency {
            font-size: 16px;
            margin-right: 5px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .invoice-container {
                box-shadow: none;
            }

            .btn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="header">
            <div class="logo-section">
                <div class="taklifa-logo">
                    @php
                        $logoPath = public_path('images/taklifa.png');
                        $logoExists = file_exists($logoPath);
                        $logoBase64 = $logoExists
                            ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
                            : null;
                    @endphp
                    @if ($logoBase64)
                        <img src="{{ $logoBase64 }}" alt="Taklifa Logo">
                    @else
                        <img src="{{ asset('images/taklifa.png') }}" alt="Taklifa Logo">
                    @endif
                </div>
            </div>

            <div class="scan-logo">
                <img src="{{ asset('images/scan.png') }}">
            </div>
            <div>
                <div class="header-title">عرض الأسعار</div>
                <div>
                    <p class="invoice-info">
                        <span class="title">رقم عرض الأسعار:</span>
                        <span class="value">{{ $invoiceNumber ?? '152 #' }}</span>
                    </p>
                    <p class="invoice-info">
                        <span class="title">تاريخ عرض الأسعار:</span>
                        <span class="value">{{ $invoiceDate ?? '17/07/2024' }}</span>
                    </p>
                </div>
                <div class="validity-banner">
                    هذا السعر صالح لمدة {{ $validityDays ?? 7 }} أيام من تاريخه
                </div>
            </div>

        </div>

        <div class="background-table">
            <!-- Company Section -->
            <div class="company-section">
                <div class="company-info">
                    <div class="company-avatar">
                        {{ $userAvatar }}
                    </div>
                    <div class="company-details">
                        <div class="company-name">{{ $companyName }}</div>
                        <div class="company-address">
                            {{ $companyAddress }}
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="#" class="btn btn-info">
                        💬 معلومات عنا
                    </a>

                    <a href="#" class="btn btn-whatsapp">
                        📞 تواصل بنا مباشر
                    </a>
                </div>
            </div>

            <!-- Products Table -->
            <div class="products-section">
                <table style="width: 100%; margin-bottom: 10px; margin-top: 20px" class="table-style">
                    <thead style="background-color: #06593a;">
                        <tr style="color: #FFFFFF;">
                            <th class="th-style">اسم المنتج</th>
                            <th class="th-style">الوصف</th>
                            <th class="th-style">السعر</th>
                            <th class="th-style">الكمية</th>
                            <th class="th-style">المجموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($items) && count($items) > 0)
                            @foreach($items as $item)
                                <tr class="color">
                                    <td class="td-style">
                                        <div class="product-name">{{ $item->name }}</div>
                                        <div class="product-description">{{ $item->description }}</div>
                                    </td>
                                    <td class="td-style">{{ $item->description }}</td>
                                    <td class="td-style price-cell">
                                        <span class="currency">ر.س</span>
                                        {{ number_format($item->price / 100, 2) }}
                                    </td>
                                    <td class="td-style">{{ $item->quantity }}</td>
                                    <td class="td-style total-cell">
                                        <span class="currency">ر.س</span>
                                        {{ number_format($item->total_price / 100, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" style="text-align: center; color: #6b7280;">لا توجد منتجات لعرضها</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Total Section -->
            <div class="total-section">
                <div class="total-label">الإجمالي</div>
                <div class="total-amount">
                    <span class="currency">ر.س</span>
                    @if(isset($total))
                        {{ number_format($total, 2) }}
                    @elseif(isset($items) && count($items) > 0)
                        {{ number_format($items->sum(function($item) { return ($item->total_price ?? 0) / 100; }), 2) }}
                    @else
                        {{ number_format(1000.00, 2) }}
                    @endif
                </div>
            </div>
        </div>

    </div>
</body>

</html>
