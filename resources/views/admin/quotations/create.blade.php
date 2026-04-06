@extends('layouts.dashboard')

@section('title', 'Create Quotation')
@section('page-title', 'Create Quotation')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('admin.quotations.store') }}" class="space-y-6 glass rounded-2xl p-6 sm:p-8">
            @csrf

            <div>
                <label for="customer_id" class="block text-xs font-medium t-muted mb-1.5">Customer</label>
                <select name="customer_id" id="customer_id" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                    <option value="">Select customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}"
                            @selected(old('customer_id', $selectedCustomer->id ?? '') == $customer->id)>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="package_id" class="block text-xs font-medium t-muted mb-1.5">Package</label>
                <select name="package_id" id="package_id" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                    <option value="">Select package</option>
                    @foreach($packages as $package)
                        <option value="{{ $package->id }}" data-price="{{ $package->price }}"
                            @selected(old('package_id') == $package->id)>
                            {{ $package->name }} — {{ $package->system_size_kw }} kW — ₹{{ number_format($package->price, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="total_price" class="block text-xs font-medium t-muted mb-1.5">Total Price (₹)</label>
                <input type="number" name="total_price" id="total_price" value="{{ old('total_price') }}" step="0.01" min="0" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div>
                <label for="details" class="block text-xs font-medium t-muted mb-1.5">Details</label>
                <textarea name="details" id="details" rows="4"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">{{ old('details') }}</textarea>
            </div>

            <div class="space-y-3 pt-1">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" name="send_email" value="1" {{ old('send_email', '1') ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-theme text-solar-500 focus:ring-solar-500 bg-input">
                    <span class="text-sm t-secondary group-hover:t-primary transition-colors">Send Email</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" name="send_whatsapp" value="1" {{ old('send_whatsapp') ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-theme text-solar-500 focus:ring-solar-500 bg-input">
                    <span class="text-sm t-secondary group-hover:t-primary transition-colors">Send WhatsApp</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" name="send_sms" value="1" {{ old('send_sms') ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-theme text-solar-500 focus:ring-solar-500 bg-input">
                    <span class="text-sm t-secondary group-hover:t-primary transition-colors">Send SMS</span>
                </label>
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="submit" class="inline-flex rounded-xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 shadow-sm hover:bg-solar-600 transition">
                    Create Quotation
                </button>
                <a href="{{ route('admin.quotations.index') }}" class="inline-flex rounded-xl border border-theme bg-white/5 px-5 py-2.5 text-sm font-semibold t-secondary hover:bg-white/10 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('package_id').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const price = selected.getAttribute('data-price');
        if (price) {
            document.getElementById('total_price').value = price;
        }
    });
</script>
@endsection
