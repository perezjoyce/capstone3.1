@extends('layouts.app')
@section('main')
<main>
    @include('sidenav')
    <div id="dashboard" class="section scrollspy">
        <div>
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
