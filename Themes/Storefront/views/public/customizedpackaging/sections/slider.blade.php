<section class="home-section-wrap">
    <div class="container">
        <div class="row">
            <div class="home-section-inner" style="width: 100%;margin-left:0;">
                <div class="home-slider-wrap" style="width: 100%;">
                    <div
                        class="home-slider"
                        data-speed="{{ $slider->speed ?? '1000' }}"
                        data-autoplay="{{ $slider->autoplay ?? 'false' }}"
                        data-autoplay-speed="{{ $slider->autoplay_speed ?? '5000' }}"
                        data-fade="{{ $slider->fade ?? 'false' }}"
                        data-dots="{{ $slider->dots ?? 'true' }}"
                        data-arrows="{{ $slider->arrows ?? 'true' }}"
                    >
                        @foreach ($slider->slides as $slidekey => $slide)
                            <div class="slide">
                                <img src="/storage/media/customizepackage-web-banner{{$slidekey+1}}.jpg" data-animation-in="zoomInImage" class="slider-image animated">

                                <div class="slide-content {{ $slide->isAlignedLeft() ? 'align-left' : 'align-right' }}">
                                    <div class="captions">
                                        <span
                                            class="caption caption-1"
                                            data-animation-in="{{ data_get($slide->options, 'caption_1.effect', 'fadeInRight') }}"
                                            data-delay-in="{{ data_get($slide->options, 'caption_1.delay', '0') }}"
                                        >
                                            {!! $slide->caption_1 !!}
                                        </span>

                                        <span
                                            class="caption caption-2"
                                            data-animation-in="{{ data_get($slide->options, 'caption_2.effect', 'fadeInRight') }}"
                                            data-delay-in="{{ data_get($slide->options, 'caption_2.delay', '0.3') }}"
                                        >
                                            {!! $slide->caption_2 !!}
                                        </span>

                                        @if ($slide->call_to_action_text)
                                            <a
                                                href="{{ $slide->call_to_action_url }}"
                                                class="btn btn-primary btn-slider"
                                                data-animation-in="{{ data_get($slide->options, 'call_to_action.effect', 'fadeInRight') }}"
                                                data-delay-in="{{ data_get($slide->options, 'call_to_action.delay', '0.7') }}"
                                                target="{{ $slide->open_in_new_window ? '_blank' : '_self' }}"
                                            >
                                                {!! $slide->call_to_action_text !!}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- @include('public.home.sections.slider_banners') -->
            </div>
        </div>
    </div>
</section>
