<?php
/**
 * Created by PhpStorm.
 * User: thomaslarousse
 * Date: 18/03/2019
 * Time: 02:28
 */

namespace App\Utils;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleToPdf extends AbstractController
{
    /**
     * Render the article and transorm it to pdf then download it
     * @param $article
     */
    public function transformArticleToPdf($article, $title)
    {

        //Set Options
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        //Call Dompdf with the options
        $dompdf = new Dompdf($pdfOptions);

        //Setting the view to render
        $html = $this->renderView('article/show.html.twig', [
            'article' => $article
        ]);

        //Load the file
        $dompdf->loadHtml($html);

        $dompdf->render();

        //Download in the browser
        $dompdf->stream($title.".pdf", [
            "Attachment" => true
        ]);
    }
}