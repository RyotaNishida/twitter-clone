<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Tweet extends Model
{
    protected $table = 'tweets';
    protected $fillable = ['tweet'];

    public function create(Request $request)
    {
        //inputで入力した要素をDBに格納する処理
        $tweet = new Tweet();
        $tweet->tweet = $request->input('tweet');
        $tweet->save();
        return $tweet->all();
    }

    public function findByTweetId()
    {
        
    }

    public function index()
    {
        Tweet::all();
    }


}