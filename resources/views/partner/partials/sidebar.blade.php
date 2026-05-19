<a href="{{ route('partner.dashboard') }}" class="sidebar-link {{ request()->routeIs('partner.dashboard') ? 'active' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
    Dashboard
</a>
<a href="{{ route('partner.customers.index') }}" class="sidebar-link {{ request()->routeIs('partner.customers.*') ? 'active' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
    My Customers
</a>
<a href="{{ route('partner.quotations.index') }}" class="sidebar-link {{ request()->routeIs('partner.quotations.*') ? 'active' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/></svg>
    Quotations
</a>
<div x-data="{ open: false }" class="mt-1">
    <button @click="open = !open" class="sidebar-link w-full flex items-center justify-between cursor-pointer border-none bg-transparent">
        <div class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M8 13h2l2 4 2-4h2"/></svg>
            <span style="font-size:inherit;">Quotation (Word format)</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-200" :class="open ? 'rotate-180' : ''"><path d="m6 9 6 6 6-6"/></svg>
    </button>
    <div x-show="open" x-transition.opacity.duration.200ms class="pl-8 pr-2 space-y-1 mt-1">
        <a href="{{ asset('assets/quotations/UPK_Template.docx') }}" download class="sidebar-link !py-1.5 !text-xs w-full block">
            UPK Electrical
        </a>
        <a href="{{ asset('assets/quotations/UPR_Solar_Template.docx') }}" download class="sidebar-link !py-1.5 !text-xs w-full block">
            UPR Solar
        </a>
        <a href="{{ asset('assets/quotations/UPR_Refrigeration_Template.doc') }}" download class="sidebar-link !py-1.5 !text-xs w-full block">
            UP Refrigeration and Sales Co
        </a>
    </div>
</div>
<a href="{{ route('partner.commissions.index') }}" class="sidebar-link {{ request()->routeIs('partner.commissions.*') ? 'active' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
    Commissions
</a>
