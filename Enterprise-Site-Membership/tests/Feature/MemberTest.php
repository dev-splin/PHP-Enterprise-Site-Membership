<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class MemberTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $tel1 = Crypt::encryptString("010-9559-3191");
        $tel2 = Crypt::encryptString("010-9559-3191");

        echo "tel1 : ".$tel1."\n";
        echo "tel2 : ".$tel2."\n";

        $deTel1 = Crypt::decryptString($tel1);
        $deTel2 = Crypt::decryptString($tel2);

        echo "tel1 : ".$deTel1."\n";
        echo "tel2 : ".$deTel2."\n";
    }
}
