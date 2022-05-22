@php
    $blogs = getContent('blog.element',false);
@endphp
<section class="blog-section padding-top padding-bottom ">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach ($blogs as $data)
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="post__item">
                    <div class="post__item-thumb">
                        <img src="{{ getImage('assets/images/frontend/announcement/'.$data->data_values->announcement_image,'550x400') }}" alt="@lang('announcement')">
                    </div>
                    <div class="post__item-content">
                        <h5 class="title"><a href="{{ route('announcement.detail',$data->id) }}">{{ __($data->data_values->title) }}</a></h5>
                        <ul class="post-meta">
                            <li>
                                <span class="date"><i class="fas fa-calendar"></i> {{ showDateTime($data->created_at) }}</span>
                            </li>
                        </ul>
                        <p>{{ shortDescription($data->data_values->short_description) }}</p>
                        <a href="{{ route('announcement.detail',$data->id) }}" class="read-more">@lang('Read More')</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
       
    </div>
</section>


