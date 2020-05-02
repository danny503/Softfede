@extends('layouts.principal')
@section('content')
    <template>
        <template v-if="navbar==0">
            <home></home>
        </template>
        <template v-if="navbar==1">
            <about></about>
        </template>
        <template v-if="navbar==2">
            <news></news>
        </template>
    </template>
@endsection 