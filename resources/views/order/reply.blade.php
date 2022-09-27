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
                            <li class="breadcrumb-item"><a href="{{route("order.index")}}">Orders</a></li>
                            <li class="breadcrumb-item active">Reply</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    <h5>{{$order->getSubject()}}</h5>
                                    <h6>To: {{$order->getSenderName() . " - " . $order->getSenderEmail()}}</h6>
                                </div>
                                <form action="{{route("order.reply.send",$order->getId())}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <textarea id="compose-textarea" name="body" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-success" type="submit">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
