@extends('layouts.app')

@section('content')
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Boats</a></li>
                <li class="breadcrumb-item active" aria-current="page">New Purchase Agreement</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        New Purchase Agreement
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="post" action="{{ route('sale.store') }}">

                            @csrf

                            @include('sales._form',['sale'=>new \App\Sale()])

                            <hr class="mt-5">

                            <div class="d-flex justify-content-between">
                                <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-text">Cancel</a>
                                <button class="btn btn-primary" type="submit" >Submit Agreement</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
