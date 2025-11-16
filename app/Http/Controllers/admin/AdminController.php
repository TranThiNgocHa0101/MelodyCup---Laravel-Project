<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class AdminController extends Controller
{
    public function adminDashboard() {
        return view('admin.dashboardAd');
    }
    public function index()
    {
        $users = User::where('role', 'customer')->paginate(5);
        return view('admin.tableUser', [
            'users' => $users
        ]);
    }
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validate dữ liệu nhập vào
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id, // Kiểm tra email duy nhất và bỏ qua người dùng hiện tại
    ]);

    // Tìm người dùng cần cập nhật
    $user = User::findOrFail($id);

    // Cập nhật thông tin người dùng
    $user->update([
        'name' => $request->input('name'),
        'email' => $request->input('email'),  // Cập nhật email
    ]);

    // Chuyển hướng về trang danh sách người dùng với thông báo thành công
    return redirect()->route('admin.tableUser')->with('success', 'Customer updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = User::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.tableUser')->with('success', 'Customer Delete successfully.');

    }
    public function getMonthlySignups()
    {
        $startDate = Carbon::now()->subDays(30);

    // Lọc theo role là customer
    $signups = DB::table('users')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
        ->where('created_at', '>=', $startDate)
        ->where('role', 'customer') // Thêm điều kiện lọc
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date', 'asc')
        ->get();

    return response()->json($signups);
    }

    

    
}
