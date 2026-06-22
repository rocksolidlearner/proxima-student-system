<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter PDF Library
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category		Libraries
 * @author			Muhanz
 * @license			MIT License
 * @link			https://github.com/hanzzame/ci3-pdf-generator-library
 *
 */

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');

use Dompdf\Dompdf;

class Pdf
{
  public function create($html, $filename)
  {
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->set_option('isRemoteEnabled', true);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    // $dompdf->stream($filename . '.pdf', array("Attachment" => 1));
    $output = $dompdf->output();
    file_put_contents('uploads/pdf_files/'.$filename . '.pdf', $output);
  }

  public function create_fee($html, $filename)
  {
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->set_option('isRemoteEnabled', true);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    // $dompdf->stream($filename . '.pdf', array("Attachment" => 1));
    $output = $dompdf->output();
    file_put_contents('uploads/pdf_fee/'.$filename . '.pdf', $output);
  }
}
