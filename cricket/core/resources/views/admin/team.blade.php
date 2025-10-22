@extends('admin.layouts.app')
@push('style')
    <style>
        /* Sync and Fetch Section Styling */
        .card-container {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .text-muted {
            font-size: 14px;
            color: #6c757d;
            margin: 0;
        }

        .text-primary {
            color: #4F46E5;
            font-weight: 600;
        }

        .form-select {
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
            width: 150px;
        }

        .btn-sync {
            background-color: transparent;
            border: none;
            color: #ff9800;
            font-size: 18px;
            cursor: pointer;
            padding: 4px;
        }

        .btn-primary {
            background-color: #4F46E5;
            color: #ffffff;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary:hover {
            background-color: #4338CA;
        }

        /* Rotation Animation */
        .rotate {
            animation: spin 0.6s linear;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-container mb-3">
                <p class="text-muted">
                    Last Synced: <span id="last-synced" class="text-primary">{{ now()->format('d M Y, H:i:s') }}</span>
                </p>
                <select class="form-select" id="category-select">
                    <option value="">@lang('Select Category')</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                    @endforeach
                </select>
                <select class="form-select" id="status-select">
                    <option value="">@lang('Select Type')</option>
                    <option value="upcoming">Upcoming</option>
                    <option value="live">Live</option>
                </select>
            
                <button id="sync-btn" class="btn-sync">
                    <i class="las la-sync"></i>
                </button>
            </div>
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Short Name')</th>
                                    <th>@lang('Slug')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($teams as $team)
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb">
                                                    <img src="{{ $team->teamImage() }}" alt="@lang('image')">
                                                </div>
                                                <span class="name">{{ __($team->name) }} <br>
                                                    <small class="text-muted fw-bold">{{ __($team->category->name) }}</small>
                                                </span>
                                            </div>
                                        </td>

                                        <td>{{ __($team->short_name) }}</td>
                                        <td>{{ $team->slug }}</td>
                                        <td>
                                            @php
                                                 $team->image_with_path = $team->teamImage();
                                            @endphp
                                            <button class="btn btn-sm btn-outline--primary cuModalBtn editBtn" data-category_id="{{ $team->category_id }}" data-image="{{ $team->image_with_path }}" data-resource="{{ $team }}" data-modal_title="@lang('Edit Team')" data-has_status="1" type="button">
                                                <i class="la la-pencil"></i>@lang('Edit')
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($teams->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($teams) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>@lang('Image')</label>
                                    <x-image-uploader image="{{ getImage(getFilePath('team'), getFileSize('team')) }}" class="w-100" type="team" :required=false />
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>@lang('Category')</label>
                                    <select class="form-control select2" name="category_id" required>
                                        <option value="">@lang('Select One')</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input class="form-control makeSlug" name="name" type="text" value="{{ old('name') }}" required />
                                </div>

                                <div class="form-group">
                                    <label>@lang('Short Name')</label>
                                    <input class="form-control" name="short_name" type="text" value="{{ old('short_name') }}" required />
                                </div>

                                <div class="form-group">
                                    <label>@lang('Slug')</label>
                                    <input class="form-control checkSlug" name="slug" type="text" value="{{ old('slug') }}" required />
                                    <code>@lang('Spaces are not allowed')</code>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Name / Slug / Category" />
    <button class="btn btn-sm btn-outline--primary h-45 cuModalBtn" data-modal_title="@lang('Add New Team')" type="button">
        <i class="las la-plus"></i>@lang('Add New')
    </button>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/cu-modal.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            let modal = $('#cuModal');
            $('.editBtn').on('click', function() {
                modal.find('select[name=category_id]').val($(this).data('category_id')).change();
                modal.find('[name=image]').removeAttr('required');
                modal.find('[name=image]').closest('.form-group').find('label').first().removeClass('required');
                modal.find('.image-upload-preview').attr('style', `background-image: url(${$(this).data('image')})`);
            });

            var placeHolderImage = "{{ getImage(getFilePath('team'), getFileSize('team')) }}";
            $('#cuModal').on('hidden.bs.modal', function() {
                modal.find('select[name=category_id]').val('').change();
                modal.find('.image-upload-preview').attr('style', `background-image: url(${placeHolderImage})`);
                modal.find('[name=image]').attr('required', 'required');
                modal.find('[name=image]').closest('.form-group').find('label').first().addClass('required');
                $('#cuModal form')[0].reset();
            });

        })(jQuery);

        $(document).ready(function () {
                $('#sync-btn').on('click', function () {
                    let categoryId = $('#category-select').val();
                    let status = $('#status-select').val();

                    if (!categoryId) {
                        alert('Please select a category before syncing');
                        return;
                    }

                    if (!status) {
                        alert('Please select status before syncing.');
                        return;
                    }

                    $.ajax({
                        url: "{{ route('admin.team.fetch') }}",
                        type: 'GET',
                        data: {
                            category_id: categoryId,
                            status: status
                        },
                        dataType: 'json',
                        beforeSend: function () {
                            $('#sync-btn')
                                .prop('disabled', true)
                                .html('<i class="las la-spinner la-spin"></i> Fetching...');
                        },
                        success: function (response) {
                            if (response.status === 'success') {
                                // alert(response.message);

                                $('#sync-btn')
                                    .prop('disabled', false)
                                    .html('<i class="las la-sync"></i>');

                                let now = new Date();
                                let formattedTime = now.toLocaleString('en-GB', {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    second: '2-digit',
                                    day: '2-digit',
                                    month: 'short',
                                    year: 'numeric'
                                });

                                $('#last-synced').text(`${formattedTime}`);
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function (xhr) {
                            alert(xhr.responseJSON?.message || 'An error occurred');
                        },
                        complete: function () {
                            $('#sync-btn')
                                .prop('disabled', false)
                                .html('<i class="las la-sync"></i> Sync');
                        }
                    });
                });
            });
    </script>
@endpush
