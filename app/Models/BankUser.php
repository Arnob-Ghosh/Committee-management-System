<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'member_id',
        'name',
        'email',
        'password',
        'contact',
        'bank_name',
        'father_name',
        'mother_name',
        'spouse_name',
        'birth_date',
        'nationality',
        'nid',
        'religion',
        'image',
        'signature',
        'designation_id',
        'comitee_designation',
        'transaction_id',
        'blood_group',
        'district',
        'thana_id',
        'union_id',
        'village_id',
        'post_office',
        'branch',
        'section',
        'present_address',
        'facebook_id',
        'status',
    ];

    // public function designation () {
    //     return $this->belongsTo(Designation::class, 'designation_id');
    // }

    // public function thana () {
    //     return $this->belongsTo(Thana::class, 'thana_id');
    // }

    // public function union () {
    //     return $this->belongsTo(Union::class, 'union_id');
    // }

    // public function village () {
    //     return $this->belongsTo(Village::class, 'village_id');
    // }

    // public function mourn_member () {
    //     return $this->hasOne(MournMember::class, 'id', 'member_id');
    // }

    public function designation () {
        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }

    public function thana () {
        return $this->hasOne(Thana::class, 'id', 'thana_id');
    }

    public function union () {
        return $this->hasOne(Union::class, 'id', 'union_id');
    }

    public function village () {
        return $this->hasOne(Village::class, 'id', 'village_id');
    }
}
