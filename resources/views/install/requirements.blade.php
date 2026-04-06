@extends('install.layout')

@section('content')
    <h1>Server requirements</h1>
    <p class="lead">Your host must meet these checks before continuing.</p>

    <ul class="checklist">
        @foreach($checks as $c)
            <li>
                <span>{{ $c['label'] }}</span>
                <span class="badge {{ $c['pass'] ? 'ok' : 'bad' }}">{{ $c['detail'] }}</span>
            </li>
        @endforeach
    </ul>

    <form class="actions" method="post" action="{{ route('install.requirements.continue') }}">
        @csrf
        <button type="submit" class="btn">Continue</button>
        <a class="btn secondary" href="{{ route('install.welcome') }}">Back</a>
    </form>
@endsection
