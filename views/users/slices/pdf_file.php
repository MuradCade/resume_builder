<?php 
require '../../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $data = ;
    $data = $_POST['data'];

    // ✅ Add CSS to hide elements in the PDF
    $data = "<style>
                button {
                    display: none !important;
                }
           .title{
        font-weight: 700;
        letter-spacing: 0.5px;
      }
      .space{
        /* font-size: 18px; */
        /* font-weight: bold; */
        margin-left:10px;
        margin-top:10px;
        margin-bottom: -5px;
      }
      .alltitle{
        font-size: 20px;
        font-weight: 600;
        letter-spacing: 0.5px;
      }
      .subtitle{
        font-size: 13px !important;
        font-weight: 500;
      }
        h6{
        margin-bottom:0px !important;
}

                
            </style>" . $data;
    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $dompdf = new Dompdf($options);

    // Load the HTML content from AJAX
    $dompdf->loadHtml($data);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // ✅ Define the directory and file path
    $directory = "../../../generated_files/";
    $pdfFilePath = $directory . "document.pdf";

    // ✅ Check if the directory exists, create it if not
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true); // Creates directory with full permissions
    }

    // ✅ Save the PDF file
    file_put_contents($pdfFilePath, $dompdf->output());

    // ✅ Return the file path as a response to AJAX
    echo json_encode(["file" => $pdfFilePath]);
}
?>
