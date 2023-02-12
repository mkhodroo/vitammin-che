<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogPostController extends Controller
{
    public function newest_posts()
    {
        return BlogPost::where('post_status', 'publish')->where('post_type', 'post')->orderBy('ID', 'desc')->get();
    }

    public function add(Request $r)
    {
        // return urlencode($r->title);
        $now = date('Y-m-d H:s:i');
        $post =  BlogPost::create([
            'post_author' => 1, 
            'post_date' => $now, 
            'post_date_gmt' => $now, 
            'post_content' => $r->content, 
            'post_title' => $r->title,
            'post_excerpt' => $r->excerpt, 
            'post_status' => 'publish', 
            'comment_status' => 'open', 
            'ping_status' => 'open', 
            'post_password' => '', 
            'post_name' => urlencode($r->title), 
            'to_ping' => '', 
            'pinged' => '', 
            'post_modified' => $now, 
            'post_modified_gmt' => $now, 
            'post_content_filtered' => '', 
            'post_parent' => 0, 
            'guid' => 'https://vitaminche.ir/blog/?p=', 
            'menu_order' => 0, 
            'post_type' => 'post', 
            'post_mime_type' => '', 
            'comment_count' => 0
        ]);
        $post->guid = $post->guid . $post->id;
        $post->save();
        return $post;
    }
}
