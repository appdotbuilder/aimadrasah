<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Grade
 *
 * @property int $id
 * @property int $student_id
 * @property int $subject_id
 * @property int $class_id
 * @property string $assessment_type
 * @property string $assessment_name
 * @property float $score
 * @property float $max_score
 * @property float $percentage
 * @property string|null $grade_letter
 * @property \Illuminate\Support\Carbon $assessment_date
 * @property int $teacher_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\User $student
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\SchoolClass $class
 * @property-read \App\Models\User $teacher
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Grade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade query()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereAssessmentType($value)

 * 
 * @mixin \Eloquent
 */
class Grade extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'student_id',
        'subject_id',
        'class_id',
        'assessment_type',
        'assessment_name',
        'score',
        'max_score',
        'percentage',
        'grade_letter',
        'assessment_date',
        'teacher_id',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'score' => 'decimal:2',
        'max_score' => 'decimal:2',
        'percentage' => 'decimal:2',
        'assessment_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the student that owns the grade.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the subject that owns the grade.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the class that owns the grade.
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Get the teacher that owns the grade.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}