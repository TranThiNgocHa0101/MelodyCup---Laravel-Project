<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController2 extends Controller
{
    public function showLeaderboard2()
    {
        // Lấy người dùng đã đăng nhập
        $user = Auth::user();
    
        // Lấy điểm của người dùng có tên trùng với tên đăng nhập và lấy thông tin người dùng
        $userScores = Score::with('user')  // Lấy thông tin người dùng (bao gồm email, name, v.v)
                            ->whereHas('user', function($query) use ($user) {
                                // Lọc theo tên người dùng
                                $query->where('name', $user->name);
                            })
                            ->orderBy('score', 'desc')  // Sắp xếp theo điểm giảm dần
                            ->get();
    
        // Truyền dữ liệu vào view, bao gồm tên, email và điểm của người dùng
        return view('user.activity', [
            'userScores' => $userScores, 
            'user' => $user, 
            'email' => $user->email,  // Lấy email của người dùng đã đăng nhập
            'username' => $user->name // Lấy tên đăng nhập của người dùng
        ]);
    }
}

      

