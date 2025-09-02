<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Exam
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $subject_id
 * @property int $class_id
 * @property int $teacher_id
 * @property \Illuminate\Support\Carbon $start_time
 * @property \Illuminate\Support\Carbon $end_time
 * @property int $duration
 * @property int $total_questions
 * @property float $total_points
 * @property bool $randomize_questions
 * @property bool $show_results_immediately
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\SchoolClass $class
 * @property-read \App\Models\User $teacher
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExamQuestion> $questions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExamResult> $results
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Exam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exam query()
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam published()

 * 
 * @mixin \Eloquent
 */
class Exam extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'subject_id',
        'class_id',
        'teacher_id',
        'start_time',
        'end_time',
        'duration',
        'total_questions',
        'total_points',
        'randomize_questions',
        'show_results_immediately',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'duration' => 'integer',
        'total_questions' => 'integer',
        'total_points' => 'decimal:2',
        'randomize_questions' => 'boolean',
        'show_results_immediately' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope a query to only include published exams.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Get the subject that owns the exam.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the class that owns the exam.
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Get the teacher that owns the exam.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Get the questions for the exam.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(ExamQuestion::class)->orderBy('order');
    }

    /**
     * Get the results for the exam.
     */
    public function results(): HasMany
    {
        return $this->hasMany(ExamResult::class);
    }
}