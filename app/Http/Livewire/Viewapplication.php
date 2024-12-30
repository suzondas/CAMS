<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\StudentsSscInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Traits\HasProfilePhoto;
use App\Models\RegistrationForm;

class Viewapplication extends Component
{
    use WithFileUploads;
    use HasProfilePhoto;

    public $photo;
    public $form;
    public $ssc_info;
    public $present_district;
    public $permanent_district;
    public $subjects = [
        "Science" => [1 => ["Physics" => [174, 175]], 2 => ["Chemistry" => [176, 177]], 3 => ["Biology" => [178, 179]], 4 => ["Math" => [265, 266]]],
        "Business Studies" => [5 => ["Accounting" => [253, 254]], 6 => ["Business & Organization" => [277, 278]], 7 => ["Production Management & Marketing" => [286, 287]], 8 => ["Finance, Banking & Insurance" => [292, 293]]],
        "Humanities" => [9 => ["Logic" => [121, 122]], 10 => ["Economics" => [109, 110]], 11 => ["Social Work" => [271, 272]], 12 => ["Civics & Good Governance" => [269, 270]], 13 => ["Islamic History & Culture" => [267, 268]], 14 => ["Islamic Studies" => [249, 250]]]
    ];


    public function changePresentDistrict()
    {
        $this->present_district = $this->form["present_district"];
    }

    public function changePermanentDistrict()
    {
        $this->permanent_district = $this->form["permanent_district"];
    }


    public function mount()
    {
        $reg_data = RegistrationForm::where('user_id', Auth::id())->first();
        if(!$reg_data){
            return $this->redirectRoute('students.registration-form');
        }
        $this->form = $reg_data->toArray();
        $this->ssc_info = StudentsSscInfo::where(['mobile' => Auth::user()->email])->first();
    }

    public function render()
    {
        return view('livewire.viewapplication');
    }
}
