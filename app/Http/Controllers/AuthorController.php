<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\AuthorService;
use App\Services\BookService;

class AuthorController extends Controller
{
    use ApiResponser;
    /**
     *  The service to consume the authors microservice
     * @var AuthorService
     */
    public $authorService;

    /**
     * The service to constume the books microservice
     */
    public $booksService;

    /**
     * Create a new controller instance.
     * @return void
     */

    public function __construct(AuthorService $authorService, BookService $booksService)
    {
        $this->authorService = $authorService;
        $this->booksService = $booksService;
    }

    public function index()
    {
        $authors = json_decode($this->authorService->obtainAuthors(), true);

        $f = array_reduce($authors, function($result, $author){
            $author['books'] =  \json_decode($this->booksService->obtainByAuthorId($author['id']));
            array_push($result, $author);
            return $result;
        }, []);

        return $f;
    }

    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthor(
            $request->all(), Response::HTTP_CREATED
        ));
    }

    public function show($author)
    {
        return $this->successResponse($this->authorService->obtainAuthor($author));
    }

    public function update(Request $request, $author)
    {
        return $this->successResponse($this->authorService->editAuthor($request->all(), $author));
    }

    public function destroy($author)
    {
        return $this->successResponse($this->authorService->deleteAuthor($author));
    }
}
