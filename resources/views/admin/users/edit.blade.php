@extends('admin.layouts.app')

@section('header', __('messages.edit_customer'))

@section('content')
<div class="kt-section__content">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __('messages.edit_customer') ?? 'Edit Customer' }}: {{ $user->name }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{ route('admin.users.index', $lang) }}" class="btn btn-secondary">
                    <i class="la la-arrow-left"></i> {{ __('messages.back') ?? 'Back' }}
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form action="{{ route('admin.users.update', [$lang, $user]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name" class="form-label">{{ __('messages.name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('messages.email') }} <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">{{ __('messages.password') }} ({{ __('messages.leave_blank') ?? 'Leave blank to keep current' }})</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">{{ __('messages.confirm_password') }}</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                   id="password_confirmation" name="password_confirmation">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="balance" class="form-label">{{ __('messages.balance') }} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" step="0.01" min="0" class="form-control @error('balance') is-invalid @enderror" 
                                       id="balance" name="balance" value="{{ old('balance', $user->balance) }}" required>
                            </div>
                            @error('balance')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-save"></i> {{ __('messages.update_customer') ?? 'Update Customer' }}
                    </button>
                    <a href="{{ route('admin.users.index', $lang) }}" class="btn btn-secondary">
                        {{ __('messages.cancel') ?? 'Cancel' }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
