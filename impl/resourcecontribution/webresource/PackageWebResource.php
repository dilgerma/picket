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

    /**
     * The path for folder is dynamically resolved in the package of the provided package component.
     *
     * @param $folder
     * @param ComponentStub $packageComponent
     * @param $fileEndingFilter
     * @param ResourceRenderer $renderer
     * @param $identifier
     */
    public function PackageWebResource($folder, ComponentStub $packageComponent, $fileEndingFilter, ResourceRenderer $renderer,$identifier)
    {
        $package = $packageComponent->getPackage();
        $folder = Strings::removeFirstCharacterIfAvailable($folder,"/");
        $targetPackage = $package."/".$folder;
        if (file_exists($targetPackage)) {
            $files = Files::listFilesInFolder($targetPackage,$fileEndingFilter);
            $this->DefaultWebResource($files, $renderer,$identifier);
        } else {
            $this->DefaultWebResource($folder,$renderer,$identifier);
            $this->log->error("cannot render package resource, it does not exist " . $folder);
        }
    }


}
