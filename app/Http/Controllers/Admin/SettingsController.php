<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'razorpay_key_id' => SiteSetting::get('razorpay_key_id', ''),
            'razorpay_key_secret' => SiteSetting::get('razorpay_key_secret', ''),
            'smtp_host' => SiteSetting::get('smtp_host', ''),
            'smtp_port' => SiteSetting::get('smtp_port', '587'),
            'smtp_username' => SiteSetting::get('smtp_username', ''),
            'smtp_password' => SiteSetting::get('smtp_password', ''),
            'smtp_from_email' => SiteSetting::get('smtp_from_email', ''),
            'smtp_from_name' => SiteSetting::get('smtp_from_name', 'U.P.R. Solar'),
            'sms_provider' => SiteSetting::get('sms_provider', 'none'),
            'sms_api_key' => SiteSetting::get('sms_api_key', ''),
            'sms_sender_id' => SiteSetting::get('sms_sender_id', ''),
            'whatsapp_api_key' => SiteSetting::get('whatsapp_api_key', ''),
            'whatsapp_phone' => SiteSetting::get('whatsapp_phone', ''),
            'notification_email_enabled' => SiteSetting::get('notification_email_enabled', '1'),
            'notification_sms_enabled' => SiteSetting::get('notification_sms_enabled', '0'),
            'notification_whatsapp_enabled' => SiteSetting::get('notification_whatsapp_enabled', '0'),
            'company_name' => SiteSetting::get('company_name', 'U.P.R. Solar Green Energy'),
            'company_phone' => SiteSetting::get('company_phone', '+91-9412452844'),
            'company_email' => SiteSetting::get('company_email', 'info@uprsolargreenenergy.com'),
            'company_address' => SiteSetting::get('company_address', 'Near IIT Metro Station, Kanpur, UP'),
            'commission_type' => SiteSetting::get('commission_type', 'percentage'),
            'commission_value' => SiteSetting::get('commission_value', '5'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $fields = [
            'razorpay_key_id' => 'payment', 'razorpay_key_secret' => 'payment',
            'smtp_host' => 'email', 'smtp_port' => 'email', 'smtp_username' => 'email',
            'smtp_password' => 'email', 'smtp_from_email' => 'email', 'smtp_from_name' => 'email',
            'sms_provider' => 'sms', 'sms_api_key' => 'sms', 'sms_sender_id' => 'sms',
            'whatsapp_api_key' => 'whatsapp', 'whatsapp_phone' => 'whatsapp',
            'notification_email_enabled' => 'notifications', 'notification_sms_enabled' => 'notifications',
            'notification_whatsapp_enabled' => 'notifications',
            'company_name' => 'general', 'company_phone' => 'general',
            'company_email' => 'general', 'company_address' => 'general',
            'commission_type' => 'commission', 'commission_value' => 'commission',
        ];

        foreach ($fields as $key => $group) {
            if ($request->has($key)) {
                SiteSetting::set($key, $request->input($key), $group);
            }
        }

        return back()->with('success', 'Settings saved successfully.');
    }
}
