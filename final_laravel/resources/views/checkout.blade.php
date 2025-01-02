@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="max-w-[1100px] mx-auto">
    <div class="w-[200px mx-auto]">
    @include ('components.stepper', ['step' => $step])
    </div>
    @if ($step == 1)
        @include('components.steps.personal-info', ['cart' => $cart])
    @elseif ($step == 2)
        @include('components.steps.confirmation', ['cart' => $cart])
    @elseif ($step == 3)
        @include('components.steps.order-success', ['cart' => $cart])
    @endif
</div>
@endsection
