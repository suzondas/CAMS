<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">

</head>
<body>
<div class="container">
    <form action="{{route('student.registration-form.submit')}}" method="POST" enctype="multipart/form-data"
          autocomplete="off">
        <table class="table table-bordered" border="1" style="width:100%;">
            <tr>
                <td class="logo"><img src="{{asset('/img/logo.png')}}"/></td>
                <td style="text-align: center;">
                    <span>গণপ্রতাতন্ত্রী বাংলাদেশ সরকার</span><br>
                    <span style="font-weight: bold; font-size:20px;">সরকারি আনন্দ মোহন কলেজ</span><br>
                    <span>ময়মনসিংহ</span><br>
                    <span>কলেজ কোড: ৩৭২৫, EIIN: 111911</span><br>
                    <span style="font-weight: bold; font-size:18px;">একাদশ শ্রেণীর ভর্তি ফরম</span><br>
                    @if($student->ssc_info->hsc_group=='Science')
                        <span>(বিজ্ঞান)</span>
                    @elseif($student->ssc_info->hsc_group=='Business Studies')
                        <span>(ব্যবসায় শিক্ষা)</span>
                    @elseif($student->ssc_info->hsc_group=='Humanities')
                        <span>(মানবিক)</span>
                    @endif
                </td>
                <td>
                    <div style="width:150px;height:150px;border:1px solid black;vertical-align: center; text-align: center;">
                        <h4>Photograph</h4>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="col-md-6">
                        Class Roll: <span style="color:red;"> Will be generated after Approval</span>
                    </div>
                    <div class="col-md-6">
                        Section: <span style="color:red;"> Will be generated after Approval</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row container">
                        <div class="col-md-12 bg-info text-center">S.S.C Information</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <span style="font-weight: bold;"> Board: {{$student->ssc_info->board_name}}</span>
                        </div>
                        <div class="col-md-3">
                            <span style="font-weight: bold;"> Roll Number:  {{$student->ssc_info->roll}}</span>
                        </div>
                        <div class="col-md-3">
                            <span style="font-weight: bold;"> GPA:  {{$student->ssc_info->gpa}}</span>
                        </div>
                        <div class="col-md-3">
                            <span style="font-weight: bold;"> Group:  {{$student->ssc_info->ssc_group}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <span style="font-weight: bold;"> Passing Year: {{$student->ssc_info->passing_year}}</span>
                        </div>
                        <div class="col-md-3">
                            <span style="font-weight: bold;"> Reg Number: {{$student->ssc_info->registration}}</span>
                        </div>
                        <div class="col-md-3">
                            <span style="font-weight: bold;"> Session: {{$student->ssc_info->session}}</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row container">
                        <div class="col-md-12 bg-info text-center">Student Information</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <span style="font-weight: bold;">eSIF Serial No:</span> <input class="form-control"
                                                                                           id="esif"
                                                                                           type="text"
                                                                                           style="width:100%;"
                                                                                           placeholder="" name=""/>
                        </div>
                        <div class="col-md-3">
                            <span style="font-weight: bold;"> Quota:</span>
                            <select class="form-control">
                                <option>Select</option>
                                <option>No Quota</option>
                                <option>FQ</option>
                                <option>EQ</option>
                                <option>SQ</option>
                                <option>PQ</option>
                            </select>
                        </div>

                        <div class="col-md-3">Date of Birth: <input class="form-control" type="date"/>
                        </div>
                        <div class="col-md-3">Birth Registration Number <input class="form-control" type="number"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Gender : <select class="form-control">
                                <option>Select</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="col-md-3">Religion : <select class="form-control">
                                <option>Select</option>
                                <option>Islam</option>
                                <option>Hinduism</option>
                                <option>Buddhism</option>
                                <option>Christianity</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="col-md-3">Nationality :
                            <input type="text" value="Bangladeshi By Birth" disabled class="form-control"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">Student's Name in English:</div>
                        <div class="col-md-8"><input class="form-control" type="text" style="width:100%"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">(বাংলায়):</div>
                        <div class="col-md-8"><input class="form-control" type="text" style="width:100%"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">Father's Name in English:</div>
                        <div class="col-md-8"><input class="form-control" type="text" style="width:100%"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">(বাংলায়):</div>
                        <div class="col-md-8"><input class="form-control" type="text" style="width:100%"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">Mother's Name in English:</div>
                        <div class="col-md-8"><input class="form-control" type="text" style="width:100%"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">(বাংলায়):</div>
                        <div class="col-md-8"><input class="form-control" type="text" style="width:100%"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">Local Guardian's Name in English:</div>
                        <div class="col-md-8"><input class="form-control" type="text" style="width:100%"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-right">(বাংলায়):</div>
                        <div class="col-md-8"><input class="form-control" type="text" style="width:100%"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Relation with local guardian: <input type="text"
                                                                                   class="form-control w-100"/>
                        </div>
                        <div class="col-md-4">Local guardian contact number: <input type="text"
                                                                                    class="form-control w-100"/>
                        </div>
                        <div class="col-md-4">Guardian's Yearly Income<input type="text" class="form-control w-100"
                                                                             required/></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Self Mobile Number: <input type="text" class="form-control w-100"/></div>
                        <div class="col-md-3">Father's Mobile Number:<input type="text" class="form-control w-100"/>
                        </div>
                        <div class="col-md-3">Mother's Mobile Number: <input type="text" class="form-control w-100"/>
                        </div>
                        <div class="col-md-3">Email (self)<input type="email" class="form-control w-100"/></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row container">
                        <div class="col-md-12 bg-info text-center">Address</div>
                    </div>
                    <h5>Present Address:</h5>
                    <div class="row">
                        <div class="col-md-4">
                            Village/Area/Road: <input type="text" class="form-control"/>
                        </div>
                        <div class="col-md-4">
                            Post Office: <input type="text" class="form-control"/>
                        </div>
                        <div class="col-md-4">
                            Post Code: <input type="number" class="form-control"/>
                        </div>
                        <div class="col-md-4">District:
                            <select class="form-control" id="present_district">

                            </select>
                        </div>
                        <div class="col-md-4">Upazila/Thana:
                            <select class="form-control" id="present_thana">

                            </select>
                        </div>
                    </div>
                    <hr>
                    <h5>Permanent Address:</h5>
                    <div class="row">
                        <div class="col-md-4">
                            Village/Area/Road: <input type="text" class="form-control"/>
                        </div>
                        <div class="col-md-4">
                            Post Office: <input type="text" class="form-control"/>
                        </div>
                        <div class="col-md-4">
                            Post Code: <input type="number" class="form-control"/>
                        </div>
                        <div class="col-md-4">District:
                            <select class="form-control" id="present_district">

                            </select>
                        </div>
                        <div class="col-md-4">Upazila/Thana:
                            <select class="form-control" id="present_thana">

                            </select>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row container">
                        <div class="col-md-12 bg-info text-center">Registered Subjects</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            Compulsory Subjects: <br>
                            1. Bangla I & II [101-102] <br>
                            2. English I & II [107-108]<br>
                            3. ICT [275]
                        </div>
                        <div class="col-md-4">
                            Elective Subjects (with code): <br>
                            4. <select id="es_4">

                            </select> <br>
                            5. <select id="es_5">

                            </select> <br>
                            6. <select id="es_6">

                            </select>
                        </div>
                        <div class="col-md-4">
                            Fourth Subject (with code): <br>
                            7.
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row container">
                        <div class="col-md-12 bg-info text-center">Transaction Information</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Transaction Type
                            <select class="form-control">
                                <option>Bank</option>
                            </select>
                        </div>
                        <div class="col-md-4">Name of Bank
                            <select class="form-control">
                                <option>Sonali Bank</option>
                                <option>Rupali Bank</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Date of Transaction
                            <input class="form-control" type="date"/>
                        </div>
                        <div class="col-md-4">Transaction Number
                            <input class="form-control" type="text"/>
                        </div>
                        <div class="col-md-4">Transaction Amount
                            <input class="form-control" type="text"/>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>