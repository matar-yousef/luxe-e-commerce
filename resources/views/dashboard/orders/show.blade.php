@extends('dashboard.layouts.master')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Customer and Order Information</h3>
                        <div class="card-tools">
                            <span class="badge badge-info" style="font-size: 1rem;">Order Status: {{ $order->status }}</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row invoice-info mb-4">
                            <div class="col-sm-4 invoice-col">
                                <strong><i class="fas fa-user mr-1"></i> Customer:</strong>
                                <address class="text-muted mt-2">
                                    {{ $order->user->name }}<br>
                                    Phone: {{ $order->phone }}<br>
                                    Address: {{ $order->address }}
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <strong><i class="fas fa-calendar-alt mr-1"></i> Order Date:</strong>
                                <p class="text-muted mt-2">{{ $order->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                            <div class="col-sm-4 invoice-col text-right">
                                <strong><i class="fas fa-money-bill-wave mr-1"></i> Total Amount:</strong>
                                <h3 class="text-primary mt-2">${{ number_format($order->total_price, 2) }}</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Product</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('images/100_100/' . $item->product->images->first()->url) }}" width="40" class="img-thumbnail mr-2"> {{ $item->product->name }}
                                            </td>
                                            <td class="text-center">${{ number_format($item->price, 2) }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-right font-weight-bold">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('dashboard.orders.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Back to Orders
                        </a>
                        <button class="btn btn-success float-right" onclick="window.print()">
                            <i class="fas fa-print"></i> Print Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection