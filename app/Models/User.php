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
        'dob',
        'subscription_status',
        'subscription_plan',
        'subscription_ends_at',
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

    public function linkedStaffProfile()
    {
        return $this->hasOne(Staff::class, 'staff_user_id');
    }

    /**
     * Returns the business context (Advisor) for data fetching.
     */
    public function context(): self
    {
        if ($this->role === 'staff' && $this->linkedStaffProfile) {
            return $this->linkedStaffProfile->advisor;
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
}
