@extends($activeTemplate.'layouts.frontend')

@section('content')
<section class="blog-section padding-top padding-bottom ">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-8 col-md-12">
                <div class="announcement__details">
                    <div class="announcement__details__thumb"><img alt="blog" src="{{ getImage('assets/images/frontend/blog/'.$blog->data_values->announcement_image,'774x516') }}"></div>
                    <h3 class="blog-title">{{ __($blog->data_values->title) }}</h3>
                        <ul class="announcement__meta d-flex flex-wrap mt-2 mb-3 align-items-center">
                            <li><a href="#"><i class="far fa-calendar"></i>{{ $blog->created_at }}</a></li>
                        </ul>
                    <div class="announcement__details__content">
                        <p>@php echo $blog->data_values->description @endphp</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">
                <div class="widget-box post-widget">
                    <h4 class="pro-title">@lang('Latest Announcements')</h4>
                    <ul class="latest-posts m-0">
                        @foreach ($blogs as $data)
                        <li>
                            <div class="post-thumb">
                                <a href="{{ route('announcement.detail',$data->id) }}">
                                    <img class="img-fluid" src="{{ getImage('assets/images/frontend/blog/'.$data->data_values->announcement_image,'774x516') }}" alt="@lang('image')">
                                </a>
                            </div>
                            <div class="post-info">
                                <h6><a href="{{ route('announcement.detail',$data->id) }}">{{ shortDescription($data->data_values->title) }}</a></h6>
                                <a href="{{ route('announcement.detail',$data->id) }}" class="posts-date"><i class="far fa-calendar-alt"></i> {{ showDateTime($data->created_at) }}</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection