<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Models\Job;

/**
 * Class Client
 * @package App\Models
 * @version November 24, 2018, 5:42 pm UTC
 *
 * @property string bio
 * @property string education
 * @property string avatar
 * @property integer user_id
 */
class Client extends Model
{
    use SoftDeletes;

    public $table = 'clients';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'bio',
        'education',
        'avatar',
        'user_id',
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'bio' => 'string',
        'education' => 'string',
        'avatar' => 'string',
        'user_id' => 'integer',
        'job_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    public function users(){ 
        return $this->belongsTo('App\User', 'user_id'); 
        }
    public function jobs(){ 
        return $this->belongsToMany('App\Models\Job','job_user','user_id','job_id');
        }  
}
