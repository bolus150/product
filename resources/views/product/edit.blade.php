@extends('welcome')

@section('content')
    <h1>{{__('product.manage_product')}}</h1>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#product">{{__('product.product')}}</a></li>
        <li><a data-toggle="tab" href="#prices">{{__('product.prices')}}</a></li>
    </ul>

    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <div class="tab-content">
        <div id="product" class="tab-pane fade in active">
            <form method="POST" action="{{ url('/product/' . $product->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="name">{{__('product.name')}}</label>

                    @if ($errors->has('name'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </div>
                    @endif

                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ? old('name') : $product->name }}" placeholder="{{__('product.name')}}">
                </div>
                <div class="form-group">
                    <label for="description">{{__('product.description')}}</label>

                    @if ($errors->has('description'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('description') }}</strong>
                        </div>
                    @endif

                    <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ old('description') ? old('description') : $product->description }}</textarea>
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
        <div id="prices" class="tab-pane fade">

            @if ($errors->has('priceEdit'))
                <div class="alert alert-danger">
                    <strong>{{ $errors->first('priceEdit') }}</strong>
                </div>
            @endif

            @if(isset( $product->prices ))
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
                            <td>
                                <strong>{{$price->price}}</strong>
                            </td>
                            <td>
                                <a href="{{url('price/' . $price->id . '/edit')}}" class="btn btn-primary pull-left mr-5">{{__('product.edit')}} </a>
                                <form action="{{url('price/' . $price->id)}}" method="POST" class="pull-left">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger">{{__('product.delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>
@endsection
