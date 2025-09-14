<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VisitorStat
 *
 * @property int $id
 * @property string $date
 * @property string $page_url
 * @property string|null $page_title
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string|null $referrer
 * @property int $session_duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat wherePageTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat wherePageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereReferrer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereSessionDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereUserAgent($value)
 * @method static \Database\Factories\VisitorStatFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class VisitorStat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'date',
        'page_url',
        'page_title',
        'ip_address',
        'user_agent',
        'referrer',
        'session_duration',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'session_duration' => 'integer',
    ];
}