<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;


class ContactController extends Controller
{
    // Hiển thị form liên hệ
    public function showForm()
    {
        return view('user.home'); 
    }
    public function sendEmail(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
    
        
        $message = new Message();
        $message->sender_name = $request->name; 
        $message->sender_email = $request->email;  
        $message->message = $request->message; 
        $message->save(); 
    
        
        return redirect()->route('contact.form')->with('success', 'Tin nhắn đã được gửi thành công!');
    }
    
    public function showMessages()
    {
        $messages = Message::latest()->take(5)->get(); 
        return view('layouts.partials.sidebar', compact('messages'));
    }

}