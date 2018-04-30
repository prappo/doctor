
@foreach($datas as $data)
    <div id="box" style="background: white" class="container">
        <div class="row">
            <div class="col-md-6 pull-left">
                <b><h4 style="color:#35773B">{{\App\User::where('id',$data->to)->value('name')}}</h4></b>
                <b style="color: #34298A">{{\App\User::where('id',$data->to)->value('bio')}}</b><br>
                <b style="color: #34298A">Consultant, Internal Medicine</b> <br>
                <b style="color: #35773B">Email: {{\App\User::where('id',$data->to)->value('email')}}</b>
            </div>

            <div class="col-md-6 text-right">
                <b><h4 style="color:#35773B">ডাঃ রাইহান রাব্বানি</h4></b>
                <b style="color: #34298A">এমবিবিএস, এফসিপিএস, ইউএস বোরড সারটিফাইড ইন ইন্তারনাল
                    মেডিসিন</b><br>
                <b style="color: #34298A">কন্সাল্টেন্ট, ইন্তারনাল মেডীসিন</b> <br>
                <b style="color: #35773B">Email: doc1@email.com</b>
            </div>
        </div>
        <div id="statusTop" class="row">

            <div class="col-md-2">
                <b>PDI-{{$data->pId}}</b>
            </div>
            <div class="col-md-3">
                <b>Name: {{\App\User::where('id',$data->from)->value('name')}}</b>
            </div>
            <div class="col-md-3">
                <b>SEX: {{$data->sex}}</b>
            </div>
            <div class="col-md-2">
                <b>Age: {{$data->age}}</b>
            </div>
            <div class="col-md-2">
                <b>Date: {{\Carbon\Carbon::parse($data->created_at)->format('Y-m-d')}}</b>
            </div>

        </div>
        <div class="row">
            <div id="" class="col-md-4">
                <h4><b style="color:#34298A">Chief Complaints :</b><br></h4>
                <div class="text-left" style="padding-left: 10px" align="center">
                    {{--<b>#38 Wks</b><br>--}}
                    {{--<b>#Weakness</b><br>--}}
                    {{--<b>#Joint pain</b>--}}
                    {!! $data->chief_complaints !!}
                </div>

                <h4><b style="color:#34298A">General Examinations</b><br></h4>
                <div class="text-left" style="padding-left: 10px" align="center">
                    {{--<b>Pulse: 75</b><br>--}}
                    {{--<b>B/P: 120/80</b><br>--}}

                    {!! $data->general_examinations !!}


                </div>

                <h4><b style="color:#34298A">Advice for investigations</b><br></h4>
                <div class="text-left" style="padding-left: 10px" align="center">
                    {!! $data->advice_for_investigations !!}

                </div>
            </div>

            <div id="rightDev" class="col-md-8">
                <div style="padding:10px" class="row">
                    <img height="50" width="50" src="{{url('/images/optimus/rx.png')}}">
                </div>
                <div class="row">
                    <div class="text-left" style="padding-left: 10px" align="center">
                        {!! $data->rx !!}

                    </div>
                </div>
                <br><br>

                <div class="row">
                    <div class="text-left" style="padding-left: 10px" align="center">
                        <h4><b style="color:blue">Advice:</b></h4>
                        {!! $data->advice !!}


                    </div>
                </div>
                <br><br>

                <div class="row">
                    <div class="text-left" style="padding-left: 10px" align="center">
                        <h4><b style="color:blue">Next visit date:</b></h4>
                        <b>{{$data->next_visit_date}}</b><br>


                    </div>
                </div>
            </div>
        </div>

        <div id="statusBottom" class="row">

            <div class="col-md-4 text-left">চেম্বার / বাসা ঃ ফেনী প্রাইভেট হাসপাতাল
                এস এস কে রদ ( হলি ক্রিসেন্ট স্কুল সংলগ্ন ) , ফেনী<br>
                রোগী দেখার সময় ঃ
                সকাল ৯টা - দুপুর ২ টা , রাত ৮টা - রাত ১০টা
            </div>
            <div class="col-md-4 text-center">

            </div>
            <div class="col-md-4 text-right">চেম্বার/ বাসা ঃ চৌধুরি জেনেরাল হাসপাতাল
                চৌমুখি পৌরসভা , নোয়াখালি
                রগী দেখার সময় ঃ বিকাল ৪টা - রাত ৮টা
            </div>

        </div>

    </div>

@endforeach
