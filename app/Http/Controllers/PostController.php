<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
   
    public function index()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = $response->json();
        return view('posts', compact('posts'));
    }

    // Crear un nuevo post (simulado, no se guardará en la API)
    public function store(Request $request)
    {
        $response = Http::post('https://jsonplaceholder.typicode.com/posts', [
            'title' => $request->title,
            'body' => $request->body,
            'userId' => 1
        ]);

        return redirect()->route('posts.index')->with('success', 'Post agregado correctamente.');
    }

    // Eliminar un post (simulado, no se elimina en la API real)
    public function destroy($id)
    {
        Http::delete("https://jsonplaceholder.typicode.com/posts/{$id}");
        return redirect()->route('posts.index')->with('success', 'Post eliminado correctamente.');
    }

}
