<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function show($id)
    {
        $message = Message::findOrFail($id);
        return response()->json($message); // Trả về JSON nếu cần API
    }
}
