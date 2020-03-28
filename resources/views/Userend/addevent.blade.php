<?php if(isset($result)) $eventdate = explode('*', $result->event_date); ?>
@extends('Userend/layout')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/addevent.css') }}"> 
    <style>
        .card-footer {
            padding: .75rem 1.25rem;
        }
        .steps {
            -webkit-box-shadow:none;
            -moz-box-shadow: none;
            box-shadow: none;
        }
        .fa_size{
            padding: 7px;
            font-size: larger;
        }


    </style>
@endsection
@section('content')
    <form  method="post" enctype="multipart/form-data" class="needs-validation {{ (Session::get('error') != NULL  || Session::get('errors') != NULL ?'was-validated':'') }}"  action="{{ isset($result)?route('editEvent',['id'=>$result->event_id] ) : route('insertEvent') }}">
        {{ csrf_field() }} 
        <input type="hidden" name="exSponsor" value="{{ isset($result) ? $result->sponsor_by:'' }}">
        <input type="hidden" name="exBanner" value="{{ isset($result)? $result->banner:'' }}">
        <div class="error">
            @if($errors->any())
                <div class="alert alert-danger ">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                {{ $message }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="wizard__steps">
                    <nav class="steps">
                        <div class="step">
                            <div class="step__content">
                                <p class="step__number">
                                    <i class="fab fa-opencart fa_size"></i>
                                </p>
                                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                                </svg>
                                <div class="lines">
                                    <div class="line -start"></div>
                                    <div class="line -background"></div>
                                    <div class="line -progress"></div>
                                </div>  
                            </div>
                        </div>

                        <div class="step">
                            <div class="step__content">
                                <p class="step__number">
                                    <i class="fas fa-map-marker-alt fa_size"></i>
                                </p>
                                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                                </svg>
                                <div class="lines">
                                    <div class="line -background"></div>
                                    <div class="line -progress"></div>
                                </div>  
                            </div>
                        </div>

                        <div class="step">
                            <div class="step__content">
                                <p class="step__number">
                                    <i class="fas fa-address-card fa_size"></i>
                                </p>
                                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                                </svg>

                                <div class="lines">
                                    <div class="line -background"></div>
                                    <div class="line -progress"></div>
                                </div> 
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="card-body" >
                <div class="row panel " style="padding-top:20px !important;">
                    <h2 class="panel__title">Event Details</h2>

                    <div class="col-sm-12 form-group">
                        <input type="text" class="form-control"  placeholder="Event Name" minlength="5" required value="{{ isset($result)? $result->name:'' }}" name="name">
                        @if($errors->get('name')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('name')[0] }}</div>
                        @endif
                    </div>

                    <div class="col-sm-6 form-group">
                        <label for="event_time">Event Time(hrs:min)</label>
                        <input type="time" class="form-control"  placeholder="Event time" required value="{{ isset($result)? $result->event_time:'' }}" name="event_time">
                        @if($errors->get('event_time')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('event_time')[0] }}</div>
                        @endif
                    </div>

                    <div class="col-sm-6 form-group">
                        <label for="event_time">Event Category</label>
                        <select class="form-control" required name="category">
                            <option disabled {{ isset($result)?'':'selected' }}>Select Event Category</option>
                            @foreach($category as $categorys)
                                <option value="{{$categorys->category_id}}" {{ (isset($result) && $result->category_id == $categorys->category_id) ? 'selected' : '' }}>
                                    {{$categorys->category}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label for="event_date_from">Event Date From</label>
                        <input type="date" class="form-control"  placeholder="Event Date From" required value="{{ isset($result)? $eventdate[0] :'' }}" name="event_date_from">
                        @if($errors->get('event_date_from')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('event_date_from')[0] }}</div>
                        @endif
                    </div>

                    <div class="col-sm-6 form-group">
                        <label for="event_date_to">Event Date To</label>
                        <input type="date" class="form-control"  placeholder="Event Date To" value="{{ (isset($result) && count($eventdate) == 2)? $eventdate[1] :'' }}" name="event_date_to">
                        @if($errors->get('event_date_to')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('event_date_to')[0] }}</div>
                        @endif
                    </div>

                    <div class="col-sm-7 form-group">
                        <input type="url" class="form-control"  placeholder="Youtube Url" minlength="5" value="{{ isset($result)? $result->youtube_url:'' }}" name="youtube_url">
                        @if($errors->get('youtube_url')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('youtube_url')[0] }}</div>
                        @endif
                    </div>

                    <div class="col-sm-5 custom-file form-group">
                        <input type="file" class="custom-file-input form-control" id="customFile" name="banner" {{ isset($result)? '' :'required' }}>
                        <label class="custom-file-label banner" for="customFile">
                            {{ isset($result)? $result->banner :'Event Banner' }}
                        </label>
                    </div>
                    
                </div>
                <div class="row panel movingOutFoward" style="padding-top:20px !important;">
                    <h2 class="panel__title">Event Details</h2>
                    <div class="col-sm-12 form-group">
                        <select class="form-control" required name="event_type">
                            <option disabled {{ isset($result)?'':'selected' }}>Select Event Entry Fees</option>
                            <option  {{ (isset($result) && $result->event_type == 'Free') ? 'selected' : '' }}>Free</option>
                            <option {{ (isset($result) && $result->event_type == 'Paid') ? 'selected' : '' }}>Paid</option>
                        </select>
                    </div>

                    <div class="col-sm-12 form-group">
                        <select class="form-control" name="country" required>
                            <option disabled {{ isset($result)?'':'selected' }}>Select Event Country</option>
                            @foreach($location as $locations)
                                <option value="{{$locations->location_id}}" {{ (isset($result) && $result->location_id == $locations->location_id) ? 'selected' : '' }}>
                                    {{$locations->location}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-12 form-group">
                        <input type="text" class="form-control"  placeholder="Event Address" minlength="5" required value="{{ isset($result)? $result->address:'' }}" name="address">
                        @if($errors->get('address')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('address')[0] }}</div>
                        @endif
                    </div>

                    <div class="col-sm-12 form-group" style="height: 200px">
                        <textarea name="content" id="content" required><?= (isset($result)) ? html_entity_decode($result->about)  : ''; ?></textarea>
                    </div>

                </div>
                <div class="row panel movingOutFoward" style="padding-top:20px !important;">
                    <h2 class="panel__title">Sponsors Details</h2>

                    <div class="col-sm-12 form-group">
                        <label for="event_time">Moblie Number(Separate each number with a comma)</label>
                        <input type="text" class="form-control"  placeholder="eg 08011111,0800000000" minlength="11" required value="{{ isset($result)? $result->num_phone:'' }}" name="num_phone">
                        @if($errors->get('num_phone')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('num_phone')[0] }}</div>
                        @endif
                    </div>

                    <div class="col-sm-12 form-group">
                        <label for="event_time">Email(Separate each email with a comma)</label>
                        <input type="email" class="form-control"  placeholder="eg mail@example.com, mail2@example.com" required value="{{ isset($result)? $result->email:'' }}" name="email" id="email" multiple>
                        @if($errors->get('email')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('email')[0] }}</div>
                        @endif
                    </div>

                    <div class="col-sm-12 form-group">
                        <input type="text" class="form-control"  placeholder="Address" required value="{{ isset($result)? $result->office:'' }}" name="office">
                        @if($errors->get('office')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('office')[0] }}</div>
                        @endif
                    </div>

                    <div class="col-sm-12 form-group">
                        <input type="url" class="form-control"  placeholder="Offical Website" required value="{{ isset($result)? $result->website:'' }}" name="website">
                        @if($errors->get('website')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('website')[0] }}</div>
                        @endif
                    </div>

                    <div class="col-sm-12 form-group" >
                        <input type="file" class="custom-file-input form-control" id="sponsor" name="sponsor_by[]" {{ isset($result)? '' :'required' }} multiple>
                        <label class="custom-file-label sponsorName" for="customFile">
                            {{ isset($result)? " files selected" :'Event Sponsors ' }}
                        </label>
                    </div>
                </div>  
            </div>

            <div class="card-footer">
                <div class="float-right"> 
                    <button class="button previous btn btn-secondary btn-sm" style="display:none;" type="button">Previous</button>
                    <button class="button next btn btn-primary btn-sm" type="button">Next</button>
                </div>
            </div>
        </div>
    </form>
