<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Language
 *
 * @package App
 * @property string $abbreviation
 * @property string $name
 * @property tinyInteger $is_active_for_admin
 * @property tinyInteger $is_active_for_users
*/
class Language extends Model
{
    use SoftDeletes;

    protected $fillable = ['abbreviation', 'name', 'is_active_for_admin', 'is_active_for_users'];
    protected $hidden = ['created_at','deleted_at','updated_at'];
    
    
}
