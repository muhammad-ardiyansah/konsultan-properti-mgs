<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        Blade::directive('decimal_dipisah_koma', function ( $expression ) {
            return "<?php echo str_replace('.',',', $expression) ?>";
        });        

        Blade::directive('decimal_ke_integer', function ( $expression ) {
            return "<?php echo intval($expression) ?>";
        });

        Blade::directive('baris_baru_stlh_9_chr', function ( $expression ) {
            return "<?php echo wordwrap($expression, 9, '\n', true) ?>";
        });        

        Blade::directive('format_tgl_dMYHis', function ( $expression ) {
            return "<?php echo \Carbon\Carbon::parse($expression)->translatedFormat('d-M-Y H:i:s') ?>";
        });

        Blade::directive('format_tgl_dMY', function ( $expression ) {
            return "<?php echo \Carbon\Carbon::parse($expression)->translatedFormat('d-M-Y') ?>";
        });

        Blade::directive('format_rupiah_dengan_rp', function ( $expression ) { 
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; 
        });

        Blade::directive('format_rupiah_tanpa_rp', function ( $expression ) { 
            return "<?php echo number_format($expression,0,',','.'); ?>"; 
        });

    }
}
