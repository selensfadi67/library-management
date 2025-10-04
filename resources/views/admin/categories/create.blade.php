@extends('admin.layouts.app')

@section('header', __('messages.add_category'))

@section('content')
<div class="kt-section__content">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __('messages.add_category') ?? 'Add New Category' }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{ route('admin.categories.index', $lang) }}" class="btn btn-secondary">
                    <i class="la la-arrow-left"></i> {{ __('messages.back') ?? 'Back' }}
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form action="{{ route('admin.categories.store', $lang) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name" class="form-label">{{ __('messages.name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" 
                                   placeholder="{{ __('messages.category_name_placeholder') ?? 'Enter category name' }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="alert alert-info">
                                <i class="la la-info-circle"></i>
                                {{ __('messages.category_info') ?? 'Categories help organize books into different sections for better browsing experience.' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">{{ __('messages.category_preview') ?? 'Category Preview' }}</h5>
                            </div>
                            <div class="card-body text-center">
                                <i class="la la-folder la-5x text-primary mb-3"></i>
                                <h4 id="preview-name" class="text-muted">{{ __('messages.category_name') ?? 'Category Name' }}</h4>
                                <p class="text-muted">{{ __('messages.preview_text') ?? 'This is how your category will appear' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-save"></i> {{ __('messages.save') ?? 'Save Category' }}
                    </button>
                    <a href="{{ route('admin.categories.index', $lang) }}" class="btn btn-secondary">
                        <i class="la la-times"></i> {{ __('messages.cancel') ?? 'Cancel' }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('name').addEventListener('input', function(e) {
    const previewName = document.getElementById('preview-name');
    if (e.target.value.trim()) {
        previewName.textContent = e.target.value;
        previewName.classList.remove('text-muted');
        previewName.classList.add('text-primary');
    } else {
        previewName.textContent = '{{ __('messages.category_name') ?? 'Category Name' }}';
        previewName.classList.remove('text-primary');
        previewName.classList.add('text-muted');
    }
});
</script>
@endsection
