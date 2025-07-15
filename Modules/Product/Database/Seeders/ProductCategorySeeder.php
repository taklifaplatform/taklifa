<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Entities\ProductCategory;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $categories = [
            [
                'name' => [
                    'en' => 'Industrial Machines',
                    'ar' => 'آلات-صناعية'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Plastic Machines',
                            'ar' => 'آلات-البلاستيك'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Plastic Blowing Machines',
                                    'ar' => 'آلات نفخ البلاستيك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Crushing Machines',
                                    'ar' => 'آلات تكسير البلاستيك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Cutting Machines',
                                    'ar' => 'آلات قطع البلاستيك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Drying Machines',
                                    'ar' => 'آلات تجفيف البلاستيك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Wrapping Machines',
                                    'ar' => 'آلات لف البلاستيك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Vacuum Forming Machines',
                                    'ar' => 'آلات تشكيل البلاستيك بالفراغ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Injection Machines',
                                    'ar' => 'آلات حقن البلاستيك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Sheet Machines',
                                    'ar' => 'آلات صفائح البلاستيك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Processing Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات معالجة البلاستيك'
                                ]
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Product Manufacturing Machines',
                                    'ar' => 'آلات صناعة منتجات البلاستيك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Product Manufacturing Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات صناعة منتجات البلاستيك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Recycling Machines',
                                    'ar' => 'آلات إعادة تدوير البلاستيك'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Packaging and Filling Machines',
                            'ar' => 'آلات-التعبئة-والتغليف'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Packaging Machines',
                                    'ar' => 'آلات التغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Filling Machines',
                                    'ar' => 'آلة تعبئة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Multi-functional Packaging Machines',
                                    'ar' => 'آلة تغليف متعددة الوظائف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sealing Machines',
                                    'ar' => 'آلة إغلاق \u002F آلة ختم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Labeling Machines',
                                    'ar' => 'آلة وضع الملصقات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Coding Machines',
                                    'ar' => 'آلة وضع الرموز \u002F آلة الترميز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Packaging Machines',
                                    'ar' => 'آلات تغليف أخرى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shrink Wrapping Machines',
                                    'ar' => 'آلة تغليف بالانكماش الحراري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wrapping Machines \u002F Coiling Machines',
                                    'ar' => 'آلة تغليف \u002F آلة لف'
                                ]
                            ],
                            [
                                'name' => [
                                    'en' => 'Wrapping \u002F Laminating Machine',
                                    'ar' => 'آلة تغليف \u002F آلة تصفيح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vacuum Packing Machines',
                                    'ar' => 'آلة تعبئة بالتفريغ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wrapping Machine',
                                    'ar' => 'خط تغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Strapping Machines',
                                    'ar' => 'آلة ربط \u002F آلة شد الأحزمة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Strapping Machine',
                                    'ar' => 'آلة لصق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pressure Filling Machine',
                                    'ar' => 'آلة تعبئة بالضغط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Packaging Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات تغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Packaging Machine Accessories',
                                    'ar' => 'آلة رص البضائع على منصة نقالة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Packaging Machine Accessories',
                                    'ar' => 'آلة تفريغ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Box Filling Machine',
                                    'ar' => 'آلة تعبئة الصناديق'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Mining and Mineral Engineering Machinery',
                            'ar' => 'آلات-التعدين-والهندسة-المعدنية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Raw Materials for Coal Mold Manufacturing',
                                    'ar' => 'المواد الخام لصنع قوالب الفحم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tank Filtration',
                                    'ar' => 'تصفية خزان ترشيح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mineral Separator',
                                    'ar' => 'فاصل معادن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mining Conveyor Belt \u002F Mining Transporter',
                                    'ar' => 'سير ناقل للمناجم \u002F ناقل تعدين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mining Crusher',
                                    'ar' => 'كسارة تعدين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mining Dryer',
                                    'ar' => 'مجفف تعدين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mining Equipment Spare Parts',
                                    'ar' => 'قطع غيار آلات التعدين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mining Mill',
                                    'ar' => 'مطحنة تعدين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mining Thickener',
                                    'ar' => 'مكثف تعدين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rock Crusher',
                                    'ar' => 'كسارة صخور'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sand Washer',
                                    'ar' => 'غسالة رمل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vibrating Screen',
                                    'ar' => 'غربال هزاز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Mining Equipment',
                                    'ar' => 'آلات تعدين أخرى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Multi-arm Excavator \u002F Jumbo Drill',
                                    'ar' => 'حفار متعدد الأذرع \u002F حفار جامبو'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Engineering Drilling Equipment',
                                    'ar' => 'جهاز حفر هندسي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Geological Drilling Equipment',
                                    'ar' => 'جهاز حفر جيولوجي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mining Drilling Equipment',
                                    'ar' => 'جهاز حفر مناجم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water Well Drilling Equipment',
                                    'ar' => 'جهاز حفر آبار المياه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Drilling Equipment',
                                    'ar' => 'أجهزة حفر أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Rubber Machines',
                            'ar' => 'آلات-المطاط'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Rubber Processing Machines',
                                    'ar' => 'آلات معالجة المطاط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rubber Processing Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات معالجة المطاط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rubber Product Manufacturing Machines',
                                    'ar' => 'آلات صناعة منتجات المطاط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rubber Product Manufacturing Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات صناعة منتجات المطاط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rubber Recycling Machines',
                                    'ar' => 'آلات إعادة تدوير المطاط'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Clothing and Textiles Machines',
                            'ar' => 'آلات-الملابس-والمنسوجات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Chemical Fiber Machine',
                                    'ar' => 'آلة الألياف الكيميائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fabric Cutting Machine',
                                    'ar' => 'آلة قطع الأقمشة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Knitting Machine \u002F Weaving Machine',
                                    'ar' => 'آلة تريكو \u002F آلة حياكة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Net Making Machine',
                                    'ar' => 'آلة صنع الشباك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Non-woven Fabric Machine',
                                    'ar' => 'آلة الأقمشة غير المنسوجة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Printing, Dyeing and Finishing Machines',
                                    'ar' => 'آلات الطباعة والصباغة والتجهيز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Quilting Machine',
                                    'ar' => 'آلة خياطة اللحف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Spinning Machine',
                                    'ar' => 'آلة غزل دوارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Textile Machine',
                                    'ar' => 'آلة المنسوجات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Textile Machine Spare Parts and Accessories',
                                    'ar' => 'قطع غيار وإكسسوارات آلات النسيج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Textile Machines',
                                    'ar' => 'آلات نسيج أخرى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Button Making Machine',
                                    'ar' => 'آلة صنع الأزرار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hat Making Machine',
                                    'ar' => 'آلة صنع القبعات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sewing and Tailoring Tools',
                                    'ar' => 'أدوات الريق والخياطة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Feather Stuffing Machine',
                                    'ar' => 'آلة حشو الريش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Winding Machine',
                                    'ar' => 'آلة لف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Glove Making Machine',
                                    'ar' => 'آلة صنع القفازات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lace Making Machine',
                                    'ar' => 'آلة صنع الدانتيل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Overlock Machine',
                                    'ar' => 'آلة أوفرلوك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Resin Stone Manufacturing Machine',
                                    'ar' => 'آلة تصنيع أحجار الرايدن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Seam Welding \u002F Closing Machine',
                                    'ar' => 'لحام الدرزات \u002F آلة إغلاق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sewing Machine',
                                    'ar' => 'آلة خياطة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shoe Making Machine',
                                    'ar' => 'آلة صنع الأحذية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shoe Repair Equipment',
                                    'ar' => 'معدات إصلاح الأحذية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Zipper Making Machine',
                                    'ar' => 'آلة صنع السحابات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Leather Machines',
                                    'ar' => 'آلات جلدية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Clothing, Shoes and Accessories Machines',
                                    'ar' => 'آلات أخرى للملابس والأحذية والإكسسوارات'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Home Product Manufacturing Machines',
                            'ar' => 'آلات-تصنيع-المنتجات-المنزلية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Furniture Manufacturing Machines',
                                    'ar' => 'آلات صناعة الأثاث'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Home Product Manufacturing Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات صناعة المنتجات المنزلية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mask Manufacturing Machines',
                                    'ar' => 'آلات صناعة النقاب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Brush Manufacturing Machines',
                                    'ar' => 'آلات صناعة الفرش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Toothpick Manufacturing Machines',
                                    'ar' => 'آلات صناعة أعواد الأسنان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Milk Bottle Manufacturing Machines',
                                    'ar' => 'آلات صناعة المبايل الملبنة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Agricultural Machines',
                            'ar' => 'آلات-زراعية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Specialized Agricultural Machines',
                                    'ar' => 'آلات زراعية متخصصة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Agricultural Machine Spare Parts',
                                    'ar' => 'قطع غيار الآلات الزراعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Feed Processing Machines',
                                    'ar' => 'آلات تجهيز الأعلاف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Milking Machines',
                                    'ar' => 'آلات الحلب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tractors',
                                    'ar' => 'جرارات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Forest Machines',
                                    'ar' => 'الآلات الغابات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Forest Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات الغابات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Agricultural Grass Cutting Machine',
                                    'ar' => 'ماكينة قص الأعشاب الزراعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Agricultural Sprayers',
                                    'ar' => 'رشاشات زراعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Biochar Machine',
                                    'ar' => 'آلة فحم حيوي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Biomass Dryer',
                                    'ar' => 'مجفف الكتلة الحيوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Livestock Sterilization Device',
                                    'ar' => 'جهاز تعقيم للمواشي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drainage and Irrigation Machines',
                                    'ar' => 'آلات الصرف والري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Seed Processing Machine',
                                    'ar' => 'آلة معالجة البذور'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Egg Incubator',
                                    'ar' => 'حاضنة البيض'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Silo',
                                    'ar' => 'صومعة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fertilizer Production Machines',
                                    'ar' => 'آلات إنتاج الأسمدة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fishing Machines',
                                    'ar' => 'آلات الصيد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Harvesting Machine',
                                    'ar' => 'آلة الحصاد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Planting and Fertilizing Machine',
                                    'ar' => 'آلة الزراعة والتسميد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Slaughter Equipment',
                                    'ar' => 'معدات الذبح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Livestock Watering System',
                                    'ar' => 'ساقية للمواشي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Livestock Feeding Unit',
                                    'ar' => 'وحدة تغذية للمواشي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Livestock Machines',
                                    'ar' => 'آلات المواشي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Livestock Scale',
                                    'ar' => 'ميزان مواشي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Agricultural Machines',
                                    'ar' => 'الآلات زراعية أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Pharmaceutical Manufacturing Machines',
                            'ar' => 'آلات-صناعة-الأدوية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Drug Testing Equipment',
                                    'ar' => 'أداة فحص الأدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drug Grinding Machine',
                                    'ar' => 'آلة طحن الأدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drug Drying Equipment',
                                    'ar' => 'معدات تجفيف الأدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drug Extraction Machine',
                                    'ar' => 'آلة استخلاص الأدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drug Packaging Equipment',
                                    'ar' => 'معدات تعبئة الأدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drug Filtering Equipment',
                                    'ar' => 'معدات ترشيح الأدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drug Injection Equipment',
                                    'ar' => 'معدات حقن الأدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drug Mixer',
                                    'ar' => 'خلاط الأدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drug Wrapping Equipment',
                                    'ar' => 'معدات تغليف الأدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drug Pill Manufacturing Equipment',
                                    'ar' => 'معدات تصنيع حبوب الأدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drug Tablet Manufacturing Equipment',
                                    'ar' => 'معدات تصنيع أقراص الأدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drug Water Treatment Equipment',
                                    'ar' => 'معدات معالجة المياه للأدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Pharmaceutical Equipment and Machines',
                                    'ar' => 'معدات وآلات صيدلانية أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Wood Processing and Carpentry Machines',
                            'ar' => 'آلات-معالجة-الخشب-والنجارة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Sawing Machines',
                                    'ar' => 'آلات النشر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wood Drilling Machine',
                                    'ar' => 'آلة حفر الخشب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wood Cutting Machines',
                                    'ar' => 'آلات قطع الخشب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wood Engraving Machines',
                                    'ar' => 'آلات نقش الخشب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wood Lathe',
                                    'ar' => 'خراطة الخشب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wood Pellet Mill',
                                    'ar' => 'مطحنة حبيبات الخشب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wood Pressing Machines',
                                    'ar' => 'آلات ضغط الخشب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Carpentry Benches',
                                    'ar' => 'مقاعد النجارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Carpentry Clamping Machines',
                                    'ar' => 'آلات تثبيت النجارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Carpentry Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات النجارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Carpentry Machines',
                                    'ar' => 'آلات النجارة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Metal Processing Machines',
                            'ar' => 'آلات-معالجة-المعادن'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Metal Casting Machines',
                                    'ar' => 'آلات صب المعادن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Coating Machines',
                                    'ar' => 'آلات طلاء المعادن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Drawing Machines',
                                    'ar' => 'آلات سحب المعادن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Cutting Machine',
                                    'ar' => 'آلة قطع المعادن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Engraving Machines',
                                    'ar' => 'آلات النقش على المعادن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Forming Machines',
                                    'ar' => 'آلات تشكيل المعادن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Polishing Machine',
                                    'ar' => 'آلة تلميع المعادن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Processing Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات معالجة المعادن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Recycling Machine',
                                    'ar' => 'آلة إعادة تدوير المعادن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Straightening Machines',
                                    'ar' => 'آلات تقويم المعادن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Wire Forming Machine',
                                    'ar' => 'آلة تشكيل الأسلاك المعدنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Nail Making Machine',
                                    'ar' => 'آلة صنع المسامير'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wire Mesh Manufacturing Machine',
                                    'ar' => 'آلة تصنيع الشبك السلكي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Metal Processing Machines',
                                    'ar' => 'آلات أخرى لمعالجة المعادن'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Paper and Glass Machines',
                            'ar' => 'آلات-الأوراق-والزجاج'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Paper Processing Machines',
                                    'ar' => 'آلات معالجة الأوراق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Paper Processing Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات معالجة الأوراق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Paper Product Manufacturing Machines',
                                    'ar' => 'آلات تصنيع المنتجات الورقية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Paper Product Manufacturing Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات تصنيع المنتجات الورقية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Glass Processing Machines',
                                    'ar' => 'آلات معالجة الزجاج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Glass Processing Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات معالجة الزجاج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Glass Product Manufacturing Machines',
                                    'ar' => 'آلات تصنيع المنتجات الزجاجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Glass Product Manufacturing Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات تصنيع المنتجات الزجاجية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Construction Materials Manufacturing Machines',
                            'ar' => 'آلات-صنع-مواد-البناء'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Panel Making Machine',
                                    'ar' => 'آلة صنع الألواح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Brick Making Machine',
                                    'ar' => 'آلة صنع الطوب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Construction Materials Manufacturing Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات تصنيع مواد البناء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cement Making Machine',
                                    'ar' => 'آلة صنع الأسمنت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dry Mortar Making Machine',
                                    'ar' => 'آلة صنع الملاط الجاف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pipe \u002F Channel Making Machine',
                                    'ar' => 'الأنابيب \u002F آلة صنع القنوات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Floor Panel Making Machines',
                                    'ar' => 'آلات صنع ألواح الأرضيات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gypsum Powder Making Machine',
                                    'ar' => 'آلة صنع مسحوق الجبس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pipe Making Machine',
                                    'ar' => 'آلة صنع الأنابيب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bridge \u002F Beam Making Machine',
                                    'ar' => 'الجسور \u002F آلة صنع المدادات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sand Making Machine',
                                    'ar' => 'آلة صنع الرمل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Steel Structure Making Machine',
                                    'ar' => 'آلة صنع الهياكل الفولاذية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stone Processing Machines',
                                    'ar' => 'آلات معالجة الحجر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tile Making Machine',
                                    'ar' => 'آلة صنع البلاط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Window and Door Making Machine',
                                    'ar' => 'آلة صنع النوافذ والأبواب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Construction Materials Manufacturing Machines',
                                    'ar' => 'آلات أخرى لتصنيع مواد البناء'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Lifting Equipment and Cranes',
                            'ar' => 'معدات-الرفع-والرافعات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Equipped Crane',
                                    'ar' => 'رافعة مجهزة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Floating Crane',
                                    'ar' => 'رافعة عائمة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bridge Crane',
                                    'ar' => 'رافعة جسرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Marine Crane',
                                    'ar' => 'رافعة بحرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Overhead Crane',
                                    'ar' => 'رافعة علوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gantry Crane',
                                    'ar' => 'رافعة بوابية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tower Crane',
                                    'ar' => 'رافعة برجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Truck Crane',
                                    'ar' => 'رافعة شاحنة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Cranes',
                                    'ar' => 'رافعات أخرى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Forklift',
                                    'ar' => 'رافعة شوكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Guide Rail',
                                    'ar' => 'سكة توجيه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Manual Crane \u002F Lifting Crane',
                                    'ar' => 'رافعة يدوية \u002F رافعة رفع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lifting Magnet',
                                    'ar' => 'مغناطيس رفع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lifting Ropes',
                                    'ar' => 'حبال رفع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lifting Table',
                                    'ar' => 'طاولة رفع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stacking and Reclaiming Machine',
                                    'ar' => 'آلة تكديس واستصلاح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Suction Discharge Crane',
                                    'ar' => 'رافعة تفريغ (بالشفط)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Winch',
                                    'ar' => 'ونش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Lifting Equipment',
                                    'ar' => 'معدات رفع أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Printing Equipment',
                            'ar' => 'معدات-الطباعة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Digital Printing Machine',
                                    'ar' => 'آلة طباعة رقمية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Printing Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات الطباعة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Silk Screen Printer',
                                    'ar' => 'طابعة شاشة حريرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Flexographic Printing',
                                    'ar' => 'طباعة فلكسوغرافية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Textile Printing Machine',
                                    'ar' => 'آلة طباعة المنسوجات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pad Printer',
                                    'ar' => 'طابعة وسائد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Heat Transfer Equipment',
                                    'ar' => 'معدات النقل الحراري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Heat Press Machine',
                                    'ar' => 'آلة الضغط الحراري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Printing Machines',
                                    'ar' => 'آلات طباعة أخرى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rotogravure Printing Machine',
                                    'ar' => 'آلة طباعة روتوغرافور'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Label Printing Machine',
                                    'ar' => 'آلة طباعة الملصقات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Offset Printing Machine',
                                    'ar' => 'آلة طباعة أوفست'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Color Printing Press',
                                    'ar' => 'مكبس طباعة ملونة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Printing Machine',
                                    'ar' => 'آلة طباعة البلاستيك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Glass Printing Machine',
                                    'ar' => 'آلة طباعة الزجاج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Code Printing Machine',
                                    'ar' => 'آلة طباعة الرموز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Embossed Printing Machine',
                                    'ar' => 'آلة طباعة بارزة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Invoice Printing Machine',
                                    'ar' => 'آلة طباعة الفواتير'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Leather Printing Machine',
                                    'ar' => 'آلة طباعة الجلود'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Business Card Printing Machine',
                                    'ar' => 'آلة طباعة بطاقات الأعمال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Post-Press Equipment',
                                    'ar' => 'معدات ما بعد الطباعة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Engineering and Construction Equipment',
                            'ar' => 'معدات-الهندسة-والانشاءات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Construction Excavator',
                                    'ar' => 'حفارة إنشائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Construction Equipment',
                                    'ar' => 'معهدة إنشائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Grader',
                                    'ar' => 'جرافة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Construction Compactors',
                                    'ar' => 'ضواغط الإنشاءات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Concrete Machines',
                                    'ar' => 'آلات الخرسانة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tile Laying Machine',
                                    'ar' => 'آلة ريش البلاط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tunnel Boring Machine',
                                    'ar' => 'آلة حفر الأنفاق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Coating \u002F Cladding Machine',
                                    'ar' => 'آلة طلاء \u002F آلة تلبيس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Engineering and Construction Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات الهندسة والإنشاءات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Engineering and Construction Machines',
                                    'ar' => 'آلات هندسة وإنشاءات أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Food Processing Equipment',
                            'ar' => 'معدات-تجهيز-الأغذية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Beverage Processing Machines',
                                    'ar' => 'آلات معالجة المشروبات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Beverage Processing Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات معالجة المشروبات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Food Processing Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات معالجة الأغذية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dairy Processing Machines',
                                    'ar' => 'آلات معالجة الألبان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Food Processing Machines',
                                    'ar' => 'آلات معالجة الأغذية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fruit Processing Machines',
                                    'ar' => 'آلات معالجة الفاكهة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Grain Processing Machines',
                                    'ar' => 'آلات معالجة الحبوب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Meat Processing Machines',
                                    'ar' => 'آلات معالجة اللحوم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Oil Processing Machines',
                                    'ar' => 'آلات معالجة الزيوت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mixer',
                                    'ar' => 'ميسنر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pet Food Processing Machines',
                                    'ar' => 'آلات معالجة طعام الحيوانات الأليفة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Poultry Processing Machines',
                                    'ar' => 'آلات معالجة الدواجن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Seafood Processing Machines',
                                    'ar' => 'آلات معالجة المكونات البحرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Snack Food Machines',
                                    'ar' => 'آلات الوجبات الخفيفة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sugar Processing Machines',
                                    'ar' => 'آلات معالجة السكر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vegetable Processing Machines',
                                    'ar' => 'آلات معالجة الخضروات'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Mixing Equipment',
                            'ar' => 'معدات-خلط'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Circular Mixer',
                                    'ar' => 'خلاط دائري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Concrete Mixer',
                                    'ar' => 'خلاط خرسانة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dispersion Mixer',
                                    'ar' => 'خلاط تشتيت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Double Cone Mixer',
                                    'ar' => 'خلاط مخروطي مزدوج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Two-Shaft Mixer',
                                    'ar' => 'خلاط ذو عمودين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cylindrical Mixer',
                                    'ar' => 'خلاط أسطواني'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Homogenizer',
                                    'ar' => 'جهاز تجانس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Horizontal Mixer',
                                    'ar' => 'خلاط أفقي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Laboratory Mixing Equipment',
                                    'ar' => 'معدات خلط مختبرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mixing Equipment Components',
                                    'ar' => 'مكونات معدات الخلط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mixing Tank',
                                    'ar' => 'خزان خلط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Paddle Mixer',
                                    'ar' => 'خلاط مملوط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'PVC Mixer',
                                    'ar' => 'خلاط PVC'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Paddle Mixer',
                                    'ar' => 'خلاط ذو مجداف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Planetary Mixer',
                                    'ar' => 'خلاط كوكبي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rotating Mixer \u002F Cylindrical Mixer',
                                    'ar' => 'خلاط دوار \u002F خلاط أسطواني'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Spiral Mixer',
                                    'ar' => 'خلاط حلزوني'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'V-shaped Mixer',
                                    'ar' => 'خلاط على شكل حرف V'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vertical Mixer',
                                    'ar' => 'خلاط عمودي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Mixing Equipment',
                                    'ar' => 'معدات خلط أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Chemical Equipment',
                            'ar' => 'معدات-كيميائية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Chemical Machines',
                                    'ar' => 'آلات كيميائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chemical Machine Spare Parts',
                                    'ar' => 'قطع غيار آلات كيميائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chemical Storage Equipment',
                                    'ar' => 'معدات تخزين المواد الكيميائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chemical Transfer Equipment',
                                    'ar' => 'معدات نقل المواد الكيميائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chemical Equipment Spare Parts',
                                    'ar' => 'قطع غيار المعدات الكيميائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chemical Reactor',
                                    'ar' => 'مفاعل كيميائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pressure Vessel',
                                    'ar' => 'وعاء ضغط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Chemical Equipment and Machines',
                                    'ar' => 'معدات وآلات كيميائية أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Oil Equipment and Machinery',
                            'ar' => 'معدات-والالات-نفطية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Mud Circulation System',
                                    'ar' => 'نظام تدوير الطين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Oil Well Drilling Equipment',
                                    'ar' => 'جهاز حفر آبار النفط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Oil Shale Separator \u002F Oil Mud Shaker',
                                    'ar' => 'جهاز فصل الصخر الزيتي \u002F هزاز طين النفط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Oil Equipment Spare Parts',
                                    'ar' => 'قطع غيار آلات النفط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pumping Unit',
                                    'ar' => 'وحدة ضخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wellhead Tree \u002F Wellhead',
                                    'ar' => 'شجرة رأس البئر \u002F رأس البئر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Oil Equipment and Machinery',
                                    'ar' => 'معدات وآلات نفطية أخرى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cement Fixing Tool',
                                    'ar' => 'أداة التثبيت بالأسمنت'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Lighting \u002F Fire Fighting',
                    'ar' => 'إضاءة-ومصابيح'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Emergency Lights',
                            'ar' => 'أضواء-الطوارئ'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Emergency Light',
                                    'ar' => 'أضواء ملاحة الطائرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fire Fighting Light',
                                    'ar' => 'مصباح الطوارئ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fire Fighting Headlamp',
                                    'ar' => 'مصباح مؤشر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Emergency Light',
                                    'ar' => 'مصباح طوارئ LED'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fire Fighting Warning Light',
                                    'ar' => 'مصباح تحذير'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'LED Outdoor Lighting',
                            'ar' => 'إضاءة-LED-الخارجية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'LED Garden Light',
                                    'ar' => 'LED مصباح حديقة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED High Column Light',
                                    'ar' => 'LED مصباح عمود عالي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Grass Light',
                                    'ar' => 'LED مصباح عشب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Outdoor Wall Light',
                                    'ar' => 'LED مصباح حائط خارجي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Directional Light',
                                    'ar' => 'LED مصباح توجيه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Street Light',
                                    'ar' => 'LED مصباح شارع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Tunnel Light',
                                    'ar' => 'LED مصباح نفق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Ground Light',
                                    'ar' => 'LED مصباح أرضي'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'LED Indoor Lighting',
                            'ar' => 'إضاءة-LED-الداخلية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Candle Light',
                                    'ar' => 'ضوء الشموع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dimmable Lights',
                                    'ar' => 'مصابيح قابلة للتعتيم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Globe Light',
                                    'ar' => 'LED مصباح كروي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Ceiling Light',
                                    'ar' => 'LED مصباح سقف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Integrated Light',
                                    'ar' => 'LED مصباح مدمج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Grid Light',
                                    'ar' => 'LED مصباح شبكي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'High Rise LED Light',
                                    'ar' => 'عالي الارتفاع LED مصباح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Linear Light',
                                    'ar' => 'LED مصباح خطي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Panel Light',
                                    'ar' => 'LED مصباح لوحي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Pendant Light',
                                    'ar' => 'LED مصباح متدلي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Table Light & LED Desk Light',
                                    'ar' => 'ومصباح كتب LED مصباح طاولة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Track Light',
                                    'ar' => 'LED ضوء المسار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Tube Light',
                                    'ar' => 'LED مصباح أنبوبي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Wall Light',
                                    'ar' => 'LED مصباح حائط'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Professional Lighting',
                            'ar' => 'إضاءة-احترافية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Lighting Equipment',
                                    'ar' => 'مصباح تجهيم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Insect Traps',
                                    'ar' => 'مصائد الحشرات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Theater Lighting',
                                    'ar' => 'إضاءة المسارح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Fiber Optic Lights',
                                    'ar' => 'LED أضواء ألياف بصرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lighting Towers',
                                    'ar' => 'أبراج الإضاءة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Motion Sensor Lights',
                                    'ar' => 'مصباح حساس للحركة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Holiday Lighting',
                            'ar' => 'إضاءة-الأعياد'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Holiday Lights',
                                    'ar' => 'أضواء الأعياد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Decorative Lighting',
                                    'ar' => 'إضاءة زينة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'New Year Lights',
                                    'ar' => 'أضواء رأس السنة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Party Lights',
                                    'ar' => 'أضواء الحفلات'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Outdoor Lighting',
                            'ar' => 'إضاءة-خارجية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Garden Lights',
                                    'ar' => 'أضواء الحديقة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lamp Posts',
                                    'ar' => 'أعمدة المصابيح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Grass Lights',
                                    'ar' => 'مصابيح العشب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'External Wall Lights',
                                    'ar' => 'مصابيح جدارية خارجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Street Lights',
                                    'ar' => 'أضواء الشوارع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Underground Lights',
                                    'ar' => 'مصابيح تحت الأرض'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Underwater Lights',
                                    'ar' => 'أضواء تحت الماء'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Indoor Lighting',
                            'ar' => 'إضاءة-داخلية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Pendant Lights',
                                    'ar' => 'مصابيح متدلية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Table Light and Reading Light',
                                    'ar' => 'مصباح طاولة ومصباح قراءة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ceiling Light',
                                    'ar' => 'مصباح سقف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wall Light',
                                    'ar' => 'مصباح حائط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Integrated Light',
                                    'ar' => 'مصباح مدمج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Floor Light',
                                    'ar' => 'مصباح أرضي'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Industrial Lighting',
                            'ar' => 'إضاءة-صناعية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'High Bay Lights',
                                    'ar' => 'مصابيح علوية عالية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Low Bay Lights',
                                    'ar' => 'مصابيح علوية منخفضة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'High Bay Linear Lights',
                                    'ar' => 'مصابيح خطية علوية عالية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Spotlights',
                                    'ar' => 'كشافات صناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Area Lighting Fixtures',
                                    'ar' => 'مصابيح إضاءة مساحات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Moisture Resistant Lights',
                                    'ar' => 'مصابيح مقاومة للرطوبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Illuminated Exit Signs',
                                    'ar' => 'علامات الخروج المضيئة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Commercial LED Lights',
                                    'ar' => 'LED مصابيح التجارية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial LED Strips',
                                    'ar' => 'صناعية LED شرائط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Pendant Lights',
                                    'ar' => 'مصابيح متدلية صناعية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Portable Lighting',
                            'ar' => 'إضاءة-محمولة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Portable Lights',
                                    'ar' => 'مصابيح محمولة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Head Lights',
                                    'ar' => 'أضواء الرأس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Storm Lanterns',
                                    'ar' => 'فوانيس الطقس العاصف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Portable Floodlights',
                                    'ar' => 'أضواء كاشفة محمولة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Lighting Decoration',
                            'ar' => 'ديكور-الإضاءة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Chandelier',
                                    'ar' => 'ثريا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fiber Optic Lighting',
                                    'ar' => 'إضاءة ألياف بصرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lantern',
                                    'ar' => 'فانوس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Light',
                                    'ar' => 'مصباح معدني'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Decorative Lighting',
                                    'ar' => 'إضاءة زخرفية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Neon Lighting',
                                    'ar' => 'إضاءة نيون'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Light Rope',
                                    'ar' => 'حبل ضوئي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tunnel Light',
                                    'ar' => 'مصباح نفقاني'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'LED Packaging Chain',
                            'ar' => 'سلسلة-تغليف-LED'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'LED Thin Flip Chip',
                                    'ar' => 'LED رقائق قليب شيب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'High Power LED',
                                    'ar' => 'عالي الطاقة LED'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Dot Matrix',
                                    'ar' => 'المصفوفة النقطية LED'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Module',
                                    'ar' => 'وحدة LED'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Lamp',
                                    'ar' => 'مصباح LED'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Surface Mount LED',
                                    'ar' => 'مثبت على السطح LED'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ultra Bright LED',
                                    'ar' => 'فائق التدفق LED'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Lamps and Lighting Tubes',
                            'ar' => 'مصابيح-وأنابيب-الإضاءة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Fluorescent Tubes',
                                    'ar' => 'أنابيب الفلوريسنت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Halogen Lamps',
                                    'ar' => 'مصابيح الهالوجين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'High Pressure Sodium Lamps',
                                    'ar' => 'مصابيح الصوديوم عالية الضغط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Incandescent Lamps',
                                    'ar' => 'مصابيح متوهجة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mercury Lamps',
                                    'ar' => 'مصابيح الزئبق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Halide Lamps',
                                    'ar' => 'مصابيح الهاليد المعدني'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Neon Lamps and Tubes',
                                    'ar' => 'مصابيح وأنابيب النيون'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'UV Lamps',
                                    'ar' => 'مصابيح الأشعة فوق البنفسجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Xenon Lamps',
                                    'ar' => 'مصابيح الزينون'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Energy Saving and Fluorescent Lamps',
                                    'ar' => 'مصابيح موفرة للطاقة والفلور سنت'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Lighting Accessories',
                            'ar' => 'ملحقات-الإضاءة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Lighting Problems',
                                    'ar' => 'مشكلات الإضاءة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Light Dimmers',
                                    'ar' => 'مخففات الضوء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lamp Covers and Shades',
                                    'ar' => 'أغلفة ومظلات المصابيح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lamp Holders and Bases',
                                    'ar' => 'حاملات وقواعد المصابيح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lighting Transformers',
                                    'ar' => 'محولات الإضاءة'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Fashion Accessories',
                    'ar' => 'إكسسورات-عصرية'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Belts',
                            'ar' => 'أحزمة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'a package adorned with beads',
                                    'ar' => 'حزمة مرصعة بالخرز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Belt Buckles',
                                    'ar' => 'مشابك الأحزمة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Belt Chains',
                                    'ar' => 'سلاسل الأحزمة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sash Belts',
                                    'ar' => 'أحزمة ساساس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fabric Belts',
                                    'ar' => 'أحزمة من القماش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Natural Leather Belts',
                                    'ar' => 'أحزمة من الجلد الطبيعي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gold-Plated Belts',
                                    'ar' => 'أحزمة مطلية بالذهب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Woven Belts',
                                    'ar' => 'أحزمة محبوكة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Leather Belts',
                                    'ar' => 'أحزمة جلدية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Belts',
                                    'ar' => 'أحزمة بلاستيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'PVC Belts',
                                    'ar' => 'أحزمة من PVC'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Silver-Plated',
                                    'ar' => 'مطلي بالفضة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Suspenders',
                                    'ar' => 'حمالات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Belt Accessories',
                                    'ar' => 'إكسسوارات الأحزمة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Head Coverings',
                            'ar' => 'أغطية-الرأس'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Bandanas',
                                    'ar' => 'بندانات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Beanies and Skull Caps',
                                    'ar' => 'بينيه وقبعات الجمجمة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hair Accessories',
                                    'ar' => 'إكسسوارات الشعر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hats',
                                    'ar' => 'قبعات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Scarves',
                                    'ar' => 'أوشحة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shawls',
                                    'ar' => 'شالات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Head Covering Accessories',
                                    'ar' => 'إكسسوارات أغطية الرأس'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Neck Clothing',
                            'ar' => 'ألبسة-العنق'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Neckties',
                                    'ar' => 'كرافات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Neck Scarves',
                                    'ar' => 'أوشحة عنق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Neck Ties',
                                    'ar' => 'ربطات عنق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Neck Clothing Accessories',
                                    'ar' => 'اكسسورات لباس العنق'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Gloves',
                            'ar' => 'قفازات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Acrylic Gloves',
                                    'ar' => 'قفازات أكريليك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cotton Gloves',
                                    'ar' => 'قفازات من القطن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Feather Gloves',
                                    'ar' => 'قفازات من الريش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Leather Gloves',
                                    'ar' => 'قفازات من الجلد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Nylon Gloves',
                                    'ar' => 'قفازات من النايلون'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wool Gloves',
                                    'ar' => 'قفازات من الصوف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Glove Accessories',
                                    'ar' => 'اكسسورات القفازات'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Glasses',
                            'ar' => 'نظارات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Medical Glasses',
                                    'ar' => 'نظارات طبية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sunglasses',
                                    'ar' => 'نظارات شمسية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Reading Glasses',
                                    'ar' => 'نظارات قراءة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sports Glasses',
                                    'ar' => 'نظارات رياضية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Swimming Glasses',
                                    'ar' => 'نظارات سباحة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Protective Glasses',
                                    'ar' => 'نظارات واقية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Virtual Reality Glasses',
                                    'ar' => 'نظارات الواقع الافتراضي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Augmented Reality Glasses',
                                    'ar' => 'نظارات الواقع المعزز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Glasses Frames',
                                    'ar' => 'إطارات نظارات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Contact Lenses',
                                    'ar' => 'عدسات لاصقة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Medical Glasses Frames',
                                    'ar' => 'إطارات نظارات طبية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Glasses Accessories',
                                    'ar' => 'اكسسورات النظارات'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Furniture',
                    'ar' => 'الأثاث'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Baby Furniture',
                            'ar' => 'أثاث أطفال رضع'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Children Playroom',
                                    'ar' => 'حاضنة لعب للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children Furniture Attachments',
                                    'ar' => 'ملحقات أثاث الأطفال الرضع'
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Children Furniture',
                            'ar' => 'أثاث-أطفال'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Children Beds',
                                    'ar' => 'خزائن أطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children Furniture Sets',
                                    'ar' => 'مجموعات أثاث أطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children Tables',
                                    'ar' => 'طاولات أطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children Furniture Attachments',
                                    'ar' => 'ملحقات أثاث الأطفال'
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Antique Furniture',
                            'ar' => 'أثاث-أنتيكا'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Antique Beds',
                                    'ar' => 'سرير أنتيكا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Antique Wardrobes',
                                    'ar' => 'خزائن أنتيكا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Antique Chairs',
                                    'ar' => 'كراسي أنتيكا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Antique Furniture Sets',
                                    'ar' => 'مجموعات أثاث أنتيكا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Antique Tables',
                                    'ar' => 'طاولات أنتيكا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Antique Furniture Attachments',
                                    'ar' => 'ملحقات أثاث أنتيكا'
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Commercial Furniture',
                            'ar' => 'أثاث-تجاري'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Computer Tables',
                                    'ar' => 'طاولات كمبيوتر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Computer Chairs',
                                    'ar' => 'كراسي كمبيوتر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Meeting Tables',
                                    'ar' => 'طاولات اجتماعات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'File Cabinets',
                                    'ar' => 'خزائن ملفات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Office Chairs',
                                    'ar' => 'كراسي مكتب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Desks',
                                    'ar' => 'مكاتب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Office Books',
                                    'ar' => 'كتب مكاتب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Commercial Furniture Accessories',
                                    'ar' => 'ملحقات الأثاث التجاري'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Hotel Furniture',
                            'ar' => 'أثاث-فنادق'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Hotel Bedroom Set',
                                    'ar' => 'طقم نوم فندقي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hotel Beds',
                                    'ar' => 'أسرة فندقية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hotel Chairs',
                                    'ar' => 'كراسي فندقية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hotel Books',
                                    'ar' => 'كتب فندقية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hotel Cart',
                                    'ar' => 'عربة فندقية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hotel Buffet',
                                    'ar' => 'بوفيه فندقية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hotel Furniture Accessories',
                                    'ar' => 'ملحقات أثاث فنادق'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Foldable Furniture',
                            'ar' => 'أثاث-قابل-للطي'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Foldable Bed',
                                    'ar' => 'سرير قابل للطي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Foldable Chairs',
                                    'ar' => 'كراسي قابل للطي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Foldable Furniture Sets',
                                    'ar' => 'مجموعات أثاث قابلة للطي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Foldable Tables',
                                    'ar' => 'طاولات قابلة للطي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Foldable Furniture Accessories',
                                    'ar' => 'ملحقات الأثاث القابل للطي'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'School Furniture',
                            'ar' => 'أثاث-مدارس'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Cafeteria Furniture',
                                    'ar' => 'أثاث كافتيريا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Kindergarten Furniture',
                                    'ar' => 'أثاث رياض الأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'School Chairs',
                                    'ar' => 'كراسي مدرسية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'School Desks',
                                    'ar' => 'مكاتب مدرسية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'School Tables and Chairs',
                                    'ar' => 'طاولات و كراسي مدرسية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'School Furniture Accessories',
                                    'ar' => 'ملحقات أثاث مدارس'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Hospital Furniture',
                            'ar' => 'أثاث-مستشفيات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Hospital Beds',
                                    'ar' => 'أسرة مستشفيات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hospital Cabinets',
                                    'ar' => 'خزائن المستشفيات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hospital Chairs',
                                    'ar' => 'كراسي المستشفيات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hospital Tables',
                                    'ar' => 'طاولات المستشفيات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hospital Carts',
                                    'ar' => 'عربات المستشفيات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hospital Furniture Accessories',
                                    'ar' => 'ملحقات أثاث مستشفيات'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Restaurant Furniture',
                            'ar' => 'أثاث-مطاعم'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Restaurant Chairs',
                                    'ar' => 'كراسي مطاعم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Restaurant Sets',
                                    'ar' => 'طقم مطاعم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Restaurant Tables',
                                    'ar' => 'طاولات مطاعم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Restaurant Furniture Accessories',
                                    'ar' => 'ملحقات أثاث مطاعم'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Home Furniture',
                            'ar' => 'أثاث-منزلي'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Bedroom Furniture',
                                    'ar' => 'أثاث غرف النوم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Living Room Furniture',
                                    'ar' => 'أثاث غرفة المعيشة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Kitchen Furniture',
                                    'ar' => 'أثاث مطبخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dining Room Furniture',
                                    'ar' => 'أثاث غرفة الطعام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Home Furniture Accessories',
                                    'ar' => 'ملحقات أثاث منزلي'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Furniture Appliances',
                            'ar' => 'أجهزة-أثاث'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Door Locks',
                                    'ar' => 'أقفال أبواب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Home Doors',
                                    'ar' => 'أبواب منزلية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Furniture Screws',
                                    'ar' => 'مسامير الأثاث'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Furniture Wheels',
                                    'ar' => 'عجلات الأثاث'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Furniture Handles and Keys',
                                    'ar' => 'مسكات ومفاتيح الأثاث'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Furniture Hinges',
                                    'ar' => 'مفصلات الأثاث'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Furniture Locks',
                                    'ar' => 'أقفال الأثاث'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Plastic Furniture',
                            'ar' => 'اثاث-بلاستيكي'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Plastic Beds',
                                    'ar' => 'أسرة بلاستيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Chairs',
                                    'ar' => 'كراسي بلاستيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Furniture Sets',
                                    'ar' => 'طقم أثاث بلاستيكي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Bathroom Chairs',
                                    'ar' => 'كراسي حمام بلاستيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Tables',
                                    'ar' => 'طاولات بلاستيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Furniture Accessories',
                                    'ar' => 'ملحقات أثاث بلاستيكي'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Outdoor Furniture',
                            'ar' => 'اثاث-خارجي'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Beach Chairs',
                                    'ar' => 'كراسي شاطئ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Garden Chairs',
                                    'ar' => 'كراسي حديقة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Garden Sets',
                                    'ar' => 'طقم حديقة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Garden Books',
                                    'ar' => 'كتب حديقة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Swings',
                                    'ar' => 'أرجوحة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Net Swings',
                                    'ar' => 'أرجوحة شبكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Outdoor Tables',
                                    'ar' => 'طاولات خارجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Patio Seats',
                                    'ar' => 'مقاعد فناء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Patio Swings',
                                    'ar' => 'أرجوحة فناء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Patio Umbrellas and Bases',
                                    'ar' => 'مظلات فناء و قواعدها'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sun Loungers',
                                    'ar' => 'كراسي استلقاء شمسي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Outdoor Furniture Accessories',
                                    'ar' => 'ملحقات اثاث خارجي'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Furniture Parts and Accessories',
                            'ar' => 'قطع-غيار-وإكسسوارات-الأثاث'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Chair Mechanisms',
                                    'ar' => 'آليات الكراسي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Furniture Frames',
                                    'ar' => 'إطارات الأثاث'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Furniture Legs',
                                    'ar' => 'أرجل الأثاث'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Home Appliances',
                    'ar' => 'الأجهزة-المنزلية'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Home Heating Appliances',
                            'ar' => 'أجهزة-التدفئة-المنزلية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Electric Heaters',
                                    'ar' => 'مدافئ كهربائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Stoves',
                                    'ar' => 'سخانات كهربائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gas Stoves',
                                    'ar' => 'سخانات غاز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gas Heaters',
                                    'ar' => 'سخانات كيروسين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Blankets',
                                    'ar' => 'بطانيات كهربائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Warmers',
                                    'ar' => 'مدافئ القدم واليد'
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Cleaning Appliances',
                            'ar' => 'أجهزة-التنظيف'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Steam Cleaners',
                                    'ar' => 'منظفات البخار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ultrasonic Cleaners',
                                    'ar' => 'منظفات بالموجات فوق الصوتية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Vacuum Cleaners',
                                    'ar' => 'مكانس كهربائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Handheld Electric Vacuum Cleaners',
                                    'ar' => 'مكانس كهربائية يدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Window Cleaners',
                                    'ar' => 'منظف النوافذ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dust Control Devices',
                                    'ar' => 'أجهزة تحكم عن الغبار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'UV Sterilizers',
                                    'ar' => 'المعقمات فوق البنفسجية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Cooking Appliances',
                            'ar' => 'أجهزة-الطهي'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Bread Making Machines',
                                    'ar' => 'آلات صنع الخبز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chocolate Fountains',
                                    'ar' => 'تواجيد الشوكولاتة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cooking Stoves',
                                    'ar' => 'مواقد الطهي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Crepe Making Machines',
                                    'ar' => 'آلات صنع الكريب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Egg Boiling Devices',
                                    'ar' => 'أجهزة غلي البيض'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Stoves',
                                    'ar' => 'المواقد الكهربائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Steam Cookers',
                                    'ar' => 'قدر الطعام البخاري الكهربائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Pressure Cookers',
                                    'ar' => 'طناجر الضغط الكهربائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Charging Plates',
                                    'ar' => 'لوحات شحن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electronic Stoves',
                                    'ar' => 'مواقد إلكترونية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Microwave Ovens',
                                    'ar' => 'أقران الميكروويف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ovens',
                                    'ar' => 'أقران'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pancake Making Machines',
                                    'ar' => 'آلات صنع البانكيك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rice Cooking Devices',
                                    'ar' => 'أجهزة طهي الأرز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rotary Grills',
                                    'ar' => 'شوايات دوارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sandwich Making Machines',
                                    'ar' => 'آلات صنع الساندويتش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Slow Cooking Devices',
                                    'ar' => 'أجهزة الطهي البطيء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Twist Ovens',
                                    'ar' => 'أقران تويست'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bread Toasters',
                                    'ar' => 'محمصات الخبز'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Washing Appliances',
                            'ar' => 'أجهزة-الغسيل'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Clothes Dryers',
                                    'ar' => 'مجففات الملابس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Clothing Irons',
                                    'ar' => 'مكواة ملابس كهربائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Steam Clothing Irons',
                                    'ar' => 'مكواة ملابس بالبخار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Washing Machines',
                                    'ar' => 'غسالات الملابس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Automatic Front-Loading Washing Machines',
                                    'ar' => 'غسالات أوتوماتيك تحميل أمامي'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Home Kitchen Appliances',
                            'ar' => 'أجهزة-المطبخ-المنزلية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Blenders',
                                    'ar' => 'خلاطات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Coffee Grinder',
                                    'ar' => 'مطحنة القهوة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Coffee Making Machine',
                                    'ar' => 'مكينة صنع القهوة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Coffee Freezer',
                                    'ar' => 'مجمدة القهوة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dishwasher',
                                    'ar' => 'غسالة الأطباق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sterilization Cabinets',
                                    'ar' => 'كابينات التعقيم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vegetable Washer',
                                    'ar' => 'غسالة الخضروات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Kettles',
                                    'ar' => 'غلايات كهربائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Food Blenders',
                                    'ar' => 'خلاطات الطعام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Food Processors',
                                    'ar' => 'معالجات الطعام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Garbage Disposal',
                                    'ar' => 'مفرمة النفايات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ice Cream Making Machines',
                                    'ar' => 'آلات صنع الآيس كريم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ice Crushers',
                                    'ar' => 'كسارات الثلج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Juicers',
                                    'ar' => 'عصارات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Meat Grinders',
                                    'ar' => 'مكائن فرم اللحم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Popcorn Making Machines',
                                    'ar' => 'مكائن صنع الفشار'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Water Heating Appliances',
                            'ar' => 'أجهزة-تسخين-المياه'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Electric Water Heaters',
                                    'ar' => 'سخانات المياه الكهربائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gas Water Heaters',
                                    'ar' => 'سخانات المياه بالغاز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Heat Pump Water Heaters',
                                    'ar' => 'سخانات المياه بضغط الحرارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Home Solar Water Heaters',
                                    'ar' => 'سخانات المياه الشمسية المنزلية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Air Conditioning Appliances',
                            'ar' => 'أجهزة-تكييف-الهواء'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Air Conditioners',
                                    'ar' => 'مكيفات الهواء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Air Purification',
                                    'ar' => 'تنقية الهواء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dehumidifiers',
                                    'ar' => 'مجففات الرطوبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fans',
                                    'ar' => 'مراوح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Air Humidifiers',
                                    'ar' => 'مرطبات الهواء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Air Handling Units',
                                    'ar' => 'وحدات معالجة الهواء'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Water Treatment Appliances',
                            'ar' => 'أجهزة-معالجة-المياه'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Water Distributors',
                                    'ar' => 'موزعات المياه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water Filters',
                                    'ar' => 'مرشحات المياه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water Purifiers and Sterilizers',
                                    'ar' => 'منقيات ومعقمات المياه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water Pumps',
                                    'ar' => 'مضخات المياه'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'General Home Appliances',
                            'ar' => 'أجهزة-منزلية-عامة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Hand Dryers',
                                    'ar' => 'مجففات الأيدي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Televisions',
                                    'ar' => 'تلفزيونات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wet Towel Dispensers',
                                    'ar' => 'موزعات المناشف الرطبة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Refrigerators and Freezers',
                            'ar' => 'ثلاجات-ومجمدات-(فريزرات)'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Freezers',
                                    'ar' => 'مجمدات (فريزرات)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ice Makers',
                                    'ar' => 'صانعات الثلج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Refrigerators',
                                    'ar' => 'ثلاجات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Horizontal Freezers',
                                    'ar' => 'مجمدات أفقية (فريزرات)'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Home Appliances Spare Parts',
                            'ar' => 'قطع-غيار-الأجهزة-المنزلية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Air Conditioning Appliances Spare Parts',
                                    'ar' => 'قطع غيار أجهزة تكييف الهواء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cleaning Appliances Spare Parts',
                                    'ar' => 'قطع غيار أجهزة التنظيف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hand Dryers Spare Parts',
                                    'ar' => 'قطع غيار مجففات الأيدي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Home Heating Appliances Spare Parts',
                                    'ar' => 'قطع غيار أجهزة التدفئة المنزلية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Kitchen Appliances Spare Parts',
                                    'ar' => 'قطع غيار أجهزة المطبخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Washing Appliances Spare Parts',
                                    'ar' => 'قطع غيار أجهزة الغسيل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Refrigerators and Freezers Spare Parts',
                                    'ar' => 'قطع غيار الثلاجات والمجمدات (فريزرات)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water Heating Appliances Spare Parts',
                                    'ar' => 'قطع غيار أجهزة تسخين المياه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water Treatment Appliances Spare Parts',
                                    'ar' => 'قطع غيار أجهزة معالجة المياه'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Industrial Tools and Equipment',
                    'ar' => 'الأدوات والمعدات الصناعية ومكوناتها'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Safety Equipment',
                            'ar' => 'أجهزة حماية البيئة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Industrial Air Purification Equipment',
                                    'ar' => 'معدات تنقية الهواء الصناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electronics recycling machine',
                                    'ar' => 'آلة إعادة تدوير الإلكترونيات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Noise Reduction Device',
                                    'ar' => 'جهاز تخفيف الضوضاء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sewage treatment equipment',
                                    'ar' => 'معدات معالجة الصرف الصحي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Waste processing equipment',
                                    'ar' => 'معدات معالجة النفايات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water treatment equipment',
                                    'ar' => 'معدات معالجة المياة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'water tank',
                                    'ar' => 'خزان ماء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chemicals for water treatment',
                                    'ar' => 'مواد كيميائية لمعالجة المياه'
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Drilling Tools',
                            'ar' => 'أدوات-الحفر'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Drilling Bits',
                                    'ar' => 'مثقاب الحفر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drilling Collars',
                                    'ar' => 'طوق الحفر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drilling Rods',
                                    'ar' => 'قضيب الحفر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drilling Sleeves',
                                    'ar' => 'أكمام الحفر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drilling Stabilizers',
                                    'ar' => 'مثبت الحفر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Soil Drill Bits',
                                    'ar' => 'مثقاب ترابي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Drill Bits',
                                    'ar' => 'مثقاب كهربائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shock Absorbers',
                                    'ar' => 'ممتص الصدمات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Drilling Tools',
                                    'ar' => 'أدوات حفر أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Measurement Tools',
                            'ar' => 'أدوات-القياس'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Geographic Survey Tools',
                                    'ar' => 'أدوات المسح الجغرافي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electrical Meters',
                                    'ar' => 'مقياس الكهرباء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Liquid and Gas Meters',
                                    'ar' => 'مقياس السوائل والغازات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Physical Measurement Devices',
                                    'ar' => 'أجهزة قياس فيزيائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Weight and Measurement Devices',
                                    'ar' => 'أجهزة الوزن والقياس'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Scraping and Sanding Tools',
                            'ar' => 'أدوات-الكشط-والصنفرة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Scraping Brush',
                                    'ar' => 'فرشاة كشط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Abrasive Cloth and Mesh',
                                    'ar' => 'قماش وشبكة كاشطة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Abrasive Grains',
                                    'ar' => 'حبيبات كاشطة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Scraping Disc',
                                    'ar' => 'قرص كشط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sandpaper',
                                    'ar' => 'صنفرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sanding Ball and Grains',
                                    'ar' => 'كرة وحبات صنفرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sanding Disc and Head',
                                    'ar' => 'قرص ورأس صنفرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sanding Powder',
                                    'ar' => 'بودرة صنفرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sanding Rod',
                                    'ar' => 'قضيب صنفرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Non-woven Abrasive Materials',
                                    'ar' => 'مواد كاشطة غير منسوجة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Polishing Pad',
                                    'ar' => 'وسادة تلميع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Scraping and Sanding Tools',
                                    'ar' => 'أدوات كشط وصنفرة أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Electrical and Air Tools',
                            'ar' => 'أدوات-كهربائية-وهوائية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'High Pressure Gun',
                                    'ar' => 'مسدس ضغط عالي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Air Drill and Hammer',
                                    'ar' => 'مثقاب ومطرقة هوائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Air Staple Gun',
                                    'ar' => 'مسدس دبابيس هوائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Air Rivet Gun',
                                    'ar' => 'مسدس مسامير برشام هوائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Air Spray Gun',
                                    'ar' => 'مسدس رش هوائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Air Screwdriver',
                                    'ar' => 'مفك براغي هوائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Air Tools',
                                    'ar' => 'أدوات هوائية أخرى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Spreader',
                                    'ar' => 'منتشار كهربائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Screwdriver',
                                    'ar' => 'مفك براغي كهربائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Impact Wrench',
                                    'ar' => 'مفتاح ربط كهربائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Grease Pump',
                                    'ar' => 'مضخة تشحيم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Heat Gun',
                                    'ar' => 'مسدس حراري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pipe Threading Machine',
                                    'ar' => 'ماكينة تشكيل خيوط الأنابيب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Tool Accessories',
                                    'ar' => 'ملحقات الأدوات الكهربائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electric Tool Sets',
                                    'ar' => 'مجموعة أدوات كهربائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Electric Tools',
                                    'ar' => 'أدوات كهربائية أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Hydraulic Tools and Parts',
                            'ar' => 'أدوات-واجزاء-هيدروليكية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Hydraulic Reservoir',
                                    'ar' => 'مُخزِّن هيدروليكي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hydraulic Cylinder',
                                    'ar' => 'أسطوانة هيدروليكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hydraulic Connections',
                                    'ar' => 'وصلات هيدروليكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hydraulic Motor',
                                    'ar' => 'موتور هيدروليكي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hydraulic Pipe',
                                    'ar' => 'أنبوب هيدروليكي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hydraulic Power Unit',
                                    'ar' => 'وحدة طاقة هيدروليكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hydraulic Pump',
                                    'ar' => 'مضخة هيدروليكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hydraulic Seal',
                                    'ar' => 'سدادة هيدروليكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hydraulic System',
                                    'ar' => 'نظام هيدروليكي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hydraulic Valve',
                                    'ar' => 'صمام هيدروليكي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Hydraulic Parts',
                                    'ar' => 'أجزاء هيدروليكية أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Manual Tools',
                            'ar' => 'أدوات-يدوية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Cutting Tools',
                                    'ar' => 'أدوات القطع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Installation and Assembly Tools',
                                    'ar' => 'أدوات التثبيت والتركيب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shaping and Molding Tools',
                                    'ar' => 'أدوات التشكيل والقوالب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pliers Tools',
                                    'ar' => 'أدوات الملاقط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Disassembly and Opening Tools',
                                    'ar' => 'أدوات الفك والفتح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chains and Ropes',
                                    'ar' => 'سلاسل وحبال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Corner Angle Brackets',
                                    'ar' => 'أقواس زاوية الزوايا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Clamps',
                                    'ar' => 'شداده'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fixed Covers',
                                    'ar' => 'أغطية ثابتة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plumbing Tools and Accessories',
                                    'ar' => 'أدوات السباكة ومستلزماتها'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Manual Tool Sets',
                                    'ar' => 'مجموعة أدوات يدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Manual Tools',
                                    'ar' => 'أدوات يدوية أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Industrial Compressors and Brakes',
                            'ar' => 'الضاغط-والفرامل-الصناعية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Centrifugal Compressor',
                                    'ar' => 'ضاغط طرد مركزي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Compressor Unit',
                                    'ar' => 'وحدة ضاغط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Reciprocating Compressor',
                                    'ar' => 'ضاغط تكافؤي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Primary Compressor',
                                    'ar' => 'ضاغط أولي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Screw Compressor',
                                    'ar' => 'ضاغط حلزوني'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Compressor Spare Parts',
                                    'ar' => 'قطع غيار ضاغط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Types of Compressors',
                                    'ar' => 'أنواع أخرى من الضواغط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Brakes',
                                    'ar' => 'فرامل صناعية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Linear Mechanical Actuators and Motors',
                            'ar' => 'المشغل-الميكانيكي-الخطي-والمحركات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Electric Linear Actuator',
                                    'ar' => 'مشغل خطي كهربائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hydraulic Linear Actuator',
                                    'ar' => 'مشغل خطي هيدروليكي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pneumatic Linear Actuator',
                                    'ar' => 'مشغل خطي هوائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Motors and Motor Spare Parts',
                                    'ar' => 'محركات وقطع غيار المحركات'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Transmissions and Power Transmission',
                            'ar' => 'النواقل-ونقل-الطاقة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Belt and Chain Transmission',
                                    'ar' => 'حزام وسلسلة ناقل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tire and Pulley Transmission',
                                    'ar' => 'إطار وبكرة ناقل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Transmission Cylinder',
                                    'ar' => 'أسطوانة ناقل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Types of Transmission Parts and Transmissions',
                                    'ar' => 'أنواع أخرى من اجزاء النواقل و النواقل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chain and Belt Motion Transmission',
                                    'ar' => 'سلسلة وحزام نقل الحركة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Clutch and Gears',
                                    'ar' => 'قابض وتروس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shafts and Shaft Connections',
                                    'ar' => 'أعمدة ووصلات الأعمدة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rotating Motor',
                                    'ar' => 'محرك دوران'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Speed Reducer',
                                    'ar' => 'مخفض سرعة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Motion Transmission Pulley',
                                    'ar' => 'بكرة نقل الحركة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Types of Motion Transmission Parts and Transmissions',
                                    'ar' => 'أنواع أخرى من اجزاء ونواقل الحركة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Valves and Valve Spare Parts',
                            'ar' => 'صمامات-وقطع-غيار-الصمامات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Control Valve',
                                    'ar' => 'صمام تحكم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Membrane Valve',
                                    'ar' => 'صمام غشائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Exhaust Valve',
                                    'ar' => 'صمام عادم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gate Valve',
                                    'ar' => 'صمام بوابة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ball Valve',
                                    'ar' => 'صمام كروي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Inlet Valve',
                                    'ar' => 'صمام بخول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Needle Valve',
                                    'ar' => 'صمام إبرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plug Valve',
                                    'ar' => 'صمام سدادة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pressure Reducing Valve',
                                    'ar' => 'صمام تخفيض الضغط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Safety Valve',
                                    'ar' => 'صمام أمان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sample Valve',
                                    'ar' => 'صمام أخذ عينة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Solenoid Valve',
                                    'ar' => 'صمام مغناطيسي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Steam Trap',
                                    'ar' => 'محبس البخار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Valves and Spare Parts',
                                    'ar' => 'صمامات وقطع غيار أخرى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Valve Actuator',
                                    'ar' => 'مشغل صمام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Valve Ball',
                                    'ar' => 'كرة الصمام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Valve Body',
                                    'ar' => 'جسم الصمام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Valve Cover',
                                    'ar' => 'غطاء الصمام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Valve Needle',
                                    'ar' => 'إبرة الصمام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Valve Seat',
                                    'ar' => 'مقعد الصمام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Valve Stem',
                                    'ar' => 'ساق الصمام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Valve Strainer',
                                    'ar' => 'مصفاة الصمام'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Welding Equipment and Supplies',
                            'ar' => 'مستلزمات-ومعدات-اللحام'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Electrode Holder',
                                    'ar' => 'حامل الإلكترود'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Welding Flux',
                                    'ar' => 'فلوك اللحام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Welding Helmet',
                                    'ar' => 'خوذة اللحام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Welding Rod',
                                    'ar' => 'قضيب اللحام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Welding Torch',
                                    'ar' => 'مشعل اللحام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Welding Wire',
                                    'ar' => 'سلك اللحام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Welding Equipment and Supplies',
                                    'ar' => 'مستلزمات ومعدات لحام أخرى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Welding Arc',
                                    'ar' => 'قوس اللحام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Brass Welding Machine',
                                    'ar' => 'آلة لحام بالنحاس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stick Welding',
                                    'ar' => 'لحام الغب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Friction Welding',
                                    'ar' => 'لحام بالاحتكاك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Laser Welding Machine',
                                    'ar' => 'آلة لحام بالليزر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'MIG Welding (Metal Inert Gas)',
                                    'ar' => 'لحام قوسي بالمعدن والغاز (MIG)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plasma Welding',
                                    'ar' => 'لحام بالبلازما'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Welding',
                                    'ar' => 'لحام البلاستيك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pressure Welding',
                                    'ar' => 'لحام بالضغط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Resistance Welding Machine',
                                    'ar' => 'جهاز لحام بالمقاومة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pipe Welding',
                                    'ar' => 'لحام أنبوبي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Welding Support Equipment',
                                    'ar' => 'معدات لحام مساعدة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Welding Nozzles',
                                    'ar' => 'فوهات اللحام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Welding Equipment',
                                    'ar' => 'معدات لحام أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Cooling and Ventilation Equipment',
                            'ar' => 'معدات-التبريد-والتهوية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Industrial Cooling Rooms',
                                    'ar' => 'غرف تبريد صناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Cooling Towers',
                                    'ar' => 'أبراج تبريد صناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Ice Making Machines',
                                    'ar' => 'آلات صنع الثلج الصناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Coolers',
                                    'ar' => 'مبردات صناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Freezers',
                                    'ar' => 'مجمدات صناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Cooling Equipment and Parts',
                                    'ar' => 'معدات وأجزاء تبريد أخرى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ventilation Opening',
                                    'ar' => 'فتحة تهوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Centrifugal Fans',
                                    'ar' => 'مراوح طرد مركزي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ventilation Channel',
                                    'ar' => 'قناة تهوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ventilation Fan',
                                    'ar' => 'مروحة تهوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Condensers and Evaporators',
                                    'ar' => 'مكثفات ومبخرات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Ventilation Equipment and Parts',
                                    'ar' => 'معدات واجزاء تهوية أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Temperature and Humidity Control Equipment',
                            'ar' => 'معدات-التحكم-في-درجة-الحرارة-والرطوبة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Boiler and Boiler Spare Parts',
                                    'ar' => 'مرجل وقطع غيار مرجل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Furnace and Furnace Spare Parts',
                                    'ar' => 'فرن وقطع غيار الفرن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drying Machine',
                                    'ar' => 'آلة تجفيف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chemical Drying Equipment',
                                    'ar' => 'معدات تجفيف كيميائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Compressed Air Dryer',
                                    'ar' => 'مجفف هواء مضغوط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drying Cabinet',
                                    'ar' => 'خزانة تجفيف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Air Dryer and Spare Parts',
                                    'ar' => 'مجفف وقطع غيار هواء صناعي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Types of Drying Machines',
                                    'ar' => 'أنواع أخرى من آلات التجفيف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Heat Exchanger',
                                    'ar' => 'مبادل حراري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Heat Exchanger Plate',
                                    'ar' => 'لوحة مبادل حراري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Heat Pump',
                                    'ar' => 'مضخة حرارية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Heating Elements and Equipment',
                                    'ar' => 'عناصر ومعدات التسخين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Liquid Cooling Plate',
                                    'ar' => 'لوحة تبريد سائلة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Thermal Unit',
                                    'ar' => 'وحدة حرارية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Steam Room',
                                    'ar' => 'غرفة بخار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Heaters and Heat Exchangers',
                                    'ar' => 'سخانات ومبادلات حرارية أخرى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Air Humidifier',
                                    'ar' => 'مرطب هواء صناعي'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Pumps and Vacuum Equipment',
                            'ar' => 'معدات-المضخات-والتفريغ'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Centrifugal Pump',
                                    'ar' => 'مضخة طرد مركزي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gasoline and Gas Pump',
                                    'ar' => 'مضخة بنزين وغاز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water Pump',
                                    'ar' => 'مضخة مياه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Jet Pump',
                                    'ar' => 'مضخة نفاثة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pressure Pump',
                                    'ar' => 'مضخة ضغط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pump Spare Parts',
                                    'ar' => 'قطع غيار مضخة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Screw Pump',
                                    'ar' => 'مضخة لولبية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Self-Priming Pump',
                                    'ar' => 'مضخة ذاتية التشغيل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vacuum Pump',
                                    'ar' => 'مضخة فراغ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Panel/Pump and Network',
                                    'ar' => 'لوحة \u002F مضخة وشبكة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pump and Vacuum Equipment Spare Parts',
                                    'ar' => 'قطع غيار معدات المضخات والتفريغ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Pump and Vacuum Equipment',
                                    'ar' => 'معدات مضخات وتفريغ أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Gas Generation Equipment',
                            'ar' => 'معدات-توليد-الغاز'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Gas Cylinder',
                                    'ar' => 'أسطوانة غاز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gas Generation Filter',
                                    'ar' => 'فلتر توليد الغاز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gas Purification Device',
                                    'ar' => 'جهاز تنقية الغاز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gas Recovery Unit',
                                    'ar' => 'وحدة استرجاع الغاز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gas Separation Unit',
                                    'ar' => 'وحدة فصل الغاز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gas Tank',
                                    'ar' => 'خزان غاز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gas Generator',
                                    'ar' => 'مولد الغاز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gas Generation Equipment Spare Parts',
                                    'ar' => 'قطع غيار معدات توليد الغاز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Gas Generation Equipment',
                                    'ar' => 'معدات توليد غازات أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Mass Transfer and Separation Equipment',
                            'ar' => 'معدات-نقل-الكتلة-والفصل'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Mass Transfer Equipment',
                                    'ar' => 'معدات نقل الكتلة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mass Transfer Equipment Spare Parts',
                                    'ar' => 'قطع غيار معدات نقل الكتلة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Separation Equipment',
                                    'ar' => 'معدات فصل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Separation Equipment Spare Parts',
                                    'ar' => 'قطع غيار معدات الفصل'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Filtration Equipment and Spare Parts',
                            'ar' => 'معدات-وقطع-غيار-الترشيح'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Air Filter',
                                    'ar' => 'فلتر الهواء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dust Collector',
                                    'ar' => 'جامع الغبار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Filter Bag and Cartridge',
                                    'ar' => 'كيس وخرطوشة فلتر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Filter Cloth',
                                    'ar' => 'قماش فلتر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Filter Element',
                                    'ar' => 'عنصر فلتر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Filter Membrane',
                                    'ar' => 'غشاء فلتر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Filter Mesh',
                                    'ar' => 'شبكة فلتر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Filter Paper',
                                    'ar' => 'ورق فلتر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Filter Plate',
                                    'ar' => 'صفيحة فلتر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Filter Press',
                                    'ar' => 'مكبس فلتر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Foam Filter',
                                    'ar' => 'فلتر رغوي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Water Filter',
                                    'ar' => 'فلتر مياه صناعي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Oil Machine Outlet',
                                    'ar' => 'منفذي زيت الآلات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Oil Filter',
                                    'ar' => 'فلتر الزيت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Reverse Osmosis System',
                                    'ar' => 'نظام التناضح العكسي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Filtration Equipment and Spare Parts',
                                    'ar' => 'معدات وقطع غيار فلترة أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Mechanical Components',
                            'ar' => 'مكونات-ميكانيكية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Primary Screws',
                                    'ar' => 'مسامير أولية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Management Shafts',
                                    'ar' => 'أعمدة الإدارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wheel and Pulley',
                                    'ar' => 'عجلة وبكرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bearings and Bearing Accessories',
                                    'ar' => 'المحامل وملحقات المحامل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tube System and Tube Holders',
                                    'ar' => 'نظام أنابيب نحتية وحامل أنابيب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Adhesive Materials',
                                    'ar' => 'مواد لاصقة صناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Seals and Gaskets',
                                    'ar' => 'الختم والحشوات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Mechanical Components',
                                    'ar' => 'مكونات ميكانيكية أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Pneumatic Components',
                            'ar' => 'مكونات-هوائية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Pneumatic Cylinder',
                                    'ar' => 'اسطوانة هوائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pneumatic Actuator',
                                    'ar' => 'مشغل هوائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Air Filter',
                                    'ar' => 'فلتر هوائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pneumatic Connections',
                                    'ar' => 'وصلات هوائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pneumatic Pipe',
                                    'ar' => 'أنبوب هوائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pneumatic Seal',
                                    'ar' => 'مانع تسرب هوائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pneumatic Valve',
                                    'ar' => 'صمام هوائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Air Source Treatment Unit',
                                    'ar' => 'وحدة معالجة المصدر الهوائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Pneumatic Components',
                                    'ar' => 'مكونات هوائية أخرى'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Food and Beverages',
                    'ar' => 'الأغذية والمشروبات'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Frozen Food',
                            'ar' => 'أطعمة مجمدة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Frozen Vegetables',
                                    'ar' => 'الخضروات المجمدة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Frozen Fruits',
                                    'ar' => 'الفواكه المجمدة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Frozen ready-made foods',
                                    'ar' => 'الأطعمة الجاهزة المجمدة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'frozen snacks',
                                    'ar' => 'الوجبات الخفيفة المجمدة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ice cream and frozen milkshakes',
                                    'ar' => 'الآيس كريم والمخفوقات المجمدة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Frozen dough',
                                    'ar' => 'العجين المجمد'
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Baby Foods',
                            'ar' => 'أغذية-الأطفال'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Baby Milk',
                                    'ar' => 'حليب الأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Baby Cereals',
                                    'ar' => 'حبوب للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Baby Biscuits',
                                    'ar' => 'بسكويت أطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Organic Light Meals',
                                    'ar' => 'وجبات خفيفة عضوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Foods for Children with Allergies',
                                    'ar' => 'أغذية للأطفال المصابين بالحساسية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Instant Foods and Meals',
                            'ar' => 'الأطعمة-والوجبات-الفورية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Fast Preparation Foods',
                                    'ar' => 'أطعمة سريعة التحضير'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ready Meals',
                                    'ar' => 'وجبات جاهزة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Spices and Seasonings',
                            'ar' => 'البهارات-والتوابل'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Aromatic Spices',
                                    'ar' => 'توابل عطرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dried Herbs',
                                    'ar' => 'أعشاب مجففة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ground Spices',
                                    'ar' => 'توابل أرضية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hot Spices',
                                    'ar' => 'توابل حارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Special Spices',
                                    'ar' => 'توابل خاصة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Spice Blends',
                                    'ar' => 'مخاليط التوابل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Whole Spices',
                                    'ar' => 'توابل كاملة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Dates and Date Products',
                            'ar' => 'التمور-ومنتجات-التمور'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Dates with Nuts',
                                    'ar' => 'تمر بالمكسرات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dried Dates',
                                    'ar' => 'تمور مجففة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fresh Dates',
                                    'ar' => 'التمور الطازجة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Processed Dates',
                                    'ar' => 'التمور المصنعة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dates with Almonds',
                                    'ar' => 'تمر باللوز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Processed and Packaged Dates',
                                    'ar' => 'التمور المصنعة والمعبأة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Packaged Dates',
                                    'ar' => 'تمور معبأة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Unstuffed and Pitted Dates',
                                    'ar' => 'تمور غير محشوة وبدون نواة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Date Paste',
                                    'ar' => 'عجينة التمر'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Sugar and Sweets',
                            'ar' => 'السكر-والحلويات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Chocolate Sweets',
                                    'ar' => 'حلويات بالشوكولاتة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dark Chocolate',
                                    'ar' => 'شوكولاتة داكنة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'White Chocolate',
                                    'ar' => 'شوكولاتة بيضاء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sugar-Free Sweets',
                                    'ar' => 'حلويات خالية من السكر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gluten-Free Sweets',
                                    'ar' => 'حلويات خالية من الغلوتين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dairy-Free Sweets',
                                    'ar' => 'حلويات خالية من منتجات الألبان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Nut-Free Sweets',
                                    'ar' => 'حلويات خالية من المكسرات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Healthy Sweets',
                                    'ar' => 'حلويات صحية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sweets with Nuts',
                                    'ar' => 'حلويات بالمكسرات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sugar',
                                    'ar' => 'سكر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sugar Products',
                                    'ar' => 'منتجات السكر'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Honey and Honey Products',
                            'ar' => 'العسل-ومنتجات-العسل'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Natural Honey',
                                    'ar' => 'عسل طبيعي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Honey Products',
                                    'ar' => 'منتجات العسل'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Coffee and Tea',
                            'ar' => 'القهوة-والشاي'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Canned Coffee',
                                    'ar' => 'قهوة معلبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Coffee Beverages',
                                    'ar' => 'مشروبات القهوة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Coffee Products',
                                    'ar' => 'منتجات القهوة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Roasted Coffee',
                                    'ar' => 'قهوة محموصة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Instant Coffee',
                                    'ar' => 'قهوة سريعة التحضير'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Slimming Coffee',
                                    'ar' => 'قهوة التخسيس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Decaffeinated Coffee',
                                    'ar' => 'قهوة منزوعة الكافيين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Coffee with Different Flavors',
                                    'ar' => 'قهوة بنكهات مختلفة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Black Tea',
                                    'ar' => 'شاي أسود'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Green Tea',
                                    'ar' => 'شاي أخضر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Matcha Tea',
                                    'ar' => 'شاي ماتشا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'White Tea',
                                    'ar' => 'شاي أبيض'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Herbal Tea',
                                    'ar' => 'شاي أعشاب'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Seafood',
                            'ar' => 'المأكولات-البحرية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Preserved Fish and Seafood',
                                    'ar' => 'الأسماك والمأكولات البحرية المحفوظة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Smoked Fish and Seafood',
                                    'ar' => 'الأسماك والمأكولات البحرية مدخنة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Seasoned Fish and Seafood',
                                    'ar' => 'الأسماك والمأكولات البحرية متبلة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Frozen Fish and Seafood',
                                    'ar' => 'الأسماك والمأكولات البحرية المجمدة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Sauces',
                            'ar' => 'صلصات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Barbecue Sauce',
                                    'ar' => 'صلصة البارايكيو'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chamomile Sauce',
                                    'ar' => 'صلصة الشامبيل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hot Sauce',
                                    'ar' => 'صلصة الشطة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sauce',
                                    'ar' => 'صلصة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fish Sauce',
                                    'ar' => 'صلصة السمك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Garlic Sauce',
                                    'ar' => 'صلصة الثوم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Spicy Sauce',
                                    'ar' => 'صلصة الحارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hummus Sauce',
                                    'ar' => 'صلصة الحمص'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ketchup',
                                    'ar' => 'كاتشب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mayonnaise Sauce',
                                    'ar' => 'صلصة المايونيز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Soy Sauce',
                                    'ar' => 'صلصة الصويا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tahini Sauce',
                                    'ar' => 'صلصة الطحينة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tomato Sauce',
                                    'ar' => 'صلصة الطماطم'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Baked Goods',
                            'ar' => 'مخبوزات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Bread',
                                    'ar' => 'الخبز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pastries',
                                    'ar' => 'الفطائر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pastries',
                                    'ar' => 'المعجنات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Baked Sweets',
                                    'ar' => 'الحلويات المخبوزة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gluten-Free Baked Goods',
                                    'ar' => 'مخبوزات خالية من الغلوتين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bread Improvers',
                                    'ar' => 'محسنات الخبز'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Beverages',
                            'ar' => 'مشروبات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Carbonated Beverages',
                                    'ar' => 'المشروبات الغازية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Juices',
                                    'ar' => 'العصائر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sports Beverages',
                                    'ar' => 'مشروبات الرياضية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Energy Beverages',
                                    'ar' => 'مشروبات الطاقة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Flavored Water',
                                    'ar' => 'ماء بنكهات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plant-based Beverages',
                                    'ar' => 'المشروبات النباتية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water',
                                    'ar' => 'مياه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ice and Ice Cubes',
                                    'ar' => 'الثلج ومكعبات الثلج'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Food Ingredients',
                            'ar' => 'مكونات-غذائية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Bakery Decoration Ingredients',
                                    'ar' => 'مكونات تزيين المخبوزات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cheese',
                                    'ar' => 'جبنة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cocoa Powder',
                                    'ar' => 'مسحوق الكاكاو'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Flour',
                                    'ar' => 'دقيق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sugar Sweets',
                                    'ar' => 'حلوى سكرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pastry Mixes',
                                    'ar' => 'مخاليط المعجنات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Starch',
                                    'ar' => 'نشا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Yeast',
                                    'ar' => 'خميرة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Dairy Products',
                            'ar' => 'منتجات-الألبان'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Cheese',
                                    'ar' => 'الأجبان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Milk',
                                    'ar' => 'الحليب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Yogurt',
                                    'ar' => 'الزبادي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cream',
                                    'ar' => 'القشطة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Yogurt Milk',
                                    'ar' => 'اللبن الزبادي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Labneh',
                                    'ar' => 'اللبنة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Coffee Whitener',
                                    'ar' => 'مبيض القهوة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Egg Products',
                            'ar' => 'منتجات-البيض'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Egg Products',
                                    'ar' => 'منتجات البيض'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Eggs',
                                    'ar' => 'البيض'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Grain Products',
                            'ar' => 'منتجات-الحبوب'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Corn Flakes',
                                    'ar' => 'رقائق الذرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wheat Bran Flakes',
                                    'ar' => 'رقائق نخالة القمح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wheat Flakes',
                                    'ar' => 'رقائق القمح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rice Products',
                                    'ar' => 'منتجات الأرز'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Oils and Fats Products',
                            'ar' => 'منتجات-الزيوت-والدهون'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Oil Products',
                                    'ar' => 'منتجات الزيوت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fat Products',
                                    'ar' => 'منتجات الدهون'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Meat and Poultry Products',
                            'ar' => 'منتجات-اللحوم-والدواجن'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Fresh Meat',
                                    'ar' => 'لحوم طازجة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fresh Poultry',
                                    'ar' => 'دواجن طازجة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Frozen Meat',
                                    'ar' => 'لحوم مجمدة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Frozen Poultry',
                                    'ar' => 'دواجن مجمدة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Smoked Meat',
                                    'ar' => 'لحوم مدخنة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Smoked Poultry',
                                    'ar' => 'دواجن مدخنة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Seasoned Meat',
                                    'ar' => 'لحوم متبلة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Seasoned Poultry',
                                    'ar' => 'دواجن متبلة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Meat and Poultry',
                                    'ar' => 'لحوم ودواجن أخرى'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Games',
                    'ar' => 'الألعاب'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Board Games',
                            'ar' => 'ألعاب إلكترونية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Electronic pets',
                                    'ar' => 'حيوانات أليفة إلكترونية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electronic keyboard for children',
                                    'ar' => 'أورغ إلكتروني للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hunting games',
                                    'ar' => 'ألعاب الصيد'
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Children\'s Games',
                            'ar' => 'ألعاب-الأطفال'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Children\'s Books',
                                    'ar' => 'كتب الأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children\'s Tents',
                                    'ar' => 'خيشيات الأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Balance Games',
                                    'ar' => 'ألعاب توازن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Interactive Games',
                                    'ar' => 'ألعاب تفاعلية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Light Games',
                                    'ar' => 'ألعاب ضوئية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Play Mats',
                                    'ar' => 'حصائر اللعب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sensory Games',
                                    'ar' => 'ألعاب حسية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Soft Games',
                                    'ar' => 'ألعاب ناعمة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Teething Toys',
                                    'ar' => 'عضاضات السنين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water Games',
                                    'ar' => 'ألعاب مائية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Remote Control Games',
                            'ar' => 'ألعاب-التحكم-عن-بعد'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'RC Aircraft',
                                    'ar' => 'RC طائرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'RC Animal',
                                    'ar' => 'RC حيوان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'RC Boat and Ship',
                                    'ar' => 'RC قارب وسفينة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'RC Car',
                                    'ar' => 'RC سيارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'RC Drone',
                                    'ar' => 'RC طائرة بدون طيار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'RC Engineering Vehicle',
                                    'ar' => 'RC سيارة هندسية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'RC Helicopter',
                                    'ar' => 'RC طائرة هليكوبتر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'RC Motorcycle',
                                    'ar' => 'RC دراجة نارية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'RC Tank',
                                    'ar' => 'RC دبابة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Robot Games',
                                    'ar' => 'ألعاب روبوتات'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Action Games',
                            'ar' => 'ألعاب-الحركة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Motion Dolls',
                                    'ar' => 'دمى الحركة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cartoon Character',
                                    'ar' => 'شخصية كرتونية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sword and Gun Games',
                                    'ar' => 'ألعاب السيوف والبنادق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stress Games',
                                    'ar' => 'ألعاب التوتر'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Games by Material',
                            'ar' => 'ألعاب-حسب-المادة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Electric Games',
                                    'ar' => 'ألعاب كهربائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ceramic Games',
                                    'ar' => 'ألعاب خزفية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Games',
                                    'ar' => 'ألعاب بلاستيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wooden Games',
                                    'ar' => 'ألعاب خشبية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Games by Style',
                            'ar' => 'ألعاب-حسب-النمط'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Artificial Games',
                                    'ar' => 'ألعاب اصطناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Folk Games',
                                    'ar' => 'ألعاب شعبية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Innovative or Strange Games',
                                    'ar' => 'ألعاب مبتكرة أو غريبة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Outdoor Games',
                            'ar' => 'ألعاب-خارجية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Bubble Games',
                                    'ar' => 'ألعاب الفقاعات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Flying Disc Games',
                                    'ar' => 'قرص طائر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Kites and Paper Crafts',
                                    'ar' => 'طائرات ورقية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Game Balls',
                                    'ar' => 'كرات ألعاب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Swings for Children',
                                    'ar' => 'أرجوحة للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Toy Swords',
                                    'ar' => 'سيوف ألعاب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Camping Games',
                                    'ar' => 'خيام ألعاب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Arrows and Bow Games',
                                    'ar' => 'السهام ولوحة السهام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Jumping Rope',
                                    'ar' => 'حبل القفز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Scooter and Skateboard',
                                    'ar' => 'سكوتر الدفع وسكوتر التزلج'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Art and Craft Games',
                            'ar' => 'ألعاب-فنية-وحرفية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Art and Craft Games',
                                    'ar' => 'ألعاب فنية وحرفية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Board and Card Games',
                                    'ar' => 'ألعاب الطاولة والورق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Building and Engineering Games',
                                    'ar' => 'ألعاب البناء والهندسة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drawing Games',
                                    'ar' => 'ألعاب الرسم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pretend and Disguise Games',
                                    'ar' => 'ألعاب التظاهر والتنكر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Educational and Mental Games',
                                    'ar' => 'ألعاب تعليمية وذهنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Track Games',
                                    'ar' => 'ألعاب المسارات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Letter and Language Games',
                                    'ar' => 'ألعاب الحروف واللغة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Magic Games',
                                    'ar' => 'ألعاب سحرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mathematics Games',
                                    'ar' => 'ألعاب الرياضيات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Model and Sculpture Games',
                                    'ar' => 'ألعاب النماذج والمجسمات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Puzzle Games',
                                    'ar' => 'ألعاب الألغاز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Scientific Games',
                                    'ar' => 'ألعاب علمية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sorting and Stacking Games',
                                    'ar' => 'ألعاب الفرز والتكديس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Musical Instrument Games',
                                    'ar' => 'ألعاب آلات موسيقية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Inflatable Games',
                            'ar' => 'ألعاب-قابلة-للنفخ'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Inflatable Ball',
                                    'ar' => 'كرة نفخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Inflatable Boat',
                                    'ar' => 'قارب نفخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Inflatable Ring',
                                    'ar' => 'فقرة نفخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Inflatable Cartoon Character',
                                    'ar' => 'شخصية كرتونية نفخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Inflatable Castle',
                                    'ar' => 'قلعة نفخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Inflatable Pool',
                                    'ar' => 'بركة نفخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Inflatable House',
                                    'ar' => 'منزل نفخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Inflatable Animal',
                                    'ar' => 'حيوان نفخ'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Children\'s Driving Games',
                            'ar' => 'ألعاب-قيادة-للأطفال'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Children\'s Bicycle',
                                    'ar' => 'دراجة هوائية للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children\'s Driving Simulation',
                                    'ar' => 'محاكاة قيادة للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children\'s Electric Car',
                                    'ar' => 'سيارة كهربائية للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children\'s Engineering Vehicle',
                                    'ar' => 'سيارة هندسية للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children\'s Four-Wheel Drive Vehicle',
                                    'ar' => 'سيارة رباعية الدفع للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children\'s Go-Kart',
                                    'ar' => 'كارت للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children\'s Motorcycle',
                                    'ar' => 'دراجة نارية للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children\'s Scooter',
                                    'ar' => 'سكوتر للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children\'s Available Car',
                                    'ar' => 'سيارة متاحة للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children\'s Tricycle',
                                    'ar' => 'دراجة ثلاثية العجلات للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children\'s Vehicle Spare Parts',
                                    'ar' => 'قطع غيار لمركبات الأطفال'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Vehicle Games',
                            'ar' => 'ألعاب-مركبات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Aircraft Game',
                                    'ar' => 'لعبة طائرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bicycle Game',
                                    'ar' => 'لعبة دراجة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Boat and Ship Game',
                                    'ar' => 'لعبة قارب وسفينة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Car Game',
                                    'ar' => 'لعبة سيارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Construction Vehicle Game',
                                    'ar' => 'لعبة سيارة إنشاءات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Train Game',
                                    'ar' => 'لعبة قطار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Truck Game',
                                    'ar' => 'لعبة شاحنة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Animals and Stuffed Toys',
                            'ar' => 'الحيوانات-والألعاب-المحشوة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Dolls',
                                    'ar' => 'دمى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electronic Stuffed Doll',
                                    'ar' => 'دمية محشوة إلكترونية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stuffed Backpack',
                                    'ar' => 'حقيبة ظهر محشوة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stuffed Cartoon Doll',
                                    'ar' => 'دمية كرتونية محشوة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stuffed Character Doll',
                                    'ar' => 'دمية شخصية محشوة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stuffed Animals',
                                    'ar' => 'حيوانات محشوة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stuffed Food',
                                    'ar' => 'طعام محشو'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stuffed Home Games',
                                    'ar' => 'ألعاب منزلية محشوة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stuffed Educational Games',
                                    'ar' => 'ألعاب تعليمية محشوة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stuffed Interactive Games',
                                    'ar' => 'ألعاب تفاعلية محشوة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Handmade Games',
                                    'ar' => 'ألعاب يدوية الصنع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Large Stuffed Games',
                                    'ar' => 'ألعاب محشوة كبيرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Small Stuffed Games',
                                    'ar' => 'ألعاب محشوة صغيرة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Game Parts and Accessories',
                            'ar' => 'قطع-غيار-الألعاب-والإكسسورات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Game Parts',
                                    'ar' => 'قطع غيار الألعاب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Game Accessories',
                                    'ar' => 'إكسسورات الألعاب'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Security and Protection',
                    'ar' => 'الأمن والحماية'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Alarm and Locks',
                            'ar' => 'أقفال وخزائن'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Security Keys',
                                    'ar' => 'مفاتيح الأمان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Security locks',
                                    'ar' => 'أقفال الأمان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Locks and safes spare parts',
                                    'ar' => 'قطع غيار الأقفال والخزائن'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Access Control Systems',
                            'ar' => 'أنظمة-التحكم-في-الدخول'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Access Card Readers',
                                    'ar' => 'قارئات بطاقات الدخول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Access Cards',
                                    'ar' => 'بطاقات الدخول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Access Control Keypads',
                                    'ar' => 'لوحات مفاتيح التحكم في الدخول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Eye Recognition Systems',
                                    'ar' => 'أنظمة التعرف على قرحية العين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Audio Door Phones',
                                    'ar' => 'هواتف باب صوتية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Face Recognition Systems',
                                    'ar' => 'نظام التعرف على الوجه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fingerprint Access Control',
                                    'ar' => 'التحكم في الدخول بصمة الإصبع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Video Door Phones',
                                    'ar' => 'هواتف باب فيديو'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Alarm',
                            'ar' => 'إنذار'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Main Control Unit for Alarm',
                                    'ar' => 'وحدة التحكم الرئيسية لإنذار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electronic Detection Systems and Accessories',
                                    'ar' => 'أنظمة الكشف الإلكتروني وإكسسوراتها'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Handheld Metal Detection Device',
                                    'ar' => 'جهاز كشف المعادن المحمول باليد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Probe, Sensor Device',
                                    'ar' => 'مسبار، جهاز استشعار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Security Screen Holder',
                                    'ar' => 'حامل شاشة الأمان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Transmitter, Receiver Device',
                                    'ar' => 'جهاز إرسال، جهاز استقبال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stroboscopic Light (Flashing)',
                                    'ar' => 'مصباح سترويوسكوب (وامض)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Alarm and Security System Accessories',
                                    'ar' => 'ملحقات أنظمة الإنذار والأمن'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Inspection Gates',
                            'ar' => 'بوابات-تفتيش'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Metal Detection Gates',
                                    'ar' => 'بوابات الكشف عن المعادن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electronic Object Detection Gates',
                                    'ar' => 'بوابات الكشف عن الأجسام الإلكترونية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hybrid Gates',
                                    'ar' => 'بوابات هجينة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'X-ray Gates',
                                    'ar' => 'بوابات الأشعة السينية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Revolving Door',
                                    'ar' => 'الباب الدوار'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Road Safety',
                            'ar' => 'سلامة-الطرق'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Convex Mirror',
                                    'ar' => 'مرآة محدبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Reflective Materials',
                                    'ar' => 'مواد عاكسة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Reflective Safety Clothing',
                                    'ar' => 'ملابس أمان عاكسة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Traffic Barrier',
                                    'ar' => 'حاجز مروري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Traffic Signal',
                                    'ar' => 'إشارة مرور'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Traffic Signal System',
                                    'ar' => 'نظام إشارة المرور'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Warning Triangle',
                                    'ar' => 'مثلث تحذير'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Self-Defense Equipment',
                            'ar' => 'لوازم-الدفاع-عن-النفس'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Pepper Spray',
                                    'ar' => 'رذاذ الفلفل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Folding Knife',
                                    'ar' => 'سكين قايض'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Personal Electric Stun Gun',
                                    'ar' => 'صاعق كهربائي شخصي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Defense Stick',
                                    'ar' => 'عصا دفاعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Personal Alarm',
                                    'ar' => 'إنذار شخصي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Glass Breaking Tool',
                                    'ar' => 'أداة تكسير الزجاج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tactical Pen',
                                    'ar' => 'قلم تكتيكي'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Military Equipment',
                            'ar' => 'لوازم-عسكرية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Security Stick',
                                    'ar' => 'عصا أمنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bulletproof Helmet',
                                    'ar' => 'خوذة واقية من الرصاص'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bulletproof Vest',
                                    'ar' => 'سترة واقية من الرصاص'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Weapon Bag',
                                    'ar' => 'حقيبة السلاح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Handcuffs',
                                    'ar' => 'كلبشات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stun Gun',
                                    'ar' => 'مسدس الصعق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Warning Tape',
                                    'ar' => 'شريط تحذيري'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Water Safety Equipment',
                            'ar' => 'معدات-السلامة-المائية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Life Ring',
                                    'ar' => 'طوق نجاة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Life Boat',
                                    'ar' => 'قارب نجاة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Life Jacket',
                                    'ar' => 'سترة نجاة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lifeguard Uniform',
                                    'ar' => 'زي المنقذ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water-Resistant Bags',
                                    'ar' => 'أكياس مقاومة للماء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Warning Whistle',
                                    'ar' => 'صفارة إنذار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'First Aid Kit',
                                    'ar' => 'طقم إسعافات أولية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rescue Light',
                                    'ar' => 'مصباح إنقاذ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rescue Rope',
                                    'ar' => 'حبل إنقاذ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fire Extinguisher Rescue Bag',
                                    'ar' => 'حقيبة إطفاء إنقاذ'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Workplace Safety Equipment',
                            'ar' => 'معدات-السلامة-في-مكان-العمل'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Ear Protection',
                                    'ar' => 'واقي الأذن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Face Shield',
                                    'ar' => 'درع واقي الوجه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Safety Accessories',
                                    'ar' => 'ملحقات السلامة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Safety Belts',
                                    'ar' => 'أحزمة الأمان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Safety Clothing',
                                    'ar' => 'ملابس السلامة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Safety Gloves',
                                    'ar' => 'قفازات السلامة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Safety Glasses',
                                    'ar' => 'نظارات السلامة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Safety Harness',
                                    'ar' => 'حزام الأمان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Safety Helmet',
                                    'ar' => 'خوذة السلامة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Safety Shoes',
                                    'ar' => 'أحذية السلامة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Fire Fighting Equipment',
                            'ar' => 'معدات-مكافحة-الحرائق'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Fire Alarm System',
                                    'ar' => 'جهاز إنذار الحريق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fire Alarm Control Panel',
                                    'ar' => 'لوحة التحكم في إنذار الحريق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fire Blanket',
                                    'ar' => 'بطانية إطفاء الحريق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fire Extinguisher',
                                    'ar' => 'طفاية حريق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fire Extinguisher Powder',
                                    'ar' => 'مسحوق طفاية الحريق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fire Hose',
                                    'ar' => 'خرطوم إطفاء الحريق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fire Hydrant',
                                    'ar' => 'صنبور إطفاء الحريق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fire Suit',
                                    'ar' => 'بدلة إطفاء الحريق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fire Fighting Equipment',
                                    'ar' => 'معدات مكافحة الحريق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Heat Detector',
                                    'ar' => 'كاشف الحرارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lightning Rod',
                                    'ar' => 'صاعقة البرق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Smoke Detector',
                                    'ar' => 'كاشف الدخان'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Surveillance Camera Products',
                            'ar' => 'منتجات-كاميرات-المراقبة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Surveillance Camera Cover',
                                    'ar' => 'غلاف كاميرا المراقبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Surveillance Cameras',
                                    'ar' => 'كاميرات المراقبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Digital Video Recorder for Cameras',
                                    'ar' => 'مسجل فيديو رقمي الكاميرات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Surveillance Camera Lenses',
                                    'ar' => 'عدسات كاميرات المراقبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Surveillance Camera Screens',
                                    'ar' => 'شاشات كاميرات المراقبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Surveillance Camera Systems',
                                    'ar' => 'أنظمة كاميرات المراقبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Digital Video Recorder Cards',
                                    'ar' => 'بطاقات مسجل الفيديو الرقمي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Surveillance Camera Accessories',
                                    'ar' => 'ملحقات كاميرات المراقبة'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Consumer electronics',
                    'ar' => 'الإلكترونيات الإستهلاكية'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Television sets',
                            'ar' => 'أجهزة التلفزيون'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Audio and video cables',
                                    'ar' => 'كابلات الصوت والفيديوا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'CRT television',
                                    'ar' => 'تلفزيون (CRT)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LCD television',
                                    'ar' => 'تلفزيون LCD'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plasma television',
                                    'ar' => 'تلفزيون بلازما'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Radio and television broadcasting',
                                    'ar' => 'بث إذاعي وتلفزيوني'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Television broadcast receiver',
                                    'ar' => 'جهاز استقبال بث تلفزيوني'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'TV rules',
                                    'ar' => 'قواعد التلفزيون'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'TV spare parts',
                                    'ar' => 'قطع غيار تلفزيون'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other televisions',
                                    'ar' => 'تلفزيونات أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Photographic Equipment',
                            'ar' => 'أجهزة-تصوير-فوتوغرافي'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Camera Bag',
                                    'ar' => 'حقيبة كاميرا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Camera Battery',
                                    'ar' => 'بطارية كاميرا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Camera Charger',
                                    'ar' => 'شاحن كاميرا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Camera Lens',
                                    'ar' => 'عدسة كاميرا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Card Reader',
                                    'ar' => 'قارئ بطاقات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Digital Camera',
                                    'ar' => 'كاميرا رقمية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Professional Photography Equipment',
                                    'ar' => 'معدات تصوير احترافية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Film Camera',
                                    'ar' => 'كاميرا فيلم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Camera',
                                    'ar' => 'كاميرا صناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lens Cleaner',
                                    'ar' => 'منظف عدسات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Memory Card',
                                    'ar' => 'بطاقة ذاكرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Photography Accessories',
                                    'ar' => 'ملحقات تصويرية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Portable Audio Devices',
                            'ar' => 'أجهزة-صوت-محمولة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'CD, Mini Disc, and Cassette Tape Player',
                                    'ar' => 'مشغل أقراص مدمجة وميني ديسك وأشرطة كاسيت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hi-Fi Player',
                                    'ar' => 'مشغل Hi-Fi'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'MP3 Player',
                                    'ar' => 'مشغل MP3'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'MP4 Player',
                                    'ar' => 'مشغل MP4'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Portable Voice Recorder',
                                    'ar' => 'مسجل صوت محمول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Portable Audio Devices',
                                    'ar' => 'أجهزة صوتية محمولة أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Computer Hardware and Software',
                            'ar' => 'أجهزة-وبرامج-الحاسوب'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Portable Computer Devices',
                                    'ar' => 'أجهزة كمبيوتر محمولة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Computer Spare Parts',
                                    'ar' => 'قطع غيار الكمبيوتر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Computer Software',
                                    'ar' => 'برامج الكمبيوتر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Office Equipment',
                                    'ar' => 'أجهزة مكتبية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Network Equipment',
                                    'ar' => 'أجهزة الشبكات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Peripheral Computer Equipment',
                                    'ar' => 'أجهزة الكمبيوتر الطرفية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Servers and Workstations',
                                    'ar' => 'الخوادم ومحطات العمل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Storage Devices',
                                    'ar' => 'أجهزة التخزين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Small Computer Devices',
                                    'ar' => 'أجهزة كمبيوتر صغيرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electronic Writing Devices',
                                    'ar' => 'أجهزة الكتابة الإلكترونية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Printers and Accessories',
                                    'ar' => 'طابعات وملحقاتها'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Scanners and Accessories',
                                    'ar' => 'ماسحات ضوئية وملحقاتها'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Servers',
                                    'ar' => 'الخوادم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Computer Hardware and Software Accessories',
                                    'ar' => 'ملحقات أجهزة وبرامج الحاسوب'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Audio Equipment',
                            'ar' => 'أطقم-صوتية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Speaker',
                                    'ar' => 'مكبر صوت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Home Audio System',
                                    'ar' => 'نظام صوت منزلي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Karaoke Equipment',
                                    'ar' => 'جهاز كاريوكي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Microphone',
                                    'ar' => 'ميكروفون'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Professional Audio',
                                    'ar' => 'صوت احترافي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Headphones and Sound Box',
                                    'ar' => 'سماعات وصندوق صوت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Audio Equipment',
                                    'ar' => 'أجهزة صوتية أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'CDs, Cassette Tapes, Tapes and Recordings',
                            'ar' => 'أقراص،-أشرطة-كاسيت،-شرائط-وتسجيلات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Audio-Visual Products',
                                    'ar' => 'منتجات صوتية ومرئية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'CD and DVD Discs',
                                    'ar' => 'أقراص مدمجة وأقراص دي في دي في دي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Disc Bags and Cases',
                                    'ar' => 'أكياس وحافظات أقراص'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'CD & DVD Disc Copiers',
                                    'ar' => 'CD& DVD ناسخ أقراص'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cassette Tapes and Tapes',
                                    'ar' => 'أشرطة كاسيت وشرائط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Discs and Tapes',
                                    'ar' => 'أقراص وشرائط أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Used Electronic Devices',
                            'ar' => 'اجهزة-الكترونية-مستعملة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Used Mobile Phones',
                                    'ar' => 'هواتف محمولة مستعملة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Used Laptop Devices',
                                    'ar' => 'أجهزة لاب توب مستعملة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Used Cameras',
                                    'ar' => 'كاميرات مستعملة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Used Televisions',
                                    'ar' => 'تلفزيونات مستعملة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Wearable Devices',
                            'ar' => 'الأجهزة-القابلة-للارتداء'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Smart Bracelet',
                                    'ar' => 'سوار ذكي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Smart Glasses',
                                    'ar' => 'نظارة ذكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Smart Watch',
                                    'ar' => 'ساعة ذكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Wearable Devices',
                                    'ar' => 'أجهزة قابلة للارتداء أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Batteries and Chargers',
                            'ar' => 'البطاريات-والشواحن'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Button Battery',
                                    'ar' => 'بطارية زر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dry and Primary Batteries',
                                    'ar' => 'البطاريات الجافة والأولية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rechargeable Batteries and Chargers',
                                    'ar' => 'البطاريات القابلة للشحن والشواحن'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Gaming and Entertainment Electronics',
                            'ar' => 'العاب-والكترونيات-ترفيهية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Entertainment Electronics',
                                    'ar' => 'إلكترونيات ترفيهية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Entertainment Electronics Accessories',
                                    'ar' => 'ملحقات إلكترونيات ترفيهية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Portable Gaming Device',
                                    'ar' => 'جهاز ألعاب محمول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gaming Controller Stick',
                                    'ar' => 'عصا تحكم بجهاز تحكم ألعاب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Entertainment Electronics',
                                    'ar' => 'إلكترونيات ترفيهية أخرى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electronic Games',
                                    'ar' => 'العاب الكترونية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Mobile Phones',
                            'ar' => 'الهواتف-المحمولة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Traditional Phone',
                                    'ar' => 'هاتف تقليدي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mobile Phone Battery',
                                    'ar' => 'بطارية هاتف محمول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mobile Phone Cable and Charger',
                                    'ar' => 'كابل وشاحن هاتف محمول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mobile Phone Case',
                                    'ar' => 'محافظة هاتف محمول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mobile Phone Holder',
                                    'ar' => 'حامل هاتف محمول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mobile Phone Cover and Decoration',
                                    'ar' => 'غلاف وزينة هاتف محمول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mobile Phone Keypad',
                                    'ar' => 'لوحة مفاتيح هاتف محمول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mobile Phone LCD',
                                    'ar' => 'محمول LCD هاتف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Strong Phone',
                                    'ar' => 'هاتف قوي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Selfie Stick',
                                    'ar' => 'عصا سيلفي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Smart Phone',
                                    'ar' => 'هاتف ذكي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Mobile Phone Accessories',
                                    'ar' => 'ملحقات هواتف محمولة أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Headphones and Earphones and Accessories',
                            'ar' => 'سماعات-الرأس-والأذن-واكسسوراتها'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Bluetooth Headphones',
                                    'ar' => 'سماعة رأس بلوتوث'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Earphones',
                                    'ar' => 'سماعات أذن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Headphones with Ear Cushions',
                                    'ar' => 'سماعة رأس مع خفاف للأذن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Earphone and Headphone Accessories',
                                    'ar' => 'إكسسوارات سماعات الأذن وللسماعات الرأس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Earphone Case',
                                    'ar' => 'علبة سماعة أذن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Headband Headphones',
                                    'ar' => 'سماعة رأس ذات شريط رأس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'In-Ear Earphones',
                                    'ar' => 'سماعة أذن داخل الأذن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mobile Phone Earphones',
                                    'ar' => 'سماعة أذن لهاتف محمول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Neck Headphones',
                                    'ar' => 'سماعة رأس حول الرقبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Earphones and Headphones',
                                    'ar' => 'سماعات أذن وسماعات رأس أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Screens and Accessories',
                            'ar' => 'شاشات-وملحقاتها'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'CRT Screens',
                                    'ar' => 'شاشة أنبوب أشعة الكاثود (CRT)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Digital Kiosks and Interactive Screens',
                                    'ar' => 'أكشاك رقمية وشاشات تفاعلية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LCD Screens',
                                    'ar' => 'شاشة LCD'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LCD Screen Units',
                                    'ar' => 'شاشة LCD وحدة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Screens',
                                    'ar' => 'شاشة LED'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Screen Stands',
                                    'ar' => 'حامل شاشة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'OLED Screens',
                                    'ar' => 'شاشة OLED'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plasma Screens',
                                    'ar' => 'شاشة بلازما'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Touch Screens',
                                    'ar' => 'شاشة لمس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Screens',
                                    'ar' => 'شاشات أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Video and Radio',
                            'ar' => 'فيديو-وراديو'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Digital Photo Frame',
                                    'ar' => 'إطار صور رقمي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Computer Camera',
                                    'ar' => 'كاميرا كمبيوتر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Surveillance, Control and Protection',
                                    'ar' => 'مراقبة وتحكم وحماية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'DVD and VCD Player',
                                    'ar' => 'DVD و VCD مشغل أقراص'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Video Camera and Accessories',
                                    'ar' => 'كاميرا فيديو واكسسواراتها'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Video Glasses',
                                    'ar' => 'نظارات فيديو'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Videos',
                                    'ar' => 'فيديوهات أخرى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Radio',
                                    'ar' => 'راديو'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Radio and Cassette Recorders',
                                    'ar' => 'مسجلات راديو وكاسيت'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Digital Device Products',
                            'ar' => 'منتجات-أجهزة-رقمية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Bluetooth Products',
                                    'ar' => 'منتجات بلوتوث'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Drones and Accessories',
                                    'ar' => 'طائرات بدون طيار وملحقاتها'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Two-way Wireless Devices',
                                    'ar' => 'أجهزة لاسلكية ثنائية الاتجاه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Printers, Storage Batteries and Chargers',
                                    'ar' => 'طابعات، بطاريات تخزين وشواحن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'E-book Reader',
                                    'ar' => 'قارئ كتب إلكترونية'
                                ],
                            ]
                        ]
                    ]
                ]
            ],

            [
                'name' => [
                    'en' => 'Building and Real Estate',
                    'ar' => 'البناء-والعقارات'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Doors and Windows',
                            'ar' => 'أبواب ونوافذ'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Interior Residential Doors',
                                    'ar' => 'أبواب سكنية داخلية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Exterior Residential Doors',
                                    'ar' => 'أبواب سكنية خارجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Commercial Doors',
                                    'ar' => 'أبواب تجارية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Doors',
                                    'ar' => 'أبواب صناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Security Doors',
                                    'ar' => 'أبواب أمنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Specialized Doors',
                                    'ar' => 'أبواب متخصصة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Automatic Doors',
                                    'ar' => 'أبواب اتوماتيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Door Accessories',
                                    'ar' => 'اكسسوارات الأبواب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Door Devices',
                                    'ar' => 'أجهزة الأبواب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Residential Windows',
                                    'ar' => 'نوافذ سكنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Commercial Windows',
                                    'ar' => 'نوافذ تجارية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Windows',
                                    'ar' => 'نوافذ صناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Security Windows',
                                    'ar' => 'نوافذ أمنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Specialized Windows',
                                    'ar' => 'نوافذ متخصصة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Window Devices',
                                    'ar' => 'أجهزة النوافذ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Window Accessories',
                                    'ar' => 'اكسسوارات النوافذ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gates',
                                    'ar' => 'بوابات'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Elevators and Corridors and Stairs',
                            'ar' => 'المصاعد-والممرات-والسلالم'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Elevators',
                                    'ar' => 'المصاعد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Escalators',
                                    'ar' => 'السلالم المتحركة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Moving Corridors',
                                    'ar' => 'الممرات المتحركة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Elevator Spare Parts',
                                    'ar' => 'قطع غيار المصاعد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Escalator Spare Parts',
                                    'ar' => 'قطع غيار السلالم المتحركة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Moving Corridor Spare Parts',
                                    'ar' => 'قطع غيار الممرات المتحركة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Elevator Accessories',
                                    'ar' => 'ملحقات المصاعد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Escalator Accessories',
                                    'ar' => 'ملحقات السلالم المتحركة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Moving Corridor Accessories',
                                    'ar' => 'ملحقات الممرات المتحركة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Ceramic Tiles',
                            'ar' => 'بلاط-سيراميك'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Ceramic Tiles',
                                    'ar' => 'بلاط سيراميك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Porcelain Tiles',
                                    'ar' => 'بلاط بورسلان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Natural Stone Tiles',
                                    'ar' => 'بلاط الحجر الطبيعي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Luxury Vinyl Tiles',
                                    'ar' => 'بلاط فينيل فاخر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Carpet Tiles',
                                    'ar' => 'بلاط السجاد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Marble Tiles',
                                    'ar' => 'بلاط رخام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Granite Tiles',
                                    'ar' => 'بلاط جرانيت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Travertine Tiles',
                                    'ar' => 'بلاط رافرتين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Slate Tiles',
                                    'ar' => 'بلاط أردواز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Glass Tiles',
                                    'ar' => 'بلاط زجاجي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Tiles',
                                    'ar' => 'بلاط معدني'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tile Accessories',
                                    'ar' => 'ملحقات البلاط'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Bathrooms',
                            'ar' => 'حمامات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Bathroom Basins',
                                    'ar' => 'أحواض الحمام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bathroom Faucets and Faucet Parts',
                                    'ar' => 'حنفيات الحمام وأجزاء الحنفيات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shower Rooms',
                                    'ar' => 'غرف الدش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bathroom Spare Parts',
                                    'ar' => 'قطع غيار الحمام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sanitary Tools Set',
                                    'ar' => 'مجموعة الأدوات الصحية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bathtubs and Jacuzzi',
                                    'ar' => 'أحواض الاستحمام والجاكوزي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bidet and Bidet Parts',
                                    'ar' => 'بديه وأجزاء البديه (حوض الاستنجاء)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bathroom Storage and Mirrors',
                                    'ar' => 'تخزين الحمام والمرايا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Showers and Shower Parts',
                                    'ar' => 'دوشات وأجزاء الدوش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bathroom Decor',
                                    'ar' => 'ديكور الحمام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sauna',
                                    'ar' => 'ساونا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bathroom Safety and Access',
                                    'ar' => 'سلامة الحمام والوصول إليه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Toilets and Toilet Parts',
                                    'ar' => 'مراحيض وأجزاء المراحيض'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bathroom Sinks',
                                    'ar' => 'مقاسل الحمام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bathroom Accessories',
                                    'ar' => 'ملحقات الحمام'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Stairs and Scaffolds',
                            'ar' => 'سلالم-وسقالات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Stairs Spare Parts',
                                    'ar' => 'قطع غيار سلالم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Scaffolds',
                                    'ar' => 'سقالات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Scaffolds Spare Parts',
                                    'ar' => 'قطع غيار السقالات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Work Platforms',
                                    'ar' => 'منصات عمل'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Mosaic',
                            'ar' => 'فسيفساء'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Flooring and Wall Decorations',
                                    'ar' => 'أرضيات وديكورات جدران'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Backsplash Panels (for Kitchens)',
                                    'ar' => 'لوحات خلفية (في المطابخ)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Work Surfaces',
                                    'ar' => 'أسطح العمل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Table Surfaces',
                                    'ar' => 'أسطح الطاولات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Exterior Elements',
                                    'ar' => 'العناصر الخارجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Commercial Spaces',
                                    'ar' => 'المساحات التجارية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Molds',
                            'ar' => 'قوالب'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Wooden Molds',
                                    'ar' => 'قوالب خشبية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Molds',
                                    'ar' => 'قوالب معدنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Aluminum Molds',
                                    'ar' => 'قوالب المنيوم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Molds',
                                    'ar' => 'قوالب بلاستيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fiberglass Reinforced Concrete Molds',
                                    'ar' => 'قوالب خرسانة مسلحة بالألياف الزجاجية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Prefabricated Buildings',
                            'ar' => 'مباني-مسبقة-الصنع'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Residential Buildings',
                                    'ar' => 'مباني سكنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Commercial Buildings',
                                    'ar' => 'مباني تجارية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial Buildings',
                                    'ar' => 'مباني صناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Service Buildings',
                                    'ar' => 'مباني خدماتية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Agricultural Buildings',
                                    'ar' => 'مباني زراعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ready-made Glass Houses',
                                    'ar' => 'بيوت زجاجية جاهزة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Solar Rooms',
                                    'ar' => 'غرف شمسية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Private Buildings',
                                    'ar' => 'مباني خاصة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Kitchens',
                            'ar' => 'مطابخ'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Kitchen Backsplash Tiles',
                                    'ar' => 'بلاط خلفية للمطابخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Kitchen Cabinets',
                                    'ar' => 'خزائن المطبخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Kitchen Faucets',
                                    'ar' => 'حنفيات المطبخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Kitchen Sinks',
                                    'ar' => 'مقاسل المطبخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Kitchen Storage',
                                    'ar' => 'تخزين المطبخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Kitchen Appliances',
                                    'ar' => 'أجهزة المطابخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Kitchen Accessories',
                                    'ar' => 'ملحقات المطابخ'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Earthworks Products',
                            'ar' => 'منتجات-الأعمال-الترابية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Geosynthetic Covers',
                                    'ar' => 'الأغطية الجيوسنتيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Geosynthetic Containment Cells',
                                    'ar' => 'خلايا الاحتواء الجيوسنتيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Geosynthetic Ground Lining',
                                    'ar' => 'الكسية الأرضية الجيوسنتيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Geosynthetic Grids',
                                    'ar' => 'الشبكات الجيوسنتيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Geocomposite',
                                    'ar' => 'مركب الجيوكومبوزيت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Geosynthetic Drainage Networks',
                                    'ar' => 'شبكات تصريف جيوسنتيكية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Plastic Construction Materials',
                            'ar' => 'مواد-البناء-البلاستيكية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Plastic Panels and Drains',
                                    'ar' => 'ألواح ومصائد بلاستيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Profiles',
                                    'ar' => 'مقاطع بلاستيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Architectural Membrane',
                                    'ar' => 'غشاء معماري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Textured Polycarbonate Panels',
                                    'ar' => 'ألواح بولي كربونات منقوشة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Construction Material Accessories',
                                    'ar' => 'ملحقات مواد البناء البلاستيكية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Stone Construction Materials and Their Products',
                            'ar' => 'مواد-البناء-الحجرية-ومنتجاتها'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Cement',
                                    'ar' => 'الأسمنت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bricks',
                                    'ar' => 'الطوب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Roof Tiles',
                                    'ar' => 'قرميد السقف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Powder Gypsum',
                                    'ar' => 'الجبس البودرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sand',
                                    'ar' => 'الرمل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Concrete and Concrete Additives',
                                    'ar' => 'الخرسانة وإضافات الخرسانة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tiles',
                                    'ar' => 'البلاط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Limestone',
                                    'ar' => 'الحيث'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gravel and Stone',
                                    'ar' => 'الحصى والحجر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mortar and Cement Mortar',
                                    'ar' => 'الملك والملك الأسمنتي'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Metal Construction Materials and Their Products',
                            'ar' => 'مواد-البناء-المعدنية-ومنتجاتها'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Steel Products',
                                    'ar' => 'منتجات الصلب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Aluminum Products',
                                    'ar' => 'منتجات الألومنيوم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Galvanized Steel Products',
                                    'ar' => 'منتجات الصلب المجلفن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stainless Steel Products',
                                    'ar' => 'منتجات الصلب المقاوم للصدأ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Construction Material Accessories',
                                    'ar' => 'ملحقات مواد البناء المعدنية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Special Construction Materials',
                            'ar' => 'مواد-بناء-خاصة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Fire Resistant Materials',
                                    'ar' => 'مواد مقاومة الحريق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Heat Insulation Materials',
                                    'ar' => 'مواد عازلة للحرارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Multi-Function Materials',
                                    'ar' => 'مواد متعددة الوظائف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sound Insulation Materials',
                                    'ar' => 'مواد عازلة للصوت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water Resistant Materials',
                                    'ar' => 'مواد مقاومة للماء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Corrosion Resistant Materials',
                                    'ar' => 'مواد مقاومة للتآكل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Acid Resistant Materials',
                                    'ar' => 'مواد مقاومة للأحماض'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Facades and Curtain Walls',
                            'ar' => 'واجهات-وستائر-جدارية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Glass Facades and Curtains',
                                    'ar' => 'واجهات وستائر زجاجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Aluminum Facades and Curtains',
                                    'ar' => 'واجهات وستائر ألنيوم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stone Facades and Curtains',
                                    'ar' => 'واجهات وستائر حجرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Composite Facades and Curtains',
                                    'ar' => 'واجهات وستائر مركبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wall Partitions',
                                    'ar' => 'قواطع الجدار'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Wallpaper and Wall Panels',
                            'ar' => 'ورق-والواح-الحائط'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Traditional Wallpaper',
                                    'ar' => 'ورق حائط تقليدي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vinyl Wallpaper',
                                    'ar' => 'ورق حائط فينيل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Non-Woven Wallpaper',
                                    'ar' => 'ورق حائط غير منسوج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Self-Adhesive Wallpaper',
                                    'ar' => 'ورق حائط لاصق ذاتي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fabric Wallpaper',
                                    'ar' => 'ورق حائط من القماش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => '3D Wallpaper',
                                    'ar' => 'ورق حائط ثلاثي الأبعاد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Natural Wallpaper',
                                    'ar' => 'ورق حائط طبيعي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Paintable Wallpaper',
                                    'ar' => 'ورق حائط قابل للطلاء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wooden Wall Panels',
                                    'ar' => 'ألواح حائط خشبية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'PVC Wall Panels',
                                    'ar' => 'ألواح حائط PVC'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Aluminum Wall Panels',
                                    'ar' => 'ألواح حائط من الألومنيوم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Natural Stone Wall Panels',
                                    'ar' => 'ألواح حائط من الحجر الطبيعي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Glass Wall Panels',
                                    'ar' => 'ألواح حائط من الزجاج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => '3D Wall Panels',
                                    'ar' => 'ألواح حائط ثلاثية الأبعاد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fabric Wall Panels',
                                    'ar' => 'ألواح حائط من القماش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gypsum Wall Panels',
                                    'ar' => 'ألواح حائط من الجبس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Acrylic Wall Panels',
                                    'ar' => 'ألواح حائط أكريليك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Decorative Wall Panels',
                                    'ar' => 'ألواح حائط جدارية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Stones',
                            'ar' => 'أحجار'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Artificial Stone',
                                    'ar' => 'حجر صناعي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Landscaping Stone',
                                    'ar' => 'حجر تنسيق الحدائق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Limestone',
                                    'ar' => 'حجر جيري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Natural Stone',
                                    'ar' => 'حجر طبيعي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stone Engravings',
                                    'ar' => 'نقوش حجرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Breakfast Stone',
                                    'ar' => 'حجر الفطار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pavement Stone',
                                    'ar' => 'حجر الرصيف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sandstone',
                                    'ar' => 'حجر رملي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Coral Limestone',
                                    'ar' => 'حجر جيري مرجاني'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Integrated Limestone',
                                    'ar' => 'حجر جيري مدمج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Granite Stone',
                                    'ar' => 'حجر جرانيت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Marble Stone',
                                    'ar' => 'حجر رخام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Slate',
                                    'ar' => 'أردواز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Parquet',
                                    'ar' => 'بارلت'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Countertops, Sinks and Tables',
                            'ar' => 'أسطح-العمل-والاحواض-والطاولات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Granite',
                                    'ar' => 'الجرانيت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Marble',
                                    'ar' => 'الرخام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Quartz',
                                    'ar' => 'الكوارتز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Engineered Stone',
                                    'ar' => 'الحجر الهندسي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wood',
                                    'ar' => 'الخشب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Accessories',
                                    'ar' => 'ملحقات'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Building Panels',
                            'ar' => 'ألواح-البناء'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Bamboo Panels',
                                    'ar' => 'ألواح الخيزران'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Straw Panels',
                                    'ar' => 'ألواح القش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Panels',
                                    'ar' => 'ألواح بلاستيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Panels',
                                    'ar' => 'ألواح معدنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gypsum Panels',
                                    'ar' => 'ألواح الجبس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cement Panels',
                                    'ar' => 'ألواح الأسمنت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Composite Wall Panels',
                                    'ar' => 'الألواح الحائط المركبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Building Panel Accessories',
                                    'ar' => 'ملحقات ألواح البناء'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Pipes and Connections',
                            'ar' => 'أنابيب-وموصلات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'PVC Pipes and Connections',
                                    'ar' => 'PVC أنابيب وموصلات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Pipes and Connections',
                                    'ar' => 'أنابيب وموصلات معدنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Pipes and Connections',
                                    'ar' => 'أنابيب وموصلات بلاستيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pipe and Connection Accessories',
                                    'ar' => 'ملحقات الأنابيب والموصلات'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Heating, Ventilation and Air Conditioning Systems',
                            'ar' => 'أنظمة-التدفئة-والتهوية-وتكييف-الهواء'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Residential HVAC Systems',
                                    'ar' => 'أنظمة التدفئة والتهوية وتكييف الهواء السكنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Commercial HVAC Systems',
                                    'ar' => 'أنظمة التدفئة والتهوية وتكييف الهواء التجارية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Industrial HVAC Systems',
                                    'ar' => 'أنظمة التدفئة والتهوية وتكييف الهواء الصناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'HVAC System Spare Parts',
                                    'ar' => 'قطع غيار أنظمة التدفئة والتهوية وتكييف الهواء'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Flooring',
                            'ar' => 'الأرضيات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Anti-Static Flooring',
                                    'ar' => 'أرضيات مضادة للكهرباء الساكنة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bamboo Flooring',
                                    'ar' => 'أرضيات الخيزران'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Straw Flooring',
                                    'ar' => 'أرضيات القش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Engineered Flooring',
                                    'ar' => 'أرضيات هندسية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Flooring Accessories',
                                    'ar' => 'إكسسوارات الأرضيات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Flooring',
                                    'ar' => 'أرضيات بلاستيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rubber Flooring',
                                    'ar' => 'أرضيات مطاطية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wooden Flooring',
                                    'ar' => 'أرضيات خشبية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Solid Wood Flooring',
                                    'ar' => 'أرضيات خشبية صلبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Parquet Flooring',
                                    'ar' => 'أرضيات باركيه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Laminate Flooring',
                                    'ar' => 'أرضيات لاميت'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Ceilings',
                            'ar' => 'الأسقف'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Gypsum Ceilings',
                                    'ar' => 'أسقف الجبس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Ceilings',
                                    'ar' => 'أسقف معدنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wooden Ceilings',
                                    'ar' => 'أسقف خشبية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hard Plastic Ceilings',
                                    'ar' => 'أسقف من البلاستيك الصلب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Aluminum Ceilings',
                                    'ar' => 'أسقف من الألومنيوم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ceiling Grid Components',
                                    'ar' => 'مكونات شبكة السقف'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Fencing',
                            'ar' => 'الاخشاب'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Wood veneer',
                                    'ar' => 'قشرة خشبية'
                                ]
                            ],
                            [
                                'name' => [
                                    'en' => 'High-Pressure Decorative Laminates (HPL)',
                                    'ar' => 'ألواح زخرفية عالية الضغط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plywood',
                                    'ar' => 'خشب رقائقي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fiberboards',
                                    'ar' => 'ألواح ليفية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Particle boards',
                                    'ar' => 'ألواح رقائقية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Solid wood boards',
                                    'ar' => 'ألواح خشب صلب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Self-adhesive plywood panels',
                                    'ar' => 'ألواح خشب رقائقي لاصق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Melamine boards',
                                    'ar' => 'ألواح الميلامين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Decay-resistant wood',
                                    'ar' => 'خشب مقاوم للتاكل'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Fireplaces and stoves',
                            'ar' => 'المدافئ والمواقد'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Stoves',
                                    'ar' => 'مدافئ'
                                ]
                            ],
                            [
                                'name' => [
                                    'en' => 'Fireplace spare parts',
                                    'ar' => 'قطع غيار المدافئ'
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Glass',
                            'ar' => 'الزجاج'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Polished Glass',
                                    'ar' => 'زجاج مصقول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tempered Glass',
                                    'ar' => 'زجاج مقوى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Waste Glass',
                                    'ar' => 'زجاج مخلف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Insulated Glass',
                                    'ar' => 'زجاج معزول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Patterned Glass',
                                    'ar' => 'زجاج منقوش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Heat-Reflective Glass',
                                    'ar' => 'زجاج عاكس للحرارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Opaque Glass',
                                    'ar' => 'زجاج معتم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fire-Resistant Glass',
                                    'ar' => 'زجاج مقاوم للحريق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bulletproof Glass',
                                    'ar' => 'زجاج مضاد للرصاص'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Decorative Glass',
                                    'ar' => 'زجاج مزخرف'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Packaging, wrapping, and printing',
                    'ar' => 'التعبئة والتغليف والطباعة'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Packaging and filling bags',
                            'ar' => 'اكياس تعبئة وتغليف'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Fast delivery packaging bag',
                                    'ar' => 'كيس تعبئة وتغليف توصيل سريع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pet food packaging bag',
                                    'ar' => 'كيس تعبئة وتغليف طعام حيوانات أليفة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tissue packing and packaging bag',
                                    'ar' => 'كيس تعبئة وتغليف مناديل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other packaging and wrapping bags',
                                    'ar' => 'أكياس تغليف وتعبئة أخرى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Anti-static packaging materials',
                                    'ar' => 'مواد تعبئة تغليف مضادة للكهرباء الساكنة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Construction materials filling and packaging bag',
                                    'ar' => 'كيس تعبئة وتغليف مواد بناء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chemical materials filling and packaging bag',
                                    'ar' => 'كيس تعبئة وتغليف مواد كيميائية'
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Packaging and Transportation',
                            'ar' => 'التعبئة-والنقل'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Containers and Equipment',
                                    'ar' => 'حاويات وتجهيزات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Freight and Logistics Packaging',
                                    'ar' => 'تعبئة الشحن واللوجستيات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Edge and Corner Protectors',
                                    'ar' => 'واقي الحواف والأركان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Foam Packaging',
                                    'ar' => 'تعبئة إسفنجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pallets',
                                    'ar' => 'منصات نقالة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Transport Containers',
                                    'ar' => 'حاويات نقل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Covers, Bottle Caps, and Closures',
                                    'ar' => 'أغطية، أغطية زجاجات، وأقفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Air Bags for Cargo Support',
                                    'ar' => 'أكياس هوائية لدعم البضائع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Packaging Cards',
                                    'ar' => 'بطاقات تغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cup Covers',
                                    'ar' => 'أغطية أكواب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Barrels and Buckets for Packaging',
                                    'ar' => 'براميل ودلاء تعبئة وتغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bottles and Containers for Packaging',
                                    'ar' => 'زجاجات وأوعية تعبئة وتغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cups for Packaging',
                                    'ar' => 'أكواب تعبئة وتغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Boxes for Packaging',
                                    'ar' => 'صناديق تعبئة وتغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cans and Jars for Packaging',
                                    'ar' => 'علب ومرطبانات تعبئة وتغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cardboard for Packaging',
                                    'ar' => 'كرتون تعبئة وتغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tubes for Packaging',
                                    'ar' => 'أنابيب تعبئة وتغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Labels for Packaging',
                                    'ar' => 'ملصقات تعبئة وتغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Paper for Packaging',
                                    'ar' => 'ورق تعبئة وتغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ropes and Straps for Packaging',
                                    'ar' => 'حبال وأشرطة تعبئة وتغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Trays for Packaging',
                                    'ar' => 'صينية تعبئة وتغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'VCI Packaging (Anti-Corrosion)',
                                    'ar' => '(مانع للتكتل) VCI تغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Adhesive Tape for Packaging',
                                    'ar' => 'شريط لاصق للتعبئة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Primary Plastic Forming',
                                    'ar' => 'تشكيل بلاستيكي أولي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Protective and Cushioning Materials',
                                    'ar' => 'مواد واقية ومبطنة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Slip Sheet',
                                    'ar' => 'ورقة انزلاق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Packaging and Transportation Materials',
                                    'ar' => 'مواد تعبئة ونقل أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Logistics Packaging and Wrapping',
                            'ar' => 'تعبئة-وتغليف-لوجستي'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Circular Container Bag',
                                    'ar' => 'كيس حاوية دائري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Container Lining Bag',
                                    'ar' => 'كيس تبطين حاوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'FIBC Bulk Bag',
                                    'ar' => 'FIBC حرام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mesh Bag',
                                    'ar' => 'كيس شبكي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'FIBC Pallet Base Platform',
                                    'ar' => 'FIBC منصة نقالة قاعدة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Square Container Bag',
                                    'ar' => 'كيس حاوية مربع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'U-Shaped Container Bag',
                                    'ar' => 'U كيس حاوية على شكل حرف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Woven Bag',
                                    'ar' => 'كيس منسوج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Woven Fabric Roll',
                                    'ar' => 'لفة قماش منسوج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Packaging Bags and Pouches',
                                    'ar' => 'أكياس وحقائب أخرى للتعبئة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Pharmaceutical Packaging and Filling',
                            'ar' => 'تغليف-وتعبئة-أدوية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Pharmaceutical Packaging Bags',
                                    'ar' => 'أكياس تعبئة وتغليف صيدلانية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pharmaceutical Packaging Boxes',
                                    'ar' => 'صناديق تعبئة وتغليف صيدلانية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pharmaceutical Packaging Tubes',
                                    'ar' => 'أنابيب تعبئة وتغليف صيدلانية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pharmaceutical Packaging Bottles',
                                    'ar' => 'زجاجات تعبئة وتغليف صيدلانية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pharmaceutical Packaging Vials',
                                    'ar' => 'قوارير تعبئة وتغليف صيدلانية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pharmaceutical Packaging Ampoules',
                                    'ar' => 'أمبولات تعبئة وتغليف صيدلانية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Pharmaceutical Packaging',
                                    'ar' => 'التعبئة والتغليف الصيدلانية الأخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Agricultural Packaging and Filling',
                            'ar' => 'تغليف-وتعبئة-زراعية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Agricultural Packaging and Filling Bags',
                                    'ar' => 'أكياس تعبئة وتغليف زراعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Agricultural Packaging and Filling Boxes',
                                    'ar' => 'صناديق تعبئة وتغليف زراعي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Agricultural Packaging and Filling',
                                    'ar' => 'تعبئة وتغليف زراعية أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Cosmetics Packaging and Filling',
                            'ar' => 'تغليف-وتعبئة-مستحضرات-تجميل'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Cosmetics Packaging and Filling Bags',
                                    'ar' => 'أكياس تعبئة وتغليف مستحضرات تجميل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cosmetics Boxes and Cartons',
                                    'ar' => 'صناديق وكرتون مستحضرات تجميل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cosmetics Packaging and Filling Tubes',
                                    'ar' => 'أنابيب تعبئة وتغليف مستحضرات تجميل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cosmetics Packaging and Filling Bottles',
                                    'ar' => 'زجاجات تعبئة وتغليف مستحضرات تجميل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Cosmetics Packaging and Filling',
                                    'ar' => 'تعبئة وتغليف مستحضرات تجميل أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Clothing Packaging and Filling',
                            'ar' => 'تغليف-وتعبئة-ملابس'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Clothing Packaging and Filling Bags',
                                    'ar' => 'أكياس تعبئة وتغليف ملابس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Clothing Packaging and Filling Boxes',
                                    'ar' => 'صناديق تعبئة وتغليف ملابس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Clothing Packaging and Filling Covers',
                                    'ar' => 'أغلفة تعبئة وتغليف ملابس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Clothing Packaging and Filling',
                                    'ar' => 'تعبئة وتغليف ملابس أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Food Packaging and Filling',
                            'ar' => 'تغليف-وتعبئة-مواد-غذائية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Food Packaging and Filling Bags',
                                    'ar' => 'أكياس تعبئة وتغليف مواد غذائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Food Packaging and Filling Boxes',
                                    'ar' => 'صناديق تعبئة وتغليف مواد غذائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Food Packaging and Filling Covers',
                                    'ar' => 'أغلفة تعبئة وتغليف مواد غذائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Food Packaging and Filling Trays',
                                    'ar' => 'صينية تعبئة وتغليف غذائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Food Packaging and Filling Bottles',
                                    'ar' => 'قوارير تعبئة وتغليف مواد غذائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Food Packaging and Filling Cans and Jars',
                                    'ar' => 'علب ومرطبانات تعبئة وتغليف مواد غذائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Food Packaging and Filling',
                                    'ar' => 'تعبئة وتغليف مواد غذائية أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Gift Packaging and Filling',
                            'ar' => 'تغليف-وتعبئة-هدايا'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Gift Packaging and Filling Bags',
                                    'ar' => 'أكياس تعبئة وتغليف هدايا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gift Packaging and Filling Boxes',
                                    'ar' => 'صناديق تعبئة وتغليف هدايا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gift Packaging and Filling Containers',
                                    'ar' => 'علب تعبئة وتغليف هدايا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gift Packaging and Filling Covers',
                                    'ar' => 'أغلفة تعبئة وتغليف هدايا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gift Packaging and Filling Holders',
                                    'ar' => 'أحضوات تعبئة وتغليف هدايا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Gift Packaging and Filling',
                                    'ar' => 'مجوهرات أخرى تعبئة وتغليف هدايا'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Filling Bottles',
                            'ar' => 'زجاجات-التعبئة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Dropper Filling Bottle',
                                    'ar' => 'زجاجة تعبئة قطارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pull-Ring Filling Bottle',
                                    'ar' => 'زجاجة تعبئة ذات حلقة سحب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pump Filling Bottle',
                                    'ar' => 'زجاجة تعبئة بمضخة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rotary Filling Bottle',
                                    'ar' => 'زجاجة تعبئة دوارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Perfume Filling Bottle',
                                    'ar' => 'زجاجة تعبئة عطر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bottle Sets',
                                    'ar' => 'طقم زجاجات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chemical Filling Bottle',
                                    'ar' => 'زجاجة تعبئة مواد كيميائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mercury Filling Bottle',
                                    'ar' => 'زجاجة تعبئة زئاد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pressure Filling Bottle',
                                    'ar' => 'زجاجة تعبئة ضغط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sub-Filling Bottle',
                                    'ar' => 'زجاجة تعبئة فرعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vacuum Filling Bottle',
                                    'ar' => 'زجاجة تعبئة مفرغة الهواء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Glass Filling Bottle',
                                    'ar' => 'زجاجة تعبئة زجاجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plastic Filling Bottle',
                                    'ar' => 'زجاجة تعبئة بلاستيكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Filling Bottle',
                                    'ar' => 'زجاجة تعبئة معدنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Aluminum Filling Bottle',
                                    'ar' => 'زجاجة تعبئة ألمنيوم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stainless Steel Filling Bottle',
                                    'ar' => 'زجاجة تعبئة فولاذ مقاوم للصدأ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ceramic Filling Bottle',
                                    'ar' => 'زجاجة تعبئة سيراميك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Filling and Packaging Bottles',
                                    'ar' => 'زجاجات تعبئة وتغليف أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Packaging Materials',
                            'ar' => 'مواد-التغليف'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Aluminum Foil',
                                    'ar' => 'رقائق ألومنيوم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cardboard Strong Paper',
                                    'ar' => 'كرتون ورق مقوى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Flexible Packaging Materials',
                                    'ar' => 'مواد تغليف مرنة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Corrugated Cardboard Paper',
                                    'ar' => 'ورق بكرتون ممجح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hot Seal Foil',
                                    'ar' => 'رقائق ختم ساخن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Kraft Paper',
                                    'ar' => 'ورق كرافت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Laser Film',
                                    'ar' => 'فيلم ليزر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Metal Film',
                                    'ar' => 'فيلم معدني'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Knitting Thread',
                                    'ar' => 'خيط حياكة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shrink Film',
                                    'ar' => 'فيلم قابل للانكماش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stretch Film',
                                    'ar' => 'فيلم قابل للتمدد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Packaging Materials',
                                    'ar' => 'مواد تغليف أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Printing Materials',
                            'ar' => 'مواد-الطباعة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Packaging Inks',
                                    'ar' => 'أحبار التغليف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Transfer Paper and Film',
                                    'ar' => 'ورق و فيلم نقل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Printing Foil',
                                    'ar' => 'رقائق الطبع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Printing Plates',
                                    'ar' => 'ألواح الطباعة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Printing Screen',
                                    'ar' => 'شبكة الطباعة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Printing Board',
                                    'ar' => 'لوحة الطباعة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Printing Materials',
                                    'ar' => 'مواد طباعة أخرى'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Bags, shoes, and their accessories.',
                    'ar' => 'الحقائب والأحذية وأكسسوراتها'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Baby shoes',
                            'ar' => 'أحذية الأطفال الرضع'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Crawling shoes',
                                    'ar' => 'أحذية الزحف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Winter shoes',
                                    'ar' => 'احذية شتوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shoes for special occasions',
                                    'ar' => 'أحذية خاصة بالمناسبات'
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Girls Shoes',
                            'ar' => 'أحذية-البنات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Winter Girls Shoes',
                                    'ar' => 'أحذية البنات الشتوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Casual Girls Shoes',
                                    'ar' => 'أحذية البنات غير الرسمية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Formal Girls Shoes',
                                    'ar' => 'أحذية البنات الرسمية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Girls Sandals',
                                    'ar' => 'صندل البنات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sports Girls Shoes',
                                    'ar' => 'أحذية البنات الرياضية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Men\'s Shoes',
                            'ar' => 'أحذية-الرجال'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Men\'s Winter Shoes',
                                    'ar' => 'أحذية الرجال الشتوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Men\'s Casual Shoes',
                                    'ar' => 'أحذية الرجال غير الرسمية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Men\'s Formal Shoes',
                                    'ar' => 'أحذية الرجال الرسمية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Men\'s Sandals',
                                    'ar' => 'صندل الرجال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Men\'s Slippers',
                                    'ar' => 'نعال الرجال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Men\'s Sports Shoes',
                                    'ar' => 'أحذية الرجال الرياضية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Women\'s Shoes',
                            'ar' => 'أحذية-النساء'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Women\'s Boots',
                                    'ar' => 'أحذية بوت نسائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Women\'s High Heels',
                                    'ar' => 'أحذية كعب عالي نسائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Women\'s Dancing Shoes',
                                    'ar' => 'أحذية رقص نسائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Women\'s Dress Shoes',
                                    'ar' => 'أحذية فستان نسائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Women\'s Flat Shoes',
                                    'ar' => 'أحذية مسطحة نسائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Women\'s High-Heeled Shoes',
                                    'ar' => 'أحذية عالية الكعب نسائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Women\'s Sandals',
                                    'ar' => 'صندل نسائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Women\'s Shoes (General)',
                                    'ar' => 'أحذية نسائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Women\'s Slippers',
                                    'ar' => 'شباشب نسائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Women\'s Sports Shoes',
                                    'ar' => 'أحذية رياضية نسائية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Boys\' Shoes',
                            'ar' => 'أحذية-الأولاد'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Boys\' Winter Shoes',
                                    'ar' => 'أحذية الأولاد الشتوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Boys\' Casual Shoes',
                                    'ar' => 'أحذية الأولاد غير الرسمية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Boys\' Formal Shoes',
                                    'ar' => 'أحذية الأولاد الرسمية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Boys\' Sandals',
                                    'ar' => 'صندل الأولاد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Boys\' Slippers',
                                    'ar' => 'نعال الأولاد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Boys\' Sports Shoes',
                                    'ar' => 'أحذية الأولاد الرياضية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Bags and Shoes Accessories',
                            'ar' => 'أكسسورات-الحقائب-والأحذية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Bags Accessories',
                                    'ar' => 'أكسسورات الحقائب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shoes Accessories',
                                    'ar' => 'أكسسورات الأحذية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Special Items Bags',
                            'ar' => 'حقائب-الأغراض-الخاصة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Camera Bags',
                                    'ar' => 'حقائب الكاميرا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'CD Bags and Covers',
                                    'ar' => 'حقائب وأغطية الأقراص المضغوطة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'CD Player Bags',
                                    'ar' => 'حقائب مشغلات الأقراص المضغوطة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chip Bags',
                                    'ar' => 'حقائب الرقائق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cosmetics Bags',
                                    'ar' => 'حقائب مستحضرات التجميل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children\'s Device Bags',
                                    'ar' => 'حقائب أجهزة الأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Eyewear Bags',
                                    'ar' => 'حقائب النظارات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Musical Instrument Bags and Covers',
                                    'ar' => 'حقائب وأغطية الآلات الموسيقية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'MP3 Bags',
                                    'ar' => 'حقائب MP3'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'PDA Bags',
                                    'ar' => 'حقائب PDA'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Promotional Bags',
                                    'ar' => 'حقائب ترويجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'School Bags',
                                    'ar' => 'حقائب المدرسة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shopping Bags',
                                    'ar' => 'حقائب التسوق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Video Game Device Bags',
                                    'ar' => 'حقائب أجهزة ألعاب الفيديو'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Sports Bags',
                            'ar' => 'حقائب-الرياضة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Backpack Bags',
                                    'ar' => 'حقائب الظهر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Camping and Hiking Bags',
                                    'ar' => 'حقائب التخييم والمشي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gym Bags',
                                    'ar' => 'حقائب الصالة الرياضية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Picnic Bags',
                                    'ar' => 'حقائب النزهة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Travel Bags and Work Bags',
                            'ar' => 'حقائب-السفر-وحقائب-العمل'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Portable Travel Bags',
                                    'ar' => 'حقائب السفر المحمولة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Doll Bags',
                                    'ar' => 'حقائب الذل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Clothing Bags',
                                    'ar' => 'حقائب الملابس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Leather Work Bags',
                                    'ar' => 'حقائب عمل جلدية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Leather Travel Bags',
                                    'ar' => 'حقائب سفر جلدية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Travel Bag Sets',
                                    'ar' => 'مجموعات حقائب السفر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wheeled Travel Bags',
                                    'ar' => 'حقائب السفر ذات العجلات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cart Bags',
                                    'ar' => 'حقائب العربة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wheeled Work Bags',
                                    'ar' => 'حقائب عمل ذات العجلات'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Handbags and Bags',
                            'ar' => 'حقائب-اليد-والحقائب'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Small Handbags',
                                    'ar' => 'حقائب اليد الصغيرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Evening Bags',
                                    'ar' => 'حقائب السهرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Leather Handbags',
                                    'ar' => 'حقائب يد جلدية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Reusable Bags',
                                    'ar' => 'حقائب قابلة لإعادة الاستخدام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shoulder Bags',
                                    'ar' => 'حقائب الكتف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Carry Bags',
                                    'ar' => 'حقائب حمل'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Wallets',
                            'ar' => 'محافظ'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Checkbook Holders',
                                    'ar' => 'حاملات دفتر الشيكات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Coin Wallets',
                                    'ar' => 'محافظ العملة المعدنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Credit Card Holders',
                                    'ar' => 'حاملات بطاقات الائتمان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Leather Wallets',
                                    'ar' => 'محافظ جلدية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Men\'s Wallets',
                                    'ar' => 'محافظ رجالية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Women\'s Wallets',
                                    'ar' => 'محافظ نسائية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Raw Materials for Shoes',
                            'ar' => 'مواد-خام-للأحذية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Shoe Fabric',
                                    'ar' => 'قماش الأحذية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shoe Leather',
                                    'ar' => 'جلد الأحذية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shoe Materials',
                                    'ar' => 'مواد الأحذية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shoe Plastic',
                                    'ar' => 'بلاستيك الأحذية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shoe Rubber',
                                    'ar' => 'مطاط الأحذية'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Sports and Recreation',
                    'ar' => 'الرياضة والترفية'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Outdoor sports',
                            'ar' => 'الرياضات الخارجية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Camping and hiking supplies',
                                    'ar' => 'مستلزمات التخييم والمشي لمسافات طويلة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Aquatic fishing supplies',
                                    'ar' => 'مستلزمات الصيد المائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Go-kart cars',
                                    'ar' => 'سيارات الكارتينج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Horse supplies',
                                    'ar' => 'مستلزمات الخيول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wild hunting supplies',
                                    'ar' => 'مستلزمات الصيد البري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Shooting supplies',
                                    'ar' => 'مستلزمات الرماية'
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Indoor Sports',
                            'ar' => 'الرياضات-الداخلية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Badminton Game Supplies',
                                    'ar' => 'مستلزمات لعبة البادمنتون'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bowling Game Supplies',
                                    'ar' => 'مستلزمات لعبة البولينج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Snooker and Billiards Supplies',
                                    'ar' => 'مستلزمات السنوكر والبلياردو'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Table Tennis Supplies',
                                    'ar' => 'مستلزمات تنس الطاولة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Winter Sports',
                            'ar' => 'الرياضات-الشتوية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Skiing Supplies',
                                    'ar' => 'لوازم التزلج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Snow Sledding Supplies',
                                    'ar' => 'لوازم قيادة الزلاجة الثلجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ice Skating Supplies',
                                    'ar' => 'لوازم التزلج على الجليد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sledging Supplies',
                                    'ar' => 'لوازم الزلاجات'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Cycling',
                            'ar' => 'ركوب-الدراجات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Road Bicycles',
                                    'ar' => 'الدراجات على الطريق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Track Bicycles',
                                    'ar' => 'الدراجات على المضمار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mountain Bicycles',
                                    'ar' => 'الدراجات الجبلية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'BMX Bicycles',
                                    'ar' => 'دراجات BMX'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Free Bicycles',
                                    'ar' => 'الدراجات الحرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cross-Country Bicycles',
                                    'ar' => 'الدراجات عبر البلاد'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stationary Bicycles',
                                    'ar' => 'الدراجات الثابتة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Indoor Bicycles',
                                    'ar' => 'الدراجات الداخلية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Team Sports Supplies',
                            'ar' => 'لوازم-الرياضات-الجماعية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Baseball Supplies',
                                    'ar' => 'مستلزمات البيسبول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Basketball Supplies',
                                    'ar' => 'مستلزمات كرة السلة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cricket Supplies',
                                    'ar' => 'مستلزمات الكريكيت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Football Supplies',
                                    'ar' => 'مستلزمات كرة القدم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hockey Supplies',
                                    'ar' => 'مستلزمات الهوكي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Volleyball Supplies',
                                    'ar' => 'مستلزمات الكرة الطائرة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Water Sports Supplies',
                            'ar' => 'لوازم-الرياضات-المائية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Boat Supplies',
                                    'ar' => 'لوازم القوارب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Surfing Supplies',
                                    'ar' => 'لوازم ركوب الأمواج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Swimming and Diving Supplies',
                                    'ar' => 'لوازم السباحة والغوص'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Sports Safety Supplies',
                            'ar' => 'لوازم-سلامة-الرياضة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Ankle Support',
                                    'ar' => 'دعامة الكاحل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Back Support',
                                    'ar' => 'دعامة الظهر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Elbow and Knee Protectors',
                                    'ar' => 'واقيات المرفق والركبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Helmets',
                                    'ar' => 'خوذات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Leg Protector',
                                    'ar' => 'واقي الساق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Waist Support',
                                    'ar' => 'دعامة الخصر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wrist Support',
                                    'ar' => 'دعامة المعصم'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Tennis Products',
                            'ar' => 'منتجات-التنس'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Tennis Balls',
                                    'ar' => 'كرات التنس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tennis Rackets',
                                    'ar' => 'مضارب التنس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tennis Racket Covers',
                                    'ar' => 'أغطية مضارب التنس'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Golf Products',
                            'ar' => 'منتجات-الغولف'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Golf Bags',
                                    'ar' => 'حقائب الغولف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Golf Balls',
                                    'ar' => 'كرات الغولف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Golf Carts',
                                    'ar' => 'عربات الغولف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Golf Spare Parts',
                                    'ar' => 'قطع غيار الغولف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Golf Clubs',
                                    'ar' => 'أندية الغولف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Golf Gloves',
                                    'ar' => 'قفازات الغولف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Golf Ball Tees',
                                    'ar' => 'مسانيد كرات الغولف (تييز)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Golf Training Tools',
                                    'ar' => 'أدوات تدريب الغولف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Golf Cart Pulling',
                                    'ar' => 'عربة جر الغولف'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Fitness Products',
                            'ar' => 'منتجات-اللياقة-البدنية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Boxing Supplies',
                                    'ar' => 'مستلزمات الملاكمة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fitness Gloves',
                                    'ar' => 'قفازات اللياقة البدنية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gym Equipment',
                                    'ar' => 'معدات الجيم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gymnastics Tools',
                                    'ar' => 'أدوات الجيمناز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Jump Ropes',
                                    'ar' => 'حبال القفز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Martial Arts Supplies',
                                    'ar' => 'مستلزمات فنون القتال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Outdoor Fitness Equipment',
                                    'ar' => 'معدات اللياقة البدنية الخارجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Step Counters',
                                    'ar' => 'عدادات الخطوات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Trampoline',
                                    'ar' => 'ترامبولين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Weight Lifting',
                                    'ar' => 'رفع الأثقال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Yoga Clothing',
                                    'ar' => 'ملابس اليوجا'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Amusement Parks',
                            'ar' => 'منتزهات-الترفيه'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Bumper Cars',
                                    'ar' => 'سيارات التصادم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Artificial Climbing Equipment',
                                    'ar' => 'معدات تسلق صناعية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Garden and Park Games',
                                    'ar' => 'ألعاب الحدائق والمنتزهات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Animal Riding Games',
                                    'ar' => 'ألعاب ركوب الحيوانات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Children\'s Sliding Games',
                                    'ar' => 'ألعاب أطفال منزلقة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water Games Equipment',
                                    'ar' => 'معدات ألعاب مائية'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Agriculture',
                    'ar' => 'الزراعة'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Organic Foods',
                            'ar' => 'أطعمة عضوية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Organic fruit',
                                    'ar' => 'فاكهة عضوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Organic grains',
                                    'ar' => 'حبوب عضوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Organic oil',
                                    'ar' => 'زيت عضوي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Organic tea',
                                    'ar' => 'شاي عضوي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Organic Vegetables',
                                    'ar' => 'خضروات عضوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other organic foods',
                                    'ar' => 'أطعمة عضوية أخرى'
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Tobacco',
                            'ar' => 'التبغ'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Common Tobacco',
                                    'ar' => 'التبغ الشائع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wild Tobacco',
                                    'ar' => 'التبغ البري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Tobacco Products',
                                    'ar' => 'منتجات التبغ الأخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Fresh Grains',
                            'ar' => 'الحبوب-الطازجة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Barley',
                                    'ar' => 'الشعير'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Buckwheat',
                                    'ar' => 'الحنطة السوداء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Corn',
                                    'ar' => 'الذرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Millet',
                                    'ar' => 'الدخن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Oats',
                                    'ar' => 'الشوفان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Quinoa',
                                    'ar' => 'الكينوا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rice',
                                    'ar' => 'الأرز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rye',
                                    'ar' => 'الجاودار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sorghum',
                                    'ar' => 'الذرة الرفيعة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wheat',
                                    'ar' => 'القمح'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'White Corn',
                                    'ar' => 'الذرة البيضاء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Yellow Corn',
                                    'ar' => 'الذرة الصفراء'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Fresh Vegetables',
                            'ar' => 'الخضروات-الطازجة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Leafy Vegetables',
                                    'ar' => 'الخضروات الورقية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Root Vegetables',
                                    'ar' => 'الخضروات الجذرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hard Vegetables',
                                    'ar' => 'الخضروات الصلبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Flower Vegetables',
                                    'ar' => 'الخضروات الزهرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fruit Vegetables',
                                    'ar' => 'الخضروات الثمرية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Fresh Fruits',
                            'ar' => 'الفواكة-الطازجة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Citrus Fruits',
                                    'ar' => 'الفواكة الحمضية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Apple Fruits',
                                    'ar' => 'لفواكة التفاحية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Berries',
                                    'ar' => 'توتيات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tropical Fruits',
                                    'ar' => 'الفواكة الاستوائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Melons',
                                    'ar' => 'البطيخيات'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Fresh Meat, Poultry, and Fish',
                            'ar' => 'اللحوم-والدواجن-والاسماك-الطازجة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Beef',
                                    'ar' => 'لحم البقر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lamb',
                                    'ar' => 'لحم الضأن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Veal',
                                    'ar' => 'لحم العجل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chicken',
                                    'ar' => 'دجاج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Turkey',
                                    'ar' => 'ديك رومي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Duck',
                                    'ar' => 'بط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Goose',
                                    'ar' => 'إوز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Quail',
                                    'ar' => 'سمان'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Plant Seeds',
                            'ar' => 'بذور-نباتية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Clover Seeds',
                                    'ar' => 'بذور البرسيم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Castor Seeds',
                                    'ar' => 'بذور الخروع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cotton Seeds',
                                    'ar' => 'بذور القطن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Flax Seeds',
                                    'ar' => 'بذور الكتان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Flower and Tree Seeds',
                                    'ar' => 'بذور وأشجار الزهور'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Feed Seeds',
                                    'ar' => 'بذور العلف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fruit Tree Seedlings',
                                    'ar' => 'فصائل وأشجار الفاكهة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Coated Seeds',
                                    'ar' => 'بذور محببة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Jatropha Seeds',
                                    'ar' => 'بذور الجات دوقا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Onion Seeds',
                                    'ar' => 'بذور البصل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Turnip Seeds',
                                    'ar' => 'بذور اللفت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Turmeric Seeds',
                                    'ar' => 'بذور الكركم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sesame Seeds',
                                    'ar' => 'بذور السمسم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sunflower Seeds',
                                    'ar' => 'بذور عباد الشمس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tomato Seeds',
                                    'ar' => 'بذور الطماطم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Plant Seeds',
                                    'ar' => 'بذور نباتية أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Seeds',
                            'ar' => 'بذور'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Flower Seeds',
                                    'ar' => 'بذور الزهور'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Grass Seeds',
                                    'ar' => 'بذور العشب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Herb Seeds',
                                    'ar' => 'بذور الأعشاب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Oil Seeds',
                                    'ar' => 'بذور الزيت'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vegetable Seeds',
                                    'ar' => 'بذور الخضروات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Seeds',
                                    'ar' => 'بذور أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Fresh Legumes',
                            'ar' => 'بقوليات-الطازجة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Bean Products',
                                    'ar' => 'منتجات الفول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chickpeas',
                                    'ar' => 'الحمص'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fenugreek',
                                    'ar' => 'الحلبة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lentils',
                                    'ar' => 'العدس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'White Beans',
                                    'ar' => 'البيضاء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lupins',
                                    'ar' => 'الترمس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Peas',
                                    'ar' => 'البازلاء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Soybeans',
                                    'ar' => 'فول الصويا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Legumes',
                                    'ar' => 'بقوليات أخرى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Oils and Fats',
                            'ar' => 'زيوت-ودهون'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Plant Oil',
                                    'ar' => 'زيت نباتي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plant Fat',
                                    'ar' => 'دهن نباتي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Animal Oil',
                                    'ar' => 'زيت حيواني'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Animal Fat',
                                    'ar' => 'دهن حيواني'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Animal Feed',
                            'ar' => 'علف-الحيوانات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Clover Grass',
                                    'ar' => 'عشب البرسيم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ground Bones',
                                    'ar' => 'عظام مطحونة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cattle Feed',
                                    'ar' => 'علف للماشية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chicken Feed',
                                    'ar' => 'علف للدجاج'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Horse Feed',
                                    'ar' => 'علف الخيول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fish Feed',
                                    'ar' => 'علف الأسماك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hay',
                                    'ar' => 'تبن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Feed',
                                    'ar' => 'علف آخر'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Fresh Nuts',
                            'ar' => 'مكسرات-الطازجة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Almonds',
                                    'ar' => 'لوز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Apricot Kernels',
                                    'ar' => 'نواة المشمش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pepper Kernels',
                                    'ar' => 'نواة الفوفل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Brazil Nuts',
                                    'ar' => 'جوز البرازيل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cashews',
                                    'ar' => 'كاجو'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chestnuts',
                                    'ar' => 'كستناء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hazelnuts',
                                    'ar' => 'بندق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Macadamia Nuts',
                                    'ar' => 'جوز الماكاداميا'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Watermelon Seeds',
                                    'ar' => 'بذور البطيخ'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Peanuts',
                                    'ar' => 'فول سوداني'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pecans',
                                    'ar' => 'بيكان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pine Nuts',
                                    'ar' => 'صنوبر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pistachios',
                                    'ar' => 'فستق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pumpkin Seeds',
                                    'ar' => 'نواة القرع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sunflower Seeds',
                                    'ar' => 'نواة عباد الشمس'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Walnuts',
                                    'ar' => 'عين الجمل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Other Nuts and Seeds',
                                    'ar' => 'مكسرات وبذور أخرى'
                                ],
                            ]
                        ]
                    ]

                ]
            ],
            [
                'name' => [
                    'en' => 'Health and Medicine',
                    'ar' => 'الصحة والطب'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Walking aids',
                            'ar' => 'أدوات المساعدة على المشي'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Crutches and Canes',
                                    'ar' => 'العكازات والعصي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wheelchairs',
                                    'ar' => 'المشايات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rollators',
                                    'ar' => 'الرولاتور'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bath Seats',
                                    'ar' => 'مقعد حمام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Portable toilet seat',
                                    'ar' => 'مقعد المرحاض المحمول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wheelchair equipped with a toilet seat',
                                    'ar' => 'كرسي متحرك مزود بمقعد مرحاض'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Steel wheelchair',
                                    'ar' => 'كرسي متحرك فولاذي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Aluminum wheelchair',
                                    'ar' => 'كرسي متحرك ألومنيوم'
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Veterinary Tools and Medicines',
                            'ar' => 'أدوات-وأدوية-بيطرية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Veterinary Tools',
                                    'ar' => 'أدوات بيطرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Veterinary Medicines',
                                    'ar' => 'أدوية بيطرية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Herbs and Medicines',
                            'ar' => 'أعشاب-وأدوية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Medicines (Tablets)',
                                    'ar' => 'أدوية (أقراص)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Herbs and Herbal Products',
                                    'ar' => 'الأعشاب ومنتجات الأعشاب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Biological Products',
                                    'ar' => 'منتجات بيولوجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vitamins',
                                    'ar' => 'فيتامينات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pharmaceutical Solutions',
                                    'ar' => 'محاليل دوائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Medicines (Syrups)',
                                    'ar' => 'أدوية (شراب)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ointments',
                                    'ar' => 'مراهم'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Diabetes Needles',
                            'ar' => 'إبر-مرضى-السكري'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Diabetes Patient Needles',
                                    'ar' => 'إبر مرضى السكري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Diabetes Patient Shoes',
                                    'ar' => 'أحذية مرضى السكري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Diabetes Patient Socks',
                                    'ar' => 'جوارب مرضى السكري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Blood Sugar Monitoring Devices',
                                    'ar' => 'أجهزة مراقبة السكر'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Medical Supplies',
                            'ar' => 'مستلزمات-طبية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Surgical Pins',
                                    'ar' => 'دبابيس جراحية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Surgical Threads',
                                    'ar' => 'خيوط جراحية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Surgical Electrical Energy Supplies',
                                    'ar' => 'مستلزمات الطاقة الكهربائية الجراحية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Medical Mask',
                                    'ar' => 'قناع طبي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Single-use Syringe',
                                    'ar' => 'حقنة تستخدم مرة واحدة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Medical Catheter Tube',
                                    'ar' => 'أنبوب فسطرة طبي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Medical Gloves',
                                    'ar' => 'قفازات طبية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sterilization Bag',
                                    'ar' => 'كيس التعقيم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chest Drainage System',
                                    'ar' => 'نظام تصريف الصدر'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Dental Equipment',
                            'ar' => 'معدات-الأسنان'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Dental Chair',
                                    'ar' => 'كرسي الأسنان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dental Handpiece',
                                    'ar' => 'قطعة يد الأسنان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dental Surgery Tools',
                                    'ar' => 'أدوات جراحة الأسنان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dental Consumables',
                                    'ar' => 'مستلزمات الأسنان الاستهلاكية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dental Tools',
                                    'ar' => 'أدوات الأسنان'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'ENT Equipment',
                            'ar' => 'معدات-الأنف-والأذن-والحنجرة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'ENT Examination Set',
                                    'ar' => 'مجموعة فحص الأنف والأذن والحنجرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Otoscope',
                                    'ar' => 'منظار الأذن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Laryngoscope',
                                    'ar' => 'منظار الحنجرة اللفوي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Video Laryngoscope',
                                    'ar' => 'منظار الحنجرة بالفيديو'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'ENT Tools',
                                    'ar' => 'أدوات الأنف والأذن والحنجرة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Massage Equipment',
                            'ar' => 'معدات-التدليك'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Back Massage Device',
                                    'ar' => 'جهاز تدليك الظهر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Body Massage Device',
                                    'ar' => 'جهاز تدليك الجسم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Foot Massage Device',
                                    'ar' => 'جهاز تدليك القدمين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Portable Massage Devices',
                                    'ar' => 'أجهزة تدليك محمولة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Massage Belts',
                                    'ar' => 'أحزمة تدليك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Massage Chairs',
                                    'ar' => 'كراسي تدليك'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Massage Table and Bed',
                                    'ar' => 'طاولة وسرير تدليك'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Diagnostic Equipment',
                            'ar' => 'معدات-التشخيص'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Vascular Doppler Device',
                                    'ar' => 'جهاز دوبلر الوعائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ultrasound Device',
                                    'ar' => 'جهاز الموجات فوق الصوتية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Eye Ultrasound',
                                    'ar' => 'الموجات فوق الصوتية للعين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'ECG Machine',
                                    'ar' => 'جهاز تخطيط القلب (ECG)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bone Density Measurement Device',
                                    'ar' => 'جهاز قياس كثافة العظام'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'EEG Machine',
                                    'ar' => 'جهاز تخطيط الدماغ (EEG)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pulse Oximeter',
                                    'ar' => 'مقياس التكسيك النبضي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Spirometer',
                                    'ar' => 'جهاز قياس السعة الرئوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Audiometer',
                                    'ar' => 'جهاز قياس السمع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Blood Glucose Devices',
                                    'ar' => 'أجهزة السكر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vein Detector',
                                    'ar' => 'جهاز تحديد الأوردة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Temperature Measurement Tools',
                                    'ar' => 'أدوات قياس الحرارة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Diagnostic Tools',
                                    'ar' => 'أدوات التشخيص'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Medical Imaging Equipment',
                            'ar' => 'معدات-التصوير-الطبي'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Magnetic Resonance Imaging (MRI)',
                                    'ar' => 'الرنين المغناطيسي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ultrasound',
                                    'ar' => 'الموجات فوق الصوتية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Computed Tomography (CT)',
                                    'ar' => 'التصوير المقطعي المحوسب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Mammography',
                                    'ar' => 'تصوير الثدي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Medical Imaging Tools',
                                    'ar' => 'أدوات التصوير الطبي'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Sterilization Equipment',
                            'ar' => 'معدات-التعقيم'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Autoclave',
                                    'ar' => 'الأوتوكلاف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Steam Sterilization Devices',
                                    'ar' => 'أجهزة التعقيم بالبخار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'UV Sterilization Devices',
                                    'ar' => 'أجهزة التعقيم بالأشعة فوق البنفسجية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Chemical Sterilization Devices',
                                    'ar' => 'أجهزة التعقيم الكيميائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Portable Sterilization Devices',
                                    'ar' => 'أجهزة التعقيم المحمولة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Small Sterilization Devices',
                                    'ar' => 'أجهزة التعقيم الصغيرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Plasma Sterilization Devices',
                                    'ar' => 'أجهزة التعقيم بالبلازما'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sterilization Tools',
                                    'ar' => 'أدوات التعقيم'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Personal Protective Equipment',
                            'ar' => 'معدات-الحماية-الشخصية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Face Mask',
                                    'ar' => 'قناع الوجه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Rapid Test Kit',
                                    'ar' => 'مجموعة اختبار سريع'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Eye Protection',
                                    'ar' => 'واقي العين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Face Shield',
                                    'ar' => 'واقي الوجه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Disposable Protective Clothing',
                                    'ar' => 'ملابس واقية تستخدم مرة واحدة'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Home Care Equipment',
                            'ar' => 'معدات-الرعاية-المنزلية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Blood Pressure Monitor',
                                    'ar' => 'جهاز ضغط الدم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Oxygen Concentrator',
                                    'ar' => 'جهاز تركيز الأكسجين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Nebulizer',
                                    'ar' => 'جهاز الاستنشاق'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Scale',
                                    'ar' => 'ميزان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bedsore Prevention Mattress',
                                    'ar' => 'فراش لمنع قرح الفراش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Health Care Tools',
                                    'ar' => 'أدوات الرعاية الصحية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Eye Equipment',
                            'ar' => 'معدات-العيون'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Slit Lamp',
                                    'ar' => 'المصباح الشقي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ophthalmoscope',
                                    'ar' => 'منظار العين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Eye Examination Table and Chair',
                                    'ar' => 'طاولة وكرسي فحص العيون'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Refractometer',
                                    'ar' => 'مقياس الانكسار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Automated Lensometer',
                                    'ar' => 'مقياس العدسات الآلي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vision Testing Device',
                                    'ar' => 'جهاز فحص النظر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Lens Testing Device',
                                    'ar' => 'جهاز فحص العدسات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Automated Visual Chart Projector',
                                    'ar' => 'جهاز عرض مخططات الإبصار الآلي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vision Testing Unit',
                                    'ar' => 'وحدة فحص النظر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pupillometer',
                                    'ar' => 'مقياس المسافة بين حدقتي العين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vision Chart',
                                    'ar' => 'مخطط الإبصار'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ophthalmology Tools',
                                    'ar' => 'أدوات طب العيون'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Diagnostic Laboratory Equipment',
                            'ar' => 'معدات-المختبر-التشخيصية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Specific Protein Analyzer',
                                    'ar' => 'محلل البروتينات المحددة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Stool Analyzer',
                                    'ar' => 'محلل البراز'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Biochemical Analyzer',
                                    'ar' => 'محلل الكيمياء الحيوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Coagulation Analyzer',
                                    'ar' => 'محلل التخثر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Blood Analyzer',
                                    'ar' => 'محلل الدم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Microplate Reader and Washer',
                                    'ar' => 'قارئ ومغسل الألواح الدقيقة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Glycosylated Hemoglobin Analyzer',
                                    'ar' => 'محلل الهيموجلوبين السكري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Blood Gas Analyzer',
                                    'ar' => 'محلل غازات الدم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Urine Analyzer',
                                    'ar' => 'محلل البول'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Laboratory Equipment',
                            'ar' => 'معدات-المختبر'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Biological Microscope',
                                    'ar' => 'المجهر البيولوجي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Light Spectrometer',
                                    'ar' => 'مطياف الضوء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Centrifuge',
                                    'ar' => 'الطرد المركزي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Thermal Bath',
                                    'ar' => 'حمام حراري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Laboratory Mixer',
                                    'ar' => 'خلاط مخبري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water Distillation Device',
                                    'ar' => 'جهاز تقطير الماء'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Magnetic and Electric Motor',
                                    'ar' => 'محرك مغناطيسي وكهربائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Laboratory Incubator',
                                    'ar' => 'حاضنة مخبرية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'pH Meter',
                                    'ar' => 'مقياس الأس الهيدروجيني (pH)'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Biological Safety Cabinet',
                                    'ar' => 'خزانة الأمان البيولوجي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Work Table',
                                    'ar' => 'طاولة العمل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Water Purification Device',
                                    'ar' => 'جهاز تنقية المياه'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ultrasonic Cleaner',
                                    'ar' => 'منظف بالموجات فوق الصوتية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Pipette',
                                    'ar' => 'ماصة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Slide',
                                    'ar' => 'شريحة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Medical Freezer',
                                    'ar' => 'مجمد طبي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Blood Bank Refrigerator',
                                    'ar' => 'ثلاجة بنك الدم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Medicine Refrigerator',
                                    'ar' => 'ثلاجة الأدوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Analytical Balance',
                                    'ar' => 'ميزان تحليل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Medical Destroyer',
                                    'ar' => 'جهاز تدمير طبي'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Women\'s and Obstetrics Equipment',
                            'ar' => 'معدات-النساء-والولادة'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Fetal Doppler Device',
                                    'ar' => 'جهاز دوبلر الجنين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Fetal Monitoring Device',
                                    'ar' => 'جهاز مراقبة الجنين'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Vaginal Speculum',
                                    'ar' => 'منظار مهبلي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Gynecological Bed',
                                    'ar' => 'سرير نسائي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Infant Incubator',
                                    'ar' => 'حاضنة للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Infant Warming Devices',
                                    'ar' => 'أجهزة تدفئة للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Infant Phototherapy Device',
                                    'ar' => 'جهاز العلاج الضوئي للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Jaundice Meter',
                                    'ar' => 'جهاز قياس اليرقان'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Infant Scale',
                                    'ar' => 'ميزان للأطفال'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Obstetrics and Gynecology Tools',
                                    'ar' => 'أدوات طب النساء والتوليد'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Surgical Equipment',
                            'ar' => 'معدات-جراحية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'General Surgical Devices',
                                    'ar' => 'الأجهزة الجراحية العامة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Minimally Invasive Surgery Equipment',
                                    'ar' => 'أجهزة الجراحة قليلة التوغل'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Hearing Surgery Equipment',
                                    'ar' => 'أجهزة جراحة السمعة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Surgical Access Equipment',
                                    'ar' => 'أجهزة الوصول الجراحي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Wound Care Equipment',
                                    'ar' => 'أجهزة العناية بالجروح'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Operating Room Equipment',
                            'ar' => 'معدات-غرفة-العمليات'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Anesthesia Machine',
                                    'ar' => 'جهاز التخدير'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Artificial Respirator',
                                    'ar' => 'جهاز التنفس الصناعي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Electrosurgical Unit',
                                    'ar' => 'وحدة الجراحة الكهربائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Patient Monitor',
                                    'ar' => 'جهاز مراقبة المريض'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Medical Control Unit',
                                    'ar' => 'وحدة التحكم الطبية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'LED Surgical Light',
                                    'ar' => 'LED مصباح جراحي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Surgical Light',
                                    'ar' => 'مصباح جراحي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Operating Table',
                                    'ar' => 'طاولة عمليات'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Delivery Table',
                                    'ar' => 'طاولة الولادة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Suction Device',
                                    'ar' => 'جهاز شفط'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Injection Pump',
                                    'ar' => 'مضخة الحقن'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'IV Pump',
                                    'ar' => 'مضخة وريدية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Feeding Pump',
                                    'ar' => 'مضخة تغذية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Blood Warmer',
                                    'ar' => 'جهاز تدفئة الدم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Surgical Microscope',
                                    'ar' => 'مجهر جراحي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Sound Shock Therapy Device',
                                    'ar' => 'جهاز تنقيت الصوت بالصدمات الصوتية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Dialysis Equipment',
                            'ar' => 'معدات-غسيل-الكلى'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Dialysis Machine',
                                    'ar' => 'جهاز غسيل الكلى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dialysis Supplies',
                                    'ar' => 'مستلزمات غسيل الكلى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dialysis Chair',
                                    'ar' => 'كرسي غسيل الكلى'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Dialysis Tools',
                                    'ar' => 'أدوات غسيل الكلى'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'First Aid Products',
                            'ar' => 'منتجات-الإسعافات-الأولية'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Electrical Shock Device',
                                    'ar' => 'جهاز الصدمة الكهربائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Portable Artificial Respirator',
                                    'ar' => 'جهاز تنفس اصطناعي محمول'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Spinal Immobilization Board',
                                    'ar' => 'لوح تثبيت العمود الفقري'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ambulance Stretcher',
                                    'ar' => 'نقالة إسعاف'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Foldable Stretcher',
                                    'ar' => 'نقالة قابلة للطي'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Resuscitation Device',
                                    'ar' => 'جهاز إنعاش'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'First Aid Kit',
                                    'ar' => 'حقيبة إسعافات أولية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'First Aid Tools',
                                    'ar' => 'أدوات الإسعافات الأولية'
                                ],
                            ]
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Medical Endoscope',
                            'ar' => 'منظار-طبي'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Gastroscope',
                                    'ar' => 'منظار المعدة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Colonoscope',
                                    'ar' => 'منظار القولون'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Duodenoscope',
                                    'ar' => 'منظار الاثني عشر'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Bronchoscope',
                                    'ar' => 'منظار القصبات الهوائية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Choledochoscope',
                                    'ar' => 'منظار القناة الصفراوية'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Cystoscope',
                                    'ar' => 'منظار المثانة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'ENT Endoscope',
                                    'ar' => 'منظار الأنف والأذن والحنجرة'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Ureteroscope',
                                    'ar' => 'منظار الحالب'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Medical Endoscope Tools',
                                    'ar' => 'أدوات المناظير الطبية'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Jewelry and Watches',
                    'ar' => 'المجوهرات والساعات'
                ],
                'categories' => [
                    [
                        'name' => [
                            'en' => 'Cufflinks and Tie Clips',
                            'ar' => 'أزرار الكم ومشابك ربطة العنق'
                        ],
                        'categories' => [
                            [
                                'name' => [
                                    'en' => 'Buttons for quantity',
                                    'ar' => 'أزرار كم'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Set of shirt cuff buttons.',
                                    'ar' => 'طقم أزرار كم قميص'
                                ],
                            ],
                            [
                                'name' => [
                                    'en' => 'Tie clamps',
                                    'ar' => 'مشابك ربطة العنق'
                                ],
                            ],
                        ]
                    ]
                ]
            ]

        ];

    }


}
