<?php

namespace App\Repositories;

use App\Interfaces\PostInterface;
use App\Models\Post;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostRepository implements PostInterface
{
    public function listing($id = null)
    {
        $data = Post::where("user_id", loggedUserID());

        if (isset($id))     $data->where("id", $id);

        return $data;
    }

    public function store(Request $request, $id = null)
    {
        $result["type"] = "error";
        try {
            DB::beginTransaction();
            $post = isset($id) ? Post::find($id) : new Post();
            $post->text = $request->post;
            $post->save();
            DB::commit();
            $result["type"] = "success";
            $result["message"] = isset($id) ? "Post Updated" : "Post Added";
        } catch (\Exception $exception) {
            DB::rollBack();
            $result["message"] = "Please contact to administrator";
            Log::debug($exception->getMessage());
        }

        return $result;
    }

    public function destroy($id)
    {
        $result["type"] = "error";
        try {
            DB::beginTransaction();
            Post::destroy($id);
            DB::commit();
            $result["type"] = "success";
            $result["message"] = "Post Deleted";
        } catch (Exception $exception) {
            DB::rollBack();
            $result["message"] = "Please contact to administrator";
            Log::debug($exception->getMessage());
        }

        return $result;
    }
}
