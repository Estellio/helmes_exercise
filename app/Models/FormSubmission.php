<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = [
        'session_id',
        'name',
        'accept_terms'
    ];

    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'form_submission_sector', 'form_submission_id', 'sector_number', 'id', 'sector_number');
    }
}
