<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    public const ROLE_CUSTOMER             = 'customer'; 
    public const ROLE_SELLER               = 'seller'; 
    public const ROLE_PROFESSIONAL         = 'professional'; 

    public const USER_ACTIVE               = 'active';
    public const USER_IN_ACTIVE            = 'inactive';

    public const LENDER_APPROVED           = 'approved';
    public const LENDER_UNAPPROVED         = 'unapproved';

    public const WORKING_WITH_AGENT        = 'yes';
    public const NOT_WORKING_WITH_AGENT    = 'no';

    public const SEEN_STATUS               = 'seen';
    public const UN_SEEN_STATUS            = 'unseen';

    // Houses table
    public const HOUSE_FOR_RENT            = 'rent';
    public const HOUSE_FOR_SELL            = 'sell';

    public const HOUSE_SELL_STATUS         = 'sell';
    public const HOUSE_SOLD_STATUS         = 'sold';

    public const DELETED_STATUS            = 'deleted';
    public const NOT_DELETED_STATUS        = 'not deleted';

    // Payments table
    public const VISA_CARD                 = 'visa';
    public const MASTER_CARD               = 'master';
    public const MAESTRO_CARD              = 'maestro';
    public const AMERICAN_EXPRESS_CARD     = 'american_express';

    public const PAYMENT_PENDING           = 'pending';
    public const PAYMENT_FAILED            = 'failed';
    public const PAYMENT_PAID              = 'paid';

    // Favorites table
    public const ADDED_TO_FAVORITE         = 'favorite';
    public const NOT_ADDED_TO_FAVORITE     = 'unfavorite';



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
