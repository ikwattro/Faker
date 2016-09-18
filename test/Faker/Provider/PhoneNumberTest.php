<?php

namespace Faker\Test\Provider;

use Faker\Generator;
use Faker\Calculator\Luhn;
use Faker\Provider\PhoneNumber;

class PhoneNumberTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Generator
     */
    private $faker;

    public function setUp()
    {
        $faker = new Generator();
        $faker->addProvider(new PhoneNumber($faker));
        $this->faker = $faker;
    }

    public function testPhoneNumberFormat()
    {
        $number = $this->faker->e164PhoneNumber();
        $this->assertRegExp('/^\+[0-9]{11,}$/', $number);
    }

    public function testImeiReturnsValidNumber()
    {
        $imei = $this->faker->imei();
        $this->assertTrue(Luhn::isValid($imei));
    }

    public function testImsiReturnsValidNulmber()
    {
        $imsi = $this->faker->imsi();
        $this->assertTrue(in_array(substr($imsi, 0, 3), range(202, 750)));
        $this->assertRegExp('/^[0-9]{15,}$/', $imsi);
    }
}
