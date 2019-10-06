@extends('admin.layouts.master')
@section('content')
    @php $route = $data ? route('admin.category.editAction', ['id' => $data->id]) : route('admin.category.postAction') @endphp

    <form  method="post" action="{!! $route !!}">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id ?? null }}">
        <input type="text" name="name" value="{{ $data->name ?? old('name') }}">
        <input type="submit" value="Submit">
    </form>

@endsection
