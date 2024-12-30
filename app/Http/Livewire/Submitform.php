<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\StudentsSscInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Models\RegistrationForm;

class Submitform extends Component
{
    use WithFileUploads;

    public $photo;
    public $uploadedPhotoUrl;
    public $form;
    public $ssc_info;
    public $present_district;
    public $permanent_district;
    public $subjects = [
        "Science" => [1 => ["Physics" => [174, 175]], 2 => ["Chemistry" => [176, 177]], 3 => ["Biology" => [178, 179]], 4 => ["Math" => [265, 266]]],
        "Business Studies" => [5 => ["Accounting" => [253, 254]], 6 => ["Business & Organization" => [277, 278]], 7 => ["Production Management & Marketing" => [286, 287]], 8 => ["Finance, Banking & Insurance" => [292, 293]]],
        "Humanities" => [9 => ["Logic" => [121, 122]], 10 => ["Economics" => [109, 110]], 11 => ["Social Work" => [271, 272]], 12 => ["Civics & Good Governance" => [269, 270]], 13 => ["Islamic History & Culture" => [267, 268]], 14 => ["Islamic Studies" => [249, 250]]]
    ];
    protected $rules = [
        'ssc_info.board_name' => 'required',
        'ssc_info.roll' => 'required',
        'ssc_info.gpa' => 'required',
        'ssc_info.ssc_group' => 'required',
        'ssc_info.passing_year' => 'required',
        'ssc_info.registration' => 'required',
        'ssc_info.session' => 'required',
        'form.name' => 'required|string|max:100',
        'form.name_bn' => 'required|string|max:100',
        'form.father_name' => 'required|string|max:100',
        'form.father_name_bn' => 'required|string|max:100',
        'form.mother_name' => 'required|string|max:100',
        'form.mother_name_bn' => 'required|string|max:100',
        'form.local_guardian_name' => 'required|string|max:100',
        'form.local_guardian_name_bn' => 'required|string|max:100',
        'form.relation_with_local_guardian' => 'required|string|max:100',
        'form.local_guardian_contact' => 'required|string|max:100',
        'form.guardian_yearly_income' => 'required|string|max:50',
        'form.self_mobile' => 'nullable|string|max:20',
        'form.father_mobile' => 'nullable|string|max:20',
        'form.mother_mobile' => 'nullable|string|max:20',
        'form.email' => 'nullable|email|max:100',
        'form.photo' => 'required|string|max:250',
        'form.present_vill' => 'required|string|max:100',
        'form.present_post_office' => 'required|string|max:100',
        'form.present_post_code' => 'nullable|string|max:100',
        'form.present_district' => 'required|integer',
        'form.present_thana' => 'required|integer',
        'form.permanent_vill' => 'required|string|max:100',
        'form.permanent_post_office' => 'required|string|max:100',
        'form.permanent_post_code' => 'nullable|string|max:100',
        'form.permanent_district' => 'required|integer',
        'form.permanent_thana' => 'required|integer',
        'form.es_4' => 'required|integer',
        'form.es_5' => 'required|integer',
        'form.es_6' => 'required|integer',
        'form.es_7' => 'required|integer',
        'form.transaction_number' => 'required|string|max:100',
        'form.transaction_amount' => 'required|string|max:100',
        'form.esif' => 'required|string|max:100',
        'form.quota' => 'required|integer',
        'form.dob' => 'required|date',
        'form.brn' => 'required|string|max:100',
        'form.gender' => 'required|integer',
        'form.religion' => 'required|integer',
        'form.user_id' => 'required|unique:registration_form,user_id',
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
        $this->ssc_info = StudentsSscInfo::where(['mobile' => Auth::user()->email])->first();
    }

    public function render()
    {
        $isSaved = RegistrationForm::where('user_id', Auth::id())->first();
        if ($isSaved) {
            return view('students.dashboard')->with(['isApproved' => $isSaved->approved]);
        }
        return view('livewire.submitform');
    }

    public function update()
    {

    }

    public function submitForm()
    {
        try {
            $this->form["photo"] = $this->uploadedPhotoUrl;
            $this->form["user_id"] = Auth::id();
            $this->form["transaction_number"] = date("Y").$this->form['roll'];
            $this->form["transaction_amount"] = Auth::id();
//            dd($this->form);exit;
            // Validate form data
//            $this->ssc_info->save();

//            dd($this->ssc_info);exit;
            $this->validate();

            // Save the registration form data in the database
//            $this->form->save(); // Automatically updates created_at and updated_at fields
            RegistrationForm::create($this->form);
            $this->ssc_info->save();
            // Success message
            session()->flash('success', 'Registration form saved successfully!');
            return redirect()->route('students.registration-form');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all(); // Get all error messages as an array

            // Join them into a string, separated by a line break or another separator if needed
            $errorMessages = implode('<br>', $errors);

            // Display the errors
            session()->flash('error', 'There was a problem with your input: ' . $errorMessages);
        } catch (\Exception $e) {
            // General error handling - for issues with saving to the database
            session()->flash('error', $e->getMessage());
        }
    }

    public function removeSessionError()
    {
        session()->forget('error');
    }

    public function uploadPhoto()
    {
        $this->validate([
            'photo' => 'image|max:2048', // Validate the uploaded file
        ]);
        // Get the uploaded image dimensions
        $imageDimensions = getimagesize($this->photo->getRealPath());
//        $width = $imageDimensions[0];
//        $height = $imageDimensions[1];
//
//        // Check if the image is exactly 300x300
//        if ($width !== 300 || $height !== 300) {
//            session()->flash('error', 'The image must be exactly 300x300px.');
//            return;
//        }

        $path = $this->photo->store('photos', 'public'); // Save photo in `storage/app/public/photos`
        $this->uploadedPhotoUrl = asset('storage/' . $path); // Generate URL to the uploaded image

    }
}
