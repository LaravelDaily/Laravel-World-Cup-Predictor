<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Prediction
 *
 * @package App
 * @property string $user
 * @property string $match
 * @property integer $result_team1
 * @property integer $result_team2
 * @property double $points
*/
class Prediction extends Model
{
    use SoftDeletes;

    protected $fillable = ['result_team1', 'result_team2', 'points', 'user_id', 'match_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setMatchIdAttribute($input)
    {
        $this->attributes['match_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setResultTeam1Attribute($input)
    {
        $this->attributes['result_team1'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setResultTeam2Attribute($input)
    {
        $this->attributes['result_team2'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setPointsAttribute($input)
    {
        if ($input != '') {
            $this->attributes['points'] = $input;
        } else {
            $this->attributes['points'] = null;
        }
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function match()
    {
        return $this->belongsTo(Match::class, 'match_id')->withTrashed();
    }
    
}
