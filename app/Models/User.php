<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'company_name',
        'email',
        'password',
        'role',
        'avatar',
        'brand_logo',
        'brand_color',
        'unique_id',
        'subscription_status',
        'subscription_plan',
        'subscription_ends_at',
        'birthday_template',
        'anniversary_template',
        'commission_rates',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'subscription_ends_at' => 'datetime',
            'commission_rates' => 'array',
        ];
    }

    public function isAdvisor(): bool
    {
        return $this->role === 'advisor' || $this->role === 'admin';
    }

    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function queries()
    {
        return $this->hasMany(Query::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function renewals()
    {
        return $this->hasMany(Renewal::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'advisor_id');
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function linkedStaffProfile()
    {
        return $this->hasOne(Staff::class, 'staff_user_id')->withoutGlobalScopes();
    }

    /**
     * Returns the business context (Advisor) for data fetching.
     */
    public function context(): self
    {
        if ($this->role === 'staff') {
            $profile = $this->linkedStaffProfile()->first();
            if ($profile && $profile->advisor) {
                return $profile->advisor;
            }
        }
        return $this;
    }

    /**
     * Helper to check if the workspace subscription is active
     */
    public function hasActiveSubscription(): bool
    {
        $tenant = $this->context();

        if (!$tenant) {
            return false;
        }

        if ($tenant->subscription_status === 'active') {
            return true;
        }

        if ($tenant->subscription_ends_at) {
            try {
                $date = \Illuminate\Support\Carbon::parse($tenant->subscription_ends_at);
                return $date->isFuture();
            } catch (\Exception $e) {
                return false;
            }
        }

        return false;
    }

    /**
     * Get the URL for the user's avatar.
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if (!$this->avatar) {
            return null;
        }

        $disk = config('filesystems.disks.s3.key') ? 's3' : 'public';

        return \Illuminate\Support\Facades\Storage::disk($disk)->url($this->avatar);
    }

    /**
     * Get the URL for the workplace logo.
     */
    public function getLogoUrlAttribute(): ?string
    {
        $context = $this->context();
        if (!$context || !$context->brand_logo) {
            return null;
        }

        $disk = config('filesystems.disks.s3.key') ? 's3' : 'public';

        return \Illuminate\Support\Facades\Storage::disk($disk)->url($context->brand_logo);
    }
}
