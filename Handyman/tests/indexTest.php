<?php
use PHPUnit\Framework\TestCase;

class indexTest extends TestCase
{
    public function testIndexFile()
    {
       $out = shell_exec("echo 123 | php index.php");
       // check standard output or some DB modifications if script mangles DB
       $is_ok = verify_results($out);
       $this->assertSame($is_ok, true);
    }
}