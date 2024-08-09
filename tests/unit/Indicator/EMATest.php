<?php declare(strict_types=1);

namespace Kensho\Chart\Tests\Unit\Indicator;

use DomainException;
use Kensho\Chart\Indicator\EMA\EMA;
use Kensho\Chart\Indicator\EMA\EMAInterface;
use Kensho\Chart\Number;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class EMATest extends TestCase
{
    #[DataProvider('provideInvalidPeriod')]
    public function testInvalidPeriod(int $period): void
    {
        $this->expectException(DomainException::class);

        $actual = new EMA($period);

        $this->assertInstanceOf(EMAInterface::class, $actual);
    }

    /**
     * @param array<string, string>      $values
     * @param array<string, string|null> $expected
     */
    #[DataProvider('provideData')]
    public function testCalculate(int $period, array $values, array $expected): void
    {
        $instance = new EMA($period);
        $actual   = [];

        foreach ($values as $date => $value) {
            $actual[$date] = $instance->calculate(new Number($value))?->round(4);
        }
        $this->assertSame($expected, $actual);
    }

    /**
     * @return array<string, array<string, int>>
     */
    public static function provideInvalidPeriod(): array
    {
        return [
            'Period negative'  => [ 'period' => -1 ],
            'Period zero'      => [ 'period' =>  0 ],
            'Period too short' => [ 'period' =>  1 ],
        ];
    }

    /**
     * @return array<string, array<string, int|array<string, string|null>>>
     */
    public static function provideData(): array
    {
        return [
            'EMA 2 days'   => [
                'period'   => 2,
                'values'   => [
                    '2023-01-25' => '141.8600',
                    '2023-01-26' => '143.9600',
                    '2023-01-27' => '145.9300',
                    '2023-01-30' => '143.0000',
                    '2023-01-31' => '144.2900',
                    '2023-02-01' => '145.4300',
                    '2023-02-02' => '150.8200',
                    '2023-02-03' => '154.5000',
                    '2023-02-06' => '151.7300',
                    '2023-02-07' => '154.6500',
                    '2023-02-08' => '151.9200',
                    '2023-02-09' => '150.8700',
                    '2023-02-10' => '151.0100',
                    '2023-02-13' => '153.8500',
                    '2023-02-14' => '153.2000',
                    '2023-02-15' => '155.3300',
                    '2023-02-16' => '153.7100',
                    '2023-02-17' => '152.5500',
                    '2023-02-21' => '148.4800',
                    '2023-02-22' => '148.9100',
                    '2023-02-23' => '149.4000',
                    '2023-02-24' => '146.7100',
                    '2023-02-27' => '147.9200',
                    '2023-02-28' => '147.4100',
                    '2023-03-01' => '145.3100',
                    '2023-03-02' => '145.9100',
                    '2023-03-03' => '151.0300',
                    '2023-03-06' => '153.8300',
                    '2023-03-07' => '151.6000',
                    '2023-03-08' => '152.8700',
                    '2023-03-09' => '150.5900',
                    '2023-03-10' => '148.5000',
                    '2023-03-13' => '150.4700',
                    '2023-03-14' => '152.5900',
                    '2023-03-15' => '152.9900',
                    '2023-03-16' => '155.8500',
                    '2023-03-17' => '155.0000',
                    '2023-03-20' => '157.4000',
                    '2023-03-21' => '159.2800',
                    '2023-03-22' => '157.8300',
                    '2023-03-23' => '158.9300',
                    '2023-03-24' => '160.2500',
                    '2023-03-27' => '158.2800',
                    '2023-03-28' => '157.6500',
                    '2023-03-29' => '160.7700',
                    '2023-03-30' => '162.3600',
                    '2023-03-31' => '164.9000',
                    '2023-04-03' => '166.1700',
                    '2023-04-04' => '165.6300',
                    '2023-04-05' => '163.7600',
                    '2023-04-06' => '164.6600',
                    '2023-04-10' => '162.0300',
                    '2023-04-11' => '160.8000',
                    '2023-04-12' => '160.1000',
                    '2023-04-13' => '165.5600',
                    '2023-04-14' => '165.2100',
                    '2023-04-17' => '165.2300',
                    '2023-04-18' => '166.4700',
                    '2023-04-19' => '167.6300',
                    '2023-04-20' => '166.6500',
                    '2023-04-21' => '165.0200',
                    '2023-04-24' => '165.3300',
                    '2023-04-25' => '163.7700',
                    '2023-04-26' => '163.7600',
                    '2023-04-27' => '168.4100',
                    '2023-04-28' => '169.6800',
                    '2023-05-01' => '169.5900',
                    '2023-05-02' => '168.5400',
                    '2023-05-03' => '167.4500',
                    '2023-05-04' => '165.7900',
                    '2023-05-05' => '173.5700',
                    '2023-05-08' => '173.5000',
                    '2023-05-09' => '171.7700',
                    '2023-05-10' => '173.5550',
                    '2023-05-11' => '173.7500',
                    '2023-05-12' => '172.5700',
                    '2023-05-15' => '172.0700',
                    '2023-05-16' => '172.0700',
                    '2023-05-17' => '172.6900',
                    '2023-05-18' => '175.0500',
                    '2023-05-19' => '175.1600',
                    '2023-05-22' => '174.2000',
                    '2023-05-23' => '171.5600',
                    '2023-05-24' => '171.8400',
                    '2023-05-25' => '172.9900',
                    '2023-05-26' => '175.4300',
                    '2023-05-30' => '177.3000',
                    '2023-05-31' => '177.2500',
                    '2023-06-01' => '180.0900',
                    '2023-06-02' => '180.9500',
                    '2023-06-05' => '179.5800',
                    '2023-06-06' => '179.2100',
                    '2023-06-07' => '177.8200',
                    '2023-06-08' => '180.5700',
                    '2023-06-09' => '180.9600',
                    '2023-06-12' => '183.7900',
                    '2023-06-13' => '183.3100',
                    '2023-06-14' => '183.9500',
                    '2023-06-15' => '186.0100',
                    '2023-06-16' => '184.9200',
                ],
                'expected' => [
                    '2023-01-25' => null,
                    '2023-01-26' => '143.2600',
                    '2023-01-27' => '145.0400',
                    '2023-01-30' => '143.6800',
                    '2023-01-31' => '144.0867',
                    '2023-02-01' => '144.9822',
                    '2023-02-02' => '148.8741',
                    '2023-02-03' => '152.6247',
                    '2023-02-06' => '152.0282',
                    '2023-02-07' => '153.7761',
                    '2023-02-08' => '152.5387',
                    '2023-02-09' => '151.4262',
                    '2023-02-10' => '151.1487',
                    '2023-02-13' => '152.9496',
                    '2023-02-14' => '153.1165',
                    '2023-02-15' => '154.5922',
                    '2023-02-16' => '154.0041',
                    '2023-02-17' => '153.0347',
                    '2023-02-21' => '149.9982',
                    '2023-02-22' => '149.2727',
                    '2023-02-23' => '149.3576',
                    '2023-02-24' => '147.5925',
                    '2023-02-27' => '147.8108',
                    '2023-02-28' => '147.5436',
                    '2023-03-01' => '146.0545',
                    '2023-03-02' => '145.9582',
                    '2023-03-03' => '149.3394',
                    '2023-03-06' => '152.3331',
                    '2023-03-07' => '151.8444',
                    '2023-03-08' => '152.5281',
                    '2023-03-09' => '151.2360',
                    '2023-03-10' => '149.4120',
                    '2023-03-13' => '150.1173',
                    '2023-03-14' => '151.7658',
                    '2023-03-15' => '152.5819',
                    '2023-03-16' => '154.7606',
                    '2023-03-17' => '154.9202',
                    '2023-03-20' => '156.5734',
                    '2023-03-21' => '158.3778',
                    '2023-03-22' => '158.0126',
                    '2023-03-23' => '158.6242',
                    '2023-03-24' => '159.7081',
                    '2023-03-27' => '158.7560',
                    '2023-03-28' => '158.0187',
                    '2023-03-29' => '159.8529',
                    '2023-03-30' => '161.5243',
                    '2023-03-31' => '163.7748',
                    '2023-04-03' => '165.3716',
                    '2023-04-04' => '165.5439',
                    '2023-04-05' => '164.3546',
                    '2023-04-06' => '164.5582',
                    '2023-04-10' => '162.8727',
                    '2023-04-11' => '161.4909',
                    '2023-04-12' => '160.5636',
                    '2023-04-13' => '163.8945',
                    '2023-04-14' => '164.7715',
                    '2023-04-17' => '165.0772',
                    '2023-04-18' => '166.0057',
                    '2023-04-19' => '167.0886',
                    '2023-04-20' => '166.7962',
                    '2023-04-21' => '165.6121',
                    '2023-04-24' => '165.4240',
                    '2023-04-25' => '164.3213',
                    '2023-04-26' => '163.9471',
                    '2023-04-27' => '166.9224',
                    '2023-04-28' => '168.7608',
                    '2023-05-01' => '169.3136',
                    '2023-05-02' => '168.7979',
                    '2023-05-03' => '167.8993',
                    '2023-05-04' => '166.4931',
                    '2023-05-05' => '171.2110',
                    '2023-05-08' => '172.7370',
                    '2023-05-09' => '172.0923',
                    '2023-05-10' => '173.0674',
                    '2023-05-11' => '173.5225',
                    '2023-05-12' => '172.8875',
                    '2023-05-15' => '172.3425',
                    '2023-05-16' => '172.1608',
                    '2023-05-17' => '172.5136',
                    '2023-05-18' => '174.2045',
                    '2023-05-19' => '174.8415',
                    '2023-05-22' => '174.4138',
                    '2023-05-23' => '172.5113',
                    '2023-05-24' => '172.0638',
                    '2023-05-25' => '172.6813',
                    '2023-05-26' => '174.5138',
                    '2023-05-30' => '176.3713',
                    '2023-05-31' => '176.9571',
                    '2023-06-01' => '179.0457',
                    '2023-06-02' => '180.3152',
                    '2023-06-05' => '179.8251',
                    '2023-06-06' => '179.4150',
                    '2023-06-07' => '178.3517',
                    '2023-06-08' => '179.8306',
                    '2023-06-09' => '180.5835',
                    '2023-06-12' => '182.7212',
                    '2023-06-13' => '183.1137',
                    '2023-06-14' => '183.6712',
                    '2023-06-15' => '185.2304',
                    '2023-06-16' => '185.0235',
                ],
            ],
            'EMA 21 days'  => [
                'period'   => 21,
                'values'   => [
                    '2023-01-25' => '141.8600',
                    '2023-01-26' => '143.9600',
                    '2023-01-27' => '145.9300',
                    '2023-01-30' => '143.0000',
                    '2023-01-31' => '144.2900',
                    '2023-02-01' => '145.4300',
                    '2023-02-02' => '150.8200',
                    '2023-02-03' => '154.5000',
                    '2023-02-06' => '151.7300',
                    '2023-02-07' => '154.6500',
                    '2023-02-08' => '151.9200',
                    '2023-02-09' => '150.8700',
                    '2023-02-10' => '151.0100',
                    '2023-02-13' => '153.8500',
                    '2023-02-14' => '153.2000',
                    '2023-02-15' => '155.3300',
                    '2023-02-16' => '153.7100',
                    '2023-02-17' => '152.5500',
                    '2023-02-21' => '148.4800',
                    '2023-02-22' => '148.9100',
                    '2023-02-23' => '149.4000',
                    '2023-02-24' => '146.7100',
                    '2023-02-27' => '147.9200',
                    '2023-02-28' => '147.4100',
                    '2023-03-01' => '145.3100',
                    '2023-03-02' => '145.9100',
                    '2023-03-03' => '151.0300',
                    '2023-03-06' => '153.8300',
                    '2023-03-07' => '151.6000',
                    '2023-03-08' => '152.8700',
                    '2023-03-09' => '150.5900',
                    '2023-03-10' => '148.5000',
                    '2023-03-13' => '150.4700',
                    '2023-03-14' => '152.5900',
                    '2023-03-15' => '152.9900',
                    '2023-03-16' => '155.8500',
                    '2023-03-17' => '155.0000',
                    '2023-03-20' => '157.4000',
                    '2023-03-21' => '159.2800',
                    '2023-03-22' => '157.8300',
                    '2023-03-23' => '158.9300',
                    '2023-03-24' => '160.2500',
                    '2023-03-27' => '158.2800',
                    '2023-03-28' => '157.6500',
                    '2023-03-29' => '160.7700',
                    '2023-03-30' => '162.3600',
                    '2023-03-31' => '164.9000',
                    '2023-04-03' => '166.1700',
                    '2023-04-04' => '165.6300',
                    '2023-04-05' => '163.7600',
                    '2023-04-06' => '164.6600',
                    '2023-04-10' => '162.0300',
                    '2023-04-11' => '160.8000',
                    '2023-04-12' => '160.1000',
                    '2023-04-13' => '165.5600',
                    '2023-04-14' => '165.2100',
                    '2023-04-17' => '165.2300',
                    '2023-04-18' => '166.4700',
                    '2023-04-19' => '167.6300',
                    '2023-04-20' => '166.6500',
                    '2023-04-21' => '165.0200',
                    '2023-04-24' => '165.3300',
                    '2023-04-25' => '163.7700',
                    '2023-04-26' => '163.7600',
                    '2023-04-27' => '168.4100',
                    '2023-04-28' => '169.6800',
                    '2023-05-01' => '169.5900',
                    '2023-05-02' => '168.5400',
                    '2023-05-03' => '167.4500',
                    '2023-05-04' => '165.7900',
                    '2023-05-05' => '173.5700',
                    '2023-05-08' => '173.5000',
                    '2023-05-09' => '171.7700',
                    '2023-05-10' => '173.5550',
                    '2023-05-11' => '173.7500',
                    '2023-05-12' => '172.5700',
                    '2023-05-15' => '172.0700',
                    '2023-05-16' => '172.0700',
                    '2023-05-17' => '172.6900',
                    '2023-05-18' => '175.0500',
                    '2023-05-19' => '175.1600',
                    '2023-05-22' => '174.2000',
                    '2023-05-23' => '171.5600',
                    '2023-05-24' => '171.8400',
                    '2023-05-25' => '172.9900',
                    '2023-05-26' => '175.4300',
                    '2023-05-30' => '177.3000',
                    '2023-05-31' => '177.2500',
                    '2023-06-01' => '180.0900',
                    '2023-06-02' => '180.9500',
                    '2023-06-05' => '179.5800',
                    '2023-06-06' => '179.2100',
                    '2023-06-07' => '177.8200',
                    '2023-06-08' => '180.5700',
                    '2023-06-09' => '180.9600',
                    '2023-06-12' => '183.7900',
                    '2023-06-13' => '183.3100',
                    '2023-06-14' => '183.9500',
                    '2023-06-15' => '186.0100',
                    '2023-06-16' => '184.9200',
                ],
                'expected' => [
                    '2023-01-25' => null,
                    '2023-01-26' => null,
                    '2023-01-27' => null,
                    '2023-01-30' => null,
                    '2023-01-31' => null,
                    '2023-02-01' => null,
                    '2023-02-02' => null,
                    '2023-02-03' => null,
                    '2023-02-06' => null,
                    '2023-02-07' => null,
                    '2023-02-08' => null,
                    '2023-02-09' => null,
                    '2023-02-10' => null,
                    '2023-02-13' => null,
                    '2023-02-14' => null,
                    '2023-02-15' => null,
                    '2023-02-16' => null,
                    '2023-02-17' => null,
                    '2023-02-21' => null,
                    '2023-02-22' => null,
                    '2023-02-23' => '149.5658',
                    '2023-02-24' => '149.3062',
                    '2023-02-27' => '149.1802',
                    '2023-02-28' => '149.0193',
                    '2023-03-01' => '148.6821',
                    '2023-03-02' => '148.4301',
                    '2023-03-03' => '148.6664',
                    '2023-03-06' => '149.1358',
                    '2023-03-07' => '149.3599',
                    '2023-03-08' => '149.6790',
                    '2023-03-09' => '149.7618',
                    '2023-03-10' => '149.6471',
                    '2023-03-13' => '149.7219',
                    '2023-03-14' => '149.9826',
                    '2023-03-15' => '150.2560',
                    '2023-03-16' => '150.7646',
                    '2023-03-17' => '151.1496',
                    '2023-03-20' => '151.7178',
                    '2023-03-21' => '152.4053',
                    '2023-03-22' => '152.8984',
                    '2023-03-23' => '153.4468',
                    '2023-03-24' => '154.0652',
                    '2023-03-27' => '154.4484',
                    '2023-03-28' => '154.7395',
                    '2023-03-29' => '155.2877',
                    '2023-03-30' => '155.9306',
                    '2023-03-31' => '156.7460',
                    '2023-04-03' => '157.6027',
                    '2023-04-04' => '158.3325',
                    '2023-04-05' => '158.8259',
                    '2023-04-06' => '159.3563',
                    '2023-04-10' => '159.5993',
                    '2023-04-11' => '159.7085',
                    '2023-04-12' => '159.7441',
                    '2023-04-13' => '160.2728',
                    '2023-04-14' => '160.7216',
                    '2023-04-17' => '161.1315',
                    '2023-04-18' => '161.6168',
                    '2023-04-19' => '162.1635',
                    '2023-04-20' => '162.5713',
                    '2023-04-21' => '162.7939',
                    '2023-04-24' => '163.0245',
                    '2023-04-25' => '163.0923',
                    '2023-04-26' => '163.1530',
                    '2023-04-27' => '163.6309',
                    '2023-04-28' => '164.1808',
                    '2023-05-01' => '164.6725',
                    '2023-05-02' => '165.0241',
                    '2023-05-03' => '165.2447',
                    '2023-05-04' => '165.2942',
                    '2023-05-05' => '166.0466',
                    '2023-05-08' => '166.7242',
                    '2023-05-09' => '167.1829',
                    '2023-05-10' => '167.7622',
                    '2023-05-11' => '168.3065',
                    '2023-05-12' => '168.6941',
                    '2023-05-15' => '169.0010',
                    '2023-05-16' => '169.2800',
                    '2023-05-17' => '169.5900',
                    '2023-05-18' => '170.0864',
                    '2023-05-19' => '170.5476',
                    '2023-05-22' => '170.8796',
                    '2023-05-23' => '170.9415',
                    '2023-05-24' => '171.0232',
                    '2023-05-25' => '171.2020',
                    '2023-05-26' => '171.5863',
                    '2023-05-30' => '172.1058',
                    '2023-05-31' => '172.5734',
                    '2023-06-01' => '173.2567',
                    '2023-06-02' => '173.9561',
                    '2023-06-05' => '174.4674',
                    '2023-06-06' => '174.8985',
                    '2023-06-07' => '175.1641',
                    '2023-06-08' => '175.6556',
                    '2023-06-09' => '176.1378',
                    '2023-06-12' => '176.8334',
                    '2023-06-13' => '177.4222',
                    '2023-06-14' => '178.0157',
                    '2023-06-15' => '178.7424',
                    '2023-06-16' => '179.3040',
                ],
            ],
            'EMA 73 days'  => [
                'period'   => 73,
                'values'   => [
                    '2023-01-25' => '141.8600',
                    '2023-01-26' => '143.9600',
                    '2023-01-27' => '145.9300',
                    '2023-01-30' => '143.0000',
                    '2023-01-31' => '144.2900',
                    '2023-02-01' => '145.4300',
                    '2023-02-02' => '150.8200',
                    '2023-02-03' => '154.5000',
                    '2023-02-06' => '151.7300',
                    '2023-02-07' => '154.6500',
                    '2023-02-08' => '151.9200',
                    '2023-02-09' => '150.8700',
                    '2023-02-10' => '151.0100',
                    '2023-02-13' => '153.8500',
                    '2023-02-14' => '153.2000',
                    '2023-02-15' => '155.3300',
                    '2023-02-16' => '153.7100',
                    '2023-02-17' => '152.5500',
                    '2023-02-21' => '148.4800',
                    '2023-02-22' => '148.9100',
                    '2023-02-23' => '149.4000',
                    '2023-02-24' => '146.7100',
                    '2023-02-27' => '147.9200',
                    '2023-02-28' => '147.4100',
                    '2023-03-01' => '145.3100',
                    '2023-03-02' => '145.9100',
                    '2023-03-03' => '151.0300',
                    '2023-03-06' => '153.8300',
                    '2023-03-07' => '151.6000',
                    '2023-03-08' => '152.8700',
                    '2023-03-09' => '150.5900',
                    '2023-03-10' => '148.5000',
                    '2023-03-13' => '150.4700',
                    '2023-03-14' => '152.5900',
                    '2023-03-15' => '152.9900',
                    '2023-03-16' => '155.8500',
                    '2023-03-17' => '155.0000',
                    '2023-03-20' => '157.4000',
                    '2023-03-21' => '159.2800',
                    '2023-03-22' => '157.8300',
                    '2023-03-23' => '158.9300',
                    '2023-03-24' => '160.2500',
                    '2023-03-27' => '158.2800',
                    '2023-03-28' => '157.6500',
                    '2023-03-29' => '160.7700',
                    '2023-03-30' => '162.3600',
                    '2023-03-31' => '164.9000',
                    '2023-04-03' => '166.1700',
                    '2023-04-04' => '165.6300',
                    '2023-04-05' => '163.7600',
                    '2023-04-06' => '164.6600',
                    '2023-04-10' => '162.0300',
                    '2023-04-11' => '160.8000',
                    '2023-04-12' => '160.1000',
                    '2023-04-13' => '165.5600',
                    '2023-04-14' => '165.2100',
                    '2023-04-17' => '165.2300',
                    '2023-04-18' => '166.4700',
                    '2023-04-19' => '167.6300',
                    '2023-04-20' => '166.6500',
                    '2023-04-21' => '165.0200',
                    '2023-04-24' => '165.3300',
                    '2023-04-25' => '163.7700',
                    '2023-04-26' => '163.7600',
                    '2023-04-27' => '168.4100',
                    '2023-04-28' => '169.6800',
                    '2023-05-01' => '169.5900',
                    '2023-05-02' => '168.5400',
                    '2023-05-03' => '167.4500',
                    '2023-05-04' => '165.7900',
                    '2023-05-05' => '173.5700',
                    '2023-05-08' => '173.5000',
                    '2023-05-09' => '171.7700',
                    '2023-05-10' => '173.5550',
                    '2023-05-11' => '173.7500',
                    '2023-05-12' => '172.5700',
                    '2023-05-15' => '172.0700',
                    '2023-05-16' => '172.0700',
                    '2023-05-17' => '172.6900',
                    '2023-05-18' => '175.0500',
                    '2023-05-19' => '175.1600',
                    '2023-05-22' => '174.2000',
                    '2023-05-23' => '171.5600',
                    '2023-05-24' => '171.8400',
                    '2023-05-25' => '172.9900',
                    '2023-05-26' => '175.4300',
                    '2023-05-30' => '177.3000',
                    '2023-05-31' => '177.2500',
                    '2023-06-01' => '180.0900',
                    '2023-06-02' => '180.9500',
                    '2023-06-05' => '179.5800',
                    '2023-06-06' => '179.2100',
                    '2023-06-07' => '177.8200',
                    '2023-06-08' => '180.5700',
                    '2023-06-09' => '180.9600',
                    '2023-06-12' => '183.7900',
                    '2023-06-13' => '183.3100',
                    '2023-06-14' => '183.9500',
                    '2023-06-15' => '186.0100',
                    '2023-06-16' => '184.9200',
                ],
                'expected' => [
                    '2023-01-25' => null,
                    '2023-01-26' => null,
                    '2023-01-27' => null,
                    '2023-01-30' => null,
                    '2023-01-31' => null,
                    '2023-02-01' => null,
                    '2023-02-02' => null,
                    '2023-02-03' => null,
                    '2023-02-06' => null,
                    '2023-02-07' => null,
                    '2023-02-08' => null,
                    '2023-02-09' => null,
                    '2023-02-10' => null,
                    '2023-02-13' => null,
                    '2023-02-14' => null,
                    '2023-02-15' => null,
                    '2023-02-16' => null,
                    '2023-02-17' => null,
                    '2023-02-21' => null,
                    '2023-02-22' => null,
                    '2023-02-23' => null,
                    '2023-02-24' => null,
                    '2023-02-27' => null,
                    '2023-02-28' => null,
                    '2023-03-01' => null,
                    '2023-03-02' => null,
                    '2023-03-03' => null,
                    '2023-03-06' => null,
                    '2023-03-07' => null,
                    '2023-03-08' => null,
                    '2023-03-09' => null,
                    '2023-03-10' => null,
                    '2023-03-13' => null,
                    '2023-03-14' => null,
                    '2023-03-15' => null,
                    '2023-03-16' => null,
                    '2023-03-17' => null,
                    '2023-03-20' => null,
                    '2023-03-21' => null,
                    '2023-03-22' => null,
                    '2023-03-23' => null,
                    '2023-03-24' => null,
                    '2023-03-27' => null,
                    '2023-03-28' => null,
                    '2023-03-29' => null,
                    '2023-03-30' => null,
                    '2023-03-31' => null,
                    '2023-04-03' => null,
                    '2023-04-04' => null,
                    '2023-04-05' => null,
                    '2023-04-06' => null,
                    '2023-04-10' => null,
                    '2023-04-11' => null,
                    '2023-04-12' => null,
                    '2023-04-13' => null,
                    '2023-04-14' => null,
                    '2023-04-17' => null,
                    '2023-04-18' => null,
                    '2023-04-19' => null,
                    '2023-04-20' => null,
                    '2023-04-21' => null,
                    '2023-04-24' => null,
                    '2023-04-25' => null,
                    '2023-04-26' => null,
                    '2023-04-27' => null,
                    '2023-04-28' => null,
                    '2023-05-01' => null,
                    '2023-05-02' => null,
                    '2023-05-03' => null,
                    '2023-05-04' => null,
                    '2023-05-05' => null,
                    '2023-05-08' => null,
                    '2023-05-09' => '158.7969',
                    '2023-05-10' => '159.1958',
                    '2023-05-11' => '159.5891',
                    '2023-05-12' => '159.9400',
                    '2023-05-15' => '160.2678',
                    '2023-05-16' => '160.5868',
                    '2023-05-17' => '160.9139',
                    '2023-05-18' => '161.2959',
                    '2023-05-19' => '161.6707',
                    '2023-05-22' => '162.0093',
                    '2023-05-23' => '162.2674',
                    '2023-05-24' => '162.5261',
                    '2023-05-25' => '162.8089',
                    '2023-05-26' => '163.1500',
                    '2023-05-30' => '163.5325',
                    '2023-05-31' => '163.9032',
                    '2023-06-01' => '164.3407',
                    '2023-06-02' => '164.7896',
                    '2023-06-05' => '165.1893',
                    '2023-06-06' => '165.5683',
                    '2023-06-07' => '165.8994',
                    '2023-06-08' => '166.2959',
                    '2023-06-09' => '166.6922',
                    '2023-06-12' => '167.1543',
                    '2023-06-13' => '167.5910',
                    '2023-06-14' => '168.0331',
                    '2023-06-15' => '168.5190',
                    '2023-06-16' => '168.9622',
                ],
            ],
            'EMA 120 days' => [
                'period'   => 120,
                'values'   => [
                    '2023-01-25' => '141.8600',
                    '2023-01-26' => '143.9600',
                    '2023-01-27' => '145.9300',
                    '2023-01-30' => '143.0000',
                    '2023-01-31' => '144.2900',
                    '2023-02-01' => '145.4300',
                    '2023-02-02' => '150.8200',
                    '2023-02-03' => '154.5000',
                    '2023-02-06' => '151.7300',
                    '2023-02-07' => '154.6500',
                    '2023-02-08' => '151.9200',
                    '2023-02-09' => '150.8700',
                    '2023-02-10' => '151.0100',
                    '2023-02-13' => '153.8500',
                    '2023-02-14' => '153.2000',
                    '2023-02-15' => '155.3300',
                    '2023-02-16' => '153.7100',
                    '2023-02-17' => '152.5500',
                    '2023-02-21' => '148.4800',
                    '2023-02-22' => '148.9100',
                    '2023-02-23' => '149.4000',
                    '2023-02-24' => '146.7100',
                    '2023-02-27' => '147.9200',
                    '2023-02-28' => '147.4100',
                    '2023-03-01' => '145.3100',
                    '2023-03-02' => '145.9100',
                    '2023-03-03' => '151.0300',
                    '2023-03-06' => '153.8300',
                    '2023-03-07' => '151.6000',
                    '2023-03-08' => '152.8700',
                    '2023-03-09' => '150.5900',
                    '2023-03-10' => '148.5000',
                    '2023-03-13' => '150.4700',
                    '2023-03-14' => '152.5900',
                    '2023-03-15' => '152.9900',
                    '2023-03-16' => '155.8500',
                    '2023-03-17' => '155.0000',
                    '2023-03-20' => '157.4000',
                    '2023-03-21' => '159.2800',
                    '2023-03-22' => '157.8300',
                    '2023-03-23' => '158.9300',
                    '2023-03-24' => '160.2500',
                    '2023-03-27' => '158.2800',
                    '2023-03-28' => '157.6500',
                    '2023-03-29' => '160.7700',
                    '2023-03-30' => '162.3600',
                    '2023-03-31' => '164.9000',
                    '2023-04-03' => '166.1700',
                    '2023-04-04' => '165.6300',
                    '2023-04-05' => '163.7600',
                    '2023-04-06' => '164.6600',
                    '2023-04-10' => '162.0300',
                    '2023-04-11' => '160.8000',
                    '2023-04-12' => '160.1000',
                    '2023-04-13' => '165.5600',
                    '2023-04-14' => '165.2100',
                    '2023-04-17' => '165.2300',
                    '2023-04-18' => '166.4700',
                    '2023-04-19' => '167.6300',
                    '2023-04-20' => '166.6500',
                    '2023-04-21' => '165.0200',
                    '2023-04-24' => '165.3300',
                    '2023-04-25' => '163.7700',
                    '2023-04-26' => '163.7600',
                    '2023-04-27' => '168.4100',
                    '2023-04-28' => '169.6800',
                    '2023-05-01' => '169.5900',
                    '2023-05-02' => '168.5400',
                    '2023-05-03' => '167.4500',
                    '2023-05-04' => '165.7900',
                    '2023-05-05' => '173.5700',
                    '2023-05-08' => '173.5000',
                    '2023-05-09' => '171.7700',
                    '2023-05-10' => '173.5550',
                    '2023-05-11' => '173.7500',
                    '2023-05-12' => '172.5700',
                    '2023-05-15' => '172.0700',
                    '2023-05-16' => '172.0700',
                    '2023-05-17' => '172.6900',
                    '2023-05-18' => '175.0500',
                    '2023-05-19' => '175.1600',
                    '2023-05-22' => '174.2000',
                    '2023-05-23' => '171.5600',
                    '2023-05-24' => '171.8400',
                    '2023-05-25' => '172.9900',
                    '2023-05-26' => '175.4300',
                    '2023-05-30' => '177.3000',
                    '2023-05-31' => '177.2500',
                    '2023-06-01' => '180.0900',
                    '2023-06-02' => '180.9500',
                    '2023-06-05' => '179.5800',
                    '2023-06-06' => '179.2100',
                    '2023-06-07' => '177.8200',
                    '2023-06-08' => '180.5700',
                    '2023-06-09' => '180.9600',
                    '2023-06-12' => '183.7900',
                    '2023-06-13' => '183.3100',
                    '2023-06-14' => '183.9500',
                    '2023-06-15' => '186.0100',
                    '2023-06-16' => '184.9200',
                ],
                'expected' => [
                    '2023-01-25' => null,
                    '2023-01-26' => null,
                    '2023-01-27' => null,
                    '2023-01-30' => null,
                    '2023-01-31' => null,
                    '2023-02-01' => null,
                    '2023-02-02' => null,
                    '2023-02-03' => null,
                    '2023-02-06' => null,
                    '2023-02-07' => null,
                    '2023-02-08' => null,
                    '2023-02-09' => null,
                    '2023-02-10' => null,
                    '2023-02-13' => null,
                    '2023-02-14' => null,
                    '2023-02-15' => null,
                    '2023-02-16' => null,
                    '2023-02-17' => null,
                    '2023-02-21' => null,
                    '2023-02-22' => null,
                    '2023-02-23' => null,
                    '2023-02-24' => null,
                    '2023-02-27' => null,
                    '2023-02-28' => null,
                    '2023-03-01' => null,
                    '2023-03-02' => null,
                    '2023-03-03' => null,
                    '2023-03-06' => null,
                    '2023-03-07' => null,
                    '2023-03-08' => null,
                    '2023-03-09' => null,
                    '2023-03-10' => null,
                    '2023-03-13' => null,
                    '2023-03-14' => null,
                    '2023-03-15' => null,
                    '2023-03-16' => null,
                    '2023-03-17' => null,
                    '2023-03-20' => null,
                    '2023-03-21' => null,
                    '2023-03-22' => null,
                    '2023-03-23' => null,
                    '2023-03-24' => null,
                    '2023-03-27' => null,
                    '2023-03-28' => null,
                    '2023-03-29' => null,
                    '2023-03-30' => null,
                    '2023-03-31' => null,
                    '2023-04-03' => null,
                    '2023-04-04' => null,
                    '2023-04-05' => null,
                    '2023-04-06' => null,
                    '2023-04-10' => null,
                    '2023-04-11' => null,
                    '2023-04-12' => null,
                    '2023-04-13' => null,
                    '2023-04-14' => null,
                    '2023-04-17' => null,
                    '2023-04-18' => null,
                    '2023-04-19' => null,
                    '2023-04-20' => null,
                    '2023-04-21' => null,
                    '2023-04-24' => null,
                    '2023-04-25' => null,
                    '2023-04-26' => null,
                    '2023-04-27' => null,
                    '2023-04-28' => null,
                    '2023-05-01' => null,
                    '2023-05-02' => null,
                    '2023-05-03' => null,
                    '2023-05-04' => null,
                    '2023-05-05' => null,
                    '2023-05-08' => null,
                    '2023-05-09' => null,
                    '2023-05-10' => null,
                    '2023-05-11' => null,
                    '2023-05-12' => null,
                    '2023-05-15' => null,
                    '2023-05-16' => null,
                    '2023-05-17' => null,
                    '2023-05-18' => null,
                    '2023-05-19' => null,
                    '2023-05-22' => null,
                    '2023-05-23' => null,
                    '2023-05-24' => null,
                    '2023-05-25' => null,
                    '2023-05-26' => null,
                    '2023-05-30' => null,
                    '2023-05-31' => null,
                    '2023-06-01' => null,
                    '2023-06-02' => null,
                    '2023-06-05' => null,
                    '2023-06-06' => null,
                    '2023-06-07' => null,
                    '2023-06-08' => null,
                    '2023-06-09' => null,
                    '2023-06-12' => null,
                    '2023-06-13' => null,
                    '2023-06-14' => null,
                    '2023-06-15' => null,
                    '2023-06-16' => null,
                ],
            ],
        ];
    }
}
