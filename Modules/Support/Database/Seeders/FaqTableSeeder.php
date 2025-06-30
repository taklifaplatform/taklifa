<?php

namespace Modules\Support\Database\Seeders;

use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faqs = [
            [
                'title' => [
                    'ar' => 'هل يمكنني تغيير عملية إستلام أو إلغاء بعد تحديد موعد عبر الإنترنات ؟',
                    'en' => 'Can I change the delivery process or cancel after scheduling an appointment online?',
                ],
                'content' => [
                    'en' => 'You can change the delivery process or cancel the appointment by contacting us at least 24 hours before the scheduled appointment.',
                    'ar' => 'يمكنك تغيير عملية التسليم أو إلغاء الموعد عن طريق الاتصال بنا قبل 24 ساعة على الأقل قبل الموعد المحدد.',
                ],
                'order' => 1,
            ],
            [
                'title' => [
                    'ar' => 'لم يتمكن مسؤول التوصيل من إستلام شحنتي ماذا عليا أن أفعل ؟',
                    'en' => 'The delivery officer was unable to receive my shipment. What should I do?',
                ],
                'content' => [
                    'en' => 'If the delivery officer is unable to receive your shipment, please contact us to reschedule the appointment.',
                    'ar' => 'إذا كان مسؤول التوصيل غير قادر على استلام شحنتك ، يرجى الاتصال بنا لإعادة جدولة الموعد.',
                ],
                'order' => 2,
            ],
            [
                'title' => [
                    'ar' => 'لماذا لا تنفتح شاشة طباعة بطاقة الشحن ؟',
                    'en' => 'Why is the shipping card printing screen not opening?',
                ],
                'content' => [
                    'en' => 'If the shipping card printing screen is not opening, please check the pop-up blocker settings in your browser.',
                    'ar' => 'إذا لم تفتح شاشة طباعة بطاقة الشحن ، يرجى التحقق من إعدادات حاجب النوافذ المنبثقة في المتصفح الخاص بك.',
                ],
                'order' => 3,
            ],
            [
                'title' => [
                    'ar' => 'توقفت طابعتي عن العمل بعد أن أكملت إنشاء شحنات .',
                    'en' => 'My printer stopped working after I completed creating shipments.',
                ],
                'content' => [
                    'en' => 'If your printer stopped working after you completed creating shipments, please check the printer settings and make sure it is connected to the computer.',
                    'ar' => 'إذا توقفت طابعتك عن العمل بعد الانتهاء من إنشاء الشحنات ، يرجى التحقق من إعدادات الطابعة والتأكد من أنها متصلة بالكمبيوتر.',
                ],
                'order' => 4,
            ],
        ];

        foreach ($faqs as $faq) {
            \Modules\Support\Entities\Faq::create($faq);
        }
    }
}
