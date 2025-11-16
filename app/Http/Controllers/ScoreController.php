<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function saveScore(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return response()->json(['message' => 'Bạn cần đăng nhập để lưu điểm.'], 401);
        }
    
        // Validate dữ liệu đầu vào (đảm bảo giá trị là số và không nhỏ hơn 0)
        $request->validate([
            'score' => 'required|numeric|min:0', // Kiểm tra số thực
        ]);
    
        // Kiểm tra giá trị score nhận được từ request
        Log::info('Điểm nhận được:', ['score' => $request->score]);
    
        // Lấy user_id từ người dùng hiện tại
        $userId = Auth::user()->id;
    
        // Lưu điểm vào bảng 'scores'
        $score = new Score();
        $score->score = (float)$request->score;  // Chuyển giá trị thành số thực
        $score->user_id = $userId;
        $score->save();
    
      // Trả về trang competition
return redirect()->route('competition')->with('message', 'Điểm đã được lưu thành công!');

    }

    public function showLeaderboard()
    {
        $topScores = Score::selectRaw('
        user_id,
        SUM(score) as total_score,
        MIN(created_at) as first_play,
        MAX(updated_at) as last_play
    ')
    ->groupBy('user_id')
    ->orderBy('total_score', 'desc')
    ->take(5)
    ->with('user')
    ->get();
        return view('admin.rankChart', compact('topScores'));
       
    }
      
}
