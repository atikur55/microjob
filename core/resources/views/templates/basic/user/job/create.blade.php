@extends($activeTemplate.'layouts.master')
@section('content')

<div class="dashboard__content contact__form__wrapper">
    <div class="campaigns__wrapper">
        <div class="">
            <form class="create__campaigns__form" action="{{ route('user.job.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-4">
                        <div class="payment-method-item">
                            <div class="payment-method-header">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview w-100" id="previewImg"
                                            style="background-image: url({{ getImage('/', imagePath()['job']['attachment']['size']) }})">
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" name="attachment" class="profilePicUpload" id="image"
                                            accept=".png, .jpg, .jpeg" onchange="previewFile(this);"/>
                                        <label for="image" class="bg--base"><i class="la la-pencil text-light"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="form-group">
                            <label for="country" class="form--label">@lang('Category')
                                <span class="text--danger">*</span>
                            </label>
                            <select class="form-control form--control h-50 w-100" name="category_id" id="category">
                                <option value="" selected disabled>@lang('Select One')</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (old('category_id') == $category->id) selected="selected" @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="country" class="form--label">@lang('Subcategory')</label>
                            <select class="form-control form--control h-50 w-100" name="subcategory_id" id="subcategory">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="country" class="form--label">@lang('Job Proof')
                        <span class="text--danger">*</span>
                    </label>
                    <select class="form-control form--control h-50 w-100" name="job_proof" id="fileOption">
                        <option value="" selected disabled>@lang('Select Type')</option>
                        <option value="1" @if (old('job_proof') == 1) selected="selected" @endif>@lang("Optional")</option>
                        <option value="2" @if (old('job_proof') == 2) selected="selected" @endif>@lang("Required")</option>
                    </select>
                </div>
                <div class="row" id="choiceOption">
                    <label for="country" class="form--label">@lang('Select File Upload Option')
                        <span class="text--danger">*</span>
                    </label>
                    <div class="input-group">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineRadio" value="all">
                            <label class="form-check-label" for="inlineRadio">@lang('Select All')</label>
                        </div>
                        @foreach ($files as $file)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="file_name[]" id="inlineRadio{{ $file->id }}" value="{{ __($file->name) }}">
                                <label class="form-check-label" for="inlineRadio{{ $file->id }}">{{ __($file->name) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <label for="workers" class="form--label">@lang('Quantity')
                            <span class="text--danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="number" id="workers" name="quantity" class="form-control form--control workers" min="1" value="{{ old('workers') }}">
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <label for="country" class="form--label">@lang('Worker will earn')
                            <span class="text--danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="number" step="any" name="rate" class="form-control form--control rate" min="0" value="{{ old('rate') }}">
                            <div class="input-group-apend ">
                                <div class="input-group-text h-50 radius-5 px-3">{{ $general->cur_text }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <label for="country" class="form--label">@lang('Total Budget')</label>
                        <div class="input-group">
                            <input type="text" name="total_budget" class="form-control form--control total" value="{{ old('total_budget') }}" readonly>
                            <div class="input-group-apend ">
                                <div class="input-group-text h-50 radius-5 px-3">{{ $general->cur_text }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <label for="country" class="form--label">@lang('Job Title')
                    <span class="text--danger">*</span>
                </label>
                <div class="input-group">
                    <input type="text" name="title" class="form-control form--control" value="{{ old('title') }}">
                </div>
                <label for="country" class="form--label">@lang('Job Description')
                    <span class="text--danger">*</span>
                </label>
                <div class="input-group">
                    <textarea class="form-control form--control nicEdit" name="description"></textarea>
                </div>

                <button class="cmn--btn btn--md w-100" type="submit">@lang('Submit')</button>
            </form>
        </div>
    </div>
</div>


@endsection

@push('style')
    <style>
        .payment-method-item .payment-method-header {
            display: flex;
            flex-wrap: wrap;
        }
        .payment-method-item .payment-method-header .thumb {
            width: 220px;
            position: relative;
            margin-bottom: 30px;
        }
        .payment-method-item .payment-method-header .thumb .profilePicPreview {
            width: 210px;
            height: 210px;
            display: block;
            border: 3px solid #f1f1f1;
            box-shadow: 0 0 5px 0 rgb(0 0 0 / 25%);
            border-radius: 10px;
            background-size: cover;
            background-position: center;
        }
        .payment-method-item .payment-method-header .thumb .avatar-edit {
            position: absolute;
            bottom: -15px;
            right: 0;
        }
        .payment-method-item .payment-method-header .thumb .profilePicUpload {
            font-size: 0;
            opacity: 0;
            width: 0;
        }

        .payment-method-item .payment-method-header .thumb .avatar-edit label {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            text-align: center;
            line-height: 45px;
            border: 2px solid #fff;
            font-size: 18px;
            cursor: pointer;
        }
        .form-control:disabled, .form-control[readonly]{
            background-color: #fffefc;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $("#choiceOption").css('display','none');

            $("#fileOption").change(function(){
                $("#choiceOption").css('display','none');
                var value = $(this).val();
                if(value == 2){
                    $("#choiceOption").css('display','block');
                }
            });

            $("#inlineRadio").click(function(){
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'))
            });

            $('#category').change(function() {

                $("#subcategory").html("");
                var data = [];

                @foreach ($categories as $category)
                    @foreach ($category->subcategory as $item)
                        data.push({ id: '{{ $item->id }}', category_id:'{{ $item->category_id }}', name:
                        '{{ $item->name }}' });
                    @endforeach
                @endforeach

                var id = $(this).val();
                $("#subcategory").prepend(`<option value="" selected disabled>Select One</option>`);
                data.forEach(value => {
                    if (value.category_id == id) {
                        $("#subcategory").append(`<option value="${value.id}">${value.name}</option>`);
                    }
                });
            }).change();

            $(".workers").on('change input',function(){

                var worker = $(this).val();
                var rate = $('.rate').val();
                var total = rate * worker;
                $('.total').val(total);
            });

            $(".rate").on('change input',function(){

                var rate = $(this).val();
                var worker = $('.workers').val();
                var total = rate * worker;
                $('.total').val(total);
            });

        })(jQuery);
        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $("#previewImg").css("background-image", "url(" + reader.result + ")");
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

@endpush
