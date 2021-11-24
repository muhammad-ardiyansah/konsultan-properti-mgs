<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Pengajuan_developer;

class CheckPengajuanBlokRumah implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    protected $developerId;
    protected $perumahanDeveloperId; 
    protected $ignoreId = null;    

    public function __construct($developerId, $perumahanDeveloperId, $ignoreId=null)
    {
        $this->developerId = $developerId;
        $this->perumahanDeveloperId = $perumahanDeveloperId;
        $this->ignoreId = $ignoreId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        // echo "developerId : ".$this->developerId;die;
        // dd($this->ignoreId);

        $arrValue = explode(',', $value);
        $chkPengajuanDeveloper = Pengajuan_developer::whereIn('blok_rumah', ['A1,A2,A3,A4,A5'])->get();
        print_r($chkPengajuanDeveloper);die;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
