<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ClassSubject
 *
 * @property int $id
 * @property int $class_id
 * @property int $subject_id
 * @property int $teacher_id
 * @property string|null $schedule_day
 * @property \Illuminate\Support\Carbon|null $schedule_time
 * @property int $duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\SchoolClass $class
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\User $teacher
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Attendance> $attendances
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ClassSubject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassSubject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassSubject query()

 * 
 * @mixin \Eloquent
 */
class ClassSubject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id',
        'schedule_day',
        'schedule_time',
        'duration',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'schedule_time' => 'datetime',
        'duration' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the class that owns the class subject.
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Get the subject that owns the class subject.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the teacher that owns the class subject.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Get the attendances for the class subject.
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}