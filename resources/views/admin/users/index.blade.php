@extends('admin.layouts.app')

@section('header', __('messages.customers'))

@section('content')
<div class="kt-section__content">
    <!-- Header with Add Button -->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __('messages.customers') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{ route('admin.users.create', $lang) }}" class="btn btn-primary">
                    <i class="la la-plus"></i> {{ __('messages.add_customer') ?? 'Add Customer' }}
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            @if($users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.name') }}</th>
                                <th>{{ __('messages.email') }}</th>
                                <th>{{ __('messages.balance') }}</th>
                                <th>{{ __('messages.purchases') }}</th>
                                <th>{{ __('messages.total_spent') }}</th>
                                <th>{{ __('messages.last_purchase') }}</th>
                                <th>{{ __('messages.registered_at') }}</th>
                                <th>{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <strong>{{ $user->name }}</strong>
                                        @if($user->email_verified_at)
                                            <br><small class="text-success"><i class="la la-check-circle"></i> Verified</small>
                                        @else
                                            <br><small class="text-warning"><i class="la la-exclamation-triangle"></i> Unverified</small>
                                        @endif
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge badge-success">${{ number_format($user->balance, 2) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $user->purchases->count() }}</span>
                                    </td>
                                    <td>
                                        @if($user->purchases->count() > 0)
                                            <span class="badge badge-warning">${{ number_format($user->purchases->sum(function($purchase) { return $purchase->book->price; }), 2) }}</span>
                                        @else
                                            <span class="badge badge-secondary">$0.00</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->purchases->count() > 0)
                                            {{ $user->purchases->first()->created_at->format('M d, Y') }}
                                        @else
                                            <span class="text-muted">{{ __('messages.no_purchases') ?? 'No purchases' }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.users.show', [$lang, $user]) }}" class="btn btn-sm btn-info">
                                                <i class="la la-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.users.edit', [$lang, $user]) }}" class="btn btn-sm btn-warning">
                                                <i class="la la-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', [$lang, $user]) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="la la-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Custom Pagination -->
                <x-custom-pagination :paginator="$users" />
            @else
                <div class="text-center py-5">
                    <i class="la la-users la-5x text-gray-400 mb-3"></i>
                    <h4>{{ __('messages.no_customers_found') ?? 'No Customers Found' }}</h4>
                    <p class="text-gray-600">{{ __('messages.no_customers_available') ?? 'No customers have registered yet.' }}</p>
                    <a href="{{ route('admin.users.create', $lang) }}" class="btn btn-primary">
                        <i class="la la-plus"></i> {{ __('messages.add_first_customer') ?? 'Add First Customer' }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
