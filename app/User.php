<?php

namespace App;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @method static User findOrFail(array|string|null $input)
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use Enums;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected $enumSexes = [
        'Male',
        'Female',
    ];


    /**
     * @return BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Companies\Role');
    }

    /**
     * @return BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Companies\Department');
    }

    /**
     * @return BelongsTo
     */
    public function position()
    {
        return $this->belongsTo('App\Models\Companies\Position');
    }

    /**
     * @return BelongsTo
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Generics\Address');
    }

    /**
     * @return HasMany
     */
    public function contactPeople()
    {
        return $this->hasMany('App\Models\Accounts\ContactPerson');
    }

    /**
     * @return HasMany
     */
    public function educationStatuses()
    {
        return $this->hasMany('App\Models\Accounts\EducationStatus');
    }

    /**
     * @return HasOne
     */
    public function familyStatus()
    {
        return $this->hasOne('App\Models\Accounts\FamilyStatus');
    }

    /**
     * @return HasMany
     */
    public function workExperiences()
    {
        return $this->hasMany('App\Models\Accounts\WorkExperience');
    }

    /**
     * @return HasMany
     */
    public function sentPrivateMessages()
    {
        return $this->hasMany('App\Models\Chats\PrivateMessage', 'sender_id');
    }

    /**
     * @return HasMany
     */
    public function receivedPrivateMessages()
    {
        return $this->hasMany('App\Models\Chats\PrivateMessage', 'receiver_id');
    }

    /**
     * @return HasMany
     */
    public function createdForums()
    {
        return $this->hasMany('App\Models\Forums\Forum', 'creator_id');
    }

    /**
     * @return BelongsToMany
     */
    public function forums()
    {
        return $this->belongsToMany('App\Models\Forums\Forum', 'forum_user');
    }

    /**
    * @return HasMany
    */
    public function forumPosts()
    {
        return $this->hasMany('App\Models\Forums\ForumPost', 'poster_id');
    }


    /**
     * @return HasMany
     */
    public function systemLogs()
    {
        return $this->hasMany('App\Models\Generics\SystemLog');
    }

    /**
     * @return HasMany
     */
    public function postedNotices()
    {
        return $this->hasMany('App\Models\Notices\Notice', 'poster_id');
    }

    /**
     * @return BelongsToMany
     */
    public function notices()
    {
        return $this->belongsToMany('App\Models\Notices\Notice', 'notice_user');
    }

    /**
     * @return HasMany
     */
    public function postedReminders()
    {
        return $this->hasMany('App\Models\Reminders\Reminder', 'poster_id');
    }

    /**
     * @return HasMany
     */
    public function reminders()
    {
        return $this->hasMany('App\Models\Reminders\Reminder');
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany('App\Models\Generics\File', 'fileable');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'user' => array_merge(
                $this->toArray(),
                [
                    'role' => $this->role->toArray(),
                    // 'position' => $this->position->toArray(),
                    // 'department' => $this->department->toArray()
                ]
            )
        ];
    }
}
