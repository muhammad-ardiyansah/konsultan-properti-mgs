<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KonsultanController;
use App\Http\Controllers\DpdController;
use App\Http\Controllers\DppController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\PengawasController;
use App\Http\Controllers\PerumahanDeveloperController;
use App\Http\Controllers\KomponenPemeriksaanRoleKonsultanController;
use App\Http\Controllers\HasilLaporanController;
use App\Http\Controllers\BankRekeningController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('front-page');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix'=>'user'], function(){    
    
    Route::get('/login/dpd',[App\Http\Controllers\UserController::class,'loginDpdView'])->name('user.login.dpd');
    // Route::view('/login/{userrole}','users.login')->name('user.login');     
    Route::get('/login/{userrole}',function ($userrole) {
        return view('users.login', ['userrole'=>$userrole]);
    })->name('user.login');      
    Route::get('/formRegistrasi/developer',[App\Http\Controllers\UserController::class,'formRegistrasiDeveloper'])->name('user.formRegistrasi.developer');
    Route::post('/saveRegistrasi/developer',[App\Http\Controllers\UserController::class,'saveRegistrasiDeveloper'])->name('user.saveRegistrasi.developer');
});

Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth','PreventBackHistory']], function(){
// Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth']], function(){

    
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
   
});

Route::group(['prefix'=>'konsultan', 'middleware'=>['isKonsultan','auth','PreventBackHistory']], function(){
// Route::group(['prefix'=>'konsultan', 'middleware'=>['isKonsultan','auth']], function(){
    
    Route::get('dashboard',[KonsultanController::class,'index'])->name('konsultan.dashboard');
    // Route::get('getPerumahanDevelopers',[KonsultanController::class,'getPerumahanDevelopers'])->name('konsultan.getPerumahanDevelopers');
    Route::get('listPengajuan',[KonsultanController::class,'listPengajuan'])->name('konsultan.listPengajuan');
    Route::get('formPengajuan',[KonsultanController::class,'formPengajuan'])->name('konsultan.formPengajuan');
    Route::post('simpanPengajuan',[KonsultanController::class,'simpanPengajuan'])->name('konsultan.simpanPengajuan');
    Route::get('detailPengajuan',[KonsultanController::class,'detailPengajuan'])->name('konsultan.detailPengajuan');
    Route::post('setIjinEditPengajuan',[KonsultanController::class,'setIjinEditPengajuan'])->name('konsultan.setIjinEditPengajuan');
    Route::post('setStatusPengajuan',[KonsultanController::class,'setStatusPengajuan'])->name('konsultan.setStatusPengajuan');
    Route::post('editDataPengajuan',[KonsultanController::class,'editDataPengajuan'])->name('konsultan.editDataPengajuan');
    Route::get('editFormPengajuan',[KonsultanController::class,'editFormPengajuan'])->name('konsultan.editFormPengajuan');
    Route::post('updatePengajuan',[KonsultanController::class,'updatePengajuan'])->name('konsultan.updatePengajuan');

    Route::get('masterTemplateKomponenPemeriksaan',[KomponenPemeriksaanRoleKonsultanController::class,'masterTemplateKomponenPemeriksaan'])->name('konsultan.masterTemplateKomponenPemeriksaan');
    Route::get('tambahMasterTemplateKomponenPemeriksaan',[KomponenPemeriksaanRoleKonsultanController::class,'tambahMasterTemplateKomponenPemeriksaan'])->name('konsultan.tambahMasterTemplateKomponenPemeriksaan');
    Route::get('editMasterTemplateKomponenPemeriksaan/{id}',[KomponenPemeriksaanRoleKonsultanController::class,'editMasterTemplateKomponenPemeriksaan'])->name('konsultan.editMasterTemplateKomponenPemeriksaan');
    Route::post('simpanMasterTemplateKomponenPemeriksaan',[KomponenPemeriksaanRoleKonsultanController::class,'simpanMasterTemplateKomponenPemeriksaan'])->name('konsultan.simpanMasterTemplateKomponenPemeriksaan');
    Route::get('deleteMasterTemplateKomponenPemeriksaan/{id}',[KomponenPemeriksaanRoleKonsultanController::class,'deleteMasterTemplateKomponenPemeriksaan'])->name('konsultan.deleteMasterTemplateKomponenPemeriksaan');
    Route::get('templateStrukturalFondasi',[KomponenPemeriksaanRoleKonsultanController::class,'templateStrukturalFondasi'])->name('konsultan.templateStrukturalFondasi');
    Route::get('getDataTemplateStrukturalFondasi',[KomponenPemeriksaanRoleKonsultanController::class,'getDataTemplateStrukturalFondasi'])->name('konsultan.getDataTemplateStrukturalFondasi');
    Route::get('tambahKomponenTemplateStrukturalFondasi',[KomponenPemeriksaanRoleKonsultanController::class,'tambahKomponenTemplateStrukturalFondasi'])->name('konsultan.tambahKomponenTemplateStrukturalFondasi');
    Route::get('editKomponenTemplateStrukturalFondasi/{id}',[KomponenPemeriksaanRoleKonsultanController::class,'editKomponenTemplateStrukturalFondasi'])->name('konsultan.editKomponenTemplateStrukturalFondasi');
    Route::get('deleteKomponenTemplateStrukturalFondasi/{id}',[KomponenPemeriksaanRoleKonsultanController::class,'deleteKomponenTemplateStrukturalFondasi'])->name('konsultan.deleteKomponenTemplateStrukturalFondasi');
    Route::post('simpanKomponenTemplateStrukturalFondasi',[KomponenPemeriksaanRoleKonsultanController::class,'simpanKomponenTemplateStrukturalFondasi'])->name('konsultan.simpanKomponenTemplateStrukturalFondasi');

    Route::get('kelInpAngPeng1StrukturalFondasi', [KomponenPemeriksaanRoleKonsultanController::class,'getKelInpAngPeng1StrukturalFondasi'])->name('konsultan.getKelInpAngPeng1StrukturalFondasi');
    Route::view('kelInpTextPeng1StrukturalFondasi', 'konsultan.struktural-fondasi.tambah.kelompok-input-text-pengukuran-1')->name('konsultan.getKelInpTextPeng1StrukturalFondasi');
    Route::get('kelInpChkboxPeng1StrukturalFondasi', [KomponenPemeriksaanRoleKonsultanController::class,'getKelInpChkboxPeng1StrukturalFondasi'])->name('konsultan.getKelInpChkboxPeng1StrukturalFondasi');
    Route::get('kelInpSlcboxPeng1StrukturalFondasi', [KomponenPemeriksaanRoleKonsultanController::class,'getKelInpChkboxPeng1StrukturalFondasi'])->name('konsultan.getKelInpSlcboxPeng1StrukturalFondasi');
    Route::get('kelInpAngPeng2StrukturalFondasi', [KomponenPemeriksaanRoleKonsultanController::class,'getKelInpAngPeng2StrukturalFondasi'])->name('konsultan.getKelInpAngPeng2StrukturalFondasi');
    Route::view('kelInpTextPeng2StrukturalFondasi', 'konsultan.struktural-fondasi.tambah.kelompok-input-text-pengukuran-2')->name('konsultan.getKelInpTextPeng2StrukturalFondasi');
    Route::get('kelInpChkboxPeng2StrukturalFondasi', [KomponenPemeriksaanRoleKonsultanController::class,'getKelInpChkboxPeng2StrukturalFondasi'])->name('konsultan.getKelInpChkboxPeng2StrukturalFondasi');
    Route::get('kelInpSlcboxPeng2StrukturalFondasi', [KomponenPemeriksaanRoleKonsultanController::class,'getKelInpChkboxPeng2StrukturalFondasi'])->name('konsultan.getKelInpSlcboxPeng2StrukturalFondasi');
    Route::get('kelInpAngPeng3StrukturalFondasi', [KomponenPemeriksaanRoleKonsultanController::class,'getKelInpAngPeng3StrukturalFondasi'])->name('konsultan.getKelInpAngPeng3StrukturalFondasi');
    Route::view('kelInpTextPeng3StrukturalFondasi', 'konsultan.struktural-fondasi.tambah.kelompok-input-text-pengukuran-3')->name('konsultan.getKelInpTextPeng3StrukturalFondasi');
    Route::get('kelInpChkboxPeng3StrukturalFondasi', [KomponenPemeriksaanRoleKonsultanController::class,'getKelInpChkboxPeng3StrukturalFondasi'])->name('konsultan.getKelInpChkboxPeng3StrukturalFondasi');
    Route::get('kelInpSlcboxPeng3StrukturalFondasi', [KomponenPemeriksaanRoleKonsultanController::class,'getKelInpChkboxPeng3StrukturalFondasi'])->name('konsultan.getKelInpSlcboxPeng3StrukturalFondasi');
    
    Route::get('kelInpAngPeng4StrukturalFondasi', [KomponenPemeriksaanRoleKonsultanController::class,'getKelInpAngPeng4StrukturalFondasi'])->name('konsultan.getKelInpAngPeng4StrukturalFondasi');
    Route::view('kelInpTextPeng4StrukturalFondasi', 'konsultan.struktural-fondasi.tambah.kelompok-input-text-pengukuran-4')->name('konsultan.getKelInpTextPeng4StrukturalFondasi');
    Route::get('kelInpChkboxPeng4StrukturalFondasi', [KomponenPemeriksaanRoleKonsultanController::class,'getKelInpChkboxPeng4StrukturalFondasi'])->name('konsultan.getKelInpChkboxPeng4StrukturalFondasi');
    Route::get('kelInpSlcboxPeng4StrukturalFondasi', [KomponenPemeriksaanRoleKonsultanController::class,'getKelInpChkboxPeng4StrukturalFondasi'])->name('konsultan.getKelInpSlcboxPeng4StrukturalFondasi');    
    
    Route::get('templateKomponenPemeriksaan',[KomponenPemeriksaanRoleKonsultanController::class,'templateKomponenPemeriksaan'])->name('konsultan.templateKomponenPemeriksaan');
    Route::get('getDataTemplateKomponenPemeriksaan',[KomponenPemeriksaanRoleKonsultanController::class,'getDataTemplateKomponenPemeriksaan'])->name('konsultan.getDataTemplateKomponenPemeriksaan');
    Route::get('tambahTemplateKomponenPemeriksaan',[KomponenPemeriksaanRoleKonsultanController::class,'tambahTemplateKomponenPemeriksaan'])->name('konsultan.tambahTemplateKomponenPemeriksaan');
    Route::get('editTemplateKomponenPemeriksaan/{id}',[KomponenPemeriksaanRoleKonsultanController::class,'editTemplateKomponenPemeriksaan'])->name('konsultan.editTemplateKomponenPemeriksaan');
    Route::post('simpanTemplateKomponenPemeriksaan',[KomponenPemeriksaanRoleKonsultanController::class,'simpanTemplateKomponenPemeriksaan'])->name('konsultan.simpanTemplateKomponenPemeriksaan');
    Route::get('deleteTemplateKomponenPemeriksaan/{id}',[KomponenPemeriksaanRoleKonsultanController::class,'deleteTemplateKomponenPemeriksaan'])->name('konsultan.deleteTemplateKomponenPemeriksaan');
    Route::get('kelompokInputAngkaPengukuran1', [KomponenPemeriksaanRoleKonsultanController::class,'getKelompokInputAngkaPengukuran1'])->name('konsultan.getKelompokInputAngkaPengukuran1');
    Route::view('kelompokInputTextPengukuran1', 'konsultan.template-komponen.tambah.kelompok-input-text-pengukuran-1')->name('konsultan.getKelompokInputTextPengukuran1');
    Route::get('kelompokInputCheckboxPengukuran1', [KomponenPemeriksaanRoleKonsultanController::class,'getKelompokInputCheckboxPengukuran1'])->name('konsultan.getKelompokInputCheckboxPengukuran1');
    Route::get('kelompokInputAngkaPengukuran2', [KomponenPemeriksaanRoleKonsultanController::class,'getKelompokInputAngkaPengukuran2'])->name('konsultan.getKelompokInputAngkaPengukuran2');
    Route::view('kelompokInputTextPengukuran2', 'konsultan.template-komponen.tambah.kelompok-input-text-pengukuran-2')->name('konsultan.getKelompokInputTextPengukuran2');
    Route::get('kelompokInputCheckboxPengukuran2', [KomponenPemeriksaanRoleKonsultanController::class,'getKelompokInputCheckboxPengukuran2'])->name('konsultan.getKelompokInputCheckboxPengukuran2');
    Route::get('kelompokInputAngkaPengukuran3', [KomponenPemeriksaanRoleKonsultanController::class,'getKelompokInputAngkaPengukuran3'])->name('konsultan.getKelompokInputAngkaPengukuran3');
    Route::view('kelompokInputTextPengukuran3', 'konsultan.template-komponen.tambah.kelompok-input-text-pengukuran-3')->name('konsultan.getKelompokInputTextPengukuran3');
    Route::get('kelompokInputCheckboxPengukuran3', [KomponenPemeriksaanRoleKonsultanController::class,'getKelompokInputCheckboxPengukuran3'])->name('konsultan.getKelompokInputCheckboxPengukuran3');
    Route::get('kelompokInputAngkaKeterangan', [KomponenPemeriksaanRoleKonsultanController::class,'getKelompokInputAngkaKeterangan'])->name('konsultan.getKelompokInputAngkaKeterangan');
    Route::view('kelompokInputTextKeterangan', 'konsultan.template-komponen.tambah.kelompok-input-text-keterangan')->name('konsultan.getKelompokInputTextKeterangan');
    Route::get('kelompokInputCheckboxKeterangan', [KomponenPemeriksaanRoleKonsultanController::class,'getKelompokInputCheckboxKeterangan'])->name('konsultan.getKelompokInputCheckboxKeterangan');        

    Route::get('listPerumahanDeveloper',[PerumahanDeveloperController::class,'indexKonsultan'])->name('konsultan.listPerumahanDeveloper');
    Route::get('listPerumahanDeveloperAjax',[PerumahanDeveloperController::class,'indexAjax'])->name('konsultan.listPerumahanDeveloperAjax');
    Route::get('tambahPerumahanDeveloper',[PerumahanDeveloperController::class,'tambah'])->name('konsultan.tambahPerumahanDeveloper');
    Route::get('editPerumahanDeveloper',[PerumahanDeveloperController::class,'edit'])->name('konsultan.editPerumahanDeveloper');
    Route::post('deletePerumahanDeveloper',[PerumahanDeveloperController::class,'delete'])->name('konsultan.deletePerumahanDeveloper');
    Route::post('simpanPerumahanDeveloper',[PerumahanDeveloperController::class,'simpan'])->name('konsultan.simpanPerumahanDeveloper');
    Route::get('getPerumahanDevelopers',[PerumahanDeveloperController::class,'getPerumahanDevelopers'])->name('konsultan.getPerumahanDevelopers');
    Route::get('getPerumahanDeveloperAdditionalInfo/{id}',[PerumahanDeveloperController::class,'getPerumahanDeveloperAdditionalInfo'])->name('konsultan.getPerumahanDeveloperAdditionalInfo');

    Route::get('listPengawas',[PengawasController::class,'indexKonsultan'])->name('konsultan.listPengawas');
    Route::get('listPengawasAjax',[PengawasController::class,'indexAjax'])->name('konsultan.listPengawasAjax');
    Route::get('tambahPengawas',[PengawasController::class,'tambah'])->name('konsultan.tambahPengawas');
    Route::get('editPengawas',[PengawasController::class,'edit'])->name('konsultan.editPengawas');
    Route::post('deletePengawas',[PengawasController::class,'delete'])->name('konsultan.deletePengawas');
    Route::post('simpanPengawas',[PengawasController::class,'simpan'])->name('konsultan.simpanPengawas');
    Route::get('getPengawas',[PengawasController::class,'getPengawas'])->name('konsultan.getPengawas');
    Route::get('getPenanggungJawabPengawas',[PengawasController::class,'getPenanggungJawabPengawas'])->name('konsultan.getPenanggungJawabPengawas');

    Route::get('laporanPengajuan',[KonsultanController::class,'laporanPengajuan'])->name('konsultan.laporanPengajuan');
    Route::post('uploadLaporanPengajuan',[KonsultanController::class,'uploadLaporanPengajuan'])->name('konsultan.uploadLaporanPengajuan');
    Route::get('getLaporan/{filename}', [HasilLaporanController::class, 'getLaporan'])->name('konsultan.getLaporan');

    Route::get('bankRekening',[BankRekeningController::class,'index'])->name('konsultan.bankRekening');
    Route::get('tambahBankRekening',[BankRekeningController::class,'tambah'])->name('konsultan.tambahBankRekening');
    Route::get('editBankRekening',[BankRekeningController::class,'edit'])->name('konsultan.editBankRekening');
    Route::post('simpanBankRekening',[BankRekeningController::class,'simpan'])->name('konsultan.simpanBankRekening');
    Route::post('deleteBankRekening',[BankRekeningController::class,'delete'])->name('konsultan.deleteBankRekening');

    Route::get('indexRekeningKonsultan',[RekeningController::class,'indexRekeningKonsultan'])->name('konsultan.indexRekeningKonsultan');
    Route::get('tambahRekeningKonsultan',[RekeningController::class,'tambahRekeningKonsultan'])->name('konsultan.tambahRekeningKonsultan');
    Route::get('editRekeningKonsultan',[RekeningController::class,'editRekeningKonsultan'])->name('konsultan.editRekeningKonsultan');
    Route::post('simpanRekeningKonsultan',[RekeningController::class,'simpanRekeningKonsultan'])->name('konsultan.simpanRekeningKonsultan');
    Route::post('deleteRekeningKonsultan',[RekeningController::class,'deleteRekeningKonsultan'])->name('konsultan.deleteRekeningKonsultan');    

    Route::get('indexInvoiceKonsultan',[InvoiceController::class,'indexInvoiceKonsultan'])->name('konsultan.indexInvoiceKonsultan');
    Route::get('tambahInvoiceKonsultan',[InvoiceController::class,'tambahInvoiceKonsultan'])->name('konsultan.tambahInvoiceKonsultan');
    Route::get('editInvoiceKonsultan',[InvoiceController::class,'editInvoiceKonsultan'])->name('konsultan.editInvoiceKonsultan');
    Route::get('viewInvoiceKonsultan',[InvoiceController::class,'viewInvoiceKonsultan'])->name('konsultan.viewInvoiceKonsultan');
    Route::post('simpanInvoiceKonsultan',[InvoiceController::class,'simpanInvoiceKonsultan'])->name('konsultan.simpanInvoiceKonsultan');
    Route::get('invoicePageKonsultan',[InvoiceController::class,'invoicePageKonsultan'])->name('konsultan.invoicePageKonsultan');

    Route::get('indexRegistrasiDeveloper',[KonsultanController::class,'indexRegistrasiDeveloper'])->name('konsultan.indexRegistrasiDeveloper');
    Route::get('tambahRegistrasiDeveloper',[KonsultanController::class,'tambahRegistrasiDeveloper'])->name('konsultan.tambahRegistrasiDeveloper');    
    Route::get('editRegistrasiDeveloper',[KonsultanController::class,'editRegistrasiDeveloper'])->name('konsultan.editRegistrasiDeveloper');    
    Route::post('deleteRegistrasiDeveloper',[KonsultanController::class,'deleteRegistrasiDeveloper'])->name('konsultan.deleteRegistrasiDeveloper');    
    Route::post('simpanRegistrasiDeveloper',[KonsultanController::class,'simpanRegistrasiDeveloper'])->name('konsultan.simpanRegistrasiDeveloper');
    
    Route::get('tambahRegistrasiUserDeveloper',[KonsultanController::class,'tambahRegistrasiUserDeveloper'])->name('konsultan.tambahRegistrasiUserDeveloper');    
    Route::get('editRegistrasiUserDeveloper',[KonsultanController::class,'editRegistrasiUserDeveloper'])->name('konsultan.editRegistrasiUserDeveloper');    
    Route::post('deleteRegistrasiUserDeveloper',[KonsultanController::class,'deleteRegistrasiUserDeveloper'])->name('konsultan.deleteRegistrasiUserDeveloper');    
    Route::post('simpanRegistrasiUserDeveloper',[KonsultanController::class,'simpanRegistrasiUserDeveloper'])->name('konsultan.simpanRegistrasiUserDeveloper');    
    Route::post('updateRegistrasiUserDeveloper',[KonsultanController::class,'updateRegistrasiUserDeveloper'])->name('konsultan.updateRegistrasiUserDeveloper');    


});

