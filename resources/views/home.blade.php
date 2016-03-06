@extends('layout.main')

@section('sections')
    <section id="home">
        @include('sections.home')
    </section>
    @if(Auth::user())
        <section id="purchase" ng-controller="PurchaseForm">
            @include('sections.purchase')
        </section>
    @endif
@endsection