<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Subject
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $description
 * @property int $credits
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SchoolClass> $classes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LearningMaterial> $learningMaterials
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Grade> $grades
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject active()
 * @method static \Database\Factories\SubjectFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Subject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'credits',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'credits' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope a query to only include active subjects.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get the classes that belong to the subject.
     */
    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(SchoolClass::class, 'class_subjects', 'subject_id', 'class_id')
                    ->withPivot(['teacher_id', 'schedule_day', 'schedule_time', 'duration'])
                    ->withTimestamps();
    }

    /**
     * Get the learning materials for the subject.
     */
    public function learningMaterials(): HasMany
    {
        return $this->hasMany(LearningMaterial::class);
    }

    /**
     * Get the exams for the subject.
     */
    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    /**
     * Get the grades for the subject.
     */
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}