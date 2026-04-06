@extends('install.layout')

@section('content')
    <h1>Run migrations</h1>
    <p class="lead">This creates all database tables. You can optionally load the default product packages (recommended for new sites).</p>

    @if(!empty($lastLog))
        <pre class="log">{{ $lastLog }}</pre>
    @endif

    <form method="post" action="{{ route('install.migrate.run') }}">
        @csrf
        <div class="check">
            <input type="checkbox" name="seed_packages" id="seed_packages" value="1" checked>
            <label for="seed_packages" style="margin:0;color:inherit;">Seed default rooftop / commercial packages</label>
        </div>
        <div class="actions">
            <button type="submit" class="btn">Run migrations</button>
            <a class="btn secondary" href="{{ route('install.configuration') }}">Back</a>
        </div>
    </form>
@endsection
