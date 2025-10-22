@extends($activeTemplate . 'layouts.bet')
@section('bet')
    @php
        $optionsId = collect(session()->get('bets'))
            ->pluck('option_id')
            ->toArray();
    @endphp
    <div class="odd-list pt-0">
        <div class="row gx-0 pd-lg-15 gx-lg-3 gy-3">
            <div class="col-12">
                <div class="odd-list__head">
                    <div class="odd-list__team">
                        <div class="odd-list__team-name">{{ __($game->teamOne->name) }}</div>
                        <div class="odd-list__team-img">
                            <img class="odd-list__team-img-is" src="{{ $game->teamOne->teamImage() }}" alt="image" />
                        </div>
                    </div>

                    <div class="odd-list__team-divide">@lang('VS')</div>

                    <div class="odd-list__team justify-content-end">
                        <div class="odd-list__team-img">
                            <img class="odd-list__team-img-is" src="{{ $game->teamTwo->teamImage() }}" alt="image" />
                        </div>
                        <div class="odd-list__team-name">{{ __($game->teamTwo->name) }}</div>
                    </div>
                </div>

                <div class="odd-list__body">
                    <div class="odd-list__body-content">
                        <div class="odd-list__title">@lang('Markets')</div>
                        
                        @php
                            $groupedQuestions = $game->questions->groupBy('market_type');
                        @endphp
                
                        @forelse ($groupedQuestions as $marketType => $questions)
                            <div class="market-group">
                                <div class="market-group-header">
                                    <button class="btn btn-dark w-100 text-start market-group-btn" type="button" data-bs-toggle="collapse" data-bs-target="#market-{{ Str::slug($marketType) }}" aria-expanded="true">
                                        {{ __(str_replace('_', ' ', $marketType)) }} ({{ $questions->count() }})
                                        <i class="fa fa-chevron-down float-end"></i>
                                    </button>
                                </div>
                                <div id="market-{{ Str::slug($marketType) }}" class="collapse show">
                                    @foreach ($questions as $question)
                                        <div class="accordion accordion--odd">
                                            <div class="accordion-item @if ($question->locked) locked @endif">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#question-{{ $question->id }}" aria-expanded="true">
                                                        {{ __($question->title) }}
                                                    </button>
                                                </h2>
                                                <div id="question-{{ $question->id }}" class="accordion-collapse collapse show">
                                                    <div class="accordion-body">
                                                        <ul class="list list--row odd-list__options">
                                                            @forelse ($question->options as $option)
                                                                <li>
                                                                    <button
                                                                        class="odd-list__option oddBtn @if (in_array($option->id, $optionsId)) active @endif @if ($option->locked) locked @endif"
                                                                        data-option_id="{{ $option->id }}">
                                                                        <span class="odd-list__option-text">{{ __($option->name) }}</span>
                                                                        <span class="odd-list__option-ratio">{{ rateData($option->odds) }}</span>
                                                                    </button>
                                                                </li>
                                                            @empty
                                                                <small class="text-muted">@lang('No odds available for now')</small>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="empty-message mt-3">
                                <img class="img-fluid" src="{{ asset($activeTemplateTrue . '/images/empty_message.png') }}"
                                    alt="@lang('image')">
                                <p>@lang('No markets available for now')</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.market-group-btn').forEach(button => {
            const icon = button.querySelector('i');
            const targetId = button.getAttribute('data-bs-target');
            const target = document.querySelector(targetId);

            if (target.classList.contains('show')) {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }

            target.addEventListener('shown.bs.collapse', () => {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            });

            target.addEventListener('hidden.bs.collapse', () => {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            });
        });
    });
</script>


@endpush