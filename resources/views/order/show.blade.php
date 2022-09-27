@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route("order.index")}}">Orders</a></li>
                            <li class="breadcrumb-item active">Show</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body p-0">
                                <div class="mailbox-read-info">
                                    <h5>{{$order->getSubject()}}</h5>
                                    <h6>From: {{$order->getSenderName() . " - " . $order->getSenderEmail()}}
                                        <span
                                            class="mailbox-read-time float-right">{{\Illuminate\Support\Carbon::parse($order->getDate())->format("d.m.Y H:i")}}</span>
                                    </h6>
                                </div>
                                <div class="mailbox-controls with-border text-center">
                                    <div class="btn-group">
                                        <a href="{{route("order.reply",$order->getId())}}" type="button"
                                           class="btn btn-default btn-sm" data-container="body"
                                           title="Reply">
                                            <i class="fas fa-reply"></i>
                                        </a>
                                        <button type="button" class="btn btn-default btn-sm" data-container="body"
                                                title="Forward">
                                            <i class="fas fa-share"></i>
                                        </button>
                                    </div>
                                    <div class="mailbox-read-message">
                                        @if(!empty($order->getTextBody()))
                                            <p class="text-left">{{$order->getTextBody()}}</p>
                                        @else
                                            <p><small>HTML content is shown as plain text to avoid code injection of any
                                                    type</small></p>
                                            <p>
                                                {{$order->getHtmlBody()}}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
