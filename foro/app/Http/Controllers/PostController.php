<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

    /** 
     * Informacion especifica de un post
    */
    public function infoPost(Request $request, $id)
    {   

        // Info del usuario    
        $userData = Session::get('user');
        
        // Post data
        $postData = DB::table('posts')->where('id', $id)->first();
        // User relacionado al post
        $userPostRelated = DB::table('users')->where('id', $postData->user_id)->first();

        // Comments
        $comments = DB::table('comments')->where('post_id', $postData->id)->get();
        $commentArray = [];

        foreach ($comments as $key => $row) {
            
            // User relacionado al post
            $userCommentRelated = DB::table('users')->where('id', $row->user_id)->first();
            $userCommentRelated = (array) $userCommentRelated;

            $commentArray[$key]['id'] = $row->id;
            $commentArray[$key]['user'] = $userCommentRelated;
            $commentArray[$key]['body'] = $row->body;
            $commentArray[$key]['date'] = $row->created_at;
        }

        // Info del post
        return view ('ask.detail', compact(
            'userData', 'postData',
            'userPostRelated',
            'commentArray'
        ));
    }

    /** 
     * Agregar un comentario
    */
    public function createComment(Request $request)
    {
        $this->validate(request(),[
            //put fields to be validated here
            'comment','post-id',
        ]);

        // Obtenemos los parametros en la variable params
        $params = $request->post();

        try {

            $comment = new Comment();

            $comment->id =  UuidV4::uuid4();
            $comment->post_id = $params['post-id'];
            $comment->user_id = Session::get('user.id');
            $comment->body = $params['comment'];
            $comment->like = "0";
            $comment->dislike = "0";

            $comment->save();

            // Response con error
            return Response(['msg' => 'Comentario creado', 'code' => 200]);

        } catch (\Exception $e) {
            // Response con error
            return Response(['msg' => 'Internal Error', 'code' => 404]);
        }
    }
}