@endsection

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@section('script')

//<script>
    tinymce.init({ selector:'#content' });
    let buttonNext = document.querySelector('.next');
    let buttonPrevious = document.querySelector('.previous');
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(0);
    let forms = document.getElementsByTagName('form');
    buttonPrevious.addEventListener('click', () => { moveStep(-1)});
    buttonNext.addEventListener('click', () => { moveStep(1)});
    

    function showTab (movement) {

        if(movement == 0)buttonPrevious.style.display = "none";
        else buttonPrevious.style.display = "inline";

        let panel = document.getElementsByClassName("panel");
        if (currentTab >= panel.length)forms[1].submit();

        panel[movement].classList.add("movingIn");
        document.getElementsByClassName("card-body")[0].style.minHeight = panel[movement].offsetHeight ;
        
        if(currentTab == (panel.length -1))buttonNext.innerHTML = "Submit";
        else buttonNext.innerHTML = "Next";
    }

    function moveStep (movement) {
        forms[1].classList.remove('was-validated');
        let panel = document.getElementsByClassName("panel");
        if (movement == 1 && !validateForm()) return false;

        if(movement > 0) panel[currentTab].classList.add("movingOutBackward");
        else panel[currentTab].classList.add("movingOutFoward");
       
        panel[currentTab].classList.remove("movingIn");
        currentTab = currentTab + movement;

        if(currentTab <= 1)document.getElementsByClassName("step")[0].classList.remove("-completed");
        else document.getElementsByClassName("step")[currentTab-1].classList.remove("-completed");
        if(currentTab > 0) document.getElementsByClassName("step")[currentTab-1].classList.add("-completed");
        
        showTab (currentTab);
        panel[currentTab].classList.remove(
            'movingOutBackward',
            'movingOutFoward'
        );
    }

    function validateForm() {
        let panel = document.getElementsByClassName("panel");
        let field = panel[currentTab].querySelectorAll(".form-control");
        
        for (let i =0; i< field.length; i++){
            if(field[i].validity.valid==false){
                forms[1].classList.add('was-validated');
                return false
            }
        }
        return true;
    }

    let imgInput = document.querySelector("input[id='customFile']");

    imgInput.addEventListener('change',function(){
        var extension = this.value.substring(this.value.lastIndexOf('.') + 1).toLowerCase();
        if (extension == "png" || extension == "jpeg" || extension == "jpg") {
            document.querySelector(".banner").innerHTML = this.files[0].name;
            document.querySelector(".error").innerHTML='';
            document.getElementsByClassName("panel")[0].style.top =0;

        }else{
            document.querySelector(".error").innerHTML=`<div class="alert alert-danger alert-dismissible fade show">Invalid Event Banner  ${this.files[0].name}. Note, valid extension must be <b>"png","jpeg","jpg"</b></div>`;

            // let error=  document.getElementsByClassName("error")[0].offsetHeight;
            let panel = document.getElementsByClassName("panel")[0];
            document.getElementsByClassName("card-body")[0].style.minHeight = panel.offsetHeight;
            // panel.style.top = error;

            this.value='';
            var scrollStep = -window.scrollY / (1000/ 15),
            scrollInterval = setInterval(() => {
                if ( window.scrollY != 0 ) window.scrollBy( 0, scrollStep );
                else clearInterval(scrollInterval); 
            },15);
 
        } 
    });
    
    let sponsor = document.querySelector("input[id='sponsor']");
    sponsor.addEventListener('change',() => {
        let property=sponsor.files;
        if(property.length > 1){
           
            for (i = 0; i < property.length; i++) {
                let extension = property[i].name.substring(property[i].name.lastIndexOf('.') + 1).toLowerCase();

                if (extension != "png" && extension != "jpeg" && extension != "jpg") {
                    
                    document.querySelector(".error").innerHTML=`<div class="alert alert-danger alert-dismissible fade show">Invalid Event Banner  ${property[i].name}. Note, valid extension must be <b>"png","jpeg","jpg"</b></div>`;

                    // let error=  document.getElementsByClassName("error")[0].offsetHeight;
                    let panel = document.getElementsByClassName("panel")[1];
                    document.getElementsByClassName("card-body")[0].style.minHeight = panel.offsetHeight;
                    // panel.style.top = error;

                    sponsor.value=[];
                    var scrollStep = -window.scrollY / (1000/ 15),
                    scrollInterval = setInterval(() => {
                        if ( window.scrollY != 0 ) window.scrollBy( 0, scrollStep );
                        else clearInterval(scrollInterval); 
                    },15);
                    break;
                }else{
                    document.querySelector(".sponsorName").innerHTML = `${property.length} sponsor selected`;
                    document.querySelector(".error").innerHTML='';
                    document.getElementsByClassName("panel")[1].style.top =0;
                }

            }

        }else{
            let extension = property[0].name.substring(property[0].name.lastIndexOf('.') + 1).toLowerCase();
            if (extension == "png" || extension == "jpeg" || extension == "jpg") {
                document.querySelector(".sponsorName").innerHTML = property[0].name;
                document.querySelector(".error").innerHTML='';
                document.getElementsByClassName("panel")[1].style.top =0;

            }else{
                document.querySelector(".error").innerHTML=`<div class="alert alert-danger alert-dismissible fade show">Invalid Event Banner  ${property[0].name}. Note, valid extension must be <b>"png","jpeg","jpg"</b></div>`;

                // let error=  document.getElementsByClassName("error")[0].offsetHeight;
                let panel = document.getElementsByClassName("panel")[1];
                document.getElementsByClassName("card-body")[0].style.minHeight = panel.offsetHeight;
                // panel.style.top = error;

                sponsor.value=[];
                var scrollStep = -window.scrollY / (1000/ 15),
                scrollInterval = setInterval(() => {
                    if ( window.scrollY != 0 ) window.scrollBy( 0, scrollStep );
                    else clearInterval(scrollInterval); 
                },15);
    
            } 
        }
    });

    
@endsection