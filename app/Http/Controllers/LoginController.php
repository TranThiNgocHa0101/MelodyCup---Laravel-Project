<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index() {
        // Nếu người dùng đã đăng nhập, chuyển hướng đến trang dashboard
        if (Auth::check()) {
            return redirect()->route('practice'); // Chỉnh sửa tên route cho đúng với route bạn muốn
        }
        return view('login');
    }
    
    public function authenticate(Request $request) {
        $validator = Validator::make($request->all(), [
           'email' => 'required|email',
           'password' => 'required' 
        ]);
        if($validator->passes()) {

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
            
                if ($user->role == 'admin') {
                    return redirect()->route('admin.dashboardAd');
                } else {
                    return redirect()->route('practice');
                }
            } else {
                return redirect() -> route('account.login')->with('error','Either email or password is incorrect.');
            }
        } else {
            return redirect() -> route('account.login')
            ->withInput()
            ->withErrors($validator);
        }
    }
    public function register() {
        return view('register');
    }
    public function processRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8' 
         ]);
         if($validator->passes()) {

            Log::info(Carbon::now('Asia/Ho_Chi_Minh'));

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'customer';
            // Không cần gán created_at và updated_at vì Laravel sẽ tự động xử lý chúng.
            $user->save();

                        
            return redirect() -> route('account.login')->with('success', 'You have registed successfully.');
         
         } else {
             return redirect() -> route('account.register')
             ->withInput()
             ->withErrors($validator);
         }
    }

    public function forgotPassForm() {
        return view('forgotPass');
    }
    public function processForgotPass(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        
        return redirect()->route('account.resetPasswordForm', ['email' => $request->email]);
    }

    public function resetPasswordForm($email) {
        return view('resetPassword', compact('email'));
    }

    public function processResetPassword(Request $request) {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);
        $user = User::where('email', $request->email)->first();
        if($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('account.login')->with('success', 'Password changed successfully!');
        }
        return back()->with('error', 'An error occurred. Please try again.');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('account.login');
    }
}
