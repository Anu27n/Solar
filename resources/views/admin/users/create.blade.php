@extends('layouts.dashboard')

@section('title', 'Create User')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('page-title', 'Create User')

@section('content')
    <div class="max-w-lg">
        <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data" class="space-y-6 glass rounded-2xl p-6 sm:p-8">
            @csrf

            <div>
                <label for="name" class="block text-xs font-medium t-muted mb-1.5">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autocomplete="name"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div>
                <label for="email" class="block text-xs font-medium t-muted mb-1.5">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div>
                <label for="phone" class="block text-xs font-medium t-muted mb-1.5">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" autocomplete="tel"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div>
                <label for="designation" class="block text-xs font-medium t-muted mb-1.5">Designation (for ID / visiting cards)</label>
                <input type="text" name="designation" id="designation" value="{{ old('designation') }}" placeholder="e.g. General Manager"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div>
                <label for="avatar" class="block text-xs font-medium t-muted mb-1.5">Photo (ID card — oval crop in PDF)</label>
                <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/png,image/webp,image/gif"
                    class="block w-full text-sm t-secondary file:mr-3 file:rounded-lg file:border-0 file:bg-solar-500 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-dark-900">
                <p class="mt-1 text-[11px] t-faint">Square or portrait photo works best; max 4 MB.</p>
            </div>

            <div>
                <label for="role" class="block text-xs font-medium t-muted mb-1.5">Role</label>
                <select name="role" id="role" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                    <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                    <option value="channel_partner" @selected(old('role') === 'channel_partner')>Channel partner</option>
                    <option value="employee" @selected(old('role') === 'employee')>Employee</option>
                    <option value="customer" @selected(old('role') === 'customer')>Customer</option>
                </select>
            </div>

            <div>
                <label for="password" class="block text-xs font-medium t-muted mb-1.5">Password</label>
                <input type="password" name="password" id="password" required autocomplete="new-password"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="submit" class="inline-flex rounded-xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 shadow-sm hover:bg-solar-600 transition">
                    Create User
                </button>
                <a href="{{ route('admin.users.index') }}" class="inline-flex rounded-xl border border-theme bg-white/5 px-5 py-2.5 text-sm font-semibold t-secondary hover:bg-white/10 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
