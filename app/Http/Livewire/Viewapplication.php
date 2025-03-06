<?php

namespace App\Http\Livewire;

use App\Models\User;
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
    public $suggested_roll = 0;
    public $hsc_roll;
    public $hsc_section;
    public $reg_id;
    public $student_id;
    public $studentView = false;
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

    public function suggested_roll($hsc_group)
    {
        $lastHscRoll = RegistrationForm::whereHas('ssc_info', function ($query) use ($hsc_group) {
            $query->where('hsc_group', $hsc_group);
        })->orderBy('id', 'desc')->value('hsc_roll');
        return intval($lastHscRoll) + 1;
    }

    public function mount($id = null)
    {
        if ($id) {
            $this->studentView = true;
            $this->student_id = $id;
            $reg_data = RegistrationForm::with('transaction')->where('user_id', $id)->first();
            $this->reg_id = $reg_data->id;
            $user_data = User::find($id);
            $this->ssc_info = StudentsSscInfo::where(['mobile' => $user_data->email])->first();
            $this->hsc_roll = $this->suggested_roll($this->ssc_info->hsc_group);
            $this->form = $reg_data->toArray();
//            dd($this->suggested_roll);
        } else {
            $reg_data = RegistrationForm::with('transaction')->where('user_id', Auth::id())->first();
            if (!$reg_data) {
                return $this->redirectRoute('students.registration-form');
            }
            $this->form = $reg_data->toArray();
            $this->ssc_info = StudentsSscInfo::where(['mobile' => Auth::user()->email])->first();
        }
    }

    public function render()
    {
        return view($this->studentView ? 'livewire.moderator-viewapplication' : 'livewire.viewapplication');
    }

    public function approve()
    {
        try {
            RegistrationForm::find($this->reg_id)->update(['hsc_roll' => $this->hsc_roll, 'hsc_section' => $this->hsc_section, 'approved' => 1]);
            return redirect()->route('students.view-student', $this->student_id);
        } catch (\Exception $exception) {
            dd($exception);
        }
    }
}
