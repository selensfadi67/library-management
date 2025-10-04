@extends('admin.layouts.app')

@section('header', __('messages.customer_details'))

@section('content')
<div class="kt-section__content">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __('messages.customer_details') ?? 'Customer Details' }}: {{ $user->name }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{ route('admin.users.index', $lang) }}" class="btn btn-secondary">
                    <i class="la la-arrow-left"></i> {{ __('messages.back') ?? 'Back' }}
                </a>
                <a href="{{ route('admin.users.edit', [$lang, $user]) }}" class="btn btn-primary">
                    <i class="la la-edit"></i> {{ __('messages.edit') }}
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-6">
                    <div class="kt-portlet kt-portlet--bordered">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">{{ __('messages.customer_info') ?? 'Customer Information' }}</h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>{{ __('messages.name') }}:</strong></td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('messages.email') }}:</strong></td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('messages.balance') }}:</strong></td>
                                    <td><span class="badge badge-success">${{ number_format($user->balance, 2) }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('messages.status') }}:</strong></td>
                                    <td>
                                        @if($user->email_verified_at)
                                            <span class="badge badge-success">{{ __('messages.verified') ?? 'Verified' }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ __('messages.unverified') ?? 'Unverified' }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('messages.registered_at') }}:</strong></td>
                                    <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="kt-portlet kt-portlet--bordered">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">{{ __('messages.purchase_summary') ?? 'Purchase Summary' }}</h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>{{ __('messages.total_purchases') }}:</strong></td>
                                    <td><span class="badge badge-info">{{ $user->purchases->count() }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('messages.total_spent') }}:</strong></td>
                                    <td><span class="badge badge-warning">${{ number_format($user->purchases->sum(function($purchase) { return $purchase->book->price; }), 2) }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('messages.last_purchase') }}:</strong></td>
                                    <td>
                                        @if($user->purchases->count() > 0)
                                            {{ $user->purchases->latest()->first()->created_at->format('M d, Y') }}
                                        @else
                                            <span class="text-muted">{{ __('messages.no_purchases') ?? 'No purchases' }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @if($user->purchases->count() > 0)
                <div class="kt-portlet kt-portlet--bordered mt-4">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">{{ __('messages.purchase_history') ?? 'Purchase History' }}</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('messages.book') }}</th>
                                        <th>{{ __('messages.author') }}</th>
                                        <th>{{ __('messages.price') }}</th>
                                        <th>{{ __('messages.purchase_date') }}</th>
                                        <th>{{ __('messages.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->purchases as $purchase)
                                        <tr>
                                            <td>{{ $purchase->id }}</td>
                                            <td>
                                                <strong>{{ $purchase->book->title }}</strong>
                                                <br><small class="text-muted">{{ $purchase->book->category->name }}</small>
                                            </td>
                                            <td>{{ $purchase->book->author }}</td>
                                            <td>
                                                <span class="badge badge-success">${{ number_format($purchase->book->price, 2) }}</span>
                                            </td>
                                            <td>{{ $purchase->created_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.books.show', [app()->getLocale(), $purchase->book]) }}" class="btn btn-sm btn-info">
                                                    <i class="la la-book"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
