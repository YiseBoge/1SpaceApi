<?php

namespace App;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class User extends Authenticatable
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

    /**
     * @return BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Generics\Role');
    }

    /**
     * @return BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Generics\Department');
    }

    /**
     * @return BelongsTo
     */
    public function position()
    {
        return $this->belongsTo('App\Models\Generics\Position');
    }

    /**
     * @return BelongsTo
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Generics\Address');
    }

    /**
     * @return HasOne
     */
    public function contactPerson()
    {
        return $this->hasOne('App\Models\Accounts\ContactPerson');
    }

    /**
     * @return HasMany
     */
    public function educationStatus()
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
     * @return HasMany
     */
    public function forums()
    {
        return $this->hasMany('App\Models\Forums\Forum');
    }

     /**
     * @return HasMany
     */
    public function sentForumMessages()
    {
        return $this->hasMany('App\Models\Forums\ForumMessage', 'sender_id');
    }

    /**
     * @return HasMany
     */
    public function receivedForumMessages()
    {
        return $this->hasMany('App\Models\Forums\ForumMessage', 'receiver_id');
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
     * @return HasMany
     */
    public function notices()
    {
        return $this->hasMany('App\Models\Notices\Notice');
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
     * @return MorphOne
     */
    public function file()
    {
        return $this->morphOne('App\Models\Generics\File', 'fileable');
    }
}
