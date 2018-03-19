@extends('welcome')

@section('content')
        <h1>{{__('price.manage_price')}}</h1>
        <hr>
        @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif

        <div id="price">
            <form method="POST" action="{{ url('/price/' . $price->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="name">{{__('price.price')}}</label>

                    @if ($errors->has('price'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('price') }}</strong>
                        </div>
                    @endif

                    <input type="text" class="form-control" name="price" id="price" value="{{ old('price') ? old('price') : $price->price }}" placeholder="{{__('price.price')}}">
                </div>
                <button type="submit" class="btn btn-success">{{__('product.save')}}</button>
                <a href="{{url('product/' . $price->product_id . '/edit')}}" class="btn btn-info">{{__('product.back')}}</a>
            </form>
        </div>
@endsection
