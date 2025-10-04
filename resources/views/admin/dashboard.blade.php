@extends('admin.layouts.app')

@section('header', __('messages.admin_dashboard'))

@section('content')
<div class="kt-section__content">
    <!-- Welcome Message -->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __('messages.welcome_admin') }}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <p class="kt-font-lg">{{ __('messages.dashboard_overview') }}</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">{{ __('messages.total_users') }}</h4>
                            <span class="kt-widget24__desc">All registered users</span>
                        </div>
                        <span class="kt-widget24__stats kt-font-brand">{{ $stats['users_count'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">{{ __('messages.total_books') }}</h4>
                            <span class="kt-widget24__desc">Available books</span>
                        </div>
                        <span class="kt-widget24__stats kt-font-success">{{ $stats['books_count'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">{{ __('messages.total_categories') }}</h4>
                            <span class="kt-widget24__desc">Book categories</span>
                        </div>
                        <span class="kt-widget24__stats kt-font-warning">{{ $stats['categories_count'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">{{ __('messages.total_purchases') }}</h4>
                            <span class="kt-widget24__desc">Total sales</span>
                        </div>
                        <span class="kt-widget24__stats kt-font-danger">{{ $stats['purchases_count'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-lg-4">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">{{ __('messages.manage_users') }}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <p>View and manage all users</p>
                    <a href="{{ route('admin.users.index', app()->getLocale()) }}" class="btn btn-primary">
                        {{ __('messages.manage_users') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">{{ __('messages.books') }}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <p>Manage book inventory</p>
                    <a href="{{ route('admin.books.index', app()->getLocale()) }}" class="btn btn-success">
                        {{ __('messages.manage_books') ?? 'Manage Books' }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">{{ __('messages.categories') }}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <p>Organize book categories</p>
                    <a href="{{ route('admin.categories.index', app()->getLocale()) }}" class="btn btn-warning">
                        {{ __('messages.manage_categories') ?? 'Manage Categories' }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Table -->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">{{ __('messages.recent_activities') }}</h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('messages.name') }}</th>
                            <th>{{ __('messages.email') }}</th>
                            <th>{{ __('messages.status') }}</th>
                            <th>{{ __('messages.created_at') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td><span class="kt-badge kt-badge--success">{{ __('messages.active') }}</span></td>
                            <td>2024-01-15</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary">{{ __('messages.edit') }}</a>
                                <a href="#" class="btn btn-sm btn-danger">{{ __('messages.delete') }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jane Smith</td>
                            <td>jane@example.com</td>
                            <td><span class="kt-badge kt-badge--warning">{{ __('messages.pending') }}</span></td>
                            <td>2024-01-14</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary">{{ __('messages.edit') }}</a>
                                <a href="#" class="btn btn-sm btn-danger">{{ __('messages.delete') }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Bob Johnson</td>
                            <td>bob@example.com</td>
                            <td><span class="kt-badge kt-badge--success">{{ __('messages.active') }}</span></td>
                            <td>2024-01-13</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary">{{ __('messages.edit') }}</a>
                                <a href="#" class="btn btn-sm btn-danger">{{ __('messages.delete') }}</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
