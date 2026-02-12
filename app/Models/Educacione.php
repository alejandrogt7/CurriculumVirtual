<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Educacione
 * 
 * @property int $id
 * @property int $usuario_id
 * @property string $institucion
 * @property string $titulo_obtenido
 * @property Carbon $fecha_inicio
 * @property Carbon|null $fecha_fin
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Educacione extends Model
{
	protected $table = 'educaciones';

	protected $casts = [
		'usuario_id' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime'
	];

	protected $fillable = [
		'usuario_id',
		'institucion',
		'titulo_obtenido',
		'fecha_inicio',
		'fecha_fin'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'usuario_id');
	}
}
