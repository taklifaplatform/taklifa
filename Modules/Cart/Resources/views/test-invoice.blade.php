<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار نظام الفواتير</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
            background: #f5f5f5;
            direction: rtl;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .title {
            color: #059669;
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 500;
        }
        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            direction: ltr;
            text-align: left;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #059669;
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
        }
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        .btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.2s;
        }
        .btn-primary {
            background: #059669;
            color: white;
        }
        .btn-primary:hover {
            background: #047857;
        }
        .btn-secondary {
            background: #6b7280;
            color: white;
        }
        .btn-secondary:hover {
            background: #4b5563;
        }
        .info {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #0c4a6e;
        }
        .quick-links {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 20px;
        }
        .quick-link {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 10px;
            border-radius: 6px;
            text-decoration: none;
            color: #374151;
            text-align: center;
            font-size: 12px;
            transition: all 0.2s;
        }
        .quick-link:hover {
            background: #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">🧾 اختبار نظام عروض الأسعار</h1>
        
        <div class="info">
            <strong>📋 خيارات الاختبار:</strong><br>
            • معاينة الفاتورة في المتصفح<br>
            • تحميل PDF مباشرة<br>
            • اختبار مع بيانات حقيقية أو تجريبية
        </div>
        
        <form id="testForm">
            <div class="form-group">
                <label for="cart_id">🛒 معرف السلة (Cart ID):</label>
                <input type="text" id="cart_id" name="cart_id" placeholder="أدخل معرف السلة أو اتركه فارغاً للبيانات التجريبية">
            </div>
            
            <div class="form-group">
                <label for="test_mode">🔧 وضع الاختبار:</label>
                <select id="test_mode" name="test_mode">
                    <option value="sample">بيانات تجريبية (Sample Data)</option>
                    <option value="preview">معاينة في المتصفح (Browser Preview)</option>
                    <option value="pdf">تحميل PDF</option>
                </select>
            </div>
            
            <div class="button-group">
                <button type="button" class="btn btn-primary" onclick="testInvoice()">
                    🚀 اختبار الفاتورة
                </button>
                <button type="button" class="btn btn-secondary" onclick="window.location.reload()">
                    🔄 إعادة تحميل
                </button>
            </div>
        </form>
        
        <div class="quick-links">
            <a href="/test-pdf" class="quick-link">
                📊 عرض أسعار تجريبي
            </a>
            <a href="/cart/1/download-pdf?preview=1" class="quick-link">
                👁️ معاينة السلة #1
            </a>
            <a href="/api/cart/1/invoice/download" class="quick-link">
                📥 تحميل API
            </a>
            <a href="#" class="quick-link" onclick="showApiInfo()">
                ⚙️ معلومات API
            </a>
        </div>
        
        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; font-size: 12px; color: #6b7280;">
            <p><strong>🔗 API Endpoints:</strong></p>
            <p><code>GET /api/cart/{cart_id}/invoice/download</code> - يتطلب تسجيل الدخول</p>
            <p><code>GET /cart/{cart_id}/download-pdf</code> - للاختبار فقط</p>
            <p><code>GET /test-pdf</code> - بيانات تجريبية</p>
        </div>
    </div>

    <script>
        function testInvoice() {
            const cartId = document.getElementById('cart_id').value.trim();
            const testMode = document.getElementById('test_mode').value;
            
            let url = '';
            
            if (testMode === 'sample' || !cartId) {
                // Use sample data
                url = '/test-pdf';
            } else if (testMode === 'preview') {
                // Browser preview with cart ID
                url = `/cart/${cartId}/download-pdf?preview=1`;
            } else {
                // PDF download with cart ID
                url = `/cart/${cartId}/download-pdf`;
            }
            
            if (testMode === 'preview' || testMode === 'sample') {
                window.open(url, '_blank');
            } else {
                window.location.href = url;
            }
        }
        
        function showApiInfo() {
            alert(`
🔧 معلومات API:

1. API Endpoint (يتطلب المصادقة):
   GET /api/cart/{cart_id}/invoice/download
   
2. Test Endpoint (للاختبار فقط):
   GET /cart/{cart_id}/download-pdf
   
3. Sample Data:
   GET /test-pdf
   
4. معاينة: أضف ?preview=1 لأي رابط

💡 تأكد من وجود سلة بالمعرف المطلوب في قاعدة البيانات
            `);
        }
        
        // Allow form submission with Enter key
        document.getElementById('testForm').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                testInvoice();
            }
        });
    </script>
</body>
</html> 