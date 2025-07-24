<!DOCTYPE html>
<html lang="ar" dir="rtl">
@php
    if (!function_exists('splitParagraphIntoChunks')) {
        function splitParagraphIntoChunks($paragraph, $wordsPerChunk = 3)
        {
            $words = preg_split('/\s+/', trim($paragraph));

            $chunks = [];

            for ($i = 0; $i < count($words); $i += $wordsPerChunk) {
                $chunk = array_slice($words, $i, $wordsPerChunk);
                $chunks[] = implode(' ', $chunk);
            }

            return $chunks;
        }
    }
@endphp

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>عرض الأسعار</title>
    <style>
        body {
            font-family: 'IBM Plex Sans Arabic', 'DejaVu Sans', sans-serif;
            direction: rtl;
            text-align: right;
        }

        /* Header Section */
        .header {
            width: 100%;
            position: relative;
            padding: 20px 0;
            background: white;
            margin-bottom: 30px;
        }

        .header-right {
            padding-right: 50px;
        }

        .header-content {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .header-center {
            display: table-cell;
            width: 20%;
            text-align: center;
            vertical-align: top;
            padding-top: 0;
        }

        .header-title {
            font-size: 32px;
            color: #12583c;
        }

        .title {
            color: #14532d;
            font-size: 18px;
            padding: 0;
        }

        .value {
            font-size: 16px;
            color: #000;
        }

        .validity-banner {
            background-color: #12583c;
            color: #fffefb;
            padding: 4px 5px;
            border-radius: 4px;
            font-size: 15px;
            display: inline-block;
            line-height: 1;
            height: auto;
        }

        .taklifa-logo {
            text-align: center;
            margin-top: 10px;
        }

        .taklifa-logo img {
            width: 120px;
            height: auto;
            display: block;
            margin: 0 auto;
            padding-left: 60px
        }

        .scan-logo img {
            width: 120px;
            height: auto;
            display: block;
        }

        .scan-text {
            font-size: 15px;
            display: block;
            padding-right: 10px;
            line-height: 0.6;
        }

        /* Company Section */
        .company-section {
            padding: 18px 20px;
            background: #e5e6e6;
            border-radius: 16px;
            margin-bottom: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .company-info {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .company-right {
            display: table-cell;
            width: 15%;
            vertical-align: middle;
            text-align: center;
            padding-left: 36px;
        }

        .company-left {
            display: table-cell;
            width: 35%;
            vertical-align: middle;
            text-align: left;
            padding-right: 15px;
        }

        .company-buttons-container {
            display: inline-block;
            white-space: nowrap;
        }

        .whatsapp-button {
            background: #73c8a6;
            color: #246c46;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 15px;
            display: inline-block;
            line-height: 1;
            height: auto;
            text-decoration: none;
        }

        .info-button {
            background: #010e1f;
            color: #939fa1;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 15px;
            display: inline-block;
            line-height: 1;
            height: auto;
            text-decoration: none;
        }

        .company-name {
            font-size: 26px;
            color: #12583c;
            margin-bottom: 3px;
            line-height: 0.5;
            text-align: right;
        }

        .company-address {
            font-size: 14px;
            color: #08080b;
            line-height: 0.7;
            text-align: right;
        }

        .company-avatar-circle {
            width: 45px;
            height: 45px;
            background: #d4d6d4;
            border-radius: 50%;
            font-size: 16px;
            color: #463c3e;
            border: 2px solid #c8c9c8;
        }

        .table-style {
            border-collapse: collapse;
            font-size: 10pt;
            background: #ffffff;
        }

        .th-style {
            border: 1px solid #829a92;
            word-wrap: break-word;
            padding: 6px;
            text-align: center;
            height: 30px;
        }

        .td-style {
            border: 1px solid #829a92;
            text-align: right;
            word-wrap: break-word;
            text-align: center;
        }

        .table-style {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .sale-summary {
            background-color: #12583c;
            color: white;
            padding: 2px 6px;
            border-radius: 8px;
            font-size: 16px;
            line-height: 0.6
        }

        .color:nth-child(even) {
            background-color: #EFF7F3;
        }

        /* Fixed width for table columns */
        td:nth-child(1) {
            width: 20%;
        }

        th:nth-child(2) {
            width: 15%;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 20%;
        }

        td:nth-child(4) {
            width: 60%;
        }

        td:nth-child(5) {
            width: 25%;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-right">
                <div class="header-title">عرض الأسعار</div>
                <div>
                    <span class="value">
                        {{-- <span class="value">{{ $invoiceNumber }}</span> --}}
                        # 125
                        <span class="title">رقم عرض الأسعار:</span>
                    </span>
                </div>
                <div>
                    <span class="value">{{ $invoiceDate ?? date('d/m/Y') }}</span>
                    <span class="title">تاريخ عرض الأسعار:</span>
                </div>
                <div class="validity-banner">
                    هذا السعر صالح لمدة {{ $validityDays ?? 7 }} أيام من تاريخه
                </div>
            </div>

            <div class="header-center">
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
            <div>
                <div class="scan-logo">
                    @php
                        $scanImagePath = public_path('images/qrcode.png');
                        $scanImageExists = file_exists($scanImagePath);
                        $scanImageBase64 = $scanImageExists
                            ? 'data:image/png;base64,' . base64_encode(file_get_contents($scanImagePath))
                            : null;
                    @endphp
                    @if ($scanImageBase64)
                        <img src="{{ $scanImageBase64 }}" alt="QR Code">
                    @else
                        <img src="{{ asset('images/qrcode.png') }}" alt="QR Code">
                    @endif
                </div>
                <div class="scan-text">
                    حمل تطبيق تكلفة
                </div>
            </div>
        </div>
    </div>

    <!-- Company Section -->
    <div class="company-section">
        <div class="company-info">
            <div class="company-left">
                <div class="company-buttons-container">
                    <a href="https://next.taklifa.com/contact-us" class="whatsapp-button" target="_blank">
                        <span>تواصل بنا مباشر</span>
                        <i class="fa fa-whatsapp" style="font-size: 18px; color: white; line-height: 0.1;"></i>
                    </a>
                    <a href="https://next.taklifa.com/page/about-us" class="info-button">
                        <span>معلومات عنا</span>
                        <i class="fa fa-commenting-o" style="font-size: 18px; color: white; line-height: 0.1;"></i>
                    </a>
                </div>
            </div>


            <div class="company-name">
                {{ $companyName }}
            </div>
            <div class="company-address">{{ $companyAddress }}</div>

            <div class="company-right">
                <div class="company-avatar-circle">
                    @php
                        $companyInitials = $companyName ? mb_substr($companyName, 0, 2) : 'شر';
                    @endphp
                    {{ $companyInitials }}
                </div>
            </div>
        </div>
        <table style="width: 100%; margin-bottom: 10px; margin-top: 20px; font-weight: bold" class="table-style">
            <thead style="background-color: #06593a;">
                <tr style="color: #FFFFFF;">
                    <th class="th-style">المجموع</th>
                    <th class="th-style">الكمية</th>
                    <th class="th-style">السعر</th>
                    <th class="th-style">الوصف</th>
                    <th class="th-style">اسم المنتج</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr class="color td-style">
                        <td class="td-style">
                            {{ number_format($item['unit_price'], 2) }}
                        </td>
                        <td class="td-style">
                            {{ $item['quantity'] }}
                        </td>
                        <td class="td-style">
                            {{ $item['type_unit'] }} /
                            <span>ريال</span>
                            {{ number_format($item['price'], 2) }}

                        </td>
                        <td class="td-style" style="padding: 0; line-height: 0.9;">
                            @php
                                $descriptions = strip_tags(html_entity_decode($item['description'] ?? ''));
                            @endphp
                            @if ($descriptions)
                                @foreach (splitParagraphIntoChunks($descriptions, 7) as $desc)
                                    <p style="margin: 0 0 3px 0;">{{ $desc }}</p>
                                @endforeach
                            @endif
                        </td>
                        <td class="td-style">
                            <table style="width: 100%; border-collapse: collapse; text-align: center; ">
                                <tr>
                                    @php
                                        $productName = strip_tags(html_entity_decode($item['name'] ?? ''));
                                    @endphp
                                    @if ($productName)
                                        @foreach (splitParagraphIntoChunks($productName, 3) as $nameChunk)
                                            <div style="margin-bottom: 2px;">{{ $nameChunk }}</div>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                    <td style="border: none">
                                        @if (isset($item['image']) && $item['image'])
                                            <div style="flex-shrink: 0;">
                                                <img src="{{ $item['image'] }}" alt="صورة المنتج"
                                                    style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;">
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="sale-summary">
            <tr>
                <td style="font-size: 15pt">
                    <span>ريال</span>
                    {{ number_format($totalCost, 2) }}
                </td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td style="font-size: 16pt">الإجمالي</td>
            </tr>
        </table>
    </div>
</body>

</html>
