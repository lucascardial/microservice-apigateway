<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\BookService;

class BookController extends Controller
{
    use ApiResponser;

    public $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    public function index()
    {

    }

    public function show($book)
    {

    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, $book)
    {

    }

    public function destroy($book)
    {
    }
}
