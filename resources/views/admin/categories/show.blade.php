@extends('admin.layouts.app')

@section('header', __('messages.category_details'))

@section('content')
<div class="kt-section__content">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __('messages.category_details') ?? 'Category Details' }}: {{ $category->name }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{ route('admin.categories.index', $lang) }}" class="btn btn-secondary">
                    <i class="la la-arrow-left"></i> {{ __('messages.back') ?? 'Back' }}
                </a>
                <a href="{{ route('admin.categories.edit', [$lang, $category]) }}" class="btn btn-warning">
                    <i class="la la-edit"></i> {{ __('messages.edit') ?? 'Edit' }}
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="la la-folder la-5x text-primary mb-3"></i>
                            <h4 class="text-primary">{{ $category->name }}</h4>
                            <p class="text-muted">{{ __('messages.category') ?? 'Category' }}</p>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="card-title">{{ __('messages.statistics') ?? 'Statistics' }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <h4 class="text-primary">{{ $category->books->count() }}</h4>
                                    <small class="text-muted">{{ __('messages.books') ?? 'Books' }}</small>
                                </div>
                                <div class="col-6">
                                    <h4 class="text-success">${{ number_format($category->books->sum('price'), 2) }}</h4>
                                    <small class="text-muted">{{ __('messages.total_value') ?? 'Total Value' }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold">{{ __('messages.name') }}</label>
                                <p class="form-control-plaintext">{{ $category->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold">{{ __('messages.created_at') }}</label>
                                <p class="form-control-plaintext">{{ $category->created_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold">{{ __('messages.updated_at') }}</label>
                                <p class="form-control-plaintext">{{ $category->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold">{{ __('messages.status') }}</label>
                                <p class="form-control-plaintext">
                                    @if($category->books->count() > 0)
                                        <span class="badge badge-success">{{ __('messages.active') ?? 'Active' }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ __('messages.empty') ?? 'Empty' }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($category->books->count() > 0)
                <hr>
                <h4 class="mb-3">{{ __('messages.books_in_category') ?? 'Books in this Category' }}</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('messages.image') }}</th>
                                <th>{{ __('messages.title') }}</th>
                                <th>{{ __('messages.author') }}</th>
                                <th>{{ __('messages.price') }}</th>
                                <th>{{ __('messages.created_at') }}</th>
                                <th>{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category->books as $book)
                                <tr>
                                    <td>
                                        @if($book->image)
                                            <img src="{{ asset('storage/' . $book->image) }}" class="img-thumbnail" style="width: 40px; height: 50px; object-fit: cover;" alt="{{ $book->title }}">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" style="width: 40px; height: 50px;">
                                                <i class="la la-book text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $book->title }}</strong>
                                        @if($book->description)
                                            <br><small class="text-muted">{{ Str::limit($book->description, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $book->author }}</td>
                                    <td>
                                        <span class="badge badge-success">${{ number_format($book->price, 2) }}</span>
                                    </td>
                                    <td>{{ $book->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.books.show', [$lang, $book]) }}" class="btn btn-sm btn-info">
                                                <i class="la la-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.books.edit', [$lang, $book]) }}" class="btn btn-sm btn-warning">
                                                <i class="la la-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <hr>
                <div class="text-center py-4">
                    <i class="la la-book la-3x text-muted mb-3"></i>
                    <h5 class="text-muted">{{ __('messages.no_books_in_category') ?? 'No books in this category' }}</h5>
                    <p class="text-muted">{{ __('messages.no_books_category_desc') ?? 'This category does not contain any books yet.' }}</p>
                    <a href="{{ route('admin.books.create', $lang) }}" class="btn btn-primary">
                        <i class="la la-plus"></i> {{ __('messages.add_book') ?? 'Add Book' }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
