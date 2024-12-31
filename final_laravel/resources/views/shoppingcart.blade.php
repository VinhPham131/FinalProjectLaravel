@extends('layouts.app')
@section('title', 'Shopping Cart')

@section('content')
@livewire('cart', ['viewType' => 'full'])
@endsection