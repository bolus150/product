@extends('welcome')

@section('content')
    <h1>{{__('product.manage_product')}}</h1>

    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <div class="tab-content">
        <div id="product" class="tab-pane fade in active">
            <form method="POST" action="{{ url('/product') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">{{__('product.name')}}</label>

                    @if ($errors->has('name'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </div>
                    @endif

                    <input type="text" class="form-control" name="name" id="name" value="{{ isset($product) ? $product->name : old('name')}}" placeholder="{{__('product.name')}}">
                </div>
                <div class="form-group">
                    <label for="description">{{__('product.description')}}</label>

                    @if ($errors->has('description'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('description') }}</strong>
                        </div>
                    @endif

                    <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ isset($product) ? $product->description : old('description')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">{{__('product.price')}}</label>

                    @if ($errors->has('price'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('price') }}</strong>
                        </div>
                    @endif

                    <input type="text" class="form-control" name="price" id="price" value="{{old('price')}}" placeholder="{{__('product.price')}}">
                </div>
                <button type="submit" class="btn btn-success">{{__('product.save')}}</button>
                <a href="{{url('/product')}}" class="btn btn-info">{{__('product.back')}}</a>
            </form>
        </div>
    </div>
@endsection
