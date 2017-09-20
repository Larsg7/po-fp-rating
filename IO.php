<?php
/**
 * Created by PhpStorm.
 * User: lars
 * Date: 10/09/17
 * Time: 23:06
 */

namespace FP_RATING;


class IO
{
    private $fileName;
    private $file;

    /**
     * IO constructor.
     */
    public function __construct($fileName)
    {

        $this->fileName = $fileName;
        $this->file = fopen($fileName, "a+");
        if (!$this->file) {
            throw new \Error("Cannot create or open file '" . $fileName . "'");
        }
    }

    public function writeRating($stars, $feedback)
    {
        if (flock($this->file, LOCK_EX)) {
            date_default_timezone_set('Europe/Berlin');
            $time = date("d.m.Y H:i:s", time());
            $string = "[" . $time . "] " . $stars . " '" . $feedback . "'\n";
            fwrite($this->file, $string);

            flock($this->file, LOCK_UN);
        }
    }

    public function readRatings()
    {
        fseek($this->file, 0);
        return fread($this->file, filesize($this->fileName));
    }
}