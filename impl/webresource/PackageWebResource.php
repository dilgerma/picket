<?php
/**
 *
 * Loads all Resources in a certain folder and subfolders
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 16.10.12
 * Time: 15:57
 * To change this template use File | Settings | File Templates.
 */
class PackageWebResource extends DefaultWebResource
{

    public function PackageWebResource($folder, $fileEndingFilter, ResourceRenderer $renderer)
    {
        if (file_exists($folder)) {
            $files = $this->listFilesInFolder($folder,$fileEndingFilter);
            $this->DefaultWebResource($files, $renderer);
        } else {
            $this->log->error("cannot render package resource, it does not exist " . $folder);
        }
    }

    private function listFilesInFolder($folder,$fileEndingFilter)
    {
        $files = array();
        if ($handle = opendir($folder)) {
            while (false !== ($file = readdir($handle))) {
                if (Strings::endsWith($file, $fileEndingFilter)) {
                    array_push($files, $file);
                }
            }
        }
        closedir($handle);
        return $files;
    }
}