Route::group(['prefix'=>'dpd', 'middleware'=>['isDpd','auth','PreventBackHistory']], function(){
// Route::group(['prefix'=>'dpd', 'middleware'=>['isDpd','auth']], function(){
    
    Route::get('dashboard',[DpdController::class,'index'])->name('dpd.dashboard');
    Route::get('listPengajuan',[DpdController::class,'listPengajuan'])->name('dpd.listPengajuan');
    Route::get('detailPengajuan',[DpdController::class,'detailPengajuan'])->name('dpd.detailPengajuan');
    Route::post('setStatusPengajuan',[DpdController::class,'setStatusPengajuan'])->name('dpd.setStatusPengajuan');   

});

Route::group(['prefix'=>'dpp', 'middleware'=>['isDpp','auth','PreventBackHistory']], function(){
// Route::group(['prefix'=>'dpp', 'middleware'=>['isDpp','auth']], function(){    
    Route::get('dashboard',[DppController::class,'index'])->name('dpp.dashboard');
    Route::get('listPengajuan',[DppController::class,'listPengajuan'])->name('dpp.listPengajuan');
    Route::get('detailPengajuan',[DppController::class,'detailPengajuan'])->name('dpp.detailPengajuan');
    Route::post('setStatusPengajuan',[DppController::class,'setStatusPengajuan'])->name('dpp.setStatusPengajuan');    


});

