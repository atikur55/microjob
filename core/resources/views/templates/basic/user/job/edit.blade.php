@extends($activeTemplate.'layouts.master')
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
            background-color: #fff;
        }
    </style>
@endpush
@section('content')

<div class="dashboard__content">
    <div class="campaigns__wrapper">
        <div class="create__campaigns">
            <form class="create__campaigns__form" action="{{ route('user.job.update',$job->id) }}" method="POST" enctype="multipart/form-data">  
                @csrf
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <div class="payment-method-item">
                            <div class="payment-method-header">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview w-100" id="previewImg"
                                            style="background-image: url({{ getImage(imagePath()['job']['attachment']['path'] . '/' . $job->attachment, imagePath()['job']['attachment']['size']) }})">
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
                    <div class="col-xl-8 col-lg-7 col-md-7">
                        <div class="form-group mb-3">
                            <label for="country" class="form--label">@lang('Category')
                                <span class="text--danger">*</span>
                            </label>
                            <select class="form-control form--control h-50 w-100" name="category_id" id="category">
                                <option value="" selected disabled>@lang('Select One')</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $job->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                <div class="row my-3">
                    <div class="col-xl-12">
                        <div class="form-group mb-3">
                            <label for="country" class="form--label">@lang('Job Proof')
                                <span class="text--danger">*</span>
                            </label>
                            <select class="form-control form--control h-50 w-100" name="job_proof" id="fileOption">
                                <option value="" selected disabled>@lang('Select Job Proof')</option>
                                <option value="1" {{ $job->job_proof == 1 ? 'selected' : '' }}>@lang("Optional")</option>
                                <option value="2" {{ $job->job_proof == 2 ? 'selected' : '' }}>@lang("Required")</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row" id="choiceOption">
                    <label for="country" class="form--label">@lang('Select File Upload Option')
                        <span class="text--danger">*</span>
                    </label>
                    <div class="input-group">
                        @foreach ($files as $file)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="file_name[]" id="inlineRadio{{ $file->id }}" value="{{ __($file->name) }}">
                                <label class="form-check-label" for="inlineRadio{{ $file->id }}">{{ __($file->name) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4">
                        <label for="workers" class="form--label">@lang('Quantity')
                            <span class="text--danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="number" id="workers" name="quantity" class="form-control form--control workers"  min="1" value="{{ $job->quantity }}" {{ $job->status == 1 ? 'readonly':'' }}>
                        </div>
                    </div>
                    
                    <div class="col-xl-4">
                        <label for="country" class="form--label">@lang('Worker will earn')
                            <span class="text--danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="number" step="any" name="rate" class="form-control form--control rate" min="0" value="{{ showAmount($job->rate) }}" {{ $job->status == 1 ? 'readonly':'' }}>
                            <div class="input-group-apend ">
                                <div class="input-group-text h-50 radius-5 px-3">{{ $general->cur_sym }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <label for="country" class="form--label">@lang('Total Budget')</label>
                        <div class="input-group">
                            <input type="text" name="total_budget" class="form-control form--control total" value="{{ showAmount($job->total) }}" readonly>
                            <div class="input-group-apend ">
                                <div class="input-group-text h-50 radius-5 px-3">{{ $general->cur_sym }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <label for="country" class="form--label">@lang('Job Title')
                    <span class="text--danger">*</span>
                </label>
                <div class="input-group">
                    <input type="text" name="title" class="form-control form--control" value="{{ $job->title }}">
                </div>
                <label for="country" class="form--label">@lang('Job Description')
                    <span class="text--danger">*</span>
                </label>
                <div class="input-group">
                    <textarea class="form-control form--control nicEdit" name="description">{{ $job->description }}</textarea>
                </div>
                <button class="cmn--btn btn--md w-100" type="submit">@lang('Submit')</button>
            </form>
        </div>
    </div>
</div>


@endsection
@push('script')
    <script>

        (function($) {
            "use strict";

            var fileName = '{{ $job->file_name }}';
            var files = fileName.split(",");
            var i;
            var j;
            var inputs = $("input[type=checkbox]");
            for(i = 0; i<files.length;i++){
                var file = files[i];
                for(j = 0;j<inputs.length;j++){
                    var checkboxVal = $(inputs[j]).val();
                    if(checkboxVal == file){
                        $(inputs[j]).attr( 'checked', true );
                    }
                }
                
            }
            if(fileName){
                $("#choiceOption").css('display','block');
            }
            else{
                $("#choiceOption").css('display','none');
            }
            $("#fileOption").change(function(){
                $("#choiceOption").css('display','none');
                var value = $(this).val();
                if(value == 2){
                    $("#choiceOption").css('display','block');
                }
            });

            $('#category').change(function() {
                var subcategory_id = '{{ $job->subcategory_id }}';
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
                        $("#subcategory").append('<option value='+value.id+' '+ (value.id == subcategory_id ? 'selected': '') +'>'+value.name+'</option>');
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
