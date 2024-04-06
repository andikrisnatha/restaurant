@extends("menu.public")

@section('icon', asset($icon))
@section('title', $pageTitle)

@section('content')
@livewire('menu.beverage')
@endsection