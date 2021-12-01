<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class PostController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** 
     * Vista para crear un post 
    */
    public function createPostView(Request $request)
    {
        return view ('ask.index');
    }

    /** 
     * Accion crear post
    */
    public function createNewPost(Request $request)
    {
        $this->validate(request(),[
            //put fields to be validated here
            'title','body','tags','userId'
        ]);

        // Obtenemos los parametros en la variable params
        $params = $request->post();
        
        try {

            $post = new Post();

            $post->id =  UuidV4::uuid4();
            $post->user_id = $params['userId'];
            $post->title = $params['title'];
            $post->body = $params['body'];
            $post->category = Post::TECH_CATEGORY;
            $post->tag = $params['tags'];

            $post->save();

            // Response optimo
            return Response(['msg' => 'Created successfully', 'code' => 200]);

        } catch (\Exception $e) {
            // Response con error
            return Response(['msg' => 'Internal Error', 'code' => 404]);
        }
    }

}