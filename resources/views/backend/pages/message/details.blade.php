@extends('backend.layout')

@section('page_title')
{{ 'All Messages' }}
@endsection

@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4>Message Details</h4>
                <div class="m-t-25">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                          <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                              <p class="pl-4" style="cursor: pointer;" href="javascript:void(0)" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                General Information
                              </p>
                            </h5>
                          </div>
                      
                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                              <p>Name: {{ $message->sender_name }}</p>
                              <p>Email: {{ $message->sender_email }}</p>
                              <p>Subject: <u>{{ $message->subject }}</u></p>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                              <p class="pl-4 collapsed" style="cursor: pointer;" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Message
                              </p>
                            </h5>
                          </div>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                              <p class="text-dark">
                                {{ $message->body }}
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                              <p class="pl-4 collapsed" style="cursor: pointer;" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Device and Location
                              </p>
                            </h5>
                          </div>
                          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <b class="d-block mb-2"><u>Device Info</u></b>
                                <p>IP: {{ $message->sender_ip }}</p>
                                @foreach ($deviceInfo as $key => $value)
                                   <p>{{ $key.": ".$value }}</p> 
                                @endforeach
                                @if ($locationInfo)
                                <b class="d-block mb-2"><u>Location Info</u></b>
                                @foreach ($locationInfo as $key => $value)
                                    <p>{{ $key.": ".$value }}</p> 
                                @endforeach
                                @endif
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
