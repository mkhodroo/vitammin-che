<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BlogPost extends Model
{
    use HasFactory;

    protected $connection = "mysql2";
    public $table = "wp_posts";
    public $timestamps = false;
    protected $fillable = [
        'ID', 'post_author', 'post_date', 'post_date_gmt', 'post_content', 'post_title', 'post_excerpt', 'post_status', 'comment_status', 'ping_status', 'post_password', 'post_name', 'to_ping', 'pinged', 'post_modified', 'post_modified_gmt', 'post_content_filtered', 'post_parent', 'guid', 'menu_order', 'post_type', 'post_mime_type', 'comment_count'
    ];


    public function image()
    {
        $image_id =  DB::connection('mysql2')->table('wp_postmeta')->where('meta_key', '_thumbnail_id ')->where('post_id', $this->ID)->first()?->meta_value;
        return BlogPost::where('ID', $image_id)->first()?->guid;
    }
}
