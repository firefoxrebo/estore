<?php
namespace PHPMVC\lib;


class FileUpload
{
    private $name;
    private $type;
    private $size;
    private $error;
    private $tmpPath;

    private $fileExtension;

    private $allowedExtensions = [
        'jpg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls'
    ];

    public function __construct(array $file)
    {
        $this->name = $this->name($file['name']);
        $this->type = $file['type'];
        $this->size = $file['size'];
        $this->error = $file['error'];
        $this->tmpPath = $file['tmp_name'];
    }

    private function name($name)
    {
        preg_match_all('/([a-z]{1,4})$/i', $name, $m);
        $this->fileExtension = $m[0][0];
        return substr(strtolower(base64_encode($this->name . APP_SALT)), 0, 26);
    }

    private function isAllowedType()
    {
        return in_array($this->fileExtension, $this->allowedExtensions);
    }

    private function isSizeNotAcceptable()
    {
        preg_match_all('/(\d+)([MG])$/i', MAX_FILE_SIZE_ALLOWED, $matches);
        $maxFileSizeToUpload = $matches[1][0];
        $sizeUnit = $matches[2][0];
        $currentFileSize = ($sizeUnit == 'M') ? ($this->size / 1024 / 1024) : ($this->size / 1024 / 1024 / 1024);
        $currentFileSize = ceil($currentFileSize);
        return(int) $currentFileSize > (int) $maxFileSizeToUpload;
    }

    private function isImage()
    {
        return preg_match('/image/i', $this->type);
    }

    public function getFileName()
    {
        return $this->name . '.' . $this->fileExtension;
    }

    public function upload()
    {
        if($this->error != 0) {
            trigger_error('Sorry file didn\'t upload successfully', E_USER_WARNING);
        } elseif(!$this->isAllowedType()) {
            trigger_error('Sorry files of type ' . $this->fileExtension .  ' are not allowed', E_USER_WARNING);
        } elseif ($this->isSizeNotAcceptable()) {
            trigger_error('Sorry the file size exceeds the maximum allowed size', E_USER_WARNING);
        } else {
            if($this->isImage()) {
                move_uploaded_file($this->tmpPath, IMAGES_UPLOAD_STORAGE . DS . $this->getFileName());
            } else {
                move_uploaded_file($this->tmpPath, DOCUMENTS_UPLOAD_STORAGE . DS . $this->getFileName());
            }
        }
        return $this;

    }




}