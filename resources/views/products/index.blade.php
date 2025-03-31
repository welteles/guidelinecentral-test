@extends('layouts.app')

@section('content')
@include('components.title', ['title' => 'Product Catalog'])
<div class="container">
    <div class="container-list">
        @foreach($products as $product)
        @include('components.product', [$product])
        @endforeach
    </div>
</div>
@endsection

