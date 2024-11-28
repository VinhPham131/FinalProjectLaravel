@extends('layouts.app')

@section('title', 'Shop')

@section('content')

<section class="grid justify-center w-screen">
  <div
    class="grid phone:max-tablet:text-center tablet:mx-[200px] max-w-[1200px] phone:max-tablet:max-w-screen phone:max-tablet:ml-5">
    <h1 class="phone:text-[35px] tablet:text-4xl font-roboto text-black phone:mb-5 tablet:mb-10">Shop The Latest</h1>
  </div>
  <main
    class="grid tablet:grid-cols-3 laptop:grid-cols-4 tablet:mx-[200px] max-w-[1200px] laptop:w-[calc(1200px-100px)] tablet:max-laptop:w-[calc(1200px-350px)] phone:max-tablet:mb-5 phone:max-tablet:w-screen">
    <!-- Sidebar -->
    <section
      class="grid flex-col phone:max-tablet:justify-center tablet:flex phone:max-tablet:border-gray-200 phone:max-tablet:border-b-2 phone:max-tablet:p-4 phone:max-tablet:mb-5 phone:max-tablet:w-screen ">

      @include('components/side-bar')
    </section>

    <!-- Products -->
    <section class="phone:max-tablet:grid phone:max-tablet:justify-center">

      <section
        class="grid h-full phone:grid-cols-2 phone:max-tablet:justify-center tablet:grid-cols-2 laptop:grid-cols-3 tablet:w-[calc(1200px-650px)] laptop:w-[calc(1200px-350px)] phone:w-[calc(500px-70px)] border-l border-gray-600 pl-9 phone:max-tablet:border-hidden">
        @foreach ($products as $item)
      @include('components.products', ['item' => $item])
    @endforeach
      </section>

    </section>
  </main>


</section>

<script src="{{asset('js/search.js')}}"></script>


@endsection