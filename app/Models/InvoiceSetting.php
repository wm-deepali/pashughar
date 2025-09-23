<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSetting extends Model
{
    use HasFactory;
    protected $table = 'invoice_tax';
    protected $fillable = [
        'company_name',
        'registration_number',
        'gst_number',
        'pan_number',
        'registered_address',
        'country',
        'state',
        'city',
        'zip_code',
        'sgst',
        'cgst',
        'igst',
        'invoice_prefix',
        'invoice_number',
        'term_and_condition',
    ];
}
