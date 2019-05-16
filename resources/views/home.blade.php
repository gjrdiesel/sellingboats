@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-10 offset-md-2">
                <h2 class="h4">Recent Sales</h2>
                <ul>
                    @foreach($sales as $sale)
                        <li>
                            <a href="{{ route('sale.show',$sale) }}">{{ $sale->boat->yearMakeModel }}
                                ({{ $sale->updated_at->diffForHumans() }})</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-2">
                <h4 class="mt-5">Makes</h4>
                <ul>
                    @foreach($makes as $make)
                        <a href="{{ build_url(['make'=>$make],['model'=>'']) }}"
                           class="{{ $make==request('make') ? 'font-weight-bold' : '' }}">
                            <li>{{ $make }}</li>
                        </a>
                    @endforeach
                </ul>
                <h4 class="mt-5">Models</h4>
                <ul>
                    @foreach($models as $model)
                        <a href="{{ build_url('make',['model'=>$model]) }}"
                           class="{{ $model==request('model') ? 'font-weight-bold' : '' }}">
                            <li>{{ $model }}</li>
                        </a>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-10">

                <div class="card">
                    <div class="card-header">
                        <form class="d-flex">
                            <div class="btn btn-text">
                                <a href="{{ route('welcome') }}">Boats</a>
                            </div>
                            <input type="text" class="form-control" value="{{ request('search') }}"
                                   placeholder="Search make, model, stock number, serial, etc" name="search">
                            <button class="btn btn-default">Go</button>
                        </form>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row mb-4">
                            @foreach($boats as $boat)
                                <div class="col-md-4">
                                    <a href="{{ $boat->createOrEditLink }}" class="boat">
                                        <div class="box mb-4 d-flex justify-content-center flex-column text-center">
                                            <div>
                                                {{ $boat->yearMakeModel }}
                                                <div>
                                                    {{ $boat->moneyFormat }}
                                                </div>
                                                @if($boat->sales_count>0)
                                                    <div>(PENDING SALE(S))</div>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        @if($boats->isEmpty() && request('search'))
                            <div class="p-5 mt-3 text-center bg-dark text-light">
                                No boats matching "{{ request('search') }}" found. <a href="{{ route('welcome') }}">Try
                                    again?</a>
                            </div>
                        @elseif($boats->isEmpty())
                            <div class="p-5 my-3 text-center bg-dark text-light">
                                No boats found. <a href="#">Add one?</a>
                            </div>
                        @endif

                        <div class="d-flex justify-content-center">
                            {{ $boats->render() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
