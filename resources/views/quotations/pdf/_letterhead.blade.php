<div class="letterhead">
    <div class="name">{{ $company->name }}</div>
    @if($company->tagline)
        <div class="tagline">{{ $company->tagline }}</div>
    @endif
    <div class="addr">
        <strong>Office:</strong> {{ $company->address_office }}
        @if($company->address_factory)
            <br><strong>Factory:</strong> {{ $company->address_factory }}
        @endif
    </div>
    <div class="contacts">
        @if($company->email)<strong>Email:</strong> {{ $company->email }}@endif
        @if($company->phonesList())
            &nbsp;|&nbsp; <strong>Phones:</strong> {{ $company->phonesList() }}
        @endif
        @if($company->gstin)
            &nbsp;|&nbsp; <strong>GSTIN:</strong> {{ $company->gstin }}
        @endif
    </div>
</div>
