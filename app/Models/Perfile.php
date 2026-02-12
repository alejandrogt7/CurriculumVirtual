<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Perfile
 * 
 * @property int $id
 * @property int $usuario_id
 * @property string $nombre_completo
 * @property string $profesion
 * @property string|null $sobre_mi
 * @property string|null $telefono
 * @property string|null $correo_electronico
 * @property string|null $sitio_web
 * @property string|null $linkedin
 * @property string|null $github
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Perfile extends Model
{
	protected $table = 'perfiles';

	protected $casts = [
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'usuario_id',
		'nombre_completo',
		'profesion',
		'sobre_mi',
		'telefono',
		'correo_electronico',
		'sitio_web',
		'linkedin',
		'github'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'usuario_id');
	}
}
