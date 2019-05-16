@extends('layouts.app',['noNav'=>true])

@section('content')
    <div class="container border-dark">
        <div class="bg-dark text-white p-4 h1 d-flex justify-content-between">
            <div>
                <a href="{{ route('home') }}" class="text-decoration-none text-white">{{ config('app.name') }}</a>
            </div>
            <div>
                Purchase Agreement
            </div>
        </div>

        <div class="p-5">

            <div class="row mb-5">
                <div class="col-4">
                    Date: {{ $sale->sold_at }}
                </div>
                <div class="col">
                    <div class="d-print-none">
                        <div class="dropdown float-right">
                            <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Options
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a href="{{ route('sale.create',['boat'=>$sale->boat->id]) }}" class="dropdown-item">New Agreement</a>
                                <a href="{{ route('sale.edit',$sale) }}" class="dropdown-item">Edit Agreement</a>
                                <a href="#" onclick="confirm('Not implemented, sorry.')" class="dropdown-item">Mark as Pending</a>
                                <a href="#" onclick="confirm('Not implemented, sorry.')" class="dropdown-item">Mark as Delivered/Completed</a>
                                <a href="#" onclick="confirm('Not implemented, sorry.')" class="dropdown-item">Trash</a>
                                <a href="#" onclick="window.print();" class="dropdown-item">Print this page</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h4 class="border-bottom">PURCHASER(S)</h4>
                    <div>Name(s): {{ $sale->customers->pluck('name')->implode(', ') }}</div>
                    <div>Primary Address: {{ $sale->customers->first()->address }}</div>
                    <div>Phone: {{ $sale->customers->first()->phone }}</div>
                    <div>Email: {{ $sale->customers->first()->email }}</div>
                </div>
                <div class="col-md-6">
                    <h4 class="border-bottom">OWNER</h4>
                    <div>Name: {{ config('app.name') }}</div>
                    <div>Primary Address: {{ config('app.address') }}</div>
                    <div>Phone: {{ config('app.phone') }}</div>
                    <div>Email: {{ config('app.email') }}</div>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="border-bottom">DESCRIPTION OF BOAT (MANUFACTURER, MODEL, YEAR, LENGTH, HIN, REGISTRATION
                    #)</h4>
                <div class="d-flex justify-content-between">
                    <div>{{ $sale->boat->yearMakeModel }}</div>
                    <div>#{{ $sale->boat->serial_number }}</div>
                </div>
            </div>

            <div class="mt-5 row">
                <div class="col-md-6">
                    Selling Price of Boat: {{ $sale->moneyFormat }}
                </div>
            </div>

            <div class="mt-5">
                <h4 class="border-bottom">LIENS OR ENCUMBRANCES</h4>
                Owner states that this boat is sold free and clear of any liens, bills or encumbrances of any nature
                except
                as stated below. The Owner warrants and will defend that they have a valid title, registration and/or
                Certificate of Documentation, the lawful right to sell the boat, and will execute and deliver all
                necessary
                documents for the transfer of ownership to the Purchaser.
            </div>

            <h4 class="border-bottom mt-5">MORE FILLER</h4>
            <p>Vestibulum sagittis posuere velit, ac vulputate est condimentum in. Aenean pharetra velit id pharetra
                faucibus. Nunc at velit ac erat accumsan placerat. Aliquam enim elit, laoreet faucibus pharetra at,
                lobortis
                ac neque. Etiam id congue ipsum, tempus finibus elit. Mauris urna nulla, scelerisque eget risus eu,
                viverra
                interdum magna. Sed vehicula ultrices diam cursus mattis. Curabitur feugiat dui tincidunt massa
                molestie, eu
                elementum magna gravida. Aenean porttitor condimentum mauris sit amet ullamcorper. Nam euismod hendrerit
                massa at scelerisque. Nunc pharetra feugiat massa a gravida. Morbi placerat, leo ac dignissim finibus,
                leo
                est varius mauris, eget venenatis eros nunc at risus. Integer efficitur eleifend fermentum. Fusce
                volutpat
                neque vitae tellus finibus, ac faucibus magna vulputate. Vestibulum faucibus interdum elit pulvinar.</p>

            <h6>FINE PRINT</h6>
            <small>Vestibulum sagittis posuere velit, ac vulputate est condimentum in. Aenean pharetra velit id pharetra
                faucibus. Nunc at velit ac erat accumsan placerat. Aliquam enim elit, laoreet faucibus pharetra at,
                lobortis ac neque. Etiam id congue ipsum, tempus finibus elit. Mauris urna nulla, scelerisque eget risus
                eu, viverra interdum magna. Sed vehicula ultrices diam cursus mattis. Curabitur feugiat dui tincidunt
                massa molestie, eu elementum magna gravida. Aenean porttitor condimentum mauris sit amet ullamcorper.
                Nam euismod hendrerit massa at scelerisque. Nunc pharetra feugiat massa a gravida. Morbi placerat, leo
                ac dignissim finibus, leo est varius mauris, eget venenatis eros nunc at risus. Integer efficitur
                eleifend fermentum. Fusce volutpat neque vitae tellus finibus, ac faucibus magna vulputate. Vestibulum
                faucibus interdum elit pulvinar.
            </small>
        </div>

    </div>
@endsection
