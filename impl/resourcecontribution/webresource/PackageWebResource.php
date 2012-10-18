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

    public function PackageWebResource($folder, $fileEndingFilter, ResourceRenderer $renderer,$identifier)
    {
        $this->DefaultWebResource($folder,$renderer,$identifier);
        if (file_exists($folder)) {
            $files = Files::listFilesInFolder($folder,$fileEndingFilter);
            $this->DefaultWebResource($files, $renderer,$identifier);
        } else {
            $this->log->error("cannot render package resource, it does not exist " . $folder);
        }
    }


}
