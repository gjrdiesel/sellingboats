<div class="row">
    <div class="div col">
        <div class="h4 ml-4">Boat Information</div>
    </div>
</div>

<input type="hidden" name="boat_id" value="{{ $boat->id }}">

<div class="row">
    <div class="col-md-4 text-md-right">Year/Make/Model:</div>
    <div class="col">{{ $boat->year }} {{ $boat->make }}/{{ $boat->model }}</div>
</div>
<div class="row">
    <div class="col-md-4 text-md-right">Serial:</div>
    <div class="col">{{ $boat->serial_number }}</div>
</div>
<div class="row">
    <div class="col-md-4 text-md-right">Stock Number:</div>
    <div class="col">{{ $boat->stock_number }}</div>
</div>
<div class="row">
    <div class="col-md-4 text-md-right">List Price:</div>
    <div class="col">{{ $boat->moneyFormat }}</div>
</div>

<div class="row mt-5">
    <div class="div col">
        <div class="h4 ml-4">Purchase Agreement</div>
    </div>
</div>

<div class="form-group row">
    <label for="sold_at"
           class="col-md-4 col-form-label text-md-right">{{ __('Sale Date') }}</label>

    <div class="col-md-5">
        <input id="sold_at" type="datetime-local"
               class="form-control @error('sold_at') is-invalid @enderror" name="sold_at"
               value="{{ old('sold_at',(new Carbon\Carbon($sale->sold_at))->format('Y-m-d\TH:i')) }}"
               required>

        @error('sold_at')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="status"
           class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

    <div class="col-md-4">
        <select id="status"
                class="form-control @error('status') is-invalid @enderror" name="status"
                required>
            @foreach(\App\Sale::$statuses as $status)
                <option value="{{ $status }}" {{ old('status',$sale->status) === $status ? 'selected' : '' }}>{{ __($status) }}</option>
            @endforeach
        </select>

        @error('status')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="price"
           class="col-md-4 col-form-label text-md-right">{{ __('Sale Price') }}</label>

    <div class="col-md-3">

        <price-input :old="{{ old('price',$sale->price ?? $boat->list_price) }}"
                     error="{{ $errors->first('price') ?? '' }}"></price-input>

    </div>
</div>

<div class="row mt-5">
    <div class="div col">
        <div class="h4 ml-4">Customer Information</div>
    </div>
</div>

<select-customer error-msg="{{ $errors->first('customers') ?? '' }}"
                 :old="{{ json_encode(old('customers',$sale->customers->pluck('id') ?? [])) }}"></select-customer>