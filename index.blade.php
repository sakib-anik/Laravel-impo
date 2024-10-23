@extends('layouts.admin.app')

@section('title',__('Digital Section'))

@push('css_or_js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<!-- Bootstrap Datepicker CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@endpush

@section('content')
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">
                    {{__('messages.dashboard')}}
                </a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                {{__('Digital Section')}}
            </li>
        </ol>
        <div class="col-md-8">
            <label class="input-label" for="link">Choose Mosque<span class="input-label-secondary" id="link"></span></label>
        <form id="myForm" action="{{ route('admin.digital.section.index') }}" method="GET">
        <div class="form-group mt-2" >
            <!-- <label class="input-label" for="link">Choose Mosque<span class="input-label-secondary" id="link"></span></label> -->
           <select  class="form-control" name="mosque_id" id="mySelect">
            <option value="">Choose Mosque</option>
            @foreach($mosques as $m)
               <option value="{{ $m->id }}">{{ $m->name }}</option>
               @endforeach
           </select>
        </div>
        <button type="submit" id="submitButton" style="display: none;"></button>
     </form>
    </div>
    </nav>

    <!-- Page Heading -->
   @if(!empty($mosque))
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $mosque->name ?? '' }}</h3>
                 </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="POST" action="{{ route('admin.digital.section.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input name="mosque_id" type="hidden" value="{{ $mosque->id ?? '' }}">
                         <div class="container">
                                <div class="card-header">
                                    <h4 class="text-capitalize">Prayer Time Title Section</h4>
                                </div>
                             <div class="row">
                            <div class="col-md-4 d-none">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link">Weekly Prayer_time Title<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_title ?? old('weekly_prayer_time_title') }}"   placeholder="Enter Title" class="form-control" type="text"  name="weekly_prayer_time_title" id="weekly_prayer_time_title"  >
                                </div>
                             </div>
                             <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label" for="link">Font Colour<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_color ?? old('weekly_prayer_time_color') }}" class="form-control" type="color"  name="weekly_prayer_time_color" id="weekly_prayer_time_color"  >
                                </div>
                             </div>
                             <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label" for="link"> Font Size<span class="input-label-secondary" id="link"></span></label>
                                    <div class="form-group d-flex align-items-center">
                                        <input value="{{ $digital->weekly_prayer_time_font_size ?? old('weekly_prayer_time_font_size') }}" placeholder="Enter Font Size" class="form-control" type="number"  name="weekly_prayer_time_font_size" id="weekly_prayer_time_font_size">
                                        <span class="input-label-secondary">px</span>
                                    </div>
                                </div>
                             </div>

                             <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label" for="link"> Background<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_font_background ?? old('weekly_prayer_time_font_background') }}" class="form-control" type="color"  name="weekly_prayer_time_font_background" id="  weekly_prayer_time_font_background"  >
                                </div>
                             </div>

                             <div class="col-md-2 d-none">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link"> Font Align<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_font_align ?? old('weekly_prayer_time_font_align') }}" placeholder="center" class="form-control" type="text"  name="weekly_prayer_time_font_align" id="weekly_prayer_time_font_align"  >
                                </div>
                             </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label" for="link">Next Azan Font Size<span class="input-label-secondary" id="link"></span></label>
                                    <div class="form-group d-flex align-items-center">
                                        <input value="{{ $digital->next_azan_font_size ?? old('next_azan_font_size') }}"   placeholder="Enter Font Size" class="form-control" type="number"  name="next_azan_font_size" id="next_azan_font_size">
                                        <span class="input-label-secondary">px</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label" for="link">Next Azan Waqt Font Colour<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->next_azan_waqt_color ?? old('next_azan_waqt_color') }}" class="form-control" type="color"  name="next_azan_waqt_color" id="next_azan_waqt_color">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label" for="link">Next Azan Time Left Font Size<span class="input-label-secondary" id="link"></span></label>
                                    <div class="form-group d-flex align-items-center">
                                        <input value="{{ $digital->next_azan_time_left_font_size ?? old('next_azan_time_left_font_size') }}"   placeholder="Enter Font Size" class="form-control" type="number" name="next_azan_time_left_font_size" id="next_azan_time_left_font_size">
                                        <span class="input-label-secondary">px</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 d-none">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link">Next Azan Time Left Font Colour<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->next_azan_time_left_font_color ?? old('next_azan_time_left_font_color') }}" class="form-control" type="color"  name="next_azan_time_left_font_color" id="next_azan_waqt_color">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label" for="link">Next Azan Time Unit Background Colour<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->next_azan_time_left_unit_bg_color ?? old('next_azan_time_left_unit_bg_color') }}" class="form-control" type="color"  name="next_azan_time_left_unit_bg_color" id="next_azan_time_left_unit_bg_color">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label" for="link">Current Time Font Size<span class="input-label-secondary" id="link"></span></label>
                                    <div class="form-group d-flex align-items-center">
                                        <input value="{{ $digital->cur_time_font_size ?? old('cur_time_font_size') }}"   placeholder="Enter Font Size" class="form-control" type="number" name="cur_time_font_size" id="cur_time_font_size">
                                        <span class="input-label-secondary">px</span>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label" for="link">Current Day Of Week Font Size<span class="input-label-secondary" id="link"></span></label>
                                    <div class="form-group d-flex align-items-center">
                                        <input value="{{ $digital->cur_day_font_size ?? old('cur_day_font_size') }}"   placeholder="Enter Font Size" class="form-control" type="number" name="cur_day_font_size" id="cur_day_font_size">
                                        <span class="input-label-secondary">px</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label" for="link">Current Date Font Size<span class="input-label-secondary" id="link"></span></label>
                                    <div class="form-group d-flex align-items-center">
                                        <input value="{{ $digital->cur_date_font_size ?? old('cur_date_font_size') }}"   placeholder="Enter Font Size" class="form-control" type="number" name="cur_date_font_size" id="cur_date_font_size">
                                        <span class="input-label-secondary">px</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label" for="link">QR Background Colour<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->qr_bg_color ?? old('qr_bg_color') }}" class="form-control" type="color"  name="qr_bg_color" id="qr_bg_color">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label" for="link">Weekly Prayer Table Font Size<span class="input-label-secondary" id="link"></span></label>
                                    <div class="form-group d-flex align-items-center">
                                        <input value="{{ $digital->table_font_size ?? old('table_font_size') }}" placeholder="Enter Font Size" class="form-control" type="number" name="table_font_size" id="table_font_size">
                                        <span class="input-label-secondary">px</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label" for="link">Prayer Table Font Size<span class="input-label-secondary" id="link"></span></label>
                                    <div class="form-group d-flex align-items-center">
                                        <input value="{{ $digital->prayer_table_font_size ?? old('prayer_table_font_size') }}" placeholder="Enter Font Size" class="form-control" type="number" name="prayer_table_font_size" id="prayer_table_font_size">
                                        <span class="input-label-secondary">px</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label" for="link">Tomorrow Title Font Size<span class="input-label-secondary" id="link"></span></label>
                                    <div class="form-group d-flex align-items-center">
                                        <input value="{{ $digital->tomorrow_title_font_size ?? old('tomorrow_title_font_size') }}" placeholder="Enter Font Size" class="form-control" type="number" name="tomorrow_title_font_size" id="tomorrow_title_font_size">
                                        <span class="input-label-secondary">px</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label" for="link">Lower Waqt Time Colour<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->lower_waqt_time_color ?? old('lower_waqt_time_color') }}" class="form-control" type="color"  name="lower_waqt_time_color" id="lower_waqt_time_color">
                                </div>
                            </div>
                          </div>
                         </div>

                         <div class="container d-none">
                            <div class="card-header">
                                <h4 class="text-capitalize">Prayer Time Day Section</h4>
                            </div>
                             <div class="row">
                            <div class="col-md-3 d-none">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link">Weekly Prayer_time Day Title<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_day_title ?? old('weekly_prayer_time_day_title') }}" placeholder="Enter Title" class="form-control" type="text"  name="weekly_prayer_time_day_title" id="weekly_prayer_time_day_title"  >
                                </div>
                             </div>
                             <div class="col-md-3 d-none">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link">Font Colour<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_day_color ?? old('weekly_prayer_time_day_color') }}" class="form-control" type="color"  name="weekly_prayer_time_day_color" id="weekly_prayer_time_day_color"  >
                                </div>
                             </div>
                             <div class="col-md-3 d-none">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link"> Font Size<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_day_font_size ?? old('weekly_prayer_time_day_font_size') }}" placeholder="10px;" class="form-control" type="text"  name="weekly_prayer_time_day_font_size" id="  weekly_prayer_time_day_font_size"  >
                                </div>
                             </div>

                             <div class="col-md-3 d-none">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link"> Background<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_day_font_background ?? old('weekly_prayer_time_day_font_background') }}" class="form-control" type="color"  name="weekly_prayer_time_day_font_background" id="  weekly_prayer_time_day_font_background"  >
                                </div>
                             </div>

                          </div>
                         </div>

                         <div class="container">
                            <div class="card-header">
                                <h4 class="text-capitalize">Bank Details Section</h4>
                            </div>
                             <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label" for="link">Bank Name<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->bank_name ?? old('bank_name') }}" placeholder="Bank Name" class="form-control" type="text"  name="bank_name" id="bank_name"  >
                                </div>
                             </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label" for="link">SC<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->bank_sc ?? old('bank_sc') }}" placeholder="SC" class="form-control" type="text"  name="bank_sc" id="bank_sc"  >
                                </div>
                             </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label" for="link">Ac No<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->bank_ac_no ?? old('bank_ac_no') }}" placeholder="Ac No" class="form-control" type="text" name="bank_ac_no" id="bank_ac_no"  >
                                </div>
                             </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label" for="link">Bank Details Font Size<span class="input-label-secondary" id="link"></span></label>
                                    <div class="form-group d-flex align-items-center">
                                        <input value="{{ $digital->bank_font_size ?? old('bank_font_size') }}" placeholder="Enter Font Size" class="form-control" type="number" name="bank_font_size" id="bank_font_size">
                                        <span class="input-label-secondary">px</span>
                                    </div>
                                </div>
                            </div>
                          </div>
                         </div>
                         <div class="container">
                            <div class="card-header">
                                <h4 class="text-capitalize">Prayer Table Column Adjustment Section</h4>
                            </div>
                             <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label" for="link">Left Side<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->prayer_left ?? old('prayer_left') }}" placeholder="" class="form-control" type="number"  name="prayer_left" id="prayer_left"  >
                                </div>
                             </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label" for="link">Right Side<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->prayer_right ?? old('prayer_right') }}" placeholder="" class="form-control" type="number"  name="prayer_right" id="prayer_right"  >
                                </div>
                             </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label" for="link">Left Section Font Size<span class="input-label-secondary" id="link"></span></label>
                                    <div class="form-group d-flex align-items-center">
                                        <input value="{{ $digital->left_font_size ?? old('left_font_size') }}" placeholder="Enter Font Size" class="form-control" type="number" name="left_font_size" id="left_font_size">
                                        <span class="input-label-secondary">px</span>
                                    </div>
                                </div>
                            </div>
                          </div>
                         </div>

                         <div class="container d-none">
                                <div class="card-header">
                                    <h4 class="text-capitalize">Theme Header</h4>
                                </div>
                             <div class="row">
                            <div class="col-md-4 d-none">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link">Theme Header<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_theme_header_size ?? old('weekly_prayer_time_theme_header_size') }}" placeholder="Enter Title" class="form-control" type="text"  name="weekly_prayer_time_theme_header_size" id="weekly_prayer_time_theme_header_size"  >
                                </div>
                             </div>
                             <div class="col-md-2 d-none">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link">Font Colour<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_theme_header_color ?? old('weekly_prayer_time_theme_header_color') }}" class="form-control" type="color"  name="weekly_prayer_time_theme_header_color" id="weekly_prayer_time_theme_header_color"  >
                                </div>
                             </div>
                             <div class="col-md-2 d-none">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link"> Font Size<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_theme_header_font ?? old('weekly_prayer_time_theme_header_font') }}" placeholder="10px;" class="form-control" type="text"  name="weekly_prayer_time_theme_header_font" id="weekly_prayer_time_theme_header_font"  >
                                </div>
                             </div>

                             <div class="col-md-2 d-none">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link"> Background<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_theme_header_background ?? old('weekly_prayer_time_theme_header_background') }}" class="form-control" type="color"  name="weekly_prayer_time_theme_header_background" id="  weekly_prayer_time_theme_header_background"  >
                                </div>
                             </div>

                             <div class="col-md-2 d-none">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link"> Font Align<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_theme_header_text_align ?? old('weekly_prayer_time_theme_header_text_align') }}" placeholder="center" class="form-control" type="text"  name="weekly_prayer_time_theme_header_text_align" id="weekly_prayer_time_theme_header_text_align"  >
                                </div>
                             </div>
                          </div>
                         </div>


                         <div class="container d-none">
                            <div class="card-header">
                                <h4 class="text-capitalize">Theme Footer</h4>
                            </div>
                             <div class="row">
                            <div class="col-md-2 d-none">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link">Theme Footer Size<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_theme_footer_size ?? old('weekly_prayer_time_theme_footer_size') }}" placeholder="Enter Title" class="form-control" type="text"  name="weekly_prayer_time_theme_footer_size" id="weekly_prayer_time_theme_footer_size"  >
                                </div>
                             </div>
                             <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link">Font Colour<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_theme_footer_color ?? old('weekly_prayer_time_theme_footer_color') }}" class="form-control" type="color"  name="weekly_prayer_time_theme_footer_color" id="weekly_prayer_time_theme_footer_color"  >
                                </div>
                             </div>
                             <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link">Font <span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_theme_footer_font ?? old('weekly_prayer_time_theme_footer_font') }}" class="form-control" type="text"  name="weekly_prayer_time_theme_footer_font" id="weekly_prayer_time_theme_footer_font"  >
                                </div>
                             </div>
                             <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link"> Font Size<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_theme_header_font ?? old('weekly_prayer_time_theme_header_font') }}" placeholder="10px;" class="form-control" type="text"  name="weekly_prayer_time_theme_header_font" id="weekly_prayer_time_theme_header_font"  >
                                </div>
                             </div>

                             <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link"> Background<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_theme_footer_background ?? old('weekly_prayer_time_theme_footer_background') }}" class="form-control" type="color"  name="weekly_prayer_time_theme_footer_background" id="  weekly_prayer_time_theme_footer_background"  >
                                </div>
                             </div>

                             <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label bg-danger" for="link"> Font Align<span class="input-label-secondary" id="link"></span></label>
                                    <input value="{{ $digital->weekly_prayer_time_theme_footer_text_align ?? old('weekly_prayer_time_theme_footer_text_align') }}" placeholder="center" class="form-control" type="text"  name="weekly_prayer_time_theme_footer_text_align" id="weekly_prayer_time_theme_footer_text_align"  >
                                </div>
                             </div>
                          </div>
                         </div>

                        <div class="container">
                            <div class="card-header">
                                <h4 class="text-capitalize">Image Section</h4>
                            </div>
                             <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label" for="link">App Logo<span class="input-label-secondary" id="link"></span></label>
                                        <input name="logo_app" value="" type="file" class="form-control" id="formFile">
                                        @if (!empty($digital->logo_app))
                                            <img src="{{ $digital->getLogo() }}" style="width: 150px; height: 150px" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label" for="link">Mosque Logo<span class="input-label-secondary" id="link"></span></label>
                                        <input name="logo_mosque" value="" type="file" class="form-control" id="formFile">
                                        @if (!empty($digital->logo_mosque))
                                            <img src="{{ $digital->getMosqueLogo() }}" style="width: 150px; height: 150px" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label" for="link">Poster<span class="input-label-secondary" id="link"></span></label>
                                        <input name="poster" value="" type="file" class="form-control" id="formFile">
                                        @if (!empty($digital->poster))
                                            <img src="{{ $digital->getPoster() }}" style="width: 250px; height: 150px" alt="">
                                        @endif
                                    </div>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-md-4">
                                    <label class="input-label" for="link">Android QR Code<span class="input-label-secondary" id="link"></span></label>
                                    <input name="droid_qr" value="" type="file" class="form-control" id="formFile">
                                    @if (!empty($digital->droid_qr))
                                        <img src="{{ $digital->getDroidQr() }}" style="width: 250px; height: 150px" alt="">
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="input-label" for="link">iOS QR Code<span class="input-label-secondary" id="link"></span></label>
                                    <input name="ios_qr" value="" type="file" class="form-control" id="formFile">
                                    @if (!empty($digital->ios_qr))
                                        <img src="{{ $digital->getIOSQr() }}" style="width: 250px; height: 150px" alt="">
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="input-label" for="link">Donate QR Code<span class="input-label-secondary" id="link"></span></label>
                                    <input name="donate_qr" value="" type="file" class="form-control" id="formFile">
                                    @if (!empty($digital->donate_qr))
                                        <img src="{{ $digital->getDonateQr() }}" style="width: 250px; height: 150px" alt="">
                                    @endif
                                </div>
                             </div>
                             <hr />
                             <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="input-label" for="link">Poster Show<span class="input-label-secondary" id="link"></span></label>
                                            <select class="form-control" name="poster_show" id="">
                                                <option @if(!empty($digital)) {{ ($digital->poster_show == 'true')? 'selected': '' }} @endif value="true">Enable</option>
                                                <option @if(!empty($digital)) {{ ($digital->poster_show == 'false')? 'selected' : '' }} @endif value="false">Disable</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="input-label" for="link">Bank Details Show<span class="input-label-secondary" id="link"></span></label>
                                            <select class="form-control" name="bank_show" id="">
                                                <option @if(!empty($digital)) {{ ($digital->bank_show == 'true')? 'selected': '' }} @endif value="true">Enable</option>
                                                <option @if(!empty($digital)) {{ ($digital->bank_show == 'false')? 'selected' : '' }} @endif value="false">Disable</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="input-label" for="mosque_name12">Mosque Name<span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->mosque_name ?? old('mosque_name') }}" placeholder="Mosque Name" class="form-control" type="text"  name="mosque_name" id="mosque_name12"  >
                                    </div>
                                </div>
                             </div>
                        </div>

                        <div class="container">
                            <div class="card-header">
                                <h4 class="text-capitalize">Logo Margin Section</h4>
                            </div>
                             <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="input-label" for="link">Margin<span class="input-label-secondary" id="link"></span></label>
                                        <div class="form-group d-flex align-items-center">
                                            <input value="{{ $digital->logo_margin ?? old('logo_margin') }}" placeholder="Enter Size" class="form-control" type="number" name="logo_margin" id="logo_margin">
                                            <span class="input-label-secondary">px</span>
                                        </div>
                                    </div>
                                </div>
                             </div>
                        </div>

                        <div class="container">
                            <div class="card-header">
                                <h4 class="text-capitalize">Scale Section</h4>
                            </div>
                             <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="input-label" for="link">Scale<span class="input-label-secondary" id="link"></span></label>
                                        <div class="form-group d-flex align-items-center">
                                            <input value="{{ $digital->scale ?? old('scale') }}" placeholder="Enter Size" class="form-control" type="text" name="scale" id="scale">
                                            <span class="input-label-secondary">x</span>
                                        </div>
                                    </div>
                                </div>
                             </div>
                        </div>

                         <div class="container">
                            <div class="card-header">
                                <h4 class="text-capitalize">Slider Section</h4>
                            </div>
                             <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="input-label" for="link">Slider Time ( seconds )<span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->weekly_prayer_time_slider_time ?? old('weekly_prayer_time_slider_time') }}" placeholder="Enter Title" class="form-control" type="text"  name="weekly_prayer_time_slider_time" id="weekly_prayer_time_slider_time"  >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="input-label" for="link">Slider Auto<span class="input-label-secondary" id="link"></span></label>
                                            <select class="form-control" name="weekly_prayer_time_slider_auto" id="">
                                                <option @if(!empty($digital)) {{ ($digital->weekly_prayer_time_slider_auto == 'true')? 'selected': '' }} @endif value="true">Auto</option>
                                                <option @if(!empty($digital)) {{ ($digital->weekly_prayer_time_slider_auto == 'false')? 'selected' : '' }} @endif value="false">Off</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-2 d-none">
                                    <div class="form-group">
                                        <label class="input-label bg-danger" for="link">Font <span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->weekly_prayer_time_slider_font ?? old('weekly_prayer_time_slider_font') }}" class="form-control" type="text"  name="weekly_prayer_time_slider_font" id="weekly_prayer_time_slider_font"  >
                                    </div>
                                </div>

                                <div class="col-md-2 d-none">
                                    <div class="form-group">
                                        <label class="input-label bg-danger" for="link"> Background<span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->weekly_prayer_time_slider_backgrund ?? old('weekly_prayer_time_slider_backgrund') }}"  class="form-control" type="color"  name="weekly_prayer_time_slider_backgrund" id="weekly_prayer_time_slider_backgrund"  >
                                    </div>
                                </div>

                                <div class="col-md-2 d-none">
                                    <div class="form-group">
                                        <label class="input-label bg-danger" for="link"> Font Align<span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->weekly_prayer_time_theme_footer_text_align ?? old('weekly_prayer_time_theme_footer_text_align') }}" placeholder="center" class="form-control" type="text"  name="weekly_prayer_time_theme_footer_text_align" id="weekly_prayer_time_theme_footer_text_align"  >
                                    </div>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="input-label" for="link">Adhan Slider Time ( minutes )<span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->azan_break ?? old('azan_break') }}" placeholder="" class="form-control" type="text"  name="azan_break" id="azan_break"  >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="input-label" for="link">Salat Slider Time ( minutes )<span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->salat_break ?? old('salat_break') }}" placeholder="" class="form-control" type="text" name="salat_break" id="salat_break" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="input-label" for="link">Refresh<span class="input-label-secondary" id="link"></span></label>
                                            <select class="form-control" name="refresher" id="">
                                                <option @if(!empty($digital)) {{ ($digital->refresher == 'true')? 'selected': '' }} @endif value="true">On</option>
                                                <option @if(!empty($digital)) {{ ($digital->refresher == 'false')? 'selected' : '' }} @endif value="false">Off</option>
                                            </select>
                                    </div>
                                </div>
                             </div>
                         </div>

                         <div class="container">
                            <div class="card-header">
                                <h4 class="text-capitalize">Hadis Section</h4>
                            </div>
                             <div class="row">
                                <div class="col-md-2 d-none">
                                    <div class="form-group">
                                        <label class="input-label bg-danger" for="link">Hadis Time<span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->hadis_time ?? old('hadis_time') }}" placeholder="Enter Title" class="form-control" type="text"  name="hadis_time" id="hadis_time"  >
                                    </div>
                                </div>
                                <div class="col-md-2 d-none">
                                    <div class="form-group">
                                        <label class="input-label bg-danger" for="link">Font <span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->hadis_font ?? old('hadis_font') }}" placeholder="normal" class="form-control" type="text"  name="hadis_font" id="hadis_font"  >
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label class="input-label" for="hadis_font_size">Font Size</label>
                                    <div class="form-group d-flex align-items-center">
                                        <input value="{{ $digital->hadis_font_size ?? old('hadis_font_size') }}" placeholder="Enter Font Size" class="form-control" type="number" name="hadis_font_size" id="hadis_font_size">
                                        <span class="input-label-secondary">px</span>
                                    </div>
                                </div>

                                <div class="col-md-2 d-none">
                                    <div class="form-group">
                                        <label class="input-label bg-danger" for="link">Colour <span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->hadis_font_color ?? old('hadis_font_color') }}" placeholder="white;" class="form-control" type="color"  name="hadis_font_color" id="hadis_font_color"  >
                                    </div>
                                </div>

                                <div class="col-md-2 d-none">
                                    <div class="form-group">
                                        <label class="input-label bg-danger" for="link"> Background<span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->hadis_font_background ?? old('hadis_font_background') }}" class="form-control" type="color"  name="hadis_font_background" id="hadis_font_background"  >
                                    </div>
                                </div>

                                <div class="col-md-2 d-none">
                                    <div class="form-group">
                                        <label class="input-label bg-danger" for="link">Hadis Width<span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->hadis_width ?? old('hadis_width') }}" placeholder="10px" class="form-control" type="text"  name="hadis_width" id="hadis_width"  >
                                    </div>
                                </div>

                                <div class="col-md-4 d-none">
                                    <div class="form-group">
                                        <label class="input-label bg-danger" for="link">Hadis Height<span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->hadis_height ?? old('hadis_height') }}" placeholder="10px" class="form-control" type="text"  name="hadis_height" id="hadis_height"  >
                                    </div>
                                </div>

                                <div class="col-md-4 d-none">
                                    <div class="form-group">
                                        <label class="input-label bg-danger" for="link">Hadis Class Col Md<span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->hadis_col_md ?? old('hadis_col_md') }}" placeholder="10px" class="form-control" type="text"  name="hadis_col_md" id="hadis_col_md"  >
                                    </div>
                                </div>

                                <div class="col-md-4 d-none">
                                    <div class="form-group">
                                        <label class="input-label bg-danger" for="link">Scan Time<span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->scan_time ?? old('scan_time') }}" placeholder="10px" class="form-control" type="text"  name="scan_time" id="scan_time"  >
                                    </div>
                                </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label" for="link">Left Side Hadis<span class="input-label-secondary" id="link"></span></label>
                                        <textarea placeholder="Enter Hadis here" class="form-control" name="hadis" id="hadis">{{ $digital->hadis ?? old('hadis') }}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label" for="link">Left Side Hadis Source<span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->hadis_src ?? old('hadis_src') }}" placeholder="Enter Hadis Source here" class="form-control" type="text"  name="hadis_src" id="hadis_src"  >
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label" for="link">Book Reference<span class="input-label-secondary" id="link"></span></label>
                                        <input value="{{ $digital->book_ref ?? old('book_ref') }}" placeholder="Enter Book Reference here" class="form-control" type="text"  name="book_ref" id="book_ref"  >
                                    </div>
                                 </div>
                             </div>



                          </div>
                         </div>
                         <div class="container">
                            <div class="card-header">
                                <h4 class="text-capitalize">Friday Collection Section</h4>
                            </div>
                             <div class="row mb-2">
                                <div class="col-md-3">
                                    <div class="form-group mb-0" style="">
                                        <label class="input-label">Collection Date<span class="input-label-secondary"></span></label>
                                        <input class="form-control" type="text" name="collection_date" id="collection_date" placeholder="dd/mm/yyyy" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label class="input-label">Day Of Week<span class="input-label-secondary"></span></label>
                                        <input class="form-control" type="text" name="collection_day" id="collection_day" placeholder="" readonly>
                                    </div>
                                </div>
                             </div>
                             <div class="mb-2 d-flex" style="">
                                <input placeholder="Category Name" name="category_name" id="category_name" class="form-control col-md-3 mr-2" />
                                <button type="button" id="add_category" class="btn btn-info mb-2">Add</button>
                             </div>
                             <div id="category_list"></div>
                            </div>
                            <hr />
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>

