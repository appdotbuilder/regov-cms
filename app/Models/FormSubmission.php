<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\FormSubmission
 *
 * @property int $id
 * @property int $form_id
 * @property array $data
 * @property string|null $submitter_name
 * @property string|null $submitter_email
 * @property string|null $ip_address
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Form $form
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|FormSubmission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormSubmission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormSubmission query()
 * @method static \Illuminate\Database\Eloquent\Builder|FormSubmission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormSubmission whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormSubmission whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormSubmission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormSubmission whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormSubmission whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormSubmission whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormSubmission whereSubmitterEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormSubmission whereSubmitterName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormSubmission whereUpdatedAt($value)
 * @method static \Database\Factories\FormSubmissionFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class FormSubmission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'form_id',
        'data',
        'submitter_name',
        'submitter_email',
        'ip_address',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Get the form this submission belongs to.
     */
    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
}