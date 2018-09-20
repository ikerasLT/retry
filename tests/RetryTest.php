<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class RetryTest extends TestCase
{
    public function testRetryNoException()
    {
        $test = 1;

        $return = retry(function () use ($test) {
            return $test;
        }, function () use (&$test) {
            $test++;
        });

        $this->assertEquals(1, $return);
    }

    public function testRetrySuccessful()
    {
        $test = 1;

        $return = retry(function () use (&$test) {
            if ($test != 2) {
                throw new \Exception();
            }

            return $test;
        }, function () use (&$test) {
            $test++;
        });

        $this->assertEquals(2, $return);
    }

    public function testRetryUnsuccessful()
    {
        $test = 1;

        $this->expectException(\Exception::class);

        $return = retry(function () use (&$test) {
            if ($test != 3) {
                throw new \Exception();
            }

            return $test;
        }, function () use (&$test) {
            $test++;
        });
    }

    public function testRetryWithCount()
    {
        $test = 1;

        $return = retry(
            function () use (&$test) {
                if ($test != 5) {
                    throw new \Exception();
                }

                return $test;
            },
            function () use (&$test) {
                $test++;
            },
            5
        );

        $this->assertEquals(5, $return);
    }
}