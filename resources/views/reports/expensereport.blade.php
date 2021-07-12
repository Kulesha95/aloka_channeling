@extends('layouts.reports')

@section('reportTitle', __('app.headers.expenseReport'))
@section('icon', 'hand-holding-usd')
@section('reportType', 'expenseReport')
@section('id', '0')
@section('filters', true)
@section('exports', true)