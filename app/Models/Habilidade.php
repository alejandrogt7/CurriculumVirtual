<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Habilidade
 * 
 * @property int $id
 * @property int $usuario_id
 * @property string $nombre_habilidad
 * @property string $nivel
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Habilidade extends Model
{
	protected $table = 'habilidades';

	protected $casts = [
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'usuario_id',
		'nombre_habilidad',
		'nivel'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'usuario_id');
	}
}