@endsection

@push('script_2')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script type="text/javascript">
    $( function() {
        $( "#collection_date" ).datepicker({
            dateFormat:'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
            onSelect: function(selectedDate) {
                // Parse the selected date
                var date = $(this).datepicker('getDate');

                // Array of day names
                var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

                // Get the day of the week
                var dayName = daysOfWeek[date.getDay()];

                // Update the 'Day' input field with the name of the day
                $('#collection_day').val(dayName);
            }
        });
    } );

    // add_category section starts here
    document.addEventListener('DOMContentLoaded', function () {
        const categoryList = document.getElementById('category_list');

        // Fetch categories when page loads
        const storeCategoryUrl = "{{ route('admin.categories.store') }}";
        const storeItemUrl = "{{ route('admin.items.store') }}";
        const fetchCategoriesUrl = "{{ route('admin.categories') }}";
        const updateCategoryUrl = "{{ route('admin.categories.update', ['id' => ':id']) }}";
        const updateItemUrl = "{{ route('admin.items.update', ['id' => ':id']) }}";
        const deleteCategoryUrl = "{{ route('admin.categories.destroy', ['id' => ':id']) }}";
        const deleteItemUrl = "{{ route('admin.items.destroy', ['id' => ':id']) }}";
        fetchCategories();
        // Add a new category
        document.getElementById('add_category').addEventListener('click', function () {
            const categoryName = document.getElementById('category_name').value;
            const collectionDate = document.getElementById('collection_date').value;
            const collectionDay = document.getElementById('collection_day').value;

            if (categoryName !== '' && collectionDate !== '' && collectionDay !== '') {
                fetch(storeCategoryUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ category_name: categoryName, collection_date: collectionDate })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        fetchCategories();
                    }
                });
            } else {
                alert("Please check if the collection date, day and category name are filled.");
            }
        });

        // Fetch categories
        function fetchCategories() {
            fetch(fetchCategoriesUrl)
            .then(response => response.json())
            .then(data => {
                categoryList.innerHTML = '';
                if(data.categories.length)
                    data.categories.forEach(category => {
                        categoryList.innerHTML += `
                            <div id="category_${category.id}" class="d-flex flex-column mb-3">
                                <div class="d-flex justify-content-between mb-2" id="categoryX_${category.id}">
                                    <div>Category: ${category.category_name}</div>
                                    <div>
                                        <button onclick="editCategory(${category.id}, '${category.category_name}')" class="btn btn-sm btn-primary">Edit</button>
                                        <button onclick="deleteCategory(${category.id})" class="btn btn-sm btn-danger">Delete</button>
                                    </div>
                                </div>
                                <div id="items_${category.id}">
                                    <div class="mb-2 d-flex">
                                        <input placeholder="Item Name" class="form-control col-md-3 mr-2" id="item_name_${category.id}" />
                                        <input placeholder="Amount" class="form-control col-md-3 mr-2" id="item_amount_${category.id}" />
                                        <button type="button" class="btn btn-info mb-2" onclick="addItem(${category.id})">Add</button>
                                    </div>
                                    ${category.items.map(item => `
                                        <div id="item_${item.id}" class="d-flex justify-content-between align-items-center mb-2">
                                            <div>${item.item_name} ${item.item_amount}</div>
                                            <div>
                                                <button onclick="editItem(${item.id}, '${item.item_name}', '${item.item_amount}')" class="btn btn-sm btn-warning">Edit</button>
                                                <button onclick="deleteItem(${item.id})" class="btn btn-sm btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        `;
                    });
            });
        }

        window.addItem = function (categoryId) {
            const itemNameInput = document.getElementById(`item_name_${categoryId}`);
            const itemAmountInput = document.getElementById(`item_amount_${categoryId}`);

            const itemName = itemNameInput.value;
            const itemAmount = itemAmountInput.value;

            if (itemName && itemAmount) {
                fetch(storeItemUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ category_id: categoryId, item_name: itemName, amount: itemAmount })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Append the new item to the category section in the UI
                        const itemsContainer = document.getElementById(`items_${categoryId}`);
                        itemsContainer.innerHTML += `
                            <div id="item_${data.item.id}" class="d-flex justify-content-between align-items-center mb-2">
                                <div>${data.item.item_name} ${data.item.item_amount}</div>
                                <div>
                                    <button onclick="editItem(${data.item.id}, '${data.item.item_name}', '${data.item.item_amount}')" class="btn btn-sm btn-warning">Edit</button>
                                    <button onclick="deleteItem(${data.item.id})" class="btn btn-sm btn-danger">Delete</button>
                                </div>
                            </div>
                        `;

                        // Clear the input fields after adding the item
                        itemNameInput.value = '';
                        itemAmountInput.value = '';
                    }
                });
            } else {
                alert("Please enter both item name and amount.");
            }
        }

        // Function to edit an existing item
        window.editItem = function (itemId, itemName, itemAmount) {
            const itemElement = document.getElementById(`item_${itemId}`);
            itemElement.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex">
                        <input type="text" value="${itemName}" id="edit_item_name_${itemId}" class="form-control col-md-3 mr-2" />
                        <input type="text" value="${itemAmount}" id="edit_item_amount_${itemId}" class="form-control col-md-3 mr-2" />
                    </div>
                    <div>
                        <button onclick="saveItem(${itemId})" class="btn btn-sm btn-success">Save</button>
                    </div>
                </div>
            `;
        }

        // Function to save the edited item
        window.saveItem = function (itemId) {
            const itemName = document.getElementById(`edit_item_name_${itemId}`).value;
            const itemAmount = document.getElementById(`edit_item_amount_${itemId}`).value;
            const updateItem = updateItemUrl.replace(':id', itemId);
            fetch(updateItem, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ item_name: itemName, amount: itemAmount })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fetchCategories(); // Refresh the categories and items list
                }
            });
        }

        // Function to delete an item
        window.deleteItem = function (itemId) {
            const deleteItem = deleteItemUrl.replace(':id', itemId);
            fetch(deleteItem, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fetchCategories(); // Refresh the categories and items list
                }
            });
        }

        // Edit a category
        window.editCategory = function (id, currentName) {
            const categoryDiv = document.getElementById(`categoryX_${id}`);
            categoryDiv.innerHTML = `
                <div>
                    <input id="edit_category_${id}" class="form-control" value="${currentName}" />
                </div>
                <div>
                    <button onclick="saveCategory(${id})" class="btn btn-sm btn-success">Save</button>
                </div>
            `;
        };

        // Save edited category
        window.saveCategory = function (id) {
            const updatedName = document.getElementById(`edit_category_${id}`).value;
            const updateUrl = updateCategoryUrl.replace(':id', id);
            fetch(updateUrl, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ category_name: updatedName })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fetchCategories();
                }
            });
        };

        // Delete a category
        window.deleteCategory = function (id) {
            const deleteUrl = deleteCategoryUrl.replace(':id', id);
            if (confirm('Are you sure you want to delete this category?')) {
                fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`category_${id}`).remove();
                    }
                });
            }
        };
    });
    // add_category section ends here
</script>
<script>

    document.getElementById("mySelect").addEventListener("change", function() {

        document.getElementById("submitButton").click();
    });
</script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteclass(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });

            $('#type').on('change', function() {
                if($('#type').val() == 'restaurant')
                {
                    $('#restaurant').removeAttr("disabled");
                    $('#deliveryman').val("").trigger( "change" );
                    $('#deliveryman').attr("disabled","true");
                }
                else if($('#type').val() == 'deliveryman')
                {
                    $('#deliveryman').removeAttr("disabled");
                    $('#restaurant').val("").trigger( "change" );
                    $('#restaurant').attr("disabled","true");
                }
            });
        });
        $('#restaurant').select2({
            ajax: {
                url: '{{url('/')}}/admin/vendor/get-restaurants',
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data) {
                    return {
                    results: data
                    };
                },
                __port: function (params, success, failure) {
                    var $request = $.ajax(params);

                    $request.then(success);
                    $request.fail(failure);

                    return $request;
                }
            }
        });

        $('#deliveryman').select2({
            ajax: {
                url: '{{url('/')}}/admin/delivery-man/get-deliverymen',
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data) {
                    return {
                    results: data
                    };
                },
                __port: function (params, success, failure) {
                    var $request = $.ajax(params);

                    $request.then(success);
                    $request.fail(failure);

                    return $request;
                }
            }
        });

        function getAccountData(route, data_id, type)
        {
            $.get({
                    url: route+data_id,
                    dataType: 'json',
                    success: function (data) {
                        $('#account_info').html('({{__('messages.cash_in_hand')}}: '+data.cash_in_hand+' {{__('messages.earning_balance')}}: '+data.earning_balance+')');
                    },
                });
        }
    </script>
    <script>
        $('#add_transaction').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.account-transaction.store')}}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        toastr.success('{{__('messages.transaction_saved')}}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        setTimeout(function () {
                            location.href = '{{route('admin.account-transaction.index')}}';
                        }, 2000);
                    }
                }
            });
        });
    </script>
@endpush
