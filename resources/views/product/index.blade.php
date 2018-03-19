@extends('welcome')

@section('content')
    <a href="{{ url('product/create') }}" class="btn btn-success">{{__('product.create')}}</a>
    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('product.name') }}</th>
            <th scope="col">{{ __('product.description') }}</th>
            <th scope="col">{{ __('product.action') }}</th>
        </tr>
        </thead>
        <tbody>
            @foreach($products as $k => $product)
                <tr>
                    <th>{{$k + 1}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>
                        <div class="pull-left">
                            <a href="{{ url('product/' . $product->id . '/edit' ) }}" class="btn btn-primary pull-left mr-5">{{__('product.edit')}}</a>
                            <form action="{{url('product/' . $product->id)}}" method="POST" class="pull-left">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger">{{__('product.delete')}}</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection