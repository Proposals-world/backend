<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    // (Optional) If you named your table differently:
    // protected $table = 'contact_messages';

    // Which fields are fillable via create()/fill()
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];
}
