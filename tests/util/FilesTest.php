<?php
include_once(__DIR__ . '/../BaseTestCase.php');
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 09:55
 * To change this template use File | Settings | File Templates.
 */
class FilesTest extends BaseTestCase
{
    public function testListFolders()
    {
        $folders = Files::listDirectoriesInFolder(__DIR__ . "/testfolder");
        $this->assertEquals(2, sizeof($folders));
    }

    public function testToLocalPath()
    {
        Files::toLocalPath("blubb");
    }
}
