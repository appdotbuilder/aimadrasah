<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ExamQuestion
 *
 * @property int $id
 * @property int $exam_id
 * @property string $question
 * @property string $type
 * @property array|null $options
 * @property string|null $correct_answer
 * @property float $points
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Exam $exam
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ExamQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExamQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExamQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExamQuestion whereType($value)

 * 
 * @mixin \Eloquent
 */
class ExamQuestion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'exam_id',
        'question',
        'type',
        'options',
        'correct_answer',
        'points',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'options' => 'array',
        'points' => 'decimal:2',
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the exam that owns the question.
     */
    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }
}