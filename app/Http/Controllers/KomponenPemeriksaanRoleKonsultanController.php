<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use App\Models\Tlu_master_template_komponen_pemeriksaan;
use App\Models\Tlu_jenis_input_pengukuran;
use App\Models\Tlu_satuan_input_pengukuran;
use App\Models\Template_komponen_pemeriksaan;
use App\Models\Template_struktural_fondasi;
use App\Models\Tlu_list_checkbox;
use App\Models\Tlu_list;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class KomponenPemeriksaanRoleKonsultanController extends Controller
{
    //
    public function masterTemplateKomponenPemeriksaan(Request $request)
    {

        $tluMasterTemplates = Tlu_master_template_komponen_pemeriksaan::select('*')
            ->where('nama_master', 'LIKE','%'.$request->nama_master.'%')
            ->paginate(3)->withQueryString();
        // return $perumahanDevelopers;
        return view('konsultan.master-template-komponen', compact('tluMasterTemplates'));

    }

    public function tambahMasterTemplateKomponenPemeriksaan()
    {
        $provinces = Province::pluck('name', 'code');
        return view('konsultan.tambah-master-template-komponen',
        compact(
            'provinces',
        ));
    }    

    public function editMasterTemplateKomponenPemeriksaan(Request $request)
    {
        $provinces = Province::pluck('name', 'code');
        $tluMasterTemplate = Tlu_master_template_komponen_pemeriksaan::find($request->id);
        return view('konsultan.edit-master-template-komponen', compact(
            'tluMasterTemplate',
            'provinces'
        ));
    
    }

    public function simpanMasterTemplateKomponenPemeriksaan(Request $request)
    {

        // $input = $request->all();
        // return response()->json($input);

        $request->validate(
            [
                'nama_master' => 'required|unique:tlu_master_template_komponen_pemeriksaans,nama_master,' . $request->id,
                'province_code' => 'required'
            ], 
            [
                'nama_master.required' => 'Nama master harus diisi',
                'nama_master.unique' => 'sudah ada',
                'province_code.required' => 'Propinsi Apersi belum dipilih'
            ]
        );        

        $aktifValue = isset($request->aktif) ? 1 : 0;

        $createMasterTemplate = Tlu_master_template_komponen_pemeriksaan::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'nama_master'=>$request->nama_master,
                'aktif'=>$aktifValue,
                'province_code'=>$request->province_code
            ]
        );
        return redirect()->route('konsultan.masterTemplateKomponenPemeriksaan', )->with('success','Data berhasil disimpan.'); 

    }

    public function deleteMasterTemplateKomponenPemeriksaan(Request $request) {

        $tluMasterTemplate = Tlu_master_template_komponen_pemeriksaan::find($request->id);

        if ($tluMasterTemplate->delete()) {
            return redirect()->route('konsultan.masterTemplateKomponenPemeriksaan')->with('success','Data berhasil dihapus.'); 
        }else{
            return redirect()->route('konsultan.masterTemplateKomponenPemeriksaan')->with('fail','Data gagal dihapus.');
        }

    }    

    public function templateStrukturalFondasi() {
        $tluMasterTemplates = Tlu_master_template_komponen_pemeriksaan::pluck('nama_master', 'id');
        return view('konsultan.struktural-fondasi.index', compact('tluMasterTemplates')); 
    }

    public function getDataTemplateStrukturalFondasi(Request $request)
    {
    
        $templateStrukturalFondasis = Template_struktural_fondasi::select('*')
            ->where('parent_id', NULL)
            ->where('tlu_master_template_id', '=', $request->tlu_master_template_id)
            ->get();
        
        // $temp = "<pre>".print_r($templateStrukturalFondasis);
        // $temp = $templateStrukturalFondasis;    
        
        $tluMasterTemplateId = $request->tlu_master_template_id;
        $printOnTemplate = "";
        foreach ($templateStrukturalFondasis as $templateStrukturalFondasi) {
            
            $temp ="";
            // jenis input pengukuran 1
            $jenisInputPengukuran1 = "";
            // $temp = str_replace("[no_komponen]", $templateStrukturalFondasi->no_komponen, $templateStrukturalFondasi->print_on_template);
            $temp = str_replace("[no_komponen]", $templateStrukturalFondasi->no_komponen, strip_tags($templateStrukturalFondasi->print_on_template, '<div>'));
            $temp = str_replace("[nama_komponen]", " ".$templateStrukturalFondasi->nama_komponen, $temp);            

            if (!empty($templateStrukturalFondasi->label_1)) {
                $temp = str_replace("[label_1]", " ".$templateStrukturalFondasi->label_1, $temp);
            }
            if ($templateStrukturalFondasi->jenis_input_pengukuran_1 == 1) {
                $jenisInputPengukuran1 = "<input type=\"text\" class=\"form-control input_angka_pengukuran_1\" name=\"input_angka_pengukuran_1[]\" value=\"\" >";
            }            

            if ($templateStrukturalFondasi->jenis_input_pengukuran_1 == 2) {
                $jenisInputPengukuran1 = "<input type=\"text\" class=\"form-control input_text_pengukuran_1\" name=\"input_text_pengukuran_1[]\" value=\"\" >";
            }

            if ($templateStrukturalFondasi->jenis_input_pengukuran_1 == 3) {
                if(strpos($templateStrukturalFondasi->list_data_input_pengukuran_1, '|') !== false){
                    $lists = explode("|",$templateStrukturalFondasi->list_data_input_pengukuran_1);
                }else{
                    $lists = explode(",",$templateStrukturalFondasi->list_data_input_pengukuran_1);
                }

                for ($x = 0; $x < count($lists); $x++) {
                    $jenisInputPengukuran1 = "<div class=\"form-check mb-2\">";
                    $jenisInputPengukuran1 .= "<input type=\"checkbox\" class=\"form-check-input\" id=\"customCheckcolor1\">";
                    // $jenisInputPengukuran1 .= stripos($temp, "[label][0]"); 
                    if (stripos($temp, "[label_checkbox_1][".$x."]") > 0) {
                        $jenisInputPengukuran1 .= "[label_checkbox_1][".$x."]";
                        $temp = str_replace("[label_checkbox_1][".$x."]", "", $temp);
                    }
                    $jenisInputPengukuran1 .= "</div>";                   
                    $temp = str_replace("[jenis_input_pengukuran_1][".$x."]", $jenisInputPengukuran1, $temp);
                    $labelCheckbox = "<label class=\"form-check-label col-12\" for=\"customCheckcolor1\">".$lists[$x]."</label>";
                    $temp = str_replace("[label_checkbox_1][".$x."]", $labelCheckbox, $temp);
                    
                } 

            }
            
            if ($templateStrukturalFondasi->jenis_input_pengukuran_1 == 4) {
                $jenisInputPengukuran1 = "<select class=\"form-select\" name=\"input_selectbox_pengukuran_1[]\" id=\"input_selectbox_pengukuran_1\" >";
                $jenisInputPengukuran1 .= "<option value=\"\">[- Pilih List -]</option>";
                if(strpos($templateStrukturalFondasi->list_data_input_pengukuran_1, '|') !== false){
                    $lists = explode("|",$templateStrukturalFondasi->list_data_input_pengukuran_1);
                }else{
                    $lists = explode(",",$templateStrukturalFondasi->list_data_input_pengukuran_1);
                }
                foreach($lists as $list) {
                    $selected = "";
                    if ($list == $request->old('input_selectbox_pengukuran_1')) {
                        $selected = "selected";
                    }
                    $jenisInputPengukuran1 .= "<option value=".$list." ".$selected.">".$list."</option>";
                }
                $jenisInputPengukuran1 .= "</select>";
            }            
            $temp = str_replace("[jenis_input_pengukuran_1]", $jenisInputPengukuran1, $temp);
            if (!empty($templateStrukturalFondasi->satuan_input_pengukuran_1)) {
                $temp = str_replace("[satuan_input_pengukuran_1]", $templateStrukturalFondasi->satuan_input_pengukuran_1, $temp);
            }
            // end jenis input pengukuran 1
            
            // jenis input pengukuran 2
            $jenisInputPengukuran2 = "";

            if (!empty($templateStrukturalFondasi->label_2)) {
                $temp = str_replace("[label_2]", " ".$templateStrukturalFondasi->label_2, $temp);
            }
            if ($templateStrukturalFondasi->jenis_input_pengukuran_2 == 1) {
                $jenisInputPengukuran2 = "<input type=\"text\" class=\"form-control input_angka_pengukuran_2\" name=\"input_angka_pengukuran_2[]\" value=\"\" >";
            }            

            if ($templateStrukturalFondasi->jenis_input_pengukuran_2 == 2) {
                $jenisInputPengukuran2 = "<input type=\"text\" class=\"form-control input_text_pengukuran_2\" name=\"input_text_pengukuran_2[]\" value=\"\" >";
            }

            if ($templateStrukturalFondasi->jenis_input_pengukuran_2 == 3) {
                if(strpos($templateStrukturalFondasi->list_data_input_pengukuran_2, '|') !== false){
                    $lists = explode("|",$templateStrukturalFondasi->list_data_input_pengukuran_2);
                }else{
                    $lists = explode(",",$templateStrukturalFondasi->list_data_input_pengukuran_2);
                }

                for ($x = 0; $x < count($lists); $x++) {
                    $jenisInputPengukuran2 = "<div class=\"form-check mb-2\">";
                    $jenisInputPengukuran2 .= "<input type=\"checkbox\" class=\"form-check-input\" id=\"customCheckcolor1\">";
                    // $jenisInputPengukuran2 .= stripos($temp, "[label][0]"); 
                    if (stripos($temp, "[label_checkbox_2][".$x."]") > 0) {
                        $jenisInputPengukuran2 .= "[label_checkbox_2][".$x."]";
                        $temp = str_replace("[label_checkbox_2][".$x."]", "", $temp);
                    }
                    $jenisInputPengukuran2 .= "</div>";                   
                    $temp = str_replace("[jenis_input_pengukuran_2][".$x."]", $jenisInputPengukuran2, $temp);
                    $labelCheckbox = "<label class=\"form-check-label col-12\" for=\"customCheckcolor1\">".$lists[$x]."</label>";
                    $temp = str_replace("[label_checkbox_2][".$x."]", $labelCheckbox, $temp);
                    
                } 

            }
            
            if ($templateStrukturalFondasi->jenis_input_pengukuran_2 == 4) {
                $jenisInputPengukuran2 = "<select class=\"form-select\" name=\"input_selectbox_pengukuran_2[]\" id=\"input_selectbox_pengukuran_2\" >";
                $jenisInputPengukuran2 .= "<option value=\"\">[- Pilih List -]</option>";
                if(strpos($templateStrukturalFondasi->list_data_input_pengukuran_2, '|') !== false){
                    $lists = explode("|",$templateStrukturalFondasi->list_data_input_pengukuran_2);
                }else{
                    $lists = explode(",",$templateStrukturalFondasi->list_data_input_pengukuran_2);
                }
                foreach($lists as $list) {
                    $selected = "";
                    if ($list == $request->old('input_selectbox_pengukuran_2')) {
                        $selected = "selected";
                    }
                    $jenisInputPengukuran2 .= "<option value=".$list." ".$selected.">".$list."</option>";
                }
                $jenisInputPengukuran2 .= "</select>";
            }            
            $temp = str_replace("[jenis_input_pengukuran_2]", $jenisInputPengukuran2, $temp);
            if (!empty($templateStrukturalFondasi->satuan_input_pengukuran_2)) {
                $temp = str_replace("[satuan_input_pengukuran_2]", $templateStrukturalFondasi->satuan_input_pengukuran_2, $temp);
            }
            // end jenis input pengukuran 2

            // jenis input pengukuran 3
            $jenisInputPengukuran3 = "";

            if (!empty($templateStrukturalFondasi->label_3)) {
                $temp = str_replace("[label_3]", " ".$templateStrukturalFondasi->label_3, $temp);
            }
            if ($templateStrukturalFondasi->jenis_input_pengukuran_3 == 1) {
                $jenisInputPengukuran3 = "<input type=\"text\" class=\"form-control input_angka_pengukuran_3\" name=\"input_angka_pengukuran_3[]\" value=\"\" >";
            }            

            if ($templateStrukturalFondasi->jenis_input_pengukuran_3 == 2) {
                $jenisInputPengukuran3 = "<input type=\"text\" class=\"form-control input_text_pengukuran_3\" name=\"input_text_pengukuran_3[]\" value=\"\" >";
            }

            if ($templateStrukturalFondasi->jenis_input_pengukuran_3 == 3) {
                if(strpos($templateStrukturalFondasi->list_data_input_pengukuran_3, '|') !== false){
                    $lists = explode("|",$templateStrukturalFondasi->list_data_input_pengukuran_3);
                }else{
                    $lists = explode(",",$templateStrukturalFondasi->list_data_input_pengukuran_3);
                }

                for ($x = 0; $x < count($lists); $x++) {
                    $jenisInputPengukuran3 = "<div class=\"form-check mb-2\">";
                    $jenisInputPengukuran3 .= "<input type=\"checkbox\" class=\"form-check-input\" id=\"customCheckcolor1\">";
                    // $jenisInputPengukuran3 .= stripos($temp, "[label][0]"); 
                    if (stripos($temp, "[label_checkbox_3][".$x."]") > 0) {
                        $jenisInputPengukuran3 .= "[label_checkbox_3][".$x."]";
                        $temp = str_replace("[label_checkbox_3][".$x."]", "", $temp);
                    }
                    $jenisInputPengukuran3 .= "</div>";                   
                    $temp = str_replace("[jenis_input_pengukuran_3][".$x."]", $jenisInputPengukuran3, $temp);
                    $labelCheckbox = "<label class=\"form-check-label col-12\" for=\"customCheckcolor1\">".$lists[$x]."</label>";
                    $temp = str_replace("[label_checkbox_3][".$x."]", $labelCheckbox, $temp);
                    
                } 

            }
            
            if ($templateStrukturalFondasi->jenis_input_pengukuran_3 == 4) {
                $jenisInputPengukuran3 = "<select class=\"form-select\" name=\"input_selectbox_pengukuran_3[]\" id=\"input_selectbox_pengukuran_3\" >";
                $jenisInputPengukuran3 .= "<option value=\"\">[- Pilih List -]</option>";
                if(strpos($templateStrukturalFondasi->list_data_input_pengukuran_3, '|') !== false){
                    $lists = explode("|",$templateStrukturalFondasi->list_data_input_pengukuran_3);
                }else{
                    $lists = explode(",",$templateStrukturalFondasi->list_data_input_pengukuran_3);
                }
                foreach($lists as $list) {
                    $selected = "";
                    if ($list == $request->old('input_selectbox_pengukuran_3')) {
                        $selected = "selected";
                    }
                    $jenisInputPengukuran3 .= "<option value=".$list." ".$selected.">".$list."</option>";
                }
                $jenisInputPengukuran3 .= "</select>";
            }            
            $temp = str_replace("[jenis_input_pengukuran_3]", $jenisInputPengukuran3, $temp);
            if (!empty($templateStrukturalFondasi->satuan_input_pengukuran_3)) {
                $temp = str_replace("[satuan_input_pengukuran_3]", $templateStrukturalFondasi->satuan_input_pengukuran_3, $temp);
            }
            // end jenis input pengukuran 3

            // jenis input pengukuran 4
            $jenisInputPengukuran4 = "";

            if (!empty($templateStrukturalFondasi->label_4)) {
                $temp = str_replace("[label_4]", " ".$templateStrukturalFondasi->label_4, $temp);
            }
            if ($templateStrukturalFondasi->jenis_input_pengukuran_4 == 1) {
                $jenisInputPengukuran4 = "<input type=\"text\" class=\"form-control input_angka_pengukuran_4\" name=\"input_angka_pengukuran_4[]\" value=\"\" >";
            }            

            if ($templateStrukturalFondasi->jenis_input_pengukuran_4 == 2) {
                $jenisInputPengukuran4 = "<input type=\"text\" class=\"form-control input_text_pengukuran_4\" name=\"input_text_pengukuran_4[]\" value=\"\" >";
            }

            if ($templateStrukturalFondasi->jenis_input_pengukuran_4 == 3) {
                if(strpos($templateStrukturalFondasi->list_data_input_pengukuran_4, '|') !== false){
                    $lists = explode("|",$templateStrukturalFondasi->list_data_input_pengukuran_4);
                }else{
                    $lists = explode(",",$templateStrukturalFondasi->list_data_input_pengukuran_4);
                }

                for ($x = 0; $x < count($lists); $x++) {
                    $jenisInputPengukuran4 = "<div class=\"form-check mb-2\">";
                    $jenisInputPengukuran4 .= "<input type=\"checkbox\" class=\"form-check-input\" id=\"customCheckcolor1\">";
                    // $jenisInputPengukuran4 .= stripos($temp, "[label][0]"); 
                    if (stripos($temp, "[label_checkbox_4][".$x."]") > 0) {
                        $jenisInputPengukuran4 .= "[label_checkbox_4][".$x."]";
                        $temp = str_replace("[label_checkbox_4][".$x."]", "", $temp);
                    }
                    $jenisInputPengukuran4 .= "</div>";                   
                    $temp = str_replace("[jenis_input_pengukuran_4][".$x."]", $jenisInputPengukuran4, $temp);
                    $labelCheckbox = "<label class=\"form-check-label col-12\" for=\"customCheckcolor1\">".$lists[$x]."</label>";
                    $temp = str_replace("[label_checkbox_4][".$x."]", $labelCheckbox, $temp);
                    
                } 

            }
            
            if ($templateStrukturalFondasi->jenis_input_pengukuran_4 == 4) {
                $jenisInputPengukuran4 = "<select class=\"form-select\" name=\"input_selectbox_pengukuran_4[]\" id=\"input_selectbox_pengukuran_4\" >";
                $jenisInputPengukuran4 .= "<option value=\"\">[- Pilih List -]</option>";
                if(strpos($templateStrukturalFondasi->list_data_input_pengukuran_4, '|') !== false){
                    $lists = explode("|",$templateStrukturalFondasi->list_data_input_pengukuran_4);
                }else{
                    $lists = explode(",",$templateStrukturalFondasi->list_data_input_pengukuran_4);
                }
                foreach($lists as $list) {
                    $selected = "";
                    if ($list == $request->old('input_selectbox_pengukuran_4')) {
                        $selected = "selected";
                    }
                    $jenisInputPengukuran4 .= "<option value=".$list." ".$selected.">".$list."</option>";
                }
                $jenisInputPengukuran4 .= "</select>";
            }            
            $temp = str_replace("[jenis_input_pengukuran_4]", $jenisInputPengukuran4, $temp);
            if (!empty($templateStrukturalFondasi->satuan_input_pengukuran_4)) {
                $temp = str_replace("[satuan_input_pengukuran_4]", $templateStrukturalFondasi->satuan_input_pengukuran_4, $temp);
            }
            // end jenis input pengukuran 4
            $printOnTemplate .= "<div class=\"col-12 text-end\"><a href=\"".route('konsultan.editKomponenTemplateStrukturalFondasi', ['id'=>$templateStrukturalFondasi->id])."\" class=\"edit\">Edit</a> <a href=\"".route('konsultan.deleteKomponenTemplateStrukturalFondasi', ['id'=>$templateStrukturalFondasi->id])."\" class=\"delete\">Delete</a></div>";
            $printOnTemplate .= $temp;
        
        }
        
        // return $printOnTemplate;
        // $printOnTemplate = strip_tags($printOnTemplate);
        // $printOnTemplate = strip_tags($printOnTemplate, ['<div>', '<select>', '<option>', '<input>']); 
        return view('konsultan.struktural-fondasi.get-data-template-struktural-fondasi', 
        compact(
            'templateStrukturalFondasis',
            'tluMasterTemplateId',
            'printOnTemplate',
        ));

    }

    public function tambahKomponenTemplateStrukturalFondasi(Request $request) 
    {
        $tluMasterTemplateId = $request->tlu_master_template_id;
        $parentId = $request->parent_id;
        $tluJenisInputPengukurans = Tlu_jenis_input_pengukuran::pluck('jenis_input', 'id');
        $tluSatuanInputPengukurans = Tlu_satuan_input_pengukuran::pluck('lambang', 'id');
        $tluListCheckboxes = Tlu_list_checkbox::pluck('list_checkbox', 'id');
        return view('konsultan.struktural-fondasi.tambah.tambah-komponen-template', 
        compact(
            'tluJenisInputPengukurans',
            'tluSatuanInputPengukurans',
            'tluListCheckboxes',
            'tluMasterTemplateId',
            'parentId'
        ));        
    }    

    public function editKomponenTemplateStrukturalFondasi(Request $request) 
    {
        $templateStrukturalFondasi = Template_struktural_fondasi::find($request->id);
        $tluJenisInputPengukurans = Tlu_jenis_input_pengukuran::pluck('jenis_input', 'id');
        $tluSatuanInputPengukurans = Tlu_satuan_input_pengukuran::pluck('lambang', 'id');
        $tluLists = Tlu_list::where('param', 'LIKE','%template_struktural_fondasi%')->pluck('list', 'id');
        return view('konsultan.struktural-fondasi.edit.edit-komponen-template', 
        compact(
        'templateStrukturalFondasi',
        'tluJenisInputPengukurans',
        'tluSatuanInputPengukurans',
        'tluLists'            
        )
    );
    }

    public function getKelInpAngPeng1StrukturalFondasi() {
        $tluSatuanInputPengukurans = Tlu_satuan_input_pengukuran::pluck('lambang', 'id');
        return view('konsultan.struktural-fondasi.tambah.kelompok-input-angka-pengukuran-1', 
        compact(
            'tluSatuanInputPengukurans'
        ));
    }    

    public function getKelInpAngPeng2StrukturalFondasi() {
        $tluSatuanInputPengukurans = Tlu_satuan_input_pengukuran::pluck('lambang', 'id');
        return view('konsultan.struktural-fondasi.tambah.kelompok-input-angka-pengukuran-2', 
        compact(
            'tluSatuanInputPengukurans'
        ));
    }

    public function getKelInpAngPeng3StrukturalFondasi() {
        $tluSatuanInputPengukurans = Tlu_satuan_input_pengukuran::pluck('lambang', 'id');
        return view('konsultan.struktural-fondasi.tambah.kelompok-input-angka-pengukuran-3', 
        compact(
            'tluSatuanInputPengukurans'
        ));
    }

    public function getKelInpAngPeng4StrukturalFondasi() {
        $tluSatuanInputPengukurans = Tlu_satuan_input_pengukuran::pluck('lambang', 'id');
        return view('konsultan.struktural-fondasi.tambah.kelompok-input-angka-pengukuran-4', 
        compact(
            'tluSatuanInputPengukurans'
        ));
    }

    public function getKelInpChkboxPeng1StrukturalFondasi() {
        $tluLists = Tlu_list::where('param', 'LIKE','%template_struktural_fondasi%')->pluck('list', 'id');
        return view('konsultan.struktural-fondasi.tambah.kelompok-input-checkbox-pengukuran-1', 
        compact(
            'tluLists'
        ));
    }

    public function getKelInpChkboxPeng2StrukturalFondasi() {
        $tluLists = Tlu_list::where('param', 'LIKE','%template_struktural_fondasi%')->pluck('list', 'id');
        return view('konsultan.struktural-fondasi.tambah.kelompok-input-checkbox-pengukuran-2', 
        compact(
            'tluLists'
        ));
    }

    public function getKelInpChkboxPeng3StrukturalFondasi() {
        $tluLists = Tlu_list::where('param', 'LIKE','%template_struktural_fondasi%')->pluck('list', 'id');
        return view('konsultan.struktural-fondasi.tambah.kelompok-input-checkbox-pengukuran-3', 
        compact(
            'tluLists'
        ));
    }    

    public function getKelInpChkboxPeng4StrukturalFondasi() {
        $tluLists = Tlu_list::where('param', 'LIKE','%template_struktural_fondasi%')->pluck('list', 'id');
        return view('konsultan.struktural-fondasi.tambah.kelompok-input-checkbox-pengukuran-4', 
        compact(
            'tluLists'
        ));
    }

    public function simpanKomponenTemplateStrukturalFondasi(Request $request) {

        // $input = $request->all();
        // return $input;

        $rules = [
            // 'no_komponen' => 'required',
            // 'nama_komponen'=>'required', 
        ];

        $messages = [
            // 'no_komponen.required' => 'No. Komponen harus diisi',
            // 'nama_komponen.required' => 'Nama Komponen harus diisi',
        ];        
       
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            // return redirect()->route('developer.tambahPerumahanDeveloper', ['developer_id'=>$request->developer_id])->withInput()->withErrors($validator->errors());
            if (isset($request->id)) {
                // return redirect()->route('developer.editPerumahanDeveloper', ['id'=>$request->id])->withInput()->withErrors($validator->errors());    
            }
            return redirect()->route('konsultan.tambahKomponenTemplateStrukturalFondasi', ['tlu_master_template_id'=>$request->tlu_master_template_id, 'parent_id'=>$request->parent_id])->withInput()->withErrors($validator->errors());        
        }

        // $input = $request->all();
        // return response()->json($input);

        $noKomponen = !empty($request->no_komponen) ? $request->no_komponen : null;
        $namaKomponen = !empty($request->nama_komponen) ? $request->nama_komponen : null;

        $jenisInputPengukuran1 = !empty($request->jenis_input_pengukuran_1) ? $request->jenis_input_pengukuran_1 : 0;
        $satuanInputPengukuran1 = isset($request->satuan_input_pengukuran_1) ? $request->satuan_input_pengukuran_1 : null;  
        $label1 = !empty($request->label_1) ? $request->label_1 : null;    
        $listDataInputPengukuran1 = isset($request->list_data_input_pengukuran_1) ? $request->list_data_input_pengukuran_1 : null;
        
        $jenisInputPengukuran2 = !empty($request->jenis_input_pengukuran_2) ? $request->jenis_input_pengukuran_2 : 0;
        $satuanInputPengukuran2 = isset($request->satuan_input_pengukuran_2) ? $request->satuan_input_pengukuran_2 : null;  
        $label2 = !empty($request->label_2) ? $request->label_2 : null;    
        $listDataInputPengukuran2 = isset($request->list_data_input_pengukuran_2) ? $request->list_data_input_pengukuran_2 : null;

        $jenisInputPengukuran3 = !empty($request->jenis_input_pengukuran_3) ? $request->jenis_input_pengukuran_3 : 0;
        $satuanInputPengukuran3 = isset($request->satuan_input_pengukuran_3) ? $request->satuan_input_pengukuran_3 : null;  
        $label3 = !empty($request->label_3) ? $request->label_3 : null;    
        $listDataInputPengukuran3 = isset($request->list_data_input_pengukuran_3) ? $request->list_data_input_pengukuran_3 : null;        

        $jenisInputPengukuran4 = !empty($request->jenis_input_pengukuran_4) ? $request->jenis_input_pengukuran_4 : 0;
        $satuanInputPengukuran4 = isset($request->satuan_input_pengukuran_4) ? $request->satuan_input_pengukuran_4 : null;  
        $label4 = !empty($request->label_4) ? $request->label_4 : null;    
        $listDataInputPengukuran4 = isset($request->list_data_input_pengukuran_4) ? $request->list_data_input_pengukuran_4 : null;        

        $printOnTemplate = !empty($request->print_on_template) ? $request->print_on_template : null;
        // echo "jenisInputPengukuran4 : ".$jenisInputPengukuran4;
        // die;

        // DB::enableQueryLog(); 
        $createTemplate = Template_struktural_fondasi::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'tlu_master_template_id'=>$request->tlu_master_template_id,
                'parent_id'=>$request->parent_id,
                'no_komponen'=>$noKomponen,
                'nama_komponen'=>$namaKomponen,
                'jenis_input_pengukuran_1'=>$request->jenis_input_pengukuran_1,
                'satuan_input_pengukuran_1'=>$satuanInputPengukuran1,
                'label_1'=>$label1,
                'list_data_input_pengukuran_1'=>$listDataInputPengukuran1,
                'jenis_input_pengukuran_2'=>$jenisInputPengukuran2,
                'satuan_input_pengukuran_2'=>$satuanInputPengukuran2,
                'label_2'=>$label2,
                'list_data_input_pengukuran_2'=>$listDataInputPengukuran2,
                'jenis_input_pengukuran_3'=>$jenisInputPengukuran3,
                'satuan_input_pengukuran_3'=>$satuanInputPengukuran3,
                'label_3'=>$label3,
                'list_data_input_pengukuran_3'=>$listDataInputPengukuran3,
                'jenis_input_pengukuran_4'=>$jenisInputPengukuran4,
                'satuan_input_pengukuran_4'=>$satuanInputPengukuran4,
                'label_4'=>$label4,
                'list_data_input_pengukuran_4'=>$listDataInputPengukuran4,
                'print_on_template'=>$printOnTemplate,                
            ]
        );
        // dd(DB::getQueryLog());
        // die;
        return redirect()->route('konsultan.getDataTemplateStrukturalFondasi', ['tlu_master_template_id'=>$request->tlu_master_template_id] )->with('success','Data berhasil disimpan.'); 

    }

    public function templateKomponenPemeriksaan() 
    {
        // $templateKomponenPemeriksaans = Template_komponen_pemeriksaan::paginate(3)->withQueryString();
        // $templateKomponenPemeriksaans = Template_komponen_pemeriksaan::where('parent_id',NULL)->get();
        // return view('konsultan.template-komponen_', compact('templateKomponenPemeriksaans'));
        $tluMasterTemplates = Tlu_master_template_komponen_pemeriksaan::pluck('nama_master', 'id');
        return view('konsultan.template-komponen.index', compact('tluMasterTemplates'));
    }

    public function getDataTemplateKomponenPemeriksaan(Request $request)
    {
        // $templateKomponens = Template_komponen_pemeriksaan::where('parent_id',NULL)->get();
        $templateKomponens = Template_komponen_pemeriksaan::select('*')
            ->where('parent_id', NULL)
            ->where('tlu_master_template_id', '=', $request->tlu_master_template_id)
            ->get();
        
        $tluMasterTemplateId = $request->tlu_master_template_id;

        return view('konsultan.template-komponen.get-data-template-komponen-pemeriksaan', 
        compact(
            'templateKomponens',
            'tluMasterTemplateId'
        ));

    }

    public function tambahTemplateKomponenPemeriksaan_() 
    {
        $tluMasterTemplates = Tlu_master_template_komponen_pemeriksaan::pluck('nama_master', 'id');
        $templateKomponenPemeriksaans = Template_komponen_pemeriksaan::where('parent_id',NULL)->get();
        return view('konsultan.tambah-template-komponen_', 
        compact(
            'tluMasterTemplates',
            'templateKomponenPemeriksaans',
        ));
    
    }    

    public function tambahTemplateKomponenPemeriksaan(Request $request) 
    {
        $tluMasterTemplateId = $request->tlu_master_template_id;
        $parentId = $request->parent_id;
        $tluJenisInputPengukurans = Tlu_jenis_input_pengukuran::pluck('jenis_input', 'id');
        $tluSatuanInputPengukurans = Tlu_satuan_input_pengukuran::pluck('lambang', 'id');
        $tluListCheckboxes = Tlu_list_checkbox::pluck('list_checkbox', 'id');
        return view('konsultan.template-komponen.tambah.tambah-template-komponen', 
        compact(
            'tluJenisInputPengukurans',
            'tluSatuanInputPengukurans',
            'tluListCheckboxes',
            'tluMasterTemplateId',
            'parentId'
        ));        
    }

    public function editTemplateKomponenPemeriksaan(Request $request) 
    {
        // $tluMasterTemplates = Tlu_master_template_komponen_pemeriksaan::pluck('nama_master', 'id');
        $templateKomponenPemeriksaan = Template_komponen_pemeriksaan::find($request->id);
        $tluJenisInputPengukurans = Tlu_jenis_input_pengukuran::pluck('jenis_input', 'id');
        $tluSatuanInputPengukurans = Tlu_satuan_input_pengukuran::pluck('lambang', 'id');
        $tluListCheckboxes = Tlu_list_checkbox::pluck('list_checkbox', 'id');
        return view('konsultan.template-komponen.edit.edit-template-komponen', 
            compact(
            'templateKomponenPemeriksaan',
            'tluJenisInputPengukurans',
            'tluSatuanInputPengukurans',
            'tluListCheckboxes',            
            )
        );        
    }    

    public function deleteTemplateKomponenPemeriksaan(Request $request) {
        $templateKomponenPemeriksaan = Template_komponen_pemeriksaan::find($request->id);
        // return $templateKomponenPemeriksaan->subtemplatekomponen;
        
        $tluMasterTemplateId = $templateKomponenPemeriksaan->tlu_master_template_id;

        if (count($templateKomponenPemeriksaan->subtemplatekomponen)) {
            return redirect()->route('konsultan.getDataTemplateKomponenPemeriksaan', ['tlu_master_template_id'=>$tluMasterTemplateId])->with('fail','Data gagal dihapus. Karena komponen "'.$templateKomponenPemeriksaan->no_komponen.' '.$templateKomponenPemeriksaan->nama_komponen.'" masih memiliki sub komponen.');
        }

        if ($templateKomponenPemeriksaan->delete()) {
            return redirect()->route('konsultan.getDataTemplateKomponenPemeriksaan', ['tlu_master_template_id'=>$tluMasterTemplateId])->with('success','Data berhasil dihapus.'); 
        }else{
            return redirect()->route('konsultan.getDataTemplateKomponenPemeriksaan', ['tlu_master_template_id'=>$tluMasterTemplateId])->with('fail','Data gagal dihapus.');
        }

    }

    public function getKelompokInputAngkaPengukuran1() {
        $tluSatuanInputPengukurans = Tlu_satuan_input_pengukuran::pluck('lambang', 'id');
        return view('konsultan.template-komponen.tambah.kelompok-input-angka-pengukuran-1', 
        compact(
            'tluSatuanInputPengukurans'
        ));
    }

    public function getKelompokInputAngkaPengukuran2() {
        $tluSatuanInputPengukurans = Tlu_satuan_input_pengukuran::pluck('lambang', 'id');
        return view('konsultan.template-komponen.tambah.kelompok-input-angka-pengukuran-2', 
        compact(
            'tluSatuanInputPengukurans'
        ));
    }

    public function getKelompokInputAngkaPengukuran3() {
        $tluSatuanInputPengukurans = Tlu_satuan_input_pengukuran::pluck('lambang', 'id');
        return view('konsultan.template-komponen.tambah.kelompok-input-angka-pengukuran-3', 
        compact(
            'tluSatuanInputPengukurans'
        ));
    }

    public function getKelompokInputAngkaKeterangan() {
        $tluSatuanInputPengukurans = Tlu_satuan_input_pengukuran::pluck('lambang', 'id');
        return view('konsultan.template-komponen.tambah.kelompok-input-angka-keterangan', 
        compact(
            'tluSatuanInputPengukurans'
        ));
    }

    public function getKelompokInputCheckboxPengukuran1() {
        $tluListCheckboxes = Tlu_list_checkbox::pluck('list_checkbox', 'id');
        return view('konsultan.template-komponen.tambah.kelompok-input-checkbox-pengukuran-1', 
        compact(
            'tluListCheckboxes'
        ));
    }

    public function getKelompokInputCheckboxPengukuran2() {
        $tluListCheckboxes = Tlu_list_checkbox::pluck('list_checkbox', 'id');
        return view('konsultan.template-komponen.tambah.kelompok-input-checkbox-pengukuran-2', 
        compact(
            'tluListCheckboxes'
        ));
    }

    public function getKelompokInputCheckboxPengukuran3() {
        $tluListCheckboxes = Tlu_list_checkbox::pluck('list_checkbox', 'id');
        return view('konsultan.template-komponen.tambah.kelompok-input-checkbox-pengukuran-3', 
        compact(
            'tluListCheckboxes'
        ));
    }

    public function getKelompokInputCheckboxKeterangan() {
        $tluListCheckboxes = Tlu_list_checkbox::pluck('list_checkbox', 'id');
        return view('konsultan.template-komponen.tambah.kelompok-input-checkbox-keterangan', 
        compact(
            'tluListCheckboxes'
        ));
    }


    public function simpanTemplateKomponenPemeriksaan(Request $request)
    {

        // $input = $request->all();
        // return $input;

        $rules = [
            'no_komponen' => 'required',
            'nama_komponen'=>'required', 
        ];

        $messages = [
            'no_komponen.required' => 'No. Komponen harus diisi',
            'nama_komponen.required' => 'Nama Komponen harus diisi',
        ];        
       
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            // return redirect()->route('developer.tambahPerumahanDeveloper', ['developer_id'=>$request->developer_id])->withInput()->withErrors($validator->errors());
            if (isset($request->id)) {
                // return redirect()->route('developer.editPerumahanDeveloper', ['id'=>$request->id])->withInput()->withErrors($validator->errors());    
            }
            return redirect()->route('konsultan.tambahTemplateKomponenPemeriksaan', ['tlu_master_template_id'=>$request->tlu_master_template_id, 'parent_id'=>$request->parent_id])->withInput()->withErrors($validator->errors());        
        }

        // $input = $request->all();
        // return response()->json($input);

        $jenisInputPengukuran1 = !empty($request->jenis_input_pengukuran_1) ? $request->jenis_input_pengukuran_1 : 0;
        $satuanInputPengukuran1 = isset($request->satuan_input_pengukuran_1) ? $request->satuan_input_pengukuran_1 : null;  
        $textSebelumInputPengukuran1 = isset($request->text_sebelum_input_pengukuran_1) ? $request->text_sebelum_input_pengukuran_1 : null;    
        $listDataInputPengukuran1 = isset($request->list_data_input_pengukuran_1) ? $request->list_data_input_pengukuran_1 : null;
        
        $jenisInputPengukuran2 = !empty($request->jenis_input_pengukuran_2) ? $request->jenis_input_pengukuran_2 : 0;
        $inputPengukuran2BarisBaru = isset($request->input_pengukuran_2_baris_baru) ? 1 : 0;
        $satuanInputPengukuran2 = isset($request->satuan_input_pengukuran_2) ? $request->satuan_input_pengukuran_2 : null;  
        $textSebelumInputPengukuran2 = isset($request->text_sebelum_input_pengukuran_2) ? $request->text_sebelum_input_pengukuran_2 : null;    
        $listDataInputPengukuran2 = isset($request->list_data_input_pengukuran_2) ? $request->list_data_input_pengukuran_2 : null;

        $jenisInputPengukuran3 = !empty($request->jenis_input_pengukuran_3) ? $request->jenis_input_pengukuran_3 : 0;
        $inputPengukuran3BarisBaru = isset($request->input_pengukuran_3_baris_baru) ? 1 : 0;
        $satuanInputPengukuran3 = isset($request->satuan_input_pengukuran_3) ? $request->satuan_input_pengukuran_3 : null;  
        $textSebelumInputPengukuran3 = isset($request->text_sebelum_input_pengukuran_3) ? $request->text_sebelum_input_pengukuran_3 : null;    
        $listDataInputPengukuran3 = isset($request->list_data_input_pengukuran_3) ? $request->list_data_input_pengukuran_3 : null;        

        $checklistKesesuaian = isset($request->checklist_kesesuaian) ? 1 : 0;

        $jenisInputKeterangan = !empty($request->jenis_input_keterangan) ? $request->jenis_input_keterangan : 0;
        $satuanInputKeterangan = isset($request->satuan_input_keterangan) ? $request->satuan_input_keterangan : null;  
        $textSebelumInputKeterangan = isset($request->text_sebelum_input_keterangan) ? $request->text_sebelum_input_keterangan : null;    
        $listDataInputKeterangan = isset($request->list_data_input_keterangan) ? $request->list_data_input_keterangan : null;        

        // echo "jenisInputPengukuran1 : ".$jenisInputPengukuran1;
        // die;

        // DB::enableQueryLog(); 
        $createTemplate = Template_komponen_pemeriksaan::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'tlu_master_template_id'=>$request->tlu_master_template_id,
                'parent_id'=>$request->parent_id,
                'no_komponen'=>$request->no_komponen,
                'nama_komponen'=>$request->nama_komponen,
                'jenis_input_pengukuran_1'=>$request->jenis_input_pengukuran_1,
                'satuan_input_pengukuran_1'=>$satuanInputPengukuran1,
                'text_sebelum_input_pengukuran_1'=>$textSebelumInputPengukuran1,
                'list_data_input_pengukuran_1'=>$listDataInputPengukuran1,
                'jenis_input_pengukuran_2'=>$jenisInputPengukuran2,
                'input_pengukuran_2_sbg_baris_baru'=>$inputPengukuran2BarisBaru,
                'satuan_input_pengukuran_2'=>$satuanInputPengukuran2,
                'text_sebelum_input_pengukuran_2'=>$textSebelumInputPengukuran2,
                'list_data_input_pengukuran_2'=>$listDataInputPengukuran2,
                'jenis_input_pengukuran_3'=>$jenisInputPengukuran3,
                'input_pengukuran_3_sbg_baris_baru'=>$inputPengukuran3BarisBaru,
                'satuan_input_pengukuran_3'=>$satuanInputPengukuran3,
                'text_sebelum_input_pengukuran_3'=>$textSebelumInputPengukuran3,
                'list_data_input_pengukuran_3'=>$listDataInputPengukuran3,
                'checklist_kesesuaian'=>$checklistKesesuaian,
                'jenis_input_keterangan'=>$jenisInputKeterangan,
                'satuan_input_keterangan'=>$satuanInputKeterangan,
                'text_sebelum_input_keterangan'=>$textSebelumInputKeterangan,
                'list_data_input_keterangan'=>$listDataInputKeterangan,
            ]
        );
        // dd(DB::getQueryLog());
        // die;
        return redirect()->route('konsultan.getDataTemplateKomponenPemeriksaan', ['tlu_master_template_id'=>$request->tlu_master_template_id] )->with('success','Data berhasil disimpan.'); 

    }


}
