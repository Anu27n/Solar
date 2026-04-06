@extends('layouts.dashboard')

@section('title', 'Assign Task')
@section('page-title', 'Assign Task')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('admin.tasks.store') }}" class="space-y-6 glass rounded-2xl p-6 sm:p-8">
            @csrf

            <div>
                <label for="title" class="block text-xs font-medium t-muted mb-1.5">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required maxlength="255"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div>
                <label for="assigned_to" class="block text-xs font-medium t-muted mb-1.5">Assigned to</label>
                <select name="assigned_to" id="assigned_to" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                    <option value="">Select employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" @selected(old('assigned_to') == $employee->id)>{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="customer_id" class="block text-xs font-medium t-muted mb-1.5">Customer <span class="t-faint font-normal">(optional)</span></label>
                <select name="customer_id" id="customer_id"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                    <option value="">None</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="type" class="block text-xs font-medium t-muted mb-1.5">Type</label>
                <select name="type" id="type" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                    <option value="kyc" @selected(old('type') === 'kyc')>KYC</option>
                    <option value="installation" @selected(old('type') === 'installation')>Installation</option>
                    <option value="loan" @selected(old('type') === 'loan')>Loan</option>
                    <option value="visit" @selected(old('type') === 'visit')>Visit</option>
                    <option value="emi_collection" @selected(old('type') === 'emi_collection')>EMI collection</option>
                    <option value="other" @selected(old('type', 'other') === 'other')>Other</option>
                </select>
            </div>

            <div>
                <label for="priority" class="block text-xs font-medium t-muted mb-1.5">Priority</label>
                <select name="priority" id="priority" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                    <option value="low" @selected(old('priority') === 'low')>Low</option>
                    <option value="medium" @selected(old('priority', 'medium') === 'medium')>Medium</option>
                    <option value="high" @selected(old('priority') === 'high')>High</option>
                    <option value="urgent" @selected(old('priority') === 'urgent')>Urgent</option>
                </select>
            </div>

            <div>
                <label for="due_date" class="block text-xs font-medium t-muted mb-1.5">Due date</label>
                <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div>
                <label for="description" class="block text-xs font-medium t-muted mb-1.5">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">{{ old('description') }}</textarea>
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="submit" class="inline-flex rounded-xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 shadow-sm hover:bg-solar-600 transition">
                    Assign task
                </button>
                <a href="{{ route('admin.tasks.index') }}" class="inline-flex rounded-xl border border-theme bg-white/5 px-5 py-2.5 text-sm font-semibold t-secondary hover:bg-white/10 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
