@extends('admin.layouts.app')

@section('header', __('messages.books'))

@section('content')
    <div class="kt-section__content">
        <!-- Header with Add Button -->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        {{ __('messages.books') }}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <a href="{{ route('admin.books.create', $lang) }}" class="btn btn-primary">
                        <i class="la la-plus"></i> {{ __('messages.add_book') ?? 'Add Book' }}
                    </a>
                </div>
            </div>
            <div class="kt-portlet__body">
                @if ($books->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.image') }}</th>
                                    <th>{{ __('messages.title') }}</th>
                                    <th>{{ __('messages.author') }}</th>
                                    <th>{{ __('messages.category') }}</th>
                                    <th>{{ __('messages.price') }}</th>
                                    <th>{{ __('messages.created_at') }}</th>
                                    <th>{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td>{{ $book->id }}</td>
                                        <td>
                                            @if ($book->image)
                                                <img src="{{ asset('storage/' . $book->image) }}"
                                                    alt="{{ $book->title }}" class="img-thumbnail"
                                                    style="width: 50px; height: 65px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center"
                                                    style="width: 50px; height: 65px;">
                                                    <i class="la la-book la-2x text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $book->title }}</strong>
                                            @if ($book->description)
                                                <br><small
                                                    class="text-muted">{{ Str::limit($book->description, 50) }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $book->author }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $book->category->name }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">${{ number_format($book->price, 2) }}</span>
                                        </td>
                                        <td>{{ $book->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.books.show', [$lang, $book]) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="la la-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.books.edit', [$lang, $book]) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="la la-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.books.destroy', [$lang, $book]) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
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
                    {{ $books->links() }}
                @else
                    <div class="text-center py-5">
                        <i class="la la-book la-5x text-gray-400 mb-3"></i>
                        <h4>{{ __('messages.no_books_found') ?? 'No Books Found' }}</h4>
                        <p class="text-gray-600">
                            {{ __('messages.no_books_available') ?? 'No books are available. Add your first book!' }}</p>
                        <a href="{{ route('admin.books.create', $lang) }}" class="btn btn-primary">
                            <i class="la la-plus"></i> {{ __('messages.add_first_book') ?? 'Add First Book' }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
