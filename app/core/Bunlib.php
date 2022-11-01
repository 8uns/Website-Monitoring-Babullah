<?php

class Bunlib
{

    public static function UploadFileTo($namepost, $location, $filename = null, $extend = ['pdf'], $size = 10240000, $folder = null,  $permission = 0777)
    {
        if ($filename == null) {
            $filename = $_FILES[$namepost]['name'];
        }
        $pisah = explode(".", $_FILES[$namepost]['name']);
        $exFile = strtolower(end($pisah));

        if (empty($_FILES[$namepost]['name'])) {
            return 'empty';
        } elseif (!in_array($exFile, $extend)) {
            return "ext";
        } elseif (intval($_FILES[$namepost]['size']) > $size) {
            return 'oversize';
        } else {
            if ($folder != null) {
                if (!file_exists($location . $folder)) {
                    mkdir($location . $folder, $permission, true);
                }
                $location = $location . $folder . "/";
            }
            if (move_uploaded_file($_FILES[$namepost]['tmp_name'], $location . $filename . "." . $exFile)) {
                return $filename . "." . $exFile;
            } else {
                return 'failed';
            }
        }
    }

    public static function uploadImgBase64($imageName, $location, $file, $folder = null, $permission = 0777)
    {
        if ($folder != null) {
            if (!file_exists($location . $folder)) {
                mkdir($location . $folder, $permission, true);
            }
            $path = $location . $folder . '/' . $imageName;
            $realImg = base64_decode($file);
            if (file_put_contents($path, $realImg)) {
                return true;
                exit;
            }
        } else {
            $path = $location . $imageName;
            $realImg = base64_decode($file);
            if (file_put_contents($path, $realImg)) {
                return true;
                exit;
            }
        }

        return false;
    }

    public static function generateToken($data)
    {
        return md5(md5(base64_encode(md5($data))));
    }

    public static function generatePassword($data)
    {
        return md5(base64_encode(md5(base64_encode(md5(md5($data))))));
    }
    public static function generatePasswordEncodeTwoWay($data)
    {
        return base64_encode(base64_encode(base64_encode($data)));
    }
    public static function generatePasswordDecodeTwoWay($data)
    {
        return base64_decode(base64_decode(base64_decode($data)));
    }

    public static function transalateBulan($bulan)
    {
        $bulan = strtolower($bulan);
        switch ($bulan) {
            case 'january':
            case 1:
                return 'Januari';
                break;
            case 'february':
            case 2:
                return 'Februari';
                break;
            case 'march':
            case 3:
                return 'Maret';
                break;
            case 'april':
            case 4:
                return 'April';
                break;
            case 'mey':
            case 5:
                return 'Mey';
                break;
            case 'june':
            case 6:
                return 'Juni';
                break;
            case 'july':
            case 7:
                return 'Juli';
                break;
            case 'august':
            case 8:
                return 'Agustus';
                break;
            case 'september':
            case 9:
                return 'September';
                break;
            case 'october':
            case 10:
                return 'Oktober';
                break;
            case 'november':
            case 11:
                return 'November';
                break;
            case 'december':
            case 12:
                return 'Desember';
                break;
            default:
                return 'none';
        }
    }
}