<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCPDF;



class UserController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|regex:/^[a-zA-Z0-9_]+$/',
            'email' => 'required|email',
        ]);

        $userProvidedUsername = $request->input('username');
        $userProvidedEmail = $request->input('email');

        $otp = mt_rand(100000, 999999);

        $dbname = $userProvidedUsername;

        try {

            DB::connection('mysql')->statement("CREATE DATABASE IF NOT EXISTS $dbname");


            config(['database.connections.mysql.database' => $dbname]);
            DB::reconnect();


            DB::statement('
                CREATE TABLE IF NOT EXISTS users (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(30) NOT NULL,
                    email VARCHAR(50),
                    password VARCHAR(255) NOT NULL,
                    otp VARCHAR(10) NOT NULL,
                    verified_at TIMESTAMP NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )
            ');


            $hashedPassword = bcrypt("your_default_password");


            DB::table('users')->insert([
                'username' => $userProvidedUsername,
                'email' => $userProvidedEmail,
                'password' => $hashedPassword,
                'otp' => $otp,
            ]);


            config(['database.connections.mysql.database' => config('database.default')]);

            $fromEmail = "venkatvenkadesh34@gmail.com";
            $to = $userProvidedEmail;
            $subject = "Verification Code ";
            $message = "Your Verification OTP is: $otp";


            Mail::raw($message, function($mail) use ($to, $fromEmail, $subject) {
                $mail->from($fromEmail)
                     ->to($to)
                     ->subject($subject);
            });

            return response()->json(['message' => 'Registration successful'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




   public function verifyOtp(Request $request)
    {
        $request->validate([
            'username' => 'required|regex:/^[a-zA-Z0-9_]+$/',
            'otp' => 'required|string|min:6|max:6',
        ]);

        $username = $request->input('username');
        $otp = $request->input('otp');

        $dbname = $username;
            config(['database.connections.mysql.database' => $dbname]);
            DB::reconnect();

        $user = DB::table('users')->where('username', $username)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($user->otp === $otp) {
            DB::table('users')->where('username', $username)->update(['verified_at' => now()]);
            return response()->json(['message' => 'OTP verification successful'], 200);
        } else {
            return response()->json(['message' => 'Invalid OTP'], 422);
        }
    }


    public function generateUserDetailsPdf($username)
    {
        try {
            $dbname = $username;
            config(['database.connections.mysql.database' => $dbname]);
            DB::reconnect();

            $userDetails = DB::table('users')->where('username', $username)->first();

            if (!$userDetails) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $pdf = new TCPDF();
            $pdf->SetPrintHeader(false);
            $pdf->SetPrintFooter(false);
            $pdf->AddPage();
            $pdf->SetFont('times', '', 12);

            $pdf->Cell(0, 10, 'User Details', 0, 1, 'C');
            $pdf->Ln(10);

            $pdf->MultiCell(0, 10, "

                Username: {$userDetails->username}
                Email: {$userDetails->email}


            ");

            $pdf->Output('user_details.pdf', 'D');

            config(['database.connections.mysql.database' => config('database.default')]);

            return response()->json(['message' => 'PDF generated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
