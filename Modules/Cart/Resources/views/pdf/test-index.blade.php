<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Testing Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Arial", sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            direction: rtl;
            text-align: right;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #059669, #14532d);
            color: white;
            padding: 30px 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .content {
            padding: 40px;
        }

        .section {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 20px;
            color: #059669;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e5e7eb;
        }

        .test-links {
            display: grid;
            gap: 15px;
        }

        .test-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #f8f9fa;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        .test-link:hover {
            background: #e5e7eb;
            transform: translateY(-2px);
        }

        .link-info {
            flex: 1;
        }

        .link-title {
            font-weight: bold;
            font-size: 16px;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .link-description {
            color: #6b7280;
            font-size: 14px;
        }

        .link-action {
            padding: 8px 16px;
            background: #059669;
            color: white;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 500;
        }

        .input-section {
            background: #f1f5f9;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .input-group {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 15px;
        }

        .input-group label {
            min-width: 120px;
            font-weight: 500;
            color: #374151;
        }

        .input-group input {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            font-size: 14px;
        }

        .dynamic-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .dynamic-link {
            padding: 8px 12px;
            background: #059669;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 500;
        }

        .dynamic-link:hover {
            background: #14532d;
        }

        .note {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .note-title {
            font-weight: bold;
            color: #92400e;
            margin-bottom: 5px;
        }

        .note-text {
            color: #78350f;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🧾 لوحة تجريب الفواتير</h1>
            <p>اختبار عرض وتصدير الفواتير بصيغة PDF</p>
        </div>

        <div class="content">
            <!-- Sample Data Tests -->
            <div class="section">
                <h2 class="section-title">اختبار مع بيانات تجريبية</h2>
                {{-- <div class="test-links">
                    <a href="{{ route('cart.test-invoice') }}" class="test-link" target="_blank">
                        <div class="link-info">
                            <div class="link-title">عرض HTML للفاتورة</div>
                            <div class="link-description">معاينة الفاتورة في المتصفح بتنسيق HTML</div>
                        </div>
                        <span class="link-action">عرض</span>
                    </a>
                </div> --}}
            </div>

            <!-- Real Cart Data Tests -->
            <div class="section">
                <h2 class="section-title">اختبار مع بيانات سلة حقيقية</h2>

                <div class="input-section">
                    <div class="input-group">
                        <label>معرف السلة:</label>
                        <input type="text" id="cartId" placeholder="مثال: 9f738362-cf18-4711-9c1f-5738128c6e8c"
                               value="9f738362-cf18-4711-9c1f-5738128c6e8c">
                    </div>

                    <div class="dynamic-links">
                        <a href="#" class="dynamic-link" id="viewCartHtml">عرض HTML</a>
                        <a href="#" class="dynamic-link" id="downloadCartPdf">تحميل PDF</a>
                    </div>
                </div>

                <div class="note">
                    <div class="note-title">ملاحظة:</div>
                    <div class="note-text">تأكد من وجود سلة بالمعرف المحدد في قاعدة البيانات. المعرف الافتراضي للاختبار قد لا يعمل إذا لم تكن البيانات موجودة.</div>
                </div>
            </div>

            <!-- Company Cart Items Tests -->
            <div class="section">
                <h2 class="section-title">اختبار جميع منتجات الشركة</h2>

                <div class="input-section">
                    <div class="input-group">
                        <label>معرف الشركة:</label>
                        <input type="number" id="companyId" placeholder="مثال: 1" value="1">
                    </div>

                    <div class="dynamic-links">
                        <a href="#" class="dynamic-link" id="viewCompanyHtml">عرض جميع منتجات الشركة</a>
                        <a href="{{ route('cart.test-company-pdf') }}" class="dynamic-link">تلقائي - أول شركة</a>
                    </div>
                </div>

                <div class="note">
                    <div class="note-title">معلومة:</div>
                    <div class="note-text">يعرض جميع المنتجات من كل السلات التابعة للشركة في فاتورة واحدة. مفيد لعرض كامل نشاط الشركة.</div>
                </div>
            </div>

            <!-- Server Information -->
            <div class="section">
                <h2 class="section-title">معلومات الخادم</h2>
                <div class="test-links">
                    <div class="test-link">
                        <div class="link-info">
                            <div class="link-title">Laravel Version</div>
                            <div class="link-description">{{ app()->version() }}</div>
                        </div>
                    </div>
                    <div class="test-link">
                        <div class="link-info">
                            <div class="link-title">PHP Version</div>
                            <div class="link-description">{{ PHP_VERSION }}</div>
                        </div>
                    </div>
                    <div class="test-link">
                        <div class="link-info">
                            <div class="link-title">Current Time</div>
                            <div class="link-description">{{ now()->format('Y-m-d H:i:s') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartIdInput = document.getElementById('cartId');
            const viewCartHtml = document.getElementById('viewCartHtml');
            const downloadCartPdf = document.getElementById('downloadCartPdf');
            const companyIdInput = document.getElementById('companyId');
            const viewCompanyHtml = document.getElementById('viewCompanyHtml');

            function updateCartLinks() {
                const cartId = cartIdInput.value.trim();
                if (cartId) {
                    viewCartHtml.href = `/test-cart-pdf/${cartId}?preview=1`;
                    downloadCartPdf.href = `/test-cart-pdf/${cartId}?pdf=1`;

                    viewCartHtml.style.opacity = '1';
                    downloadCartPdf.style.opacity = '1';
                } else {
                    viewCartHtml.href = '#';
                    downloadCartPdf.href = '#';

                    viewCartHtml.style.opacity = '0.5';
                    downloadCartPdf.style.opacity = '0.5';
                }
            }

            function updateCompanyLinks() {
                const companyId = companyIdInput.value.trim();
                if (companyId) {
                    viewCompanyHtml.href = `/test-company-pdf/${companyId}`;
                    viewCompanyHtml.style.opacity = '1';
                } else {
                    viewCompanyHtml.href = '#';
                    viewCompanyHtml.style.opacity = '0.5';
                }
            }

            cartIdInput.addEventListener('input', updateCartLinks);
            companyIdInput.addEventListener('input', updateCompanyLinks);

            updateCartLinks(); // Initial call
            updateCompanyLinks(); // Initial call
        });
    </script>
</body>
</html>