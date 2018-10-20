<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ExerciseV18\Validator;

final class ValidatorTest extends TestCase
{
    /**
     * @dataProvider checkingRequiredFieldProvider
     */
    public function testCheckingRequiredField(array $data): void
    {
        $validator = new Validator([
            'name' => ['required' => true]
        ]);
        
        $this->expectException(DomainException::class);
        
        $validator->validate($data);
    }
    
    public function checkingRequiredFieldProvider(): array
    {
        return [
            [[]],
            [['name' => null]],
            [['name' => '']],
            [['name' => []]],
        ];
    }
    
    /**
     * @dataProvider checkingRequiredFieldProvider
     * @dataProvider checkingNotRequiredFieldProvider
     */
    public function testCheckingNotRequiredField(array $data): void
    {
        $validator = new Validator([
            'name' => ['required' => false],
        ]);
        
        $this->assertEmpty($validator->validate($data));
    }
    
    public function checkingNotRequiredFieldProvider(): array
    {
        return [
            [['name' => 1]],
            [['name' => '123']],
            [['name' => true]],
            [['name' => false]],
            [['name' => [1, 2]]]
        ];
    }
    
    /**
     * @dataProvider checkingPatternProvider
     */
    public function testCheckingPattern(string $pattern, bool $isCorrect, array $data): void
    {
        $validator = new Validator([
            'name' => ['pattern' => $pattern]
        ]);

        if ($isCorrect) {
            $this->assertEmpty($validator->validate($data));
        } else {
            $this->expectException(InvalidArgumentException::class);
            $validator->validate($data);
        }
    }
    
    public function checkingPatternProvider(): array
    {
        return [
            ['/[A-Z\^]{1,6}/', false, ['name' => 'ax']],
            ['/[A-Z\^]{1,6}/', true, ['name' => 'AX']],
            ['/[A-Z\^]{1,6}/', false, ['name' => '']],
            ['/[A-Z\^]{1,6}/', false, []],
            ['/[A-Z\^]{1,6}/', false, ['name' => null]],
        ];
    }
    
    /**
     * @dataProvider checkingEmailFieldProvider
     */
    public function testCheckingEmailField(bool $isCorrect, array $data): void
    {
        $validator = new Validator([
            'email' => ['type' => 'email']
        ]);

        if ($isCorrect) {
            $this->assertEmpty($validator->validate($data));
        } else {
            $this->expectException(InvalidArgumentException::class);
            $validator->validate($data);
        }
    }
    
    public function checkingEmailFieldProvider(): array
    {
        return [
            [false, ['email' => 'test']],
            [false, ['email' => 'test@']],
            [false, ['email' => 'test@test']],
            [true, ['email' => 'test@test.test']],
            [true, ['email' => 'test.test@test.test']],
            [true, ['email' => 'test-test@test.test']],
            [false, ['email' => 'test$@##^%&^*^&*(^(&*)())test@test.test']],
            [false, ['email' => 't.e.s.t.@test.test']],
            [false, []],
            [false, ['email' => null]],
        ];
    }
    
    /**
     * @dataProvider checkingAfterDateFieldProvider
     */
    public function testCheckingAfterDateField($isCorrect, array $data): void
    {
        $validator = new Validator([
            'end-date' => ['after' => 'start-date']
        ]);

        if ($isCorrect) {
            $this->assertEmpty($validator->validate($data));
        } else {
            $this->expectException(OutOfRangeException::class);
            $validator->validate($data);
        }
    }
    
    public function checkingAfterDateFieldProvider(): array
    {
        return [
            [true, ['start-date' => '2018-10-20', 'end-date' => '2018-10-22']],
            [true, ['start-date' => '2018-10-20', 'end-date' => '2018-10-20']],
            [true, ['start-date' => '20.10.2018', 'end-date' => '2018-10-20']],
            [false, ['start-date' => '2018-10-20', 'end-date' => '2018-10-19']],
            [false, ['start-date' => '', 'end-date' => '2018-10-19']],
            [false, ['start-date' => '2018-10-20', 'end-date' => '']],
            [false, ['start-date' => '', 'end-date' => '']],
            [false, []],
            [false, ['start-date' => null, 'end-date' => '2018-10-19']],
            [false, ['end-date' => '2018-10-19']],
        ];
    }
    
}