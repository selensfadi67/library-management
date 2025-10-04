@extends('admin.layouts.app')

@section('header', __('messages.categories'))

@section('content')
<div class="kt-section__content">
    <!-- Header with Add Button -->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __('messages.categories') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{ route('admin.categories.create', $lang) }}" class="btn btn-primary">
                    <i class="la la-plus"></i> {{ __('messages.add_category') ?? 'Add Category' }}
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            @if($categories->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.name') }}</th>
                                <th>{{ __('messages.books_count') ?? 'Books Count' }}</th>
                                <th>{{ __('messages.created_at') }}</th>
                                <th>{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $category->books_count }}</span>
                                    </td>
                                    <td>{{ $category->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.categories.show', [$lang, $category]) }}" class="btn btn-sm btn-info">
                                                <i class="la la-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.categories.edit', [$lang, $category]) }}" class="btn btn-sm btn-warning">
                                                <i class="la la-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.categories.destroy', [$lang, $category]) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
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
                {{$categories->links()}}
            @else
                <div class="text-center py-5">
                    <i class="la la-folder la-5x text-gray-400 mb-3"></i>
                    <h4>{{ __('messages.no_categories_found') ?? 'No Categories Found' }}</h4>
                    <p class="text-gray-600">{{ __('messages.no_categories_available') ?? 'No categories are available. Add your first category!' }}</p>
                    <a href="{{ route('admin.categories.create', $lang) }}" class="btn btn-primary">
                        <i class="la la-plus"></i> {{ __('messages.add_first_category') ?? 'Add First Category' }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
