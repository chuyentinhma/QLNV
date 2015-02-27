<?php namespace Impl\Repo;

use Carbon\Carbon;
abstract class RepoAbstract {

    
    /**
     * Make a string "slug-friendly" for URLs
     * @param  string $string  Human-friendly tag
     * @return string       Computer-friendly tag
     */
    protected function slug($string)
    {
        return filter_var( str_replace(' ', '-', strtolower( trim($string) ) ), FILTER_SANITIZE_URL);
    }
    
     /**
     * format date time to Y-m-d H:m:s
     * @param  string $date 
     * @return Carbon     
     */
    protected function formatDateTimes($date) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        return Carbon::createFromFormat('d/m/Y', $date);
    }
    
     /**
     * format data from database to array inspecific ['id' => 'name']
     * @param  Array
     * @return Array     
     */
    public function formatData($items) {
        
        $output = [];
        
        foreach ($items as $item) {
            
            $output[$item->id] = $item->symbol;
        }
        
        return $output;
    }
}