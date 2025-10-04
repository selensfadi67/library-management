@extends('admin.layouts.app')

@section('header', __('messages.book_details'))

@section('content')
<div class="kt-section__content">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __('messages.book_details') ?? 'Book Details' }}: {{ $book->title }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{ route('admin.books.index', $lang) }}" class="btn btn-secondary">
                    <i class="la la-arrow-left"></i> {{ __('messages.back') ?? 'Back' }}
                </a>
                <a href="{{ route('admin.books.edit', [$lang, $book]) }}" class="btn btn-warning">
                    <i class="la la-edit"></i> {{ __('messages.edit') ?? 'Edit' }}
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" class="img-fluid" alt="{{ $book->title }}">
                            @else
                                <i class="la la-book la-5x text-muted mb-3"></i>
                                <p class="text-muted">{{ __('messages.no_image') ?? 'No image available' }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold">{{ __('messages.title') }}</label>
                                <p class="form-control-plaintext">{{ $book->title }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold">{{ __('messages.author') }}</label>
                                <p class="form-control-plaintext">{{ $book->author }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold">{{ __('messages.price') }}</label>
                                <p class="form-control-plaintext">
                                    <span class="badge badge-success badge-lg">${{ number_format($book->price, 2) }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold">{{ __('messages.category') }}</label>
                                <p class="form-control-plaintext">
                                    <span class="badge badge-info">{{ $book->category->name }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label font-weight-bold">{{ __('messages.description') }}</label>
                        <div class="form-control-plaintext bg-light p-3 rounded">
                            {{ $book->description }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold">{{ __('messages.created_at') }}</label>
                                <p class="form-control-plaintext">{{ $book->created_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold">{{ __('messages.updated_at') }}</label>
                                <p class="form-control-plaintext">{{ $book->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($book->purchases->count() > 0)
                <hr>
                <h4 class="mb-3">{{ __('messages.purchase_history') ?? 'Purchase History' }}</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('messages.customer') }}</th>
                                <th>{{ __('messages.email') }}</th>
                                <th>{{ __('messages.purchase_date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($book->purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->user->name }}</td>
                                    <td>{{ $purchase->user->email }}</td>
                                    <td>{{ $purchase->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <hr>
                <div class="text-center py-4">
                    <i class="la la-shopping-cart la-3x text-muted mb-3"></i>
                    <h5 class="text-muted">{{ __('messages.no_purchases') ?? 'No purchases yet' }}</h5>
                    <p class="text-muted">{{ __('messages.no_purchases_desc') ?? 'This book has not been purchased by any customers yet.' }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection