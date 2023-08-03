<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $table = 'tweets';
    protected $fillable = ['tweet'];

    public function saveTweet(Request $request)
    {
        $tweet = new Tweet();
        $tweet->tweet = $request->tweet;
        $tweet->save();
        return $tweet->all();
    }

    public function getDate()
    {
        $data = DB::table($this->table)->get();
        return $data;
    }
}
