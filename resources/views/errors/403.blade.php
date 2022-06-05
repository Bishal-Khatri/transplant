@extends('errors::gentelella')

@section('title', __('Forbidden'))
@section('code', '403')
@section('short_message', 'Access Denied')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
