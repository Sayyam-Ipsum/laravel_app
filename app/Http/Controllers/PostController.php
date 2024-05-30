<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Interfaces\PostInterface;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use stdClass;

class PostController extends Controller
{
    use ResponseTrait;

    protected PostInterface $postInterface;

    public function __construct(PostInterface $postInterface)
    {
        $this->postInterface = $postInterface;
    }

    public function modal($id = null)
    {
        $title = "Create Post";
        $post = new StdClass();

        if (isset($id)) {
            $title = "Edit Post";
            $post = $this->postInterface->listing($id)->first();
        }

        return view("posts.form", compact(['title', 'post']));
    }

    public function store(PostRequest $request, $id = null)
    {
        $result = $this->postInterface->store($request, $id);

        return to_route("dashboard")->with($result["type"], $result["message"]);
    }

    public function destroy($id)
    {
        $shop = $this->postInterface->listing($id)->first();

        if (!$shop) {
            return $this->jsonResponse("error", "post not found");
        }

        $result = $this->postInterface->destroy($id);

        return $this->jsonResponse($result["type"], $result["message"]);
    }
}
