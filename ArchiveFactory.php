<?php

namespace ArchiveFactory;

use ArchiveTar;
use Tar;
use Zip;

/**
 * Class ArchiveFactory.
 */
class ArchiveFactory {

  /**
   * The archive class.
   *
   * @var mixed
   */
  private $archive;

  /**
   * Get an appropriate archive class for the file.
   *
   * @param string $file
   *   The file path.
   *
   * @return mixed|\PharData|\ZipArchive
   *   The ZipArchive object used by this object.
   *
   * @throws ArchiverException
   */
  public function getArchive($file) {
    $extension = strstr(pathinfo($file)['basename'], '.');
    switch ($extension) {
      case '.tar.gz':
        $this->archive = new ArchiveTar($file, 'gz');
        break;

      case '.tar':
        $this->archive = new Tar($file);
        break;

      case '.zip':
        $this->archive = new Zip($file);
        break;

      default:
        break;
    }
    return $this->archive;
  }

}
