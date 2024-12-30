<?php

namespace App\Http\Controllers;

use App\Models\StudentsSscInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\Cast\Object_;
use Twilio\Rest\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentRegistrationController extends Controller
{
    // Show the registration page
    public function showRegister()
    {
        return view('students.register');
    }

    // Send OTP to the student's mobile number after validation of SSC roll, registration number, and mobile
    public function sendOtp(Request $request)
    {
        // Validate input

        // Validate input
        $request->validate([
            'board_name' => 'required|string',
            'ssc_group' => 'required|string',
            'roll' => 'required',
            'hsc_group' => 'hsc_group',
//            'registration_number' => 'required|string',
            'mobile' => 'required|digits:11|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], ['mobile.unique' => 'This mobile number already registered']);

        //search record
        /* $student = StudentsSscInfo::where('roll', $request->ssc_roll)
             ->where('board_name', $request->input('board_name'))
             ->where('ssc_group', $request->input('ssc_group'))
             ->first();

         if (!$student) {
             return back()->withErrors('Student information not found.');
         }

         if ($student->registered == 1) {
             return back()->withErrors('This student is already registered.');
         }*/

        // Generate OTP
        $otp = rand(100000, 999999);  // Generate a 6-digit OTP

        // Save OTP in session (this could also be stored in the database with expiration)
        Session::put('otp', 1234);
//        Session::put('student_id', $student->id);
        Session::put('password', $request->input('password'));
        Session::put('mobile', $request->input('mobile'));
        Session::put('board_name', $request->input('board_name'));
        Session::put('ssc_group', $request->input('ssc_group'));
        Session::put('roll', $request->input('roll'));
        Session::put('hsc_group', $request->input('hsc_group'));
//        Session::put('name', $student->name);
        return redirect()->route('student.register.otp')
            ->with('success', 'OTP sent successfully to provided mobile number');
        /*=============================OTP API=======================*/
        /*try {
            $twilio = new Client('AC91e3ed142e4bc8e55a7892fe3dfe9d46', 'dd95b79e254194d43c145ad2bed6129c');
            $twilio->messages->create(
                '+88' . $student->mobile, // Add country code for Bangladesh
                [
                    'from' => '+19788308948',
                    'body' => 'Your OTP for college admission is: ' . $otp,
                ]
            );

            return redirect()->route('student.register.otp')
                ->with('success', 'OTP sent successfully to your mobile number used in HSC Admission System.');
        } catch (\Exception $e) {
            return back()->withErrors('Failed to send OTP: ' . $e->getMessage());
        }

        return back()->withErrors('Failed to send OTP. Please try again.');*/
        /*=============================OTP API=======================*/
    }

    // Show OTP verification form
    public function showOtpForm()
    {
        return view('students.otp-verification');
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $password = Session::get('password'); // Retrieve password from session
        if (!$password) {
            return back()->withErrors('Password not found. Please retry registration.');
        }
        // Validate OTP input
        $request->validate([
            'otp' => 'required|digits:4',
        ]);

        // Check if the OTP matches
        if ($request->input('otp') == Session::get('otp')) {

            // Retrieve student info from session
            /*  $studentId = Session::get('student_id');
              $student = StudentsSscInfo::find($studentId);

              if (!$student) {
                  return back()->withErrors('Student record not found.');
              }*/


            // Create a new user in Voyager users table
            try {
                $sscInfo = StudentsSscInfo::create([
                    'board_name' => Session::get('board_name'),
                    'ssc_group' => Session::get('ssc_group'),
                    'roll' => Session::get('roll'),
                    'hsc_group' => Session::get('hsc_group'),
                    'mobile' => Session::get('mobile'),
                ]);
                $user = User::create([
                    'email' => Session::get('mobile'), // Use mobile as email
                    'password' => Hash::make($password),     // Encrypted password
                    'role_id' => 2,                               // Assign "user" role (adjust as needed)
                    'avatar' => 'users/default.png',              // Default avatar
                ]);

                // Update 'registered' column to 1
                $sscInfo->registered = 1;
                $sscInfo->save();
            } catch (\Exception $e) {
                // Log the user out from the current session and clear OTP
                Session::forget('otp');
                Session::forget('student_id');
                Session::forget('password');
                Session::forget('board_name');
                Session::forget('ssc_group');
                Session::forget('roll');
                Session::forget('hsc_group');
                Session::forget('mobile');

                // Redirect to Home
                return redirect()->route('student.register')->withErrors('Failed to Register ' . $e->getMessage());
            }

            // Log the user out from the current session and clear OTP
            Session::forget('otp');
            Session::forget('student_id');
            Session::forget('password');
            Session::forget('board_name');
            Session::forget('ssc_group');
            Session::forget('roll');
            Session::forget('hsc_group');
            Session::forget('mobile');

            // Redirect to Voyager admin login
            return redirect()->route('voyager.login')->with('success', 'Account created successfully! Please log in.');
        } else {
            return back()->withErrors('Invalid OTP. Please try again.');
        }
    }

    /*  */

    function openRegistrationForm()
    {
        $student = new \stdClass();
        $student->ssc_info = StudentsSscInfo::where(['mobile' => Auth::user()->email])->first();

        return view('students.registration-form')->with(['student' => $student]);
    }

}
