<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Sushi\Sushi;

class User extends Authenticatable
{
    use Sushi;

    protected $guarded = [];

    protected $rows = [
        [
            'id' => 1,
            'username' => 'void',
            'bio' => '',
            'receives_emails' => false,
            'receives_updates' => '',
            'receives_offers' => '',
            'country' => 'United States',
        ]
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
        ];
    }
}
