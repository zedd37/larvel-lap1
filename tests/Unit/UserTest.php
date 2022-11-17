<?php
namespace Tests\Unit;
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\UserController;
class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_name()
    {
        $user= new UserController("ziad", "ziadsamer@gmail.com");
        $this->assertEquals("ziad", $user->name());
        $newName= "Samy";
        $this->assertSame($newName, $user->name($newName));
    }
    public function test_email()
    {
        $user= new UserController("ziad", "ziadsamer@gmail.com");
        $this->assertEquals("ziad@gmail.com", $user->email());
        $newMail= "Samy@gmail.com";
        $this->assertEquals($newMail, $user->email($newMail));
    }
}