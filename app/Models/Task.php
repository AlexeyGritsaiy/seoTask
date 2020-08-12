<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $post_id
 * @property int $task_id
 * @property int $se_id
 * @property int $loc_id
 * @property int $key_id
 * @property string $result_url
 * @property string $result_title
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Task extends Model
{
    protected $fillable = [
        'post_id',
        'task_id',
        'se_id',
        'loc_id',
        'key_id',
        'result_url',
        'result_title',
    ];
}
