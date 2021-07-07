<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, Notifiable, SoftDeletes;

	public $table = 'users';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

	protected $dates = ['deleted_at'];


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name',
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'last_name',
		'org_role_id',
		'department_id',
		'is_2fa',
		'start_date',
		'end_date'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'first_name' => 'string',
		'email' => 'string',
		'email_verified_at' => 'datetime',
		'password' => 'string',
		'remember_token' => 'string',
		'last_name' => 'string',
		'org_role_id' => 'integer',
		'department_id' => 'integer',
		'is_2fa' => 'integer',
		'start_date' => 'date',
		'end_date' => 'date'
	];

	public static $rules = [
		'first_name' => 'required|string|max:255',
		'email' => 'required|string|max:255',
		'email_verified_at' => 'nullable',
		'password' => 'required|string|max:255',
		'remember_token' => 'nullable|string|max:100',
		'created_at' => 'nullable',
		'updated_at' => 'nullable',
		'deleted_at' => 'nullable',
		'last_name' => 'required|string|max:255',
		'org_role_id' => 'required|integer',
		'department_id' => 'required|integer',
		'start_date' => 'required',
		'end_date' => 'required'
	];

	public function department()
	{
		return $this->belongsTo('App\Models\Administration\Department');
	}

	public function orgRole()
	{
		return $this->belongsTo('App\Models\Administration\OrgRole');
	}

	public function getStartDateAttribute(){
		$carbon = new Carbon($this->attributes['start_date']);
		return $carbon->isoFormat('DD-MM-YYYY');
	}

	public function setStartDateAttribute($value){
		$carbon = new Carbon();
		$this->attributes['start_date'] = $carbon->parse($value);
	}

	public function getEndDateAttribute(){
		$carbon = new Carbon($this->attributes['end_date']);
		return $carbon->isoFormat('DD-MM-YYYY');
	}

	public function setEndDateAttribute($value){
		$carbon = new Carbon();
		$this->attributes['end_date'] = $carbon->parse($value);
	}
}
