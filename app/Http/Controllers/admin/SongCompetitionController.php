<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PianoVirtual;

class SongCompetitionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $songs = PianoVirtual::all();
        return view('admin.songCompetition', compact('songs'));
    }
    public function indexForUser1()
    {
        // Lấy danh sách bài hát và trả về giao diện User
        $songs = PianoVirtual::all();
        return view('user.Competition', compact('songs'));
    }
    
    public function getNotes1($id)
    {
        // Lấy thông tin bài hát theo ID
        $songs = PianoVirtual::findOrFail($id);

        // Trả về nốt nhạc của bài hát dưới dạng JSON
        return response()->json($songs->song);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.songCompetition');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        // Validate dữ liệu
        $validated = $request->validate([
            'level' => 'required|integer|min:1|max:255',
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'song' => 'required|string',
        ]);

        // Giải mã chuỗi URL từ `notes`
        $notes = urldecode($validated['song']);

        // Lưu bài hát vào cơ sở dữ liệu
        PianoVirtual::create([
            'level' => $validated['level'],
            'name' => $validated['name'],
            'author' => $validated['author'],
            'song' => $notes,
        ]);

        return redirect()->back()->with('success', 'Bài hát đã được thêm thành công!');
    } catch (\Exception $e) {
        // Bắt lỗi nếu có và hiển thị
        dd($e->getMessage());
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $song = PianoVirtual::findOrFail($id);

        return view('admin.editCompetition', compact('song'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'level' => 'required|integer|min:1|max:255',
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'song' => 'required|string',
        ]);
    
        // Tìm người dùng cần cập nhật
        $song = PianoVirtual::findOrFail($id);
    
        // Cập nhật thông tin người dùng
        $song->update([
            'level' => $request->input('level'),
            'name' => $request->input('name'),  
            'author' => $request->input('author'),
            'song' => $request->input('song'),    
        ]);
    
        // Chuyển hướng về trang danh sách người dùng với thông báo thành công
        return redirect()->route('admin.songCompetition')->with('success', 'Song updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $song= PianoVirtual::findOrFail($id);
        $song->delete();
        return redirect()->route('admin.songCompetition')->with('success', 'Song Delete successfully.');

    }
}
