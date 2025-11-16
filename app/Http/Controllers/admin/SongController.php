<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Song;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $songs = Song::all();
        return view('admin.listSong', compact('songs'));
    }
    public function indexForUser()
    {
        // Lấy danh sách bài hát và trả về giao diện User
        $songs = Song::all();
        return view('user.practice', compact('songs'));
    }
    
    public function getNotes($id)
    {
     
        $song = Song::findOrFail($id);

       
        return response()->json($song->notes);
    }

   
    public function create()
    {
        return view('admin.listSong');
    }

    
    public function store(Request $request)
{
    try {
       
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'composer' => 'required|string|max:255',
            'notes' => 'required|string',
        ]);

        
        $notes = urldecode($validated['notes']);

        
        Song::create([
            'title' => $validated['title'],
            'composer' => $validated['composer'],
            'notes' => $notes,
        ]);

        return redirect()->back()->with('success', 'Bài hát đã được thêm thành công!');
    } catch (\Exception $e) {
       
        dd($e->getMessage());
    }
}

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $song = Song::findOrFail($id);

    if (!$song) {
        abort(404, 'Bài hát không tồn tại');
    }

    return view('user.practice', compact('song')); // Trả về view với dữ liệu bài hát
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $song = Song::findOrFail($id);

        return view('admin.editSong', compact('song'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'composer' => 'required|string|max:255', 
            'notes' => 'required|string',
        ]);
    
        // Tìm người dùng cần cập nhật
        $song = Song::findOrFail($id);
    
        // Cập nhật thông tin người dùng
        $song->update([
            'title' => $request->input('title'),
            'composer' => $request->input('composer'),  
            'notes' => $request->input('notes'),  
        ]);
    
        // Chuyển hướng về trang danh sách người dùng với thông báo thành công
        return redirect()->route('admin.listSong')->with('success', 'Song updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $song= Song::findOrFail($id);
        $song->delete();
        return redirect()->route('admin.listSong')->with('success', 'Song Delete successfully.');

    }
    public function searchResults(Request $request)
    {
        $query = $request->get('q');
        $results = Song::where('title', 'LIKE', "%$query%")->get(); // Lấy tất cả kết quả theo từ khóa

        return view('user.results', compact('results', 'query')); // Trả về view với kết quả tìm kiếm
    }
   
}
