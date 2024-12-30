<div>
    <div class="container">
            <table class="table table-bordered" border="1" style="width:100%;">
                <tr>
                    <td class="logo text-center"><img src="{{asset('/img/logo.png')}}" style="width:150px;height:180px;"/></td>
                    <td style="text-align: center;">
                        <span>গণপ্রতাতন্ত্রী বাংলাদেশ সরকার</span><br>
                        <span style="font-weight: bold; font-size:20px;">সরকারি আনন্দ মোহন কলেজ</span><br>
                        <span>ময়মনসিংহ</span><br>
                        <span>কলেজ কোড: ৩৭২৫, EIIN: 111911</span><br>
                        <span style="font-weight: bold; font-size:18px;">একাদশ শ্রেণীর ভর্তি ফরম</span><br>
                        @if($ssc_info->hsc_group=='Science')
                            <span>(বিজ্ঞান)</span>
                        @elseif($ssc_info->hsc_group=='Business Studies')
                            <span>(ব্যবসায় শিক্ষা)</span>
                        @elseif($ssc_info->hsc_group=='Humanities')
                            <span>(মানবিক)</span>
                        @endif
                    </td>
                    <td>
                        <div style="border: 2px solid #007bff; border-radius: 10px; width: 150px; margin: auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
                                <img src="{{ $form['photo'] }}" alt="Photo"
                                     style="width: 100%; height: auto; border-radius: 5px;"
                                     class="img-thumbnail">
                            <h4 class="text-center"><b>Photo</b></h4>
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
                        <div class="row container-fluid">
                            <div class="col-md-12 bg-info text-center">S.S.C Information</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <span style="font-weight: bold;"> Board: {{$ssc_info->board_name}}</span>
                            </div>
                            <div class="col-md-3">
                                <span style="font-weight: bold;"> Roll Number:  {{$ssc_info->roll}}</span>
                            </div>
                            <div class="col-md-3">
                                <span style="font-weight: bold;"> GPA:  {{$ssc_info->gpa}}</span>
                            </div>
                            <div class="col-md-3">
                                <span style="font-weight: bold;"> Group:  {{$ssc_info->ssc_group}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <span style="font-weight: bold;"> Passing Year: {{$ssc_info->passing_year}}</span>
                            </div>
                            <div class="col-md-3">
                                <span style="font-weight: bold;"> Reg Number: {{$ssc_info->registration}}</span>
                            </div>
                            <div class="col-md-3">
                                <span style="font-weight: bold;"> Session: {{$ssc_info->session}}</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row container-fluid">
                            <div class="col-md-12 bg-info text-center">Student Information</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <span style="font-weight: bold;">eSIF Serial No:</span> <input class="form-control"
                                                                                               wire:model="form.esif"
                                                                                               id="esif"
                                                                                               type="text"
                                                                                               style="width:100%;"
                                                                                               placeholder="" name=""/>
                            </div>
                            <div class="col-md-3">
                                <span style="font-weight: bold;"> Quota:</span>
                                <select class="form-control" wire:model="form.quota">
                                    <option>Select</option>
                                    <option value="1">No Quota</option>
                                    <option value="2">FQ</option>
                                    <option value="3">EQ</option>
                                    <option value="4">SQ</option>
                                    <option value="5">PQ</option>
                                </select>
                            </div>

                            <div class="col-md-3">Date of Birth: <input wire:model="form.dob" class="form-control"
                                                                        type="date"/>
                            </div>
                            <div class="col-md-3">Birth Registration Number <input wire:model="form.brn"
                                                                                   class="form-control" type="number"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Gender : <select wire:model="form.gender" class="form-control">
                                    <option>Select</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                            <div class="col-md-3">Religion : <select wire:model="form.religion" class="form-control">
                                    <option>Select</option>
                                    <option value="1">Islam</option>
                                    <option value="2">Hinduism</option>
                                    <option value="3">Buddhism</option>
                                    <option value="4">Christianity</option>
                                    <option value="5">Other</option>
                                </select>
                            </div>
                            <div class="col-md-3">Nationality :
                                <input type="text" value="Bangladeshi By Birth" disabled class="form-control"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-right">Student's Name in English:</div>
                            <div class="col-md-8"><input wire:model="form.name" class="form-control" type="text"
                                                         style="width:100%"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-right">(বাংলায়):</div>
                            <div class="col-md-8"><input wire:model="form.name_bn" class="form-control" type="text"
                                                         style="width:100%"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-right">Father's Name in English:</div>
                            <div class="col-md-8"><input wire:model="form.father_name" class="form-control" type="text"
                                                         style="width:100%"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-right">(বাংলায়):</div>
                            <div class="col-md-8"><input wire:model="form.father_name_bn" class="form-control"
                                                         type="text"
                                                         style="width:100%"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-right">Mother's Name in English:</div>
                            <div class="col-md-8"><input wire:model="form.mother_name" class="form-control" type="text"
                                                         style="width:100%"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-right">(বাংলায়):</div>
                            <div class="col-md-8"><input wire:model="form.mother_name_bn" class="form-control"
                                                         type="text"
                                                         style="width:100%"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-right">Local Guardian's Name in English:</div>
                            <div class="col-md-8"><input wire:model="form.local_guardian_name" class="form-control"
                                                         type="text" style="width:100%"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-right">(বাংলায়):</div>
                            <div class="col-md-8"><input wire:model="form.local_guardian_name_bn" class="form-control"
                                                         type="text" style="width:100%"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Relation with local guardian: <input
                                        wire:model="form.relation_with_local_guardian" type="text"
                                        class="form-control w-100"/>
                            </div>
                            <div class="col-md-4">Local guardian contact number: <input
                                        wire:model="form.local_guardian_contact" type="text"
                                        class="form-control w-100"/>
                            </div>
                            <div class="col-md-4">Guardian's Yearly Income<input
                                        wire:model="form.guardian_yearly_income"
                                        type="text" class="form-control w-100"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Self Mobile Number: <input wire:model="form.self_mobile" type="text"
                                                                             class="form-control w-100"/>
                            </div>
                            <div class="col-md-3">Father's Mobile Number:<input wire:model="form.father_mobile"
                                                                                type="text"
                                                                                class="form-control w-100"/>
                            </div>
                            <div class="col-md-3">Mother's Mobile Number: <input wire:model="form.mother_mobile"
                                                                                 type="text"
                                                                                 class="form-control w-100"/>
                            </div>
                            <div class="col-md-3">Email (self)<input wire:model="form.email" type="email"
                                                                     class="form-control w-100"/></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row container-fluid">
                            <div class="col-md-12 bg-info text-center">Address</div>
                        </div>
                        <h5>Present Address:</h5>
                        <div class="row">
                            <div class="col-md-4">
                                Village/Area/Road: <input wire:model="form.present_vill" type="text"
                                                          class="form-control"/>
                            </div>
                            <div class="col-md-4">
                                Post Office: <input wire:model="form.present_post_office" type="text"
                                                    class="form-control"/>
                            </div>
                            <div class="col-md-4">
                                Post Code: <input wire:model="form.present_post_code" type="number"
                                                  class="form-control"/>
                            </div>
                            <div class="col-md-4">District:
                                <select wire:model.defer="form.present_district" class="form-control"
                                        id="present_district"
                                        wire:change="changePresentDistrict()">
                                    <option>Select</option>
                                    @foreach(\App\Helpers\GetDistrict::GetAllDistricts() as $key=>$val)
                                        <option value="{{__($val->DISTRICT_ID )}}">{{__($val->DISTRICT_NAME)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">Upazila/Thana:
                                <select wire:model="form.present_thana" class="form-control" id="present_thana">
                                    <option>Select</option>
                                    @foreach(\App\Helpers\GetThanas::GetThanas($form['present_district']) as $key=>$val)
                                        <option value="{{__($val->THANA_ID )}}">{{__($val->THANA_NAME)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h5>Permanent Address:</h5>
                        <div class="row">
                            <div class="col-md-4">
                                Village/Area/Road: <input wire:model="form.permanent_vill" type="text"
                                                          class="form-control"/>
                            </div>
                            <div class="col-md-4">
                                Post Office: <input wire:model="form.permanent_post_office" type="text"
                                                    class="form-control"/>
                            </div>
                            <div class="col-md-4">
                                Post Code: <input wire:model="form.permanent_post_code" type="number"
                                                  class="form-control"/>
                            </div>
                            <div class="col-md-4">District:
                                <select wire:model.defer="form.permanent_district" class="form-control"
                                        id="permanent_district"
                                        wire:change="changePermanentDistrict()">
                                    <option>Select</option>
                                    @foreach(\App\Helpers\GetDistrict::GetAllDistricts() as $key=>$val)
                                        <option value="{{__($val->DISTRICT_ID )}}">{{__($val->DISTRICT_NAME)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">Upazila/Thana:
                                <select wire:model="form.permanent_thana" class="form-control" id="permanent_thana">
                                    <option>Select</option>
                                    @foreach(\App\Helpers\GetThanas::GetThanas($form['permanent_district']) as $key=>$val)
                                        <option value="{{__($val->THANA_ID )}}">{{__($val->THANA_NAME)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row container-fluid">
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
                                4. <select id="es_4" wire:model="form.es_4" class="">
                                    <option>Select</option>
                                    @foreach($subjects[$ssc_info->hsc_group] as $key => $val)
                                        <option value="{{ $key }}">
                                            {{ array_key_first($val) }}
                                            [ {{ implode('-', $val[array_key_first($val)]) }} ]
                                        </option>
                                    @endforeach
                                </select> <br>
                                5. <select id="es_5" wire:model="form.es_5" class="">
                                    <option>Select</option>
                                    @foreach($subjects[$ssc_info->hsc_group] as $key => $val)
                                        <option value="{{ $key }}">
                                            {{ array_key_first($val) }}
                                            [ {{ implode('-', $val[array_key_first($val)]) }} ]
                                        </option>
                                    @endforeach
                                </select> <br>
                                6. <select id="es_6" wire:model="form.es_6" class="">
                                    <option>Select</option>
                                    @foreach($subjects[$ssc_info->hsc_group] as $key => $val)
                                        <option value="{{ $key }}">
                                            {{ array_key_first($val) }}
                                            [ {{ implode('-', $val[array_key_first($val)]) }} ]
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                Fourth Subject (with code): <br>
                                7. <select id="es_7" wire:model="form.es_7" class="">
                                    <option>Select</option>
                                    @foreach($subjects[$ssc_info->hsc_group] as $key => $val)
                                        <option value="{{ $key }}">
                                            {{ array_key_first($val) }}
                                            [ {{ implode('-', $val[array_key_first($val)]) }} ]
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row container-fluid">
                            <div class="col-md-12 bg-info text-center">Transaction Information</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Transaction Type
                                <select wire:model="form.transaction_type" class="form-control">
                                    <option>Select</option>
                                    <option value="1">Bank</option>
                                </select>
                            </div>
                            <div class="col-md-4">Name of Bank
                                <select wire:model="form.bank_name" class="form-control">
                                    <option>Select</option>
                                    <option value="1">Sonali Bank</option>
                                    <option value="2">Rupali Bank</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Date of Transaction
                                <input wire:model="form.transaction_date" class="form-control" type="date"/>
                            </div>
                            <div class="col-md-4">Transaction Number
                                <input wire:model="form.transaction_number" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4">Transaction Amount
                                <input wire:model="form.transaction_amount" class="form-control" type="text"/>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="bg-info text-center">
                <a href="{{route('students.registration-form')}}"><button type="button" class="btn btn-animate btn-warning">Back to Home</button></a>
            </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Select all input, select, and textarea elements
            const formElements = document.querySelectorAll('input, select, textarea');

            // Disable each element
            formElements.forEach(element => {
                element.disabled = true;
            });
        });
    </script>
</div>
