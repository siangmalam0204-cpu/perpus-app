<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return inertia('Books/Index', [
            'books' => $books,
        ]);
    }

    public function create()
    {
        return inertia('Books/Create');
    }

    public function store(Request $request)
    {
        // 1. Validasi data yang dikirim dari form (lihat Dasar Teori E.5)
        $validated = $request->validate([
            'kode_buku' => 'required|unique:books',
            'judul' => 'required|max:255',
            'pengarang' => 'required|max:255',
            'penerbit' => 'nullable|max:255', // boleh kosong
            'tahun' => 'nullable|digits:4', // jika diisi, harus 4 digit angka
            'stok' => 'required|integer|min:0',
        ]);
        // 2. Jika seluruh data valid, simpan sebagai baris baru di tabel books
        Book::create($validated);
        // 3. Arahkan kembali ke halaman daftar buku, sertakan pesan sukses
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function show(Book $book)
    {
        // 
    }

    public function edit(Book $book)
    {
        return inertia('Books/Edit', [
            'book' => $book,
        ]);
    }

    public function update(Request $request, Book $book)
    {


        $validated = $request->validate([
            'kode_buku' => 'required|unique:books,kode_buku,' . $book->id,
            'judul' => 'required|max:255',
            'pengarang' => 'required|max:255',
            'penerbit' => 'nullable|max:255',
            'tahun' => 'nullable|digits:4',
            'stok' => 'required|integer|min:0',
        ]);
        // Mengganti data lama pada $book dengan data baru yang sudah divalidasi
        $book->update($validated);
        // Kembali ke daftar buku, sertakan flash message (lihat Dasar Teori E.3)
        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Book $book)
    {
        // Menghapus baris data buku ini secara permanen dari tabel books
        $book->delete();
        // Kembali ke daftar buku, sertakan flash message
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus');
    }

    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            // Blok baru: membagikan pesan flash ke SELURUH halaman Vue secara otomatis
            'flash' => [
                // session('success') membaca pesan yang dikirim lewat ->with('success', ...)
                // pada Langkah 2 dan 4; bernilai null apabila tidak ada pesan
                'success' => session('success'),
            ],
        ];
    }

}