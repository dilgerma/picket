<?php
include_once(__DIR__ . '/../../BaseTestCase.php');
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 18.10.12
 * Time: 07:51
 * To change this template use File | Settings | File Templates.
 */
class PackageWebResourceTest extends BaseTestCase
{
    public function testRenderJS()
    {
        $resource = new JavaScriptPackageWebResource("/test",new PackageLabel("test",new SimpleModel("")),"ident");
        $result = $resource->render();
        $expected = "\n<script language='JavaScript' type='text/javascript' src='/tests/resourcecontribution/resource/test/js/another/script-2.js' />\n\n<script language='JavaScript' type='text/javascript' src='/tests/resourcecontribution/resource/test/js/script-1.js' />\n";
        $this->assertEquals($expected,$result);
    }

    public function testRenderJSWithLeadeingSlash(){
        $resource = new JavaScriptPackageWebResource("/test",new PackageLabel("test",new SimpleModel("")),"ident");
        $result = $resource->render();
        $expected = "\n<script language='JavaScript' type='text/javascript' src='/tests/resourcecontribution/resource/test/js/another/script-2.js' />\n\n<script language='JavaScript' type='text/javascript' src='/tests/resourcecontribution/resource/test/js/script-1.js' />\n";
        $this->assertEquals($expected,$result);
    }

    public function testRenderCSS()
    {
        $resource = new CSSPackageWebResource("test",new PackageLabel("test",new SimpleModel("")),"ident");
        $result = $resource->render();
        $expected = "\n<link href=\"/tests/resourcecontribution/resource/test/js/another/some-styles.css\" rel=\"stylesheet\">\n\n<link href=\"/tests/resourcecontribution/resource/test/js/styles.css\" rel=\"stylesheet\">\n";
        $this->assertEquals($expected,$result);
    }
}

class PackageLabel extends Label {}