@extends('layouts.dashboard')

@section('title', 'Company Profiles')
@section('page-title', 'Company Profiles')
@section('page-subtitle', 'Letterhead, bank details, GSTIN and default terms per company')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    @if($profiles->isEmpty())
        <div class="glass rounded-2xl p-8 text-center max-w-lg mx-auto">
            <p class="text-sm font-semibold t-primary">No company profiles yet</p>
            <p class="text-xs t-muted mt-2">The three letterheads (UPK Electrical, UPR Solar, UP Refrigeration) are created by the database seeder. On the server, run from the project folder:</p>
            <pre class="mt-4 text-left text-[11px] t-secondary bg-input rounded-xl p-4 border border-theme overflow-x-auto">php artisan db:seed --class=Database\Seeders\CompanyProfileSeeder</pre>
            <p class="text-[11px] t-faint mt-3">Or run <code class="font-mono">php artisan db:seed</code> if you have not seeded yet. The web installer also seeds company profiles automatically after migrations.</p>
        </div>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach($profiles as $p)
            <div class="glass rounded-2xl p-5 flex flex-col">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <span class="inline-flex items-center rounded-lg bg-solar-500/15 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-solar-600 dark:text-solar-400">{{ $p->ref_prefix }}</span>
                        <h3 class="text-sm font-semibold t-primary mt-2">{{ $p->name }}</h3>
                        @if($p->tagline)<p class="text-[11px] t-muted mt-1 line-clamp-2">{{ \Illuminate\Support\Str::limit($p->tagline, 90) }}</p>@endif
                    </div>
                    <span class="text-[10px] font-semibold uppercase tracking-wider px-2 py-0.5 rounded-md {{ $p->is_active ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-slate-500/10 t-muted' }}">
                        {{ $p->is_active ? 'Active' : 'Off' }}
                    </span>
                </div>
                <dl class="mt-4 space-y-2 text-xs t-secondary">
                    <div><dt class="t-faint text-[10px] uppercase tracking-wider">Email</dt><dd>{{ $p->email ?? '—' }}</dd></div>
                    <div><dt class="t-faint text-[10px] uppercase tracking-wider">Phones</dt><dd>{{ $p->phonesList() ?: '—' }}</dd></div>
                    <div><dt class="t-faint text-[10px] uppercase tracking-wider">GSTIN</dt><dd>{{ $p->gstin ?? '—' }}</dd></div>
                    <div><dt class="t-faint text-[10px] uppercase tracking-wider">Bank</dt><dd>{{ $p->bank_name ? $p->bank_name . ' · ' . $p->bank_ac_no : '—' }}</dd></div>
                    <div><dt class="t-faint text-[10px] uppercase tracking-wider">Next Ref</dt><dd class="font-mono">{{ $p->ref_prefix }}/{{ str_pad((string) $p->next_quotation_seq, 2, '0', STR_PAD_LEFT) }}/{{ $p->ref_year_mode === 'fiscal' ? (now()->month >= 4 ? now()->year . '-' . substr(now()->addYear()->year, -2) : (now()->year - 1) . '-' . substr(now()->year, -2)) : now()->year }}</dd></div>
                </dl>
                <div class="mt-4 pt-3 border-t border-theme">
                    <a href="{{ route('admin.company-profiles.edit', $p) }}" class="inline-flex rounded-xl bg-solar-500 px-3 py-2 text-xs font-semibold text-dark-900 hover:bg-solar-400 transition">Edit</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
