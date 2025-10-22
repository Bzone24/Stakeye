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
                <div class="d-flex align-items-center gap-2">
                    <select class="form-select" id="category-select">
                        <option value="">@lang('Select One')</option>
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
                    <button class="btn btn-sm btn-outline-primary d-flex align-items-center fetchBtn" id="fetchMarketDataBtn" 
                        data-loading-text="<i class='fas fa-spinner fa-spin'></i> Fetching..." 
                        data-original-text="<i class='fas fa-chart-line me-1'></i> Fetch live Market Data">
                        <i class="fas fa-chart-line me-1"></i> Fetch live Market Data
                    </button>
                </div>
            </div>
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th class="text-center">@lang('Title')</th>
                                    <th>@lang('League') |@lang('Category')</th>
                                    <th>@lang('Game Starts From')</th>
                                    <th>@lang('Bet Starts From')</th>
                                    <th>@lang('Bet Ends At')</th>
                                    <th>@lang('Markets')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($games as $game)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-lg-around justify-content-end gap-1">
                                                <div class="thumb" title="{{ @$game->teamOne->name }}">
                                                    <div class="d-flex align-items-center flex-column">
                                                        <img src="{{ @$game->teamOne->teamImage() }}" alt="@lang('image')">
                                                        {{ __($game->teamOne->short_name) }}
                                                    </div>
                                                </div>
                                                <span> @lang('VS')</span>
                                                <div class="thumb" title="{{ @$game->teamTwo->name }}">
                                                    <div class="d-flex align-items-center flex-column">
                                                        <img src="{{ @$game->teamTwo->teamImage() }}" alt="@lang('image')">
                                                        {{ __(@$game->teamTwo->short_name) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="fw-bold">{{ __(@$game->league->short_name) }}</span>
                                            <br>
                                            {{ __(@$game->league->category->name) }}
                                        </td>

                                        <td>
                                            <em class="fw-bold">{{ showDateTime($game->start_time, 'd M, Y h:i A') }}</em>
                                        </td>

                                        <td>
                                            {{ showDateTime($game->bet_start_time, 'd M, Y h:i A') }}
                                        </td>

                                        <td>
                                            {{ showDateTime($game->bet_end_time, 'd M, Y, h:i A') }}
                                        </td>

                                        <td>{{ $game->questions_count }}</td>

                                        <td> @php echo $game->statusBadge @endphp </td>

                                        <td>
                                            <div class="button--group">
                                                <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.game.edit', $game->id) }}">
                                                    <i class="la la-pencil"></i>@lang('Edit')
                                                </a>

                                                @if ($game->status)
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.game.status', $game->id) }}" data-question="@lang('Are you sure to disable this game')?">
                                                        <i class="la la-eye-slash"></i>@lang('Disable')
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.game.status', $game->id) }}" data-question="@lang('Are you sure to enable this game')?">
                                                        <i class="la la-eye"></i>@lang('Enable')
                                                    </button>
                                                @endif

                                                <a class="btn btn-sm btn-outline--info" href="{{ route('admin.question.index', $game->id) }}">
                                                    <i class="la la-question-circle"></i>@lang('Markets')
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>

                @if ($games->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($games) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <x-confirmation-modal />

    <div class="offcanvas offcanvas-end" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" tabindex="-1">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">@lang('Filter by')</h5>
            <button class="close bg--transparent" data-bs-dismiss="offcanvas" type="button" aria-label="Close">
                <i class="las la-times"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <form action="">
                <div class="form-group">
                    <label>@lang('Team One')</label>
                    <select class="form-control select2-basic" name="team_one_id">
                        <option value="">@lang('All')</option>
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}" @selected(request()->team_one_id == $team->id)>{{ $team->name }} - {{ @$team->short_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>@lang('Team Two')</label>
                    <select class="form-control select2-basic" name="team_two_id">
                        <option value="">@lang('All')</option>
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}" @selected(request()->team_two_id == $team->id)>{{ $team->name }} - {{ @$team->short_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>@lang('Leauge')</label>
                    <select class="form-control select2-basic" name="league_id">
                        <option value="">@lang('All')</option>
                        @foreach ($leagues as $league)
                            <option value="{{ $league->id }}" @selected(request()->league_id == $league->id)>{{ __($league->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>@lang('Game Started From')</label>
                    <input name="start_time" type="search" class="datepicker-here form-control bg--white pe-2 date-range" placeholder="@lang('Start Date - End Date')" autocomplete="off" value="{{ request()->start_time }}">
                </div>
                <div class="form-group">
                    <label>@lang('Bet Started From')</label>
                    <input name="bet_start_time" type="search" class="datepicker-here form-control bg--white pe-2 date-range" placeholder="@lang('Start Date - End Date')" autocomplete="off" value="{{ request()->bet_start_time }}">
                </div>
                <div class="form-group">
                    <label>@lang('Bet Ended At')</label>
                    <input name="bet_end_time" type="search" class="datepicker-here form-control bg--white pe-2 date-range" placeholder="@lang('Start Date - End Date')" autocomplete="off" value="{{ request()->bet_end_time }}">
                </div>
                <div class="form-group">
                    <button class="btn btn--primary w-100 h-45"> @lang('Filter')</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .thumb img {
            width: 30px;
            height: 30px;
        }
    </style>
@endpush

@push('breadcrumb-plugins')
    <button class="btn btn-sm btn-outline--info " data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" type="button" aria-controls="offcanvasRight"><i class="las la-filter"></i> @lang('Filter')</button>
    <a class="btn btn-sm btn-outline--primary " href="{{ route('admin.game.create') }}"><i class="las la-plus"></i>@lang('Add New')</a>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/daterangepicker.min.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/global/css/daterangepicker.css') }}">
@endpush
@push('script')
    <script>
        (function($) {
            "use strict"

            const datePicker = $('.date-range').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                },
                showDropdowns: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 15 Days': [moment().subtract(14, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(30, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'Last 6 Months': [moment().subtract(6, 'months').startOf('month'), moment().endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                },
                maxDate: moment()
            });
            const changeDatePickerText = (event, startDate, endDate) => {
                $(event.target).val(startDate.format('MMMM DD, YYYY') + ' - ' + endDate.format('MMMM DD, YYYY'));
            }


            $('.date-range').on('apply.daterangepicker', (event, picker) => changeDatePickerText(event, picker.startDate, picker.endDate));


            if ($('.date-range').val()) {
                let dateRange = $('.date-range').val().split(' - ');
                $('.date-range').data('daterangepicker').setStartDate(new Date(dateRange[0]));
                $('.date-range').data('daterangepicker').setEndDate(new Date(dateRange[1]));
            }

        })(jQuery)

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
                        url: "{{ route('admin.game.fetch') }}",
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
            $(document).ready(function () {
                $('#fetchMarketDataBtn').on('click', function () {
                    let $btn = $(this);
                    let categoryId = $('#category-select').val();
                    let status = $('#status-select').val();


                    if (!categoryId) {
                        alert('Please select a category before fetching');
                        return;
                    }

                    if (!status) {
                        alert('Please select status before syncing.');
                        return;
                    }
                    
                    $.ajax({
                        url: "{{ route('admin.game.market') }}",
                        type: 'GET',
                        data: { sport_id: categoryId },
                        dataType: 'json',
                        beforeSend: function () {
                            // ✅ Change button text to "Fetching..." and disable button
                            $btn.prop('disabled', true).html($btn.data('loading-text'));
                        },
                        success: function (response) {
                            if (response.status === 'success') {

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
                            // ✅ Restore button state
                            $btn.prop('disabled', false).html($btn.data('original-text'));
                        }
                    });
                });
            });
    </script>
@endpush
