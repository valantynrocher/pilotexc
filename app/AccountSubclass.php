<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountSubclass extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'account_subclasses';

    public $incrementing = false;

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['analytic_account_id', 'general_account_id', 'account_subclass_id', 'date_entry', 'journal', 'piece_nb', 'name', 'debit_amount', 'credit_amount', 'type_id'];

    // RELATIONS
    public function accountEntries()
    {
        return $this->hasMany('App\AccountEntry');
    }

    public function accountClass()
    {
        return $this->belongsTo('App\AccountClass');
    }
}
