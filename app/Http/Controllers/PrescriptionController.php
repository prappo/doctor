<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;

use App\Http\Requests;

class PrescriptionController extends Controller
{
    public function index(){
        return view('prescription.index');
    }

    public function download(){
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $content = '
        
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prescription</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <style>
        #statusTop {
            border-top: 2px solid black;
            border-bottom: 2px solid black;
        }

        #rightDev {
            border-right: 2px solid black;
            min-height: 130px;
            padding: 20px;
        }

        #statusBottom {
            border-top: 2px solid black;
        }

        .container {
            border: 2px solid black;
        }


    </style>
</head>
<body>
<a href="#" onclick="return xepOnline.Formatter.Format(\'box\');">
    <img src="button-print.png">
</a>
<div id="box" class="container">
    <div class="row">
        <div class="col-md-6 pull-left">
            <b><h4 style="color:#35773B">Dr. Raihan Rabbani</h4></b>
            <b style="color: #34298A">MBBS, FCPS, US Board Certified in Internal Medicine</b><br>
            <b style="color: #34298A">Consultant, Internal Medicine</b> <br>
            <b style="color: #35773B">Email: doc1@email.com</b>
        </div>

        <div class="col-md-6 text-right">
            <b><h4 style="color:#35773B">ডাঃ রাইহান রাব্বানি</h4></b>
            <b style="color: #34298A">এমবিবিএস, এফসিপিএস, ইউএস বোরড সারটিফাইড ইন ইন্তারনাল মেডিসিন</b><br>
            <b style="color: #34298A">কন্সাল্টেন্ট, ইন্তারনাল মেডীসিন</b> <br>
            <b style="color: #35773B">Email: doc1@email.com</b>
        </div>
    </div>
    <div id="statusTop" class="row">

        <div class="col-md-2">
            <b>PDI-1232</b>
        </div>
        <div class="col-md-3">
            <b>Name: Prappo Islam Prince</b>
        </div>
        <div class="col-md-3">
            <b>SEX: M</b>
        </div>
        <div class="col-md-2">
            <b>Age: 50</b>
        </div>
        <div class="col-md-2">
            <b>Date: 02-04-2018</b>
        </div>

    </div>


    <div class="row">
        <div id="rightDev" class="col-md-4">
            <h4><b style="color:#34298A">Chief Complaints :</b><br></h4>
            <div class="text-left" style="padding-left: 10px" align="center">
                <b>#38 Wks</b><br>
                <b>#Weakness</b><br>
                <b>#Joint pain</b>
            </div>

            <h4><b style="color:#34298A">General Examinations</b><br></h4>
            <div class="text-left" style="padding-left: 10px" align="center">
                <b>Pulse: 75</b><br>
                <b>B/P: 120/80</b><br>

            </div>

            <h4><b style="color:#34298A">Advice for investigations</b><br></h4>
            <div class="text-left" style="padding-left: 10px" align="center">
                <b>USG of whole Abdomen</b><br>

            </div>
        </div>

        <div class="col-md-8">
            <div style="padding:10px" class="row">
                <img height="50" width="50" src="http://localhost:8000/images/optimus/rx.png">
            </div>
            <div class="row">
                <div class="text-left" style="padding-left: 10px" align="center">
                    <b>Tab. Zeefol -- ১-০-১ ------৩০ দিন</b><br>
                    <b>Tab. Zeefol -- ১-০-১ ------৩০ দিন</b><br>
                    <b>Tab. Zeefol -- ১-০-১ ------৩০ দিন</b><br>


                </div>
            </div>
            <br><br>

            <div class="row">
                <div class="text-left" style="padding-left: 10px" align="center">
                    <h4><b style="color:blue">Advice:</b></h4>
                    <b>ভারি কাজ করবেন না </b><br>


                </div>
            </div>
            <br><br>

            <div class="row">
                <div class="text-left" style="padding-left: 10px" align="center">
                    <h4><b style="color:blue">Next vist date:</b></h4>
                    <b>12-4-2018</b><br>


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
            মোবাইল ঃ ০১৭৮০১৭৯৫১১ <br>
            ( জরুরী প্রয়োজনে যে কোন সময় )
        </div>
        <div class="col-md-4 text-right">চেম্বার/ বাসা ঃ চৌধুরি জেনেরাল হাসপাতাল
            চৌমুখি পৌরসভা , নোয়াখালি
            রগী দেখার সময় ঃ বিকাল ৪টা - রাত ৮টা
        </div>


    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<script src="http://www.cloudformatter.com/Resources/Pages/CSS2Pdf/Script/xepOnline.jqPlugin.js"></script>
<script>


    var doc = new jsPDF();
    var specialElementHandlers = {
        \'#editor\': function (element, renderer) {
            return true;
        }
    };

    $(\'#cmd\').click(function () {
        doc.fromHTML($(\'#box\').html(), 15, 15, {
            \'width\': 170,
            \'elementHandlers\': specialElementHandlers
        });
        doc.save(\'sample-file.pdf\');
    });

    // This code is collected but useful, click below to jsfiddle link.

</script>
</body>
</html>
        ';
        $dompdf->loadHtml($content);

// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
        $dompdf->render();

// Output the generated PDF to Browser
        $dompdf->stream();
    }
}
