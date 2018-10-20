<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ExerciseV18\CompanyStatistics;
use ExerciseV18\Tests\PhpUnitUtil;

final class CompanyStatisticsTest extends TestCase
{
    public function testGetApiUrl(): void
    {
        $companyStatistics = new CompanyStatistics();
        $this->assertEquals(
            'https://www.quandl.com/api/v3/datasets/WIKI/GOOG.csv?order=asc&start_date=2018-01-01&end_date=2018-02-02', 
            PhpUnitUtil::getPrivateMethod($companyStatistics, 'getApiUrl', ['GOOG', '2018-01-01', '2018-02-02'])
        );
    }
    
    /**
     * @dataProvider csvToArrayProvider
     */
    public function testCsvToArray(string $csv, array $array): void
    {
        $companyStatistics = new CompanyStatistics();
        
        $this->assertEquals(
            $array,
            PhpUnitUtil::getPrivateMethod($companyStatistics, 'csvToArray', [$csv])
        );
    }
    
    public function csvToArrayProvider(): array
    {
        return [
            ['a,b,c,d' . "\n" . '1,2,3,4' . "\n", [['a', 'b', 'c', 'd'], [1, 2, 3, 4]]],
            ['a' . "\n" . '1' . "\n", [['a'], [1]]],
            ['a,b,' . "\n" . '1,2,' . "\n", [['a', 'b', ''], [1, 2, '']]],
            [',,' . "\n" . ',,' . "\n", [['', '', ''], ['', '', '']]],
            [',,' . "\n" . ',1,' . "\n", [['', '', ''], ['', 1, '']]],
            [',' . "\n" . ',' . "\n", [['', ''], ['', '']]],
            ['' . "\n" . '' . "\n", []],
        ];
    }
    
    /**
     * @dataProvider getProvider
     */
    public function testGet(string $companySymbol, string $startDate, string $endDate, int $httpCode): void
    {
        $companyStatistics = new CompanyStatistics();
        $result = $companyStatistics->get($companySymbol, $startDate, $endDate);

        $this->assertEquals(
            $httpCode,
            $result['httpCode']
        );
    }
    
    public function getProvider(): array
    {
        return [
            ['AAAAAAA', '2018-01-01', '2018-01-01', 404],
            ['GOOG', '2018-01-02', '2018-01-01', 422],
            ['GOOG', '2018-01-01', '2018-01-01', 200]
        ];
    }
}