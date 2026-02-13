<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Educacione[] $educaciones
 * @property Collection|Experiencia[] $experiencias
 * @property Collection|Habilidade[] $habilidades
 * @property Collection|Perfile[] $perfiles
 * @property Collection|Proyecto[] $proyectos
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token'
	];

	public function educaciones()
	{
		return $this->hasMany(Educacione::class, 'usuario_id');
	}

	public function experiencias()
	{
		return $this->hasMany(Experiencia::class, 'usuario_id');
	}

	public function habilidades()
	{
		return $this->hasMany(Habilidade::class, 'usuario_id');
	}

	public function perfil()
	{
		return $this->hasOne(Perfile::class, 'usuario_id');
	}

	public function proyectos()
	{
		return $this->hasMany(Proyecto::class, 'usuario_id');
	}
}
