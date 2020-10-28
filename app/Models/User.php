<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\InvoicePaid;
use Illuminate\Notifications\Notifiable;

/**
 * Class User.
 *
 * @package namespace App\Models;
 */
class User extends Authenticatable implements Transformable
{
    use TransformableTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'password',
        'gender',
        'phone',
        'avatar_image',
        'status'
    ];

    public function sendInvoiceNotification($invoice)
    {
        $this->notify(new InvoicePaid($invoice));
    }

}
