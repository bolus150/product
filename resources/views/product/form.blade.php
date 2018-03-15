@extends('welcome')

@section('content')
    <h1>{{__('product.manage_product')}}</h1>
    <a href="{{url('/')}}" class="btn btn-primary pull-right">{{__('product.back')}}</a>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#product">{{__('product.product')}}</a></li>
            <li><a data-toggle="tab" href="#prices">{{__('product.prices')}}</a></li>
        </ul>

        @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif

        <div class="tab-content">
            <div id="product" class="tab-pane fade in active">
                <form method="POST" action="{{url('product/' . $method)}}">
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
                    <button type="submit" class="btn btn-primary">{{__('product.save')}}</button>
                </form>
            </div>
            <div id="prices" class="tab-pane fade">

                @if ($errors->has('priceEdit'))
                    <div class="alert alert-danger">
                        <strong>{{ $errors->first('priceEdit') }}</strong>
                    </div>
                @endif

                @if(isset( $product ))
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{__('product.price')}}</th>
                            <th>{{__('product.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product->prices as $price)
                            <tr>
                                <form action="{{url('price/save/' . $price->id )}}">
                                    <td><input type="text" name="priceEdit" value="{{$price->price}}" class="form-control"></td>
                                    <td>
                                        <button class="btn btn-primary">{{__('product.save')}} </button>
                                        <a href="{{url('price/delete/' . $price->id)}}" class="btn btn-danger">{{__('product.delete')}}</a>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
@endsection
