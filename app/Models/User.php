<?php

namespace App\Models;

use App\Enums\Country;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Sushi\Sushi;

class User extends Authenticatable
{
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'receive_emails' => 'boolean',
        'receive_updates' => 'boolean',
        'receive_offers' => 'boolean',
        'country' => Country::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        //
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

    use Sushi;

    protected $rows = [
        [
            'id' => 1,
            'username' => 'void',
            'bio' => 'A little bit about myself...',
            'receive_emails' => false,
            'receive_updates' => '',
            'receive_offers' => '',
            'country' => 'US',
        ]
    ];
}