Route::group(['prefix'=>'developer', 'middleware'=>['isDeveloper','auth','PreventBackHistory']], function(){
// Route::group(['prefix'=>'developer', 'middleware'=>['isDeveloper','auth']], function(){    
    
    Route::get('/',[DeveloperController::class,'listPengajuan']);
    Route::get('dashboard',[DeveloperController::class,'index'])->name('developer.dashboard');
    Route::get('listPengajuan',[DeveloperController::class,'listPengajuan'])->name('developer.listPengajuan');
    Route::get('formPengajuan',[DeveloperController::class,'formPengajuan'])->name('developer.formPengajuan');
    Route::post('simpanPengajuan',[DeveloperController::class,'simpanPengajuan'])->name('developer.simpanPengajuan');
    Route::get('detailPengajuan',[DeveloperController::class,'detailPengajuan'])->name('developer.detailPengajuan');
    Route::post('setStatusPengajuan',[DeveloperController::class,'setStatusPengajuan'])->name('developer.setStatusPengajuan');
    Route::post('editDataPengajuan',[DeveloperController::class,'editDataPengajuan'])->name('developer.editDataPengajuan');
    Route::get('editFormPengajuan',[DeveloperController::class,'editFormPengajuan'])->name('developer.editFormPengajuan');
    Route::post('updatePengajuan',[DeveloperController::class,'updatePengajuan'])->name('developer.updatePengajuan');

    Route::get('listPerumahanDeveloper',[PerumahanDeveloperController::class,'indexDeveloper'])->name('developer.listPerumahanDeveloper');
    Route::get('listPerumahanDeveloperAjax',[PerumahanDeveloperController::class,'indexAjax'])->name('developer.listPerumahanDeveloperAjax');
    Route::get('tambahPerumahanDeveloper',[PerumahanDeveloperController::class,'tambah'])->name('developer.tambahPerumahanDeveloper');
    Route::get('editPerumahanDeveloper',[PerumahanDeveloperController::class,'edit'])->name('developer.editPerumahanDeveloper');
    Route::post('deletePerumahanDeveloper',[PerumahanDeveloperController::class,'delete'])->name('developer.deletePerumahanDeveloper');
    Route::post('simpanPerumahanDeveloper',[PerumahanDeveloperController::class,'simpan'])->name('developer.simpanPerumahanDeveloper');
    Route::get('getPerumahanDeveloperAdditionalInfo/{id}',[PerumahanDeveloperController::class,'getPerumahanDeveloperAdditionalInfo'])->name('developer.getPerumahanDeveloperAdditionalInfo');
    Route::get('getPerumahanDevelopers',[PerumahanDeveloperController::class,'getPerumahanDevelopers'])->name('developer.getPerumahanDevelopers');

    Route::get('listPengawas',[PengawasController::class,'indexKonsultan'])->name('developer.listPengawas');
    Route::get('listPengawasAjax',[PengawasController::class,'indexAjax'])->name('developer.listPengawasAjax');
    Route::get('tambahPengawas',[PengawasController::class,'tambah'])->name('developer.tambahPengawas');
    Route::get('editPengawas',[PengawasController::class,'edit'])->name('developer.editPengawas');
    Route::post('deletePengawas',[PengawasController::class,'delete'])->name('developer.deletePengawas');
    Route::post('simpanPengawas',[PengawasController::class,'simpan'])->name('developer.simpanPengawas');
    Route::get('getPengawas',[PengawasController::class,'getPengawas'])->name('developer.getPengawas');
    Route::get('getPenanggungJawabPengawas',[PengawasController::class,'getPenanggungJawabPengawas'])->name('developer.getPenanggungJawabPengawas');

    Route::get('indexInvoiceDeveloper',[InvoiceController::class,'indexInvoiceDeveloper'])->name('developer.indexInvoiceDeveloper');
    Route::get('viewInvoiceDeveloper',[InvoiceController::class,'viewInvoiceDeveloper'])->name('developer.viewInvoiceDeveloper');
    Route::get('tambahKonfirmasiDeveloper',[InvoiceController::class,'tambahKonfirmasiDeveloper'])->name('developer.tambahKonfirmasiDeveloper');
    Route::post('simpanKonfirmasiDeveloper',[InvoiceController::class,'simpanKonfirmasiDeveloper'])->name('developer.simpanKonfirmasiDeveloper');

    Route::get('laporanPengajuan',[DeveloperController::class,'laporanPengajuan'])->name('developer.laporanPengajuan');


});

Route::group(['prefix'=>'pengawas', 'middleware'=>['isPengawas','auth','PreventBackHistory']], function(){
// Route::group(['prefix'=>'pengawas', 'middleware'=>['isPengawas','auth']], function(){    
    
    Route::get('dashboard',[PengawasController::class,'index'])->name('pengawas.dashboard');
   
});

Route::get('dependent-dropdown', [App\Http\Controllers\DependentDropdownController::class, 'index'])->name('dependent-dropdown.index');
Route::post('dependent-dropdown', [App\Http\Controllers\DependentDropdownController::class, 'store'])->name('dependent-dropdown.store');

Route::post('getCities', [App\Http\Controllers\DeveloperController::class, 'getCities'])->name('developer.getCities');
Route::post('getDistricts', [App\Http\Controllers\DeveloperController::class, 'getDistricts'])->name('developer.getDistricts');
Route::post('getVillages', [App\Http\Controllers\DeveloperController::class, 'getVillages'])->name('developer.getVillages');