<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

/**
 * Class Job
 * @package App\Models
 * @version November 24, 2018, 8:51 pm UTC
 *
 * @property string name
 * @property string bio
 * @property string avatar
 */
class Job extends Model
{
    use SoftDeletes;

    public $table = 'jobs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'bio',
        'avatar',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'bio' => 'string',
        'avatar' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function users(){ 
        return $this->belongsToMany('App\User','job_user','job_id','user_id');
        }

    
}
