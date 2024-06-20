<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanHistory extends Model
{
    use HasFactory;

    const STATUS_NOT_YET_REGISTERED = 'NOT YET REGISTERED';
    const STATUS_IN_PROGRESS_DOCUMENTS_UPLOADED = 'IN PROGRESS DOCUMENTS UPLOADED';
    const STATUS_LOAN_APPROVED = 'LOAN APPROVED';
    const STATUS_LOAN_SANCTIONED = 'LOAN SANCTIONED';
    const STATUS_AMOUNT_CREDITED = 'AMOUNT CREDITED';

    protected $table = 'loan_histories';

    protected $fillable = [
        'loan_no',
        'status'
    ];
}
