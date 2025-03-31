@extends('layouts.app')

@section('content')
@include('components.title', ['title' => 'Product Detail'])

<div class="container">
@include('components.product-detail', [$product])
</div>
@endsection


