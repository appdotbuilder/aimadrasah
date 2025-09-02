<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Attendance
 *
 * @property int $id
 * @property int $student_id
 * @property int $class_subject_id
 * @property \Illuminate\Support\Carbon $attendance_date
 * @property string $status
 * @property string|null $notes
 * @property int $recorded_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\User $student
 * @property-read \App\Models\ClassSubject $classSubject
 * @property-read \App\Models\User $recordedBy
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereAttendanceDate($value)

 * 
 * @mixin \Eloquent
 */
class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'student_id',
        'class_subject_id',
        'attendance_date',
        'status',
        'notes',
        'recorded_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'attendance_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the student that owns the attendance.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the class subject that owns the attendance.
     */
    public function classSubject(): BelongsTo
    {
        return $this->belongsTo(ClassSubject::class);
    }

    /**
     * Get the user who recorded the attendance.
     */
    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}