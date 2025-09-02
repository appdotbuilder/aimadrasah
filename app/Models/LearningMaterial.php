<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\LearningMaterial
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $type
 * @property string|null $file_path
 * @property string|null $external_link
 * @property int $subject_id
 * @property int $class_id
 * @property int $teacher_id
 * @property int|null $file_size
 * @property bool $is_published
 * @property int $download_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\SchoolClass $class
 * @property-read \App\Models\User $teacher
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|LearningMaterial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LearningMaterial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LearningMaterial query()
 * @method static \Illuminate\Database\Eloquent\Builder|LearningMaterial whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LearningMaterial whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LearningMaterial published()

 * 
 * @mixin \Eloquent
 */
class LearningMaterial extends Model
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
        'type',
        'file_path',
        'external_link',
        'subject_id',
        'class_id',
        'teacher_id',
        'file_size',
        'is_published',
        'download_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'file_size' => 'integer',
        'is_published' => 'boolean',
        'download_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope a query to only include published materials.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Get the subject that owns the learning material.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the class that owns the learning material.
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Get the teacher that owns the learning material.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}