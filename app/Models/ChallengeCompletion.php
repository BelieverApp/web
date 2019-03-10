<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Utility;

class ChallengeCompletion extends Model
{
    use SoftDeletes;
    protected $table = 'challenge_completions';
    protected $fillable = ['challenge_id', 'user_id'];

    public function getCreatedAtAttribute($timestamp)
    {
        return Utility::prettifyDate($timestamp);
    }

    public static function getCompletionCount($challenge_id)
    {
        return Self::where('challenge_id', $challenge_id)->count();
    }
}
