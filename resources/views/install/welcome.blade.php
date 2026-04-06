@extends('install.layout')

@section('content')
    <h1>Welcome</h1>
    <p class="lead">
        This wizard configures your database, writes <code style="color:#cbd5e1">.env</code>, runs migrations, and creates your first administrator.
        You will need a MySQL database already created on your host (empty database is best).
    </p>
    <div class="actions">
        <a class="btn" href="{{ route('install.requirements') }}">Begin installation</a>
    </div>
@endsection
