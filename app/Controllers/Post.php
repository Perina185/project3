<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PostModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Post extends BaseController
{
    public function index()
    {
        // Buat object model $post
        $post = new PostModel();

        // Siapkan data untuk dikirim ke view dengan nama $posts
        $data['posts'] = $post->where('status', 'published')->findAll();

        // Kirim data ke view
        echo view('post', $data);
    }

    public function viewPost($slug)
    {
        $post = new PostModel();

        // Cari post berdasarkan slug dan status published
        $data['post'] = $post->where([
            'slug' => $slug,
            'status' => 'published'
        ])->first();

        // Tampilkan 404 jika tidak ditemukan
        if (!$data['post']) {
            throw PageNotFoundException::forPageNotFound();
        }

        // Tampilkan view detail
        echo view('post_detail', $data);
    }
}
