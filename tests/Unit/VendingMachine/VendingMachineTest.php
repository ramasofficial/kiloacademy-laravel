<?php

declare(strict_types=1);

namespace Tests\Unit\VendingMachine;

use App\Services\VendingMachine\Balance;
use App\Services\VendingMachine\VendingMachine;
use Generator;
use PHPUnit\Framework\TestCase;

class VendingMachineTest extends TestCase
{
    /**
     * @dataProvider coinsDataProvider
     */
    public function testVendingMachineAcceptsCoinsCorrect(int $coins): void
    {
        $vendingMachine = new VendingMachine(new Balance());

        $vendingMachine->add($coins);

        $this->assertTrue(true);
    }

    public function coinsDataProvider(): Generator
    {
        yield 'First example with 5 coins' => [
            'coins' => 5,
        ];

        yield 'Second example with 10 coins' => [
            'coins' => 10,
        ];

        yield 'Third example with 15 coins' => [
            'coins' => 15,
        ];
    }

    public function testVendingMachineShouldReturnBalanceCorrect(): void
    {
        $vendingMachine = new VendingMachine(new Balance());

        $vendingMachine->add(5);
        $vendingMachine->add(10);

        $this->assertSame(15, $vendingMachine->getBalance());
    }

    public function testVendingMachineShouldResetMachineCorrect(): void
    {
        $vendingMachine = new VendingMachine(new Balance());

        $vendingMachine->add(5);
        $vendingMachine->add(10);
        $vendingMachine->reset();

        $this->assertSame(0, $vendingMachine->getBalance());
    }
}
