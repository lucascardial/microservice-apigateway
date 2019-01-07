<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    use ApiResponser;
    /**
     *  The service to consume the authors microservice
     * @var AuthorService
     */
    public $authorService;

    /**
     * Create a new controller instance.
     * @return void
     */

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index()
    {
        return $this->successResponse($this->authorService->obtainAuthors());
    }

    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthor(
            $request->all(), Response::HTTP_CREATED
        ));
    }

    public function show($author)
    {

    }

    public function update(Request $request, $author)
    {

    }

    public function destroy($author)
    {

    }
}
