<?php

namespace ExerciseV18;

/**
* CompanyStatistics class
* @author Sergii Babikov
*/
class CompanyStatistics
{
    const API_URL = 'https://www.quandl.com/api/v3/datasets/WIKI/{company-symbol}.csv?order=asc&start_date={start-date}&end_date={end-date}';
    
    /**
    * Get company statistics
    * 
    * @param string $ip
    */
    public function get(string $companySymbol, string $startDate, string $endDate): array
    {
        $apiUrl = $this->getApiUrl($companySymbol, $startDate, $endDate);
        
        // create curl resource 
        $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, $apiUrl); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 
        
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // close curl resource to free up system resources 
        curl_close($ch);
        
        return ['httpCode' => $httpCode, 'data' => $this->csvToArray($output)];
    }
    
    /**
    * Get API URL with defined parameters
    * 
    * @param string $companySymbol
    * @param string $startDate
    * @param string $endDate
    * @return string
    */
    private function getApiUrl(string $companySymbol, string $startDate, string $endDate): string
    {
        return str_replace(['{company-symbol}', '{start-date}', '{end-date}'], [$companySymbol, $startDate, $endDate], $this::API_URL);
    }
    
    /**
    * Convert CSV to Array format
    * 
    * @param string $csvData
    * @return array
    */
    private function csvToArray(string $csvData): array
    {
        $lines = explode(PHP_EOL, $csvData);
        
        $array = array();
        foreach ($lines as $line) {
            if (empty($line)) {
                continue;
            }
            
            $array[] = str_getcsv($line);
        }
        
        return $array;
    }
}
