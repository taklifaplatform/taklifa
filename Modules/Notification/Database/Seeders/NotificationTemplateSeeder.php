<?php

namespace Modules\Notification\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Notification\Entities\NotificationTemplate;

class NotificationTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $templates = [
        //     [
        //         'type' => NotificationTemplate::TYPE_COMPANY_DELETE_INVITATION,
        //         'settings_title' => [
        //             'en' => 'Notify me when company driver invitation is deleted',
        //             'ar' => 'أعلمني عند حذف دعوة سائق الشركة',
        //         ],

        //         'sms_notification' => true,
        //         'sms_notification_title' => [
        //             'en' => 'Company Driver Invitation Deleted',
        //             'ar' => 'تم حذف دعوة سائق الشركة',
        //         ],
        //         'sms_notification_description' => [
        //             'en' => 'Your company driver invitation request has been deleted',
        //             'ar' => 'تم حذف طلب دعوة سائق الشركة الخاص بك',
        //         ],

        //         'db_notification' => true,
        //         'db_notification_title' => [
        //             'en' => 'Company Driver Invitation Deleted',
        //             'ar' => 'تم حذف دعوة سائق الشركة',
        //         ],
        //         'db_notification_description' => [
        //             'en' => 'Your company driver invitation request has been deleted',
        //             'ar' => 'تم حذف طلب دعوة سائق الشركة الخاص بك',
        //         ],

        //         'email_notification' => true,
        //         'email_notification_subject' => [
        //             'en' => 'Company Driver Invitation Deleted',
        //             'ar' => 'تم حذف دعوة سائق الشركة',
        //         ],
        //         'email_notification_title' => [
        //             'en' => 'Company Driver Invitation Deleted',
        //             'ar' => 'تم حذف دعوة سائق الشركة',
        //         ],
        //         'email_notification_description' => [
        //             'en' => 'Your company driver invitation request has been deleted',
        //             'ar' => 'تم حذف طلب دعوة سائق الشركة الخاص بك',
        //         ],

        //         'push_notification' => true,
        //         'push_notification_title' => [
        //             'en' => 'Driver Invitation Deleted',
        //             'ar' => 'تم حذف دعوة السائق',
        //         ],
        //         'push_notification_description' => [
        //             'en' => 'Your company driver invitation request has been deleted',
        //             'ar' => 'تم حذف طلب دعوة سائق الشركة الخاص بك',
        //         ],

        //         'has_settings' => false,
        //         'icon_user_avatar' => false,
        //         'icon_rounded' => true,
        //         'icon_background_color' => null,
        //     ],
        //     [
        //         'type' => NotificationTemplate::TYPE_COMPANY_SEND_INVITATION,
        //         'settings_title' => [
        //             'en' => 'Notify me when company driver invitation is sent',
        //             'ar' => 'أعلمني عند إرسال دعوة سائق الشركة',
        //         ],

        //         'sms_notification' => true,
        //         'sms_notification_title' => [
        //             'en' => 'Company Driver Invitation',
        //             'ar' => 'دعوة سائق الشركة',
        //         ],
        //         'sms_notification_description' => [
        //             'en' => 'You have been invited to join the company as a driver.',
        //             'ar' => 'لقد تمت دعوتك للانضمام إلى الشركة كسائق.',
        //         ],

        //         'db_notification' => true,
        //         'db_notification_title' => [
        //             'en' => 'Company Driver Invitation',
        //             'ar' => 'دعوة سائق الشركة',
        //         ],
        //         'db_notification_description' => [
        //             'en' => 'You have been invited to join the company as a driver.',
        //             'ar' => 'لقد تمت دعوتك للانضمام إلى الشركة كسائق.',
        //         ],

        //         'email_notification' => true,
        //         'email_notification_subject' => [
        //             'en' => 'Company Driver Invitation',
        //             'ar' => 'دعوة سائق الشركة',
        //         ],
        //         'email_notification_title' => [
        //             'en' => 'Company Driver Invitation',
        //             'ar' => 'دعوة سائق الشركة',
        //         ],

        //         'email_notification_description' => [
        //             'en' => 'You have been invited to join the company as a driver.',
        //             'ar' => 'لقد تمت دعوتك للانضمام إلى الشركة كسائق.',
        //         ],

        //         'push_notification' => true,
        //         'push_notification_title' => [
        //             'en' => 'Company Driver Invitation',
        //             'ar' => 'دعوة سائق الشركة',
        //         ],
        //         'push_notification_description' => [
        //             'en' => 'You have been invited to join the company as a driver.',
        //             'ar' => 'لقد تمت دعوتك للانضمام إلى الشركة كسائق.',
        //         ],

        //         'has_settings' => false,
        //         'icon_user_avatar' => false,
        //         'icon_rounded' => true,
        //         'icon_background_color' => null,
        //     ],
        //     [
        //         'type' => NotificationTemplate::TYPE_COMPANY_UPDATE_INVITATION,
        //         'settings_title' => [
        //             'en' => 'Notify me when company driver invitation is updated',
        //             'ar' => 'أعلمني عند تحديث دعوة سائق الشركة',
        //         ],

        //         'sms_notification' => true,
        //         'sms_notification_title' => [
        //             'en' => 'Company Driver Invitation Updated',
        //             'ar' => 'تم تحديث دعوة سائق الشركة',
        //         ],
        //         'sms_notification_description' => [
        //             'en' => 'Your company driver invitation request has been updated',
        //             'ar' => 'تم تحديث طلب دعوة سائق الشركة الخاص بك',
        //         ],

        //         'db_notification' => true,
        //         'db_notification_title' => [
        //             'en' => 'Company Driver Invitation Updated',
        //             'ar' => 'تم تحديث دعوة سائق الشركة',
        //         ],
        //         'db_notification_description' => [
        //             'en' => 'Your company driver invitation request has been updated',
        //             'ar' => 'تم تحديث طلب دعوة سائق الشركة الخاص بك',
        //         ],

        //         'email_notification' => true,
        //         'email_notification_subject' => [
        //             'en' => 'Company Driver Invitation Updated',
        //             'ar' => 'تم تحديث دعوة سائق الشركة',
        //         ],
        //         'email_notification_title' => [
        //             'en' => 'Company Driver Invitation Updated',
        //             'ar' => 'تم تحديث دعوة سائق الشركة',
        //         ],
        //         'email_notification_description' => [
        //             'en' => 'Your company driver invitation request has been updated',
        //             'ar' => 'تم تحديث طلب دعوة سائق الشركة الخاص بك',
        //         ],

        //         'push_notification' => true,
        //         'push_notification_title' => [
        //             'en' => 'Driver Invitation Updated',
        //             'ar' => 'تم تحديث دعوة السائق',
        //         ],
        //         'push_notification_description' => [
        //             'en' => 'Your company driver invitation request has been updated',
        //             'ar' => 'تم تحديث طلب دعوة سائق الشركة الخاص بك',
        //         ],

        //         'has_settings' => false,
        //         'icon_user_avatar' => false,
        //         'icon_rounded' => true,
        //         'icon_background_color' => null,
        //     ],
        //     [
        //         'type' => NotificationTemplate::TYPE_COMPANY_MANAGER_SHIPMENT_NEW_INVITATION_NOTIFICATION,
        //         'settings_title' => [
        //             'en' => 'Notify me when company manager sends a new shipment invitation',
        //             'ar' => 'أعلمني عندما يرسل مدير الشحنة دعوة جديدة',
        //         ],

        //         'sms_notification' => true,
        //         'sms_notification_title' => [
        //             'en' => 'New Shipment Invitation',
        //             'ar' => 'دعوة شحنة جديدة',
        //         ],
        //         'sms_notification_description' => [
        //             'en' => ':user requested a new shipment from :company',
        //             'ar' => 'طلب :user شحنة جديدة من :company',
        //         ],

        //         'db_notification' => true,
        //         'db_notification_title' => [
        //             'en' => 'New Shipment Invitation',
        //             'ar' => 'دعوة شحنة جديدة',
        //         ],
        //         'db_notification_description' => [
        //             'en' => 'You have been invited to join the company as a shipment manager.',
        //             'ar' => 'لقد تمت دعوتك للانضمام إلى الشركة كمدير شحنة.',
        //         ],

        //         'email_notification' => true,
        //         'email_notification_subject' => [
        //             'en' => 'New Shipment Invitation',
        //             'ar' => 'دعوة شحنة جديدة',
        //         ],
        //         'email_notification_title' => [
        //             'en' => 'New Shipment Invitation',
        //             'ar' => 'دعوة شحنة جديدة',
        //         ],
        //         'email_notification_description' => [
        //             'en' => 'You have been invited to join the company as a shipment manager.',
        //             'ar' => 'لقد تمت دعوتك للانضمام إلى الشركة كمدير شحنة.',
        //         ],

        //         'push_notification' => true,
        //         'push_notification_title' => [
        //             'en' => 'New Shipment Invitation',
        //             'ar' => 'دعوة شحنة جديدة',
        //         ],
        //     ],
        //     [
        //         'type' => NotificationTemplate::TYPE_DRIVER_SHIPMENT_NEW_INVITATION_NOTIFICATION,
        //         'settings_title' => [
        //             'en' => 'Notify me when driver receives a new shipment invitation',
        //             'ar' => 'أعلمني عندما يتلقى السائق دعوة شحنة جديدة',
        //         ],

        //         'sms_notification' => true,
        //         'sms_notification_title' => [
        //             'en' => '{SENDER_NAME} invited you to new shipment.',
        //             'ar' => 'دعاك {SENDER_NAME} إلى شحنة جديدة.',
        //         ],
        //         'sms_notification_description' => [
        //             'en' => 'Invited you to new shipment.',
        //             'ar' => 'دعاك إلى شحنة جديدة.',
        //         ],

        //         'db_notification' => true,
        //         'db_notification_title' => [
        //             'en' => '{SENDER_NAME} invited you to new shipment.',
        //             'ar' => 'دعاك {SENDER_NAME} إلى شحنة جديدة.',
        //         ],
        //         'db_notification_description' => [
        //             'en' => 'Invited you to new shipment.',
        //             'ar' => 'دعاك إلى شحنة جديدة.',
        //         ],

        //         'email_notification' => true,
        //         'email_notification_subject' => [
        //             'en' => '{SENDER_NAME} invited you to new shipment.',
        //             'ar' => 'دعاك {SENDER_NAME} إلى شحنة جديدة.',
        //         ],
        //         'email_notification_title' => [
        //             'en' => '{SENDER_NAME} invited you to new shipment.',
        //             'ar' => 'دعاك {SENDER_NAME} إلى شحنة جديدة.',
        //         ],

        //         'email_notification_description' => [
        //             'en' => 'Invited you to new shipment.',
        //             'ar' => 'دعاك إلى شحنة جديدة.',
        //         ],

        //         'push_notification' => true,
        //         'push_notification_title' => [
        //             'en' => '{SENDER_NAME} invited you to new shipment.',
        //             'ar' => 'دعاك {SENDER_NAME} إلى شحنة جديدة.',
        //         ],
        //         'push_notification_description' => [
        //             'en' => 'Invited you to new shipment.',
        //             'ar' => 'دعاك إلى شحنة جديدة.',
        //         ],

        //         'has_settings' => false,
        //         'icon_user_avatar' => true,
        //         'icon_rounded' => true,
        //         'icon_background_color' => null,
        //     ],
        //     [
        //         'type' => NotificationTemplate::TYPE_SHIPMENT_INVITATION_ACCEPTED_NOTIFICATION,
        //         'settings_title' => [
        //             'en' => 'Notify me when shipment invitation is accepted',
        //             'ar' => 'أعلمني عند قبول دعوة الشحنة',
        //         ],

        //         'sms_notification' => true,
        //         'sms_notification_title' => [
        //             'en' => '{SENDER_NAME} Shipment Invitation Accepted',
        //             'ar' => 'تم قبول دعوة الشحنة من {SENDER_NAME}',
        //         ],
        //         'sms_notification_description' => [
        //             'en' => 'Accepted your shipment invitation',
        //             'ar' => 'تم قبول دعوة الشحنة الخاصة بك',
        //         ],

        //         'db_notification' => true,
        //         'db_notification_title' => [
        //             'en' => '{SENDER_NAME} Shipment Invitation Accepted',
        //             'ar' => 'تم قبول دعوة الشحنة من {SENDER_NAME}',
        //         ],

        //         'db_notification_description' => [
        //             'en' => 'Accepted your shipment invitation',
        //             'ar' => 'تم قبول دعوة الشحنة الخاصة بك',
        //         ],

        //         'email_notification' => true,
        //         'email_notification_subject' => [
        //             'en' => '{SENDER_NAME} Shipment Invitation Accepted',
        //             'ar' => 'تم قبول دعوة الشحنة من {SENDER_NAME}',
        //         ],
        //         'email_notification_title' => [
        //             'en' => '{SENDER_NAME} Shipment Invitation Accepted',
        //             'ar' => 'تم قبول دعوة الشحنة من {SENDER_NAME}',
        //         ],

        //         'email_notification_description' => [
        //             'en' => 'Accepted your shipment invitation',
        //             'ar' => 'تم قبول دعوة الشحنة الخاصة بك',
        //         ],

        //         'push_notification' => true,
        //         'push_notification_title' => [
        //             'en' => '{SENDER_NAME} Shipment Invitation Accepted',
        //             'ar' => 'تم قبول دعوة الشحنة من {SENDER_NAME}',
        //         ],
        //         'push_notification_description' => [
        //             'en' => 'Accepted your shipment invitation',
        //             'ar' => 'تم قبول دعوة الشحنة الخاصة بك',
        //         ],

        //         'has_settings' => false,
        //         'icon_user_avatar' => true,
        //         'icon_rounded' => true,
        //         'icon_background_color' => null,
        //     ],
        //     [
        //         'type' => NotificationTemplate::TYPE_SHIPMENT_INVITATION_DECLINED_NOTIFICATION,
        //         'settings_title' => [
        //             'en' => 'Notify me when shipment invitation is declined',
        //             'ar' => 'أعلمني عند رفض دعوة الشحنة',
        //         ],

        //         'sms_notification' => true,
        //         'sms_notification_title' => [
        //             'en' => '{SENDER_NAME} Shipment Invitation Declined',
        //             'ar' => 'تم رفض دعوة الشحنة من {SENDER_NAME}',
        //         ],
        //         'sms_notification_description' => [
        //             'en' => 'Declined your shipment invitation',
        //             'ar' => 'تم رفض دعوة الشحنة الخاصة بك',
        //         ],

        //         'db_notification' => true,
        //         'db_notification_title' => [
        //             'en' => '{SENDER_NAME} Shipment Invitation Declined',
        //             'ar' => 'تم رفض دعوة الشحنة من {SENDER_NAME}',
        //         ],
        //         'db_notification_description' => [
        //             'en' => 'Declined your shipment invitation',
        //             'ar' => 'تم رفض دعوة الشحنة الخاصة بك',
        //         ],

        //         'email_notification' => true,
        //         'email_notification_subject' => [
        //             'en' => '{SENDER_NAME} Shipment Invitation Declined',
        //             'ar' => 'تم رفض دعوة الشحنة من {SENDER_NAME}',
        //         ],
        //         'email_notification_title' => [
        //             'en' => '{SENDER_NAME} Shipment Invitation Declined',
        //             'ar' => 'تم رفض دعوة الشحنة من {SENDER_NAME}',
        //         ],

        //         'email_notification_description' => [
        //             'en' => 'Declined your shipment invitation',
        //             'ar' => 'تم رفض دعوة الشحنة الخاصة بك',
        //         ],

        //         'push_notification' => true,
        //         'push_notification_title' => [
        //             'en' => '{SENDER_NAME} Shipment Invitation Declined',
        //             'ar' => 'تم رفض دعوة الشحنة من {SENDER_NAME}',
        //         ],
        //         'push_notification_description' => [
        //             'en' => 'Declined your shipment invitation',
        //             'ar' => 'تم رفض دعوة الشحنة الخاصة بك',
        //         ],

        //         'has_settings' => false,
        //         'icon_user_avatar' => true,
        //         'icon_rounded' => true,
        //         'icon_background_color' => null,
        //     ],
        //     [
        //         'type' => NotificationTemplate::TYPE_SHIPMENT_NEW_PROPOSAL_NOTIFICATION,
        //         'settings_title' => [
        //             'en' => 'Notify me when new shipment proposal is sent',
        //             'ar' => 'أعلمني عند إرسال اقتراح شحنة جديد',
        //         ],

        //         'sms_notification' => true,
        //         'sms_notification_title' => [
        //             'en' => '{SENDER_NAME} New Shipment Proposal',
        //             'ar' => 'اقتراح شحنة جديد من {SENDER_NAME}',
        //         ],
        //         'sms_notification_description' => [
        //             'en' => 'Sent you a new shipment proposal',
        //             'ar' => 'أرسل لك اقتراح شحنة جديد',
        //         ],

        //         'db_notification' => true,
        //         'db_notification_title' => [
        //             'en' => '{SENDER_NAME} New Shipment Proposal',
        //             'ar' => 'اقتراح شحنة جديد من {SENDER_NAME}',
        //         ],
        //         'db_notification_description' => [
        //             'en' => 'Sent you a new shipment proposal',
        //             'ar' => 'أرسل لك اقتراح شحنة جديد',
        //         ],

        //         'email_notification' => true,
        //         'email_notification_subject' => [
        //             'en' => '{SENDER_NAME} New Shipment Proposal',
        //             'ar' => 'اقتراح شحنة جديد من {SENDER_NAME}',
        //         ],
        //         'email_notification_title' => [
        //             'en' => '{SENDER_NAME} New Shipment Proposal',
        //             'ar' => 'اقتراح شحنة جديد من {SENDER_NAME}',
        //         ],

        //         'email_notification_description' => [
        //             'en' => 'Sent you a new shipment proposal',
        //             'ar' => 'أرسل لك اقتراح شحنة جديد',
        //         ],

        //         'push_notification' => true,
        //         'push_notification_title' => [
        //             'en' => '{SENDER_NAME} New Shipment Proposal',
        //             'ar' => 'اقتراح شحنة جديد من {SENDER_NAME}',
        //         ],
        //         'push_notification_description' => [
        //             'en' => 'Sent you a new shipment proposal',
        //             'ar' => 'أرسل لك اقتراح شحنة جديد',
        //         ],

        //         'has_settings' => false,
        //         'icon_user_avatar' => true,
        //         'icon_rounded' => true,
        //         'icon_background_color' => null,
        //     ]
        // ];

        // foreach ($templates as $template) {
        //     NotificationTemplate::create($template);
        // }
    }
}
