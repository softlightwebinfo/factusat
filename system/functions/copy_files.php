<?php
    function copyFiles($type = "http")
    {
        switch ($type) {
            case "http":
                copy("http://superbackings.com/public/img/1.png", "public/1-copy.png");
                break;
            case "FTP":
                copy("/home/archkzt/KTZS/125.ktz", "public/125.ktz");

                break;
            case "FTP":

                copy("ssh2.sftp://user:pass@host:22/usr/..../archivo",
                    "ssh2.sftp://user:pass@host:22/usr/..../archivo");
                break;
            default:
                break;
        }
    }

?>
