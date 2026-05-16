@extends('layouts.dashboard')

@section('title', 'ID & visiting cards')
@section('page-title', 'ID & visiting cards')
@section('page-subtitle', 'PDF downloads — pick company letterhead, then generate')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="max-w-5xl space-y-6">
        <div class="glass rounded-2xl p-5 sm:p-6 text-sm t-secondary">
            <p class="t-primary font-medium">Staff cards use each person’s <strong>name</strong>, <strong>designation</strong>, <strong>email</strong>, and <strong>phone</strong> from <a href="{{ route('admin.users.index') }}" class="text-solar-600 dark:text-solar-400 underline underline-offset-2">Users</a>. Use <strong>Edit</strong> on a user to upload a <strong>photo</strong> (shown in an oval on the ID card).</p>
            <p class="mt-2 text-xs t-muted">Upload a <strong>company logo</strong> under <a href="{{ route('admin.company-profiles.index') }}" class="text-solar-600 dark:text-solar-400 underline underline-offset-2">Company Profiles</a> → Edit — it appears on both PDFs. Choose which company brand below, then download the PDF.</p>
        </div>

        <div class="glass rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b border-subtle text-left text-[10px] font-semibold t-faint uppercase tracking-widest">
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Designation</th>
                            <th class="px-4 py-3">Email / Phone</th>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3">Generate (company + PDF)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border-subtle)]">
                        @forelse($staff as $u)
                            <tr class="hover:bg-[var(--bg-card-hover)]">
                                <td class="px-4 py-3 font-medium t-primary">{{ $u->name }}</td>
                                <td class="px-4 py-3 t-secondary">{{ $u->designation ?: '—' }}</td>
                                <td class="px-4 py-3 text-xs t-secondary">
                                    <div>{{ $u->email }}</div>
                                    <div class="t-muted">{{ $u->phone ?: '—' }}</div>
                                </td>
                                <td class="px-4 py-3 text-xs">{{ ucwords(str_replace('_', ' ', $u->role)) }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:flex-wrap sm:items-center">
                                        <form class="flex flex-wrap items-center gap-2" method="GET" action="{{ route('admin.stationery.id-card', $u) }}">
                                            <select name="company_profile_id" required class="rounded-lg bg-input border border-theme t-primary text-xs px-2 py-1.5 min-w-[140px] max-w-[220px]">
                                                @foreach($companies as $c)
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="rounded-lg bg-solar-500 px-3 py-1.5 text-xs font-semibold text-dark-900 hover:bg-solar-400 whitespace-nowrap">ID card PDF</button>
                                        </form>
                                        <form class="flex flex-wrap items-center gap-2" method="GET" action="{{ route('admin.stationery.visiting-card', $u) }}">
                                            <select name="company_profile_id" required class="rounded-lg bg-input border border-theme t-primary text-xs px-2 py-1.5 min-w-[140px] max-w-[220px]">
                                                @foreach($companies as $c)
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="rounded-lg border border-theme bg-white/5 px-3 py-1.5 text-xs font-semibold t-secondary hover:bg-white/10 whitespace-nowrap">Visiting card PDF</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center t-muted">No staff users found. Add users with roles admin, employee, or channel partner.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
