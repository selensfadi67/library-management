@extends('admin.layouts.app')

@section('header', __('messages.purchases'))

@section('content')
<div class="kt-section__content">
    <!-- Header -->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __('messages.purchases') }}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            @if($purchases->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.customer') }}</th>
                                <th>{{ __('messages.email') }}</th>
                                <th>{{ __('messages.book') }}</th>
                                <th>{{ __('messages.category') }}</th>
                                <th>{{ __('messages.price') }}</th>
                                <th>{{ __('messages.purchase_date') }}</th>
                                <th>{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->id }}</td>
                                    <td>
                                        <strong>{{ $purchase->user->name }}</strong>
                                        @if($purchase->user->email_verified_at)
                                            <br><small class="text-success"><i class="la la-check-circle"></i> Verified</small>
                                        @else
                                            <br><small class="text-warning"><i class="la la-exclamation-triangle"></i> Unverified</small>
                                        @endif
                                    </td>
                                    <td>{{ $purchase->user->email }}</td>
                                    <td>
                                        <strong>{{ $purchase->book->title }}</strong>
                                        <br><small class="text-muted"> {{ $purchase->book->author }}</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $purchase->book->category->name }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success">${{ number_format($purchase->book->price, 2) }}</span>
                                    </td>
                                    <td>{{ $purchase->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.books.show', [app()->getLocale(), $purchase->book]) }}" class="btn btn-sm btn-info" title="{{ __('messages.view_book') ?? 'View Book' }}">
                                                <i class="la la-book"></i>
                                            </a>
                                            <button class="btn btn-sm btn-warning" title="{{ __('messages.view_customer') ?? 'View Customer' }}">
                                                <i class="la la-user"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Custom Pagination -->
                <x-custom-pagination :paginator="$purchases" />
            @else
                <div class="text-center py-5">
                    <i class="la la-shopping-cart la-5x text-gray-400 mb-3"></i>
                    <h4>{{ __('messages.no_purchases_found') ?? 'No Purchases Found' }}</h4>
                    <p class="text-gray-600">{{ __('messages.no_purchases_available') ?? 'No purchases have been made yet.' }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
