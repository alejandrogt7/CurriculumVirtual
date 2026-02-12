<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Proyecto
 * 
 * @property int $id
 * @property int $usuario_id
 * @property string $titulo
 * @property string $descripcion
 * @property string|null $enlace_proyecto
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Proyecto extends Model
{
	protected $table = 'proyectos';

	protected $casts = [
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'usuario_id',
		'titulo',
		'descripcion',
		'enlace_proyecto'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'usuario_id');
	}
}
