<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Pengajuan_developer_detail;

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
        // var_dump($value);
        // echo ($value);
        // $arrValue[] = 'A1';
        $arrValue = explode(',', $value);
        // print_r($arrValue);die;
        $chkPengajuanDeveloper = Pengajuan_developer_detail::select('*')
        ->where('developer_id', '=', $this->developerId)
        ->where('perumahan_developer_id', '=', $this->perumahanDeveloperId)
        ->whereIn('blok_rumah', $arrValue)
        ->where('pengajuan_developer_id', '!=', $this->ignoreId)->get();
        // echo $chkPengajuanDeveloper->count();
        //print_r($chkPengajuanDeveloper);
        // die;
        if ($chkPengajuanDeveloper->count() == 0) {
            return true;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // return 'The validation error message.';
        return 'sudah ada yang pernah diajukan untuk perumahan yang anda pilih ';
    }
}
