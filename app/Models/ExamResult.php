<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ExamResult
 *
 * @property int $id
 * @property int $exam_id
 * @property int $student_id
 * @property \Illuminate\Support\Carbon $started_at
 * @property \Illuminate\Support\Carbon|null $submitted_at
 * @property float|null $score
 * @property float|null $percentage
 * @property string $status
 * @property array|null $answers
 * @property int|null $time_spent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Exam $exam
 * @property-read \App\Models\User $student
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ExamResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExamResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExamResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExamResult whereStatus($value)

 * 
 * @mixin \Eloquent
 */
class ExamResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'exam_id',
        'student_id',
        'started_at',
        'submitted_at',
        'score',
        'percentage',
        'status',
        'answers',
        'time_spent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'started_at' => 'datetime',
        'submitted_at' => 'datetime',
        'score' => 'decimal:2',
        'percentage' => 'decimal:2',
        'answers' => 'array',
        'time_spent' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the exam that owns the result.
     */
    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     * Get the student that owns the result.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}