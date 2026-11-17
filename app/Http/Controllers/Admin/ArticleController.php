<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }
    
    public function create()
    {
        return view('admin.articles.create');
    }
    
    public function store(Request $request)
    {
        // Debug: cek apakah request sampai
        // dd($request->all());
        
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:articles,slug|max:255',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $data['image'] = $imagePath;
        }
        
        $data['views'] = 0;
        $data['is_published'] = $request->has('is_published');
        
        // Debug: cek data sebelum save
        // dd($data);
        
        $article = Article::create($data);
        
        if ($article) {
            return redirect()->route('admin.articles.index')
                ->with('success', 'Artikel "' . $article->title . '" berhasil ditambahkan');
        } else {
            return back()->withInput()->with('error', 'Gagal menyimpan artikel');
        }
    }
    
    // Tambahkan method untuk upload gambar dari CKEditor
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('articles/images', $filename, 'public');
            
            $url = Storage::url($path);
            
            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }
        
        return response()->json([
            'uploaded' => false,
            'error' => ['message' => 'Gagal upload gambar']
        ]);
    }
    
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }
    
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug,' . $article->id,
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $request->file('image')->store('articles', 'public');
        }
        
        $data['is_published'] = $request->has('is_published');
        
        $article->update($data);
        
        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diupdate');
    }
    
    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();
        
        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus');
    }

        public function toggleStatus(Article $article)
    {
        try {
            // Toggle status
            $article->is_published = !$article->is_published;
            $article->save();
            
            return response()->json([
                'success' => true,
                'is_published' => $article->is_published,
                'message' => $article->is_published ? 'Artikel telah dipublikasikan' : 'Artikel telah diarsipkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status: ' . $e->getMessage()
            ], 500);
        }
    }
}