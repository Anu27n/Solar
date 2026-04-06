@extends('install.layout')

@section('content')
    <h1>Finish</h1>
    <p class="lead">
        Your application is ready. Locking the installer prevents anyone from running this wizard again.
        If you need to re-run it later, delete <code style="color:#cbd5e1">storage/app/installer.lock</code> on the server (not recommended on production).
    </p>

    <form method="post" action="{{ route('install.finish.lock') }}">
        @csrf
        <div class="actions">
            <button type="submit" class="btn">Lock installer &amp; go to site</button>
        </div>
    </form>
@endsection
