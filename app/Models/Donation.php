<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $table = 'donations';

    protected $fillable = ['title', 'description', 'target_amount', 'user_id', 'is_complete','totalAmountRaised'];

    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('amount')
            ->withTimestamps();
    }

    public function userHasDonated($userId)
    {
        return $this->participants()
            ->where('user_id', $userId)
            ->count() > 0;
    }

    public function getUserDonationHistory($userId)
    {
        return $this->participants()
            ->where('user_id', $userId)
            ->get();
    }

    // Donation.php

public function donors()
{
    return $this->belongsToMany(User::class, 'donation_user')->withPivot('amount');
}



}
