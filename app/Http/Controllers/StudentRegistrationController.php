<?php

namespace App\Http\Controllers;

use App\Models\StudentsSscInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Twilio\Rest\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentRegistrationController extends Controller
{
    // Show the registration page
    public function showRegistrationForm()
    {
        return view('students.register');
    }

    // Send OTP to the student's mobile number after validation of SSC roll, registration number, and mobile
    public function sendOtp(Request $request)
    {
        // Validate input

        // Validate input
        $request->validate([
            'ssc_roll' => 'required|string',
            'registration_number' => 'required|string',
//            'mobile' => 'required|digits:11',
            'password' => 'required|string|min:6|confirmed',
        ]);

        //search record
        $student = StudentsSscInfo::where('roll', $request->ssc_roll)
            ->where('registration', $request->registration_number)
            ->first();

        if (!$student) {
            return back()->withErrors('Invalid information.');
        }

        if ($student->registered == 1) {
            return back()->withErrors('This student is already registered.');
        }

        // Generate OTP
        $otp = rand(100000, 999999);  // Generate a 6-digit OTP

        // Save OTP in session (this could also be stored in the database with expiration)
        Session::put('otp', $otp);
        Session::put('student_id', $student->id);

        // Send OTP via SMS (using an API or service, here we'll mock the sending)
        // Example: SMS API integration (using a mock service here)
        try {
            $twilio = new Client('', '');
            $twilio->messages->create(
                '+88' . $student->mobile, // Add country code for Bangladesh
                [
                    'from' => '+19788308948',
                    'body' => 'Your OTP for college registration is: ' . $otp,
                ]
            );
            Session::put('password', $request->password);
            return redirect()->route('student.register.otp')
                ->with('success', 'OTP sent successfully to your mobile number used in HSC Admission System.');
        } catch (\Exception $e) {
            return back()->withErrors('Failed to send OTP: ' . $e->getMessage());
        }

        return back()->withErrors('Failed to send OTP. Please try again.');
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
            'otp' => 'required|digits:6',
        ]);

        // Check if the OTP matches
        if ($request->otp == Session::get('otp')) {
            // Retrieve student info from session
            $studentId = Session::get('student_id');
            $student = StudentsSscInfo::find($studentId);

            if (!$student) {
                return back()->withErrors('Student record not found.');
            }



            // Create a new user in Voyager users table
            try {
                $user = User::create([
                    'name' => $student->name,                     // Name from student record
                    'email' => $student->mobile, // Use mobile as email
                    'password' => Hash::make($password),     // Encrypted password
                    'role_id' => 2,                               // Assign "user" role (adjust as needed)
                    'avatar' => 'users/default.png',              // Default avatar
                ]);

                // Update 'registered' column to 1
                $student->registered = 1;
                $student->save();
            } catch (\Exception $e) {
                // Log the user out from the current session and clear OTP
                Session::forget('otp');
                Session::forget('student_id');
                Session::forget('password');

                // Redirect to Home
                return redirect()->route('student.register')->withErrors('Failed to Register ' . $e->getMessage());
            }

            // Log the user out from the current session and clear OTP
            Session::forget('otp');
            Session::forget('student_id');
            Session::forget('password');

            // Redirect to Voyager admin login
            return redirect()->route('voyager.login')->with('success', 'Account created successfully! Please log in.');
        } else {
            return back()->withErrors('Invalid OTP. Please try again.');
        }
    }
}
