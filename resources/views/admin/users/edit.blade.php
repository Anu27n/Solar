@extends('layouts.dashboard')

@section('title', 'Edit user')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('page-title', 'Edit user')

@section('content')
    <div class="max-w-lg">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data" class="space-y-6 glass rounded-2xl p-6 sm:p-8">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-xs font-medium t-muted mb-1.5">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required autocomplete="name"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
            </div>

            <div>
                <label for="email" class="block text-xs font-medium t-muted mb-1.5">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required autocomplete="email"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
            </div>

            <div>
                <label for="phone" class="block text-xs font-medium t-muted mb-1.5">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" autocomplete="tel"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
            </div>

            <div>
                <label for="designation" class="block text-xs font-medium t-muted mb-1.5">Designation</label>
                <input type="text" name="designation" id="designation" value="{{ old('designation', $user->designation) }}"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
            </div>

            <div>
                <label class="block text-xs font-medium t-muted mb-1.5">Photo (ID card)</label>
                @if($user->avatar_path)
                    <div class="mb-2 flex items-center gap-4">
                        <img src="{{ asset('storage/'.$user->avatar_path) }}" alt="" class="h-16 w-16 rounded-full object-cover border border-theme">
                        <label class="inline-flex items-center gap-2 text-xs t-secondary cursor-pointer">
                            <input type="checkbox" name="remove_avatar" value="1" {{ old('remove_avatar') ? 'checked' : '' }}>
                            Remove photo
                        </label>
                    </div>
                @endif
                <input type="file" name="avatar" accept="image/jpeg,image/png,image/webp,image/gif"
                    class="block w-full text-sm t-secondary file:mr-3 file:rounded-lg file:border-0 file:bg-solar-500 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-dark-900">
                <p class="mt-1 text-[11px] t-faint">Upload a new image to replace. Shown in oval on ID card PDF.</p>
            </div>

            <div>
                <label for="role" class="block text-xs font-medium t-muted mb-1.5">Role</label>
                <select name="role" id="role" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
                    <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                    <option value="channel_partner" @selected(old('role', $user->role) === 'channel_partner')>Channel partner</option>
                    <option value="employee" @selected(old('role', $user->role) === 'employee')>Employee</option>
                    <option value="customer" @selected(old('role', $user->role) === 'customer')>Customer</option>
                </select>
            </div>

            <div>
                <label for="password" class="block text-xs font-medium t-muted mb-1.5">New password (optional)</label>
                <input type="password" name="password" id="password" autocomplete="new-password"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
            </div>
            <div>
                <label for="password_confirmation" class="block text-xs font-medium t-muted mb-1.5">Confirm new password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-solar-500">
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="submit" class="inline-flex rounded-xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 shadow-sm hover:bg-solar-400 transition">
                    Save changes
                </button>
                <a href="{{ route('admin.users.index') }}" class="inline-flex rounded-xl border border-theme bg-white/5 px-5 py-2.5 text-sm font-semibold t-secondary hover:bg-white/10 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
