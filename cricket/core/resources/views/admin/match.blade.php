@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('Match')</th>
                                    <th>@lang('Tournament')</th>
                                    <th>@lang('Start Time')</th>
                                    <th>@lang('Market Count')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($matches as $match)
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb">
                                                    {{-- <img src="{{ $match->teamImage() }}" alt="@lang('image')"> --}}
                                                </div>
                                                <span class="name">{{ __($match->name) }} <br>
                                                    {{-- <small class="text-muted fw-bold">{{ __($match->tournament->name) }}</small> --}}
                                                </span>
                                            </div>
                                        </td>

                                        <td>{{ __($match->tournament->name) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($match->openDate)->format('d M Y, h:i A') }}</td>
                                        <td>{{ $match->marketCount }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline--primary cuModalBtn editBtn" data-competition_id="{{ $match->tournament->competition_id }}" data-resource="{{ $match }}"  data-modal_title="@lang('Edit match')" data-has_status="1" type="button">
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

                @if ($matches->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($matches) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-md" role="document">
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
                            <!-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label>@lang('Image')</label>
                                    <x-image-uploader image="{{ getImage(getFilePath('team'), getFileSize('team')) }}" class="w-100" type="team" :required=false />
                                </div>
                            </div> -->
                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label>@lang('Tournament')</label>
                                    <select class="form-control select2" name="competition_id" required>
                                        <option value="">@lang('Select One')</option>
                                        @foreach ($tournaments as $tournament)
                                            <option value="{{ $tournament->competition_id }}">{{ __($tournament->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('Match')</label>
                                    <input class="form-control" name="name" type="text" value="{{ old('name') }}" required />
                                </div>

                                <div class="form-group">
                                    <label>@lang('Start Time')</label>
                                    <input class="form-control" name="openDate" type="datetime-local" value="{{ old('openDate') }}" required />
                                </div>

                                <div class="form-group">
                                    <label>@lang('Market Count')</label>
                                    <input class="form-control" name="marketCount" type="number" value="{{ old('marketCount') }}" required />
                                    <code>@lang('Please enter a valid number')</code>
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
                modal.find('select[name=competition_id]').val($(this).data('competition_id')).change();
                modal.find('[name=image]').removeAttr('required');
                modal.find('[name=image]').closest('.form-group').find('label').first().removeClass('required');
                modal.find('.image-upload-preview').attr('style', `background-image: url(${$(this).data('image')})`);
            });

            var placeHolderImage = "{{ getImage(getFilePath('team'), getFileSize('team')) }}";
            $('#cuModal').on('hidden.bs.modal', function() {
                modal.find('select[name=competition_id]').val('').change();
                modal.find('.image-upload-preview').attr('style', `background-image: url(${placeHolderImage})`);
                modal.find('[name=image]').attr('required', 'required');
                modal.find('[name=image]').closest('.form-group').find('label').first().addClass('required');
                $('#cuModal form')[0].reset();
            });

        })(jQuery);
    </script>
@endpush
