@extends('layouts.dashboard')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')
@section('page-subtitle', 'Company profile, payments, messaging, and integrations')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="max-w-4xl animate-fade-in">
        <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-4">
            @csrf

            {{-- Section 1: Company Information --}}
            <div class="glass rounded-2xl overflow-hidden">
                <button type="button" onclick="toggleSettingsSection('settings-section-company')"
                    class="w-full flex items-center justify-between gap-3 px-5 py-4 text-left hover:bg-white/[0.03] transition-colors">
                    <div>
                        <span class="block text-sm font-semibold t-primary">Company Information</span>
                        <span class="block text-xs t-muted mt-0.5">Name, contact, and address shown on documents</span>
                    </div>
                    <svg class="w-5 h-5 t-muted shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <div id="settings-section-company" class="border-t border-subtle">
                    <div class="px-5 pb-5 pt-4 grid gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="company_name" class="block text-xs font-medium t-muted mb-1.5">Company name</label>
                            <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $settings['company_name'] ?? '') }}"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="company_phone" class="block text-xs font-medium t-muted mb-1.5">Phone</label>
                            <input type="text" name="company_phone" id="company_phone" value="{{ old('company_phone', $settings['company_phone'] ?? '') }}"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="company_email" class="block text-xs font-medium t-muted mb-1.5">Email</label>
                            <input type="email" name="company_email" id="company_email" value="{{ old('company_email', $settings['company_email'] ?? '') }}"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="company_address" class="block text-xs font-medium t-muted mb-1.5">Address</label>
                            <textarea name="company_address" id="company_address" rows="3"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">{{ old('company_address', $settings['company_address'] ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 2: Razorpay --}}
            <div class="glass rounded-2xl overflow-hidden">
                <button type="button" onclick="toggleSettingsSection('settings-section-razorpay')"
                    class="w-full flex items-center justify-between gap-3 px-5 py-4 text-left hover:bg-white/[0.03] transition-colors">
                    <div>
                        <span class="block text-sm font-semibold t-primary">Payment Gateway (Razorpay)</span>
                        <span class="block text-xs t-muted mt-0.5">API keys for online payments</span>
                    </div>
                    <svg class="w-5 h-5 t-muted shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <div id="settings-section-razorpay" class="border-t border-subtle">
                    <div class="px-5 pb-5 pt-4 grid gap-4">
                        <p class="text-xs t-secondary leading-relaxed">
                            Configure your Razorpay API keys. Get them from
                            <a href="https://dashboard.razorpay.com" target="_blank" rel="noopener noreferrer" class="font-medium text-solar-600 dark:text-solar-400 hover:underline">https://dashboard.razorpay.com</a>
                        </p>
                        <div>
                            <label for="razorpay_key_id" class="block text-xs font-medium t-muted mb-1.5">Key ID</label>
                            <input type="text" name="razorpay_key_id" id="razorpay_key_id" value="{{ old('razorpay_key_id', $settings['razorpay_key_id'] ?? '') }}" autocomplete="off"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="razorpay_key_secret" class="block text-xs font-medium t-muted mb-1.5">Key secret</label>
                            <input type="password" name="razorpay_key_secret" id="razorpay_key_secret" value="{{ old('razorpay_key_secret', $settings['razorpay_key_secret'] ?? '') }}" autocomplete="new-password"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 3: SMTP --}}
            <div class="glass rounded-2xl overflow-hidden">
                <button type="button" onclick="toggleSettingsSection('settings-section-smtp')"
                    class="w-full flex items-center justify-between gap-3 px-5 py-4 text-left hover:bg-white/[0.03] transition-colors">
                    <div>
                        <span class="block text-sm font-semibold t-primary">Email / SMTP</span>
                        <span class="block text-xs t-muted mt-0.5">Outbound mail delivery</span>
                    </div>
                    <svg class="w-5 h-5 t-muted shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <div id="settings-section-smtp" class="border-t border-subtle">
                    <div class="px-5 pb-5 pt-4 grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="smtp_host" class="block text-xs font-medium t-muted mb-1.5">SMTP host</label>
                            <input type="text" name="smtp_host" id="smtp_host" value="{{ old('smtp_host', $settings['smtp_host'] ?? '') }}"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="smtp_port" class="block text-xs font-medium t-muted mb-1.5">SMTP port</label>
                            <input type="text" name="smtp_port" id="smtp_port" value="{{ old('smtp_port', $settings['smtp_port'] ?? '587') }}"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="smtp_username" class="block text-xs font-medium t-muted mb-1.5">Username</label>
                            <input type="text" name="smtp_username" id="smtp_username" value="{{ old('smtp_username', $settings['smtp_username'] ?? '') }}" autocomplete="username"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="smtp_password" class="block text-xs font-medium t-muted mb-1.5">Password</label>
                            <input type="password" name="smtp_password" id="smtp_password" value="{{ old('smtp_password', $settings['smtp_password'] ?? '') }}" autocomplete="new-password"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="smtp_from_email" class="block text-xs font-medium t-muted mb-1.5">From email</label>
                            <input type="email" name="smtp_from_email" id="smtp_from_email" value="{{ old('smtp_from_email', $settings['smtp_from_email'] ?? '') }}"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="smtp_from_name" class="block text-xs font-medium t-muted mb-1.5">From name</label>
                            <input type="text" name="smtp_from_name" id="smtp_from_name" value="{{ old('smtp_from_name', $settings['smtp_from_name'] ?? '') }}"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 4: SMS --}}
            <div class="glass rounded-2xl overflow-hidden">
                <button type="button" onclick="toggleSettingsSection('settings-section-sms')"
                    class="w-full flex items-center justify-between gap-3 px-5 py-4 text-left hover:bg-white/[0.03] transition-colors">
                    <div>
                        <span class="block text-sm font-semibold t-primary">SMS</span>
                        <span class="block text-xs t-muted mt-0.5">Provider and API credentials</span>
                    </div>
                    <svg class="w-5 h-5 t-muted shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <div id="settings-section-sms" class="border-t border-subtle">
                    <div class="px-5 pb-5 pt-4 grid gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="sms_provider" class="block text-xs font-medium t-muted mb-1.5">Provider</label>
                            <select name="sms_provider" id="sms_provider"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                                <option value="none" @selected(old('sms_provider', $settings['sms_provider'] ?? 'none') === 'none')>None</option>
                                <option value="textlocal" @selected(old('sms_provider', $settings['sms_provider'] ?? '') === 'textlocal')>Textlocal</option>
                                <option value="msg91" @selected(old('sms_provider', $settings['sms_provider'] ?? '') === 'msg91')>MSG91</option>
                                <option value="twilio" @selected(old('sms_provider', $settings['sms_provider'] ?? '') === 'twilio')>Twilio</option>
                            </select>
                        </div>
                        <div>
                            <label for="sms_api_key" class="block text-xs font-medium t-muted mb-1.5">API key</label>
                            <input type="text" name="sms_api_key" id="sms_api_key" value="{{ old('sms_api_key', $settings['sms_api_key'] ?? '') }}" autocomplete="off"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="sms_sender_id" class="block text-xs font-medium t-muted mb-1.5">Sender ID</label>
                            <input type="text" name="sms_sender_id" id="sms_sender_id" value="{{ old('sms_sender_id', $settings['sms_sender_id'] ?? '') }}"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 5: WhatsApp --}}
            <div class="glass rounded-2xl overflow-hidden">
                <button type="button" onclick="toggleSettingsSection('settings-section-whatsapp')"
                    class="w-full flex items-center justify-between gap-3 px-5 py-4 text-left hover:bg-white/[0.03] transition-colors">
                    <div>
                        <span class="block text-sm font-semibold t-primary">WhatsApp</span>
                        <span class="block text-xs t-muted mt-0.5">Business API credentials</span>
                    </div>
                    <svg class="w-5 h-5 t-muted shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <div id="settings-section-whatsapp" class="border-t border-subtle">
                    <div class="px-5 pb-5 pt-4 grid gap-4">
                        <div>
                            <label for="whatsapp_api_key" class="block text-xs font-medium t-muted mb-1.5">API key</label>
                            <input type="text" name="whatsapp_api_key" id="whatsapp_api_key" value="{{ old('whatsapp_api_key', $settings['whatsapp_api_key'] ?? '') }}" autocomplete="off"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="whatsapp_phone" class="block text-xs font-medium t-muted mb-1.5">WhatsApp phone</label>
                            <input type="text" name="whatsapp_phone" id="whatsapp_phone" value="{{ old('whatsapp_phone', $settings['whatsapp_phone'] ?? '') }}" placeholder="+91XXXXXXXXXX"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                            <p class="mt-1.5 text-xs t-faint">Use E.164 format with country code, e.g. +91 for India.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 6: Notifications --}}
            <div class="glass rounded-2xl overflow-hidden">
                <button type="button" onclick="toggleSettingsSection('settings-section-notifications')"
                    class="w-full flex items-center justify-between gap-3 px-5 py-4 text-left hover:bg-white/[0.03] transition-colors">
                    <div>
                        <span class="block text-sm font-semibold t-primary">Notification preferences</span>
                        <span class="block text-xs t-muted mt-0.5">Choose channels for system alerts</span>
                    </div>
                    <svg class="w-5 h-5 t-muted shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <div id="settings-section-notifications" class="border-t border-subtle">
                    <div class="px-5 pb-5 pt-4 space-y-4">
                        @php
                            $notifEmail = old('notification_email_enabled', $settings['notification_email_enabled'] ?? '');
                            $notifSms = old('notification_sms_enabled', $settings['notification_sms_enabled'] ?? '');
                            $notifWa = old('notification_whatsapp_enabled', $settings['notification_whatsapp_enabled'] ?? '');
                            $isOn = fn ($v) => $v === '1' || $v === 1 || $v === true || $v === 'true' || $v === 'on';
                        @endphp
                        <label class="flex items-center justify-between gap-4 rounded-xl border border-theme bg-input/50 px-4 py-3 cursor-pointer hover:border-solar-500/30 transition-colors">
                            <span class="text-sm t-secondary">Email notifications</span>
                            <span class="inline-flex items-center gap-2">
                                <input type="hidden" name="notification_email_enabled" value="0">
                                <input type="checkbox" name="notification_email_enabled" value="1" class="h-4 w-4 rounded border-theme text-solar-600 focus:ring-solar-500"
                                    @checked($isOn($notifEmail))>
                            </span>
                        </label>
                        <label class="flex items-center justify-between gap-4 rounded-xl border border-theme bg-input/50 px-4 py-3 cursor-pointer hover:border-solar-500/30 transition-colors">
                            <span class="text-sm t-secondary">SMS notifications</span>
                            <span class="inline-flex items-center gap-2">
                                <input type="hidden" name="notification_sms_enabled" value="0">
                                <input type="checkbox" name="notification_sms_enabled" value="1" class="h-4 w-4 rounded border-theme text-solar-600 focus:ring-solar-500"
                                    @checked($isOn($notifSms))>
                            </span>
                        </label>
                        <label class="flex items-center justify-between gap-4 rounded-xl border border-theme bg-input/50 px-4 py-3 cursor-pointer hover:border-solar-500/30 transition-colors">
                            <span class="text-sm t-secondary">WhatsApp notifications</span>
                            <span class="inline-flex items-center gap-2">
                                <input type="hidden" name="notification_whatsapp_enabled" value="0">
                                <input type="checkbox" name="notification_whatsapp_enabled" value="1" class="h-4 w-4 rounded border-theme text-solar-600 focus:ring-solar-500"
                                    @checked($isOn($notifWa))>
                            </span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Section 7: Commission --}}
            <div class="glass rounded-2xl overflow-hidden">
                <button type="button" onclick="toggleSettingsSection('settings-section-commission')"
                    class="w-full flex items-center justify-between gap-3 px-5 py-4 text-left hover:bg-white/[0.03] transition-colors">
                    <div>
                        <span class="block text-sm font-semibold t-primary">Commission rules</span>
                        <span class="block text-xs t-muted mt-0.5">Default partner commission structure</span>
                    </div>
                    <svg class="w-5 h-5 t-muted shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <div id="settings-section-commission" class="border-t border-subtle">
                    <div class="px-5 pb-5 pt-4 grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="commission_type" class="block text-xs font-medium t-muted mb-1.5">Type</label>
                            <select name="commission_type" id="commission_type"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                                <option value="percentage" @selected(old('commission_type', $settings['commission_type'] ?? 'percentage') === 'percentage')>Percentage</option>
                                <option value="fixed" @selected(old('commission_type', $settings['commission_type'] ?? '') === 'fixed')>Fixed</option>
                            </select>
                        </div>
                        <div>
                            <label for="commission_value" class="block text-xs font-medium t-muted mb-1.5">% or ₹ amount</label>
                            <input type="number" name="commission_value" id="commission_value" value="{{ old('commission_value', $settings['commission_value'] ?? '') }}" step="any" min="0"
                                class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl bg-solar-500 px-10 py-3.5 text-base font-semibold text-dark-900 shadow-lg shadow-solar-500/20 hover:bg-solar-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Settings
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
function toggleSettingsSection(id) {
    const el = document.getElementById(id);
    el.classList.toggle('hidden');
}
</script>
@endsection